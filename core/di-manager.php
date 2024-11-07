<?php
class DIManager
{

    public function __construct() {}

    public function resolve(string $class)
    {

        $reflectionClass = new ReflectionClass($class);

        $constructor = $reflectionClass->getConstructor();

        //yapıcı metod yoksa nesnesi de yoktur. nesne olşutur
        if ($constructor === null) {
            return $reflectionClass->newInstance();
        }

        //yapıcının parametreleri alınır yoksa yeni nesne olştur
        $params = $constructor->getParameters();
        if ($params === []) {
            return $reflectionClass->newInstance();
        }

        //parametrelerin türüne göre bak. parametreler çözülür
        $newInstanceParams = [];
        foreach ($params as $param) {
            
            if( $param->getClass() != null){
                // parametre sınıf türünde ise o sınıf için adımları tekrarla
                $newInstanceParams[] = $this->resolve($param->getClass()->getName());
            }
        }

        return $reflectionClass->newInstanceArgs(
            $newInstanceParams
        );
    }
}

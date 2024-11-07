<?php
class DIManager
{
    /**
     * @var Object[] $instances
     */
    private $instances = [];

    public function __construct() {}

    private function findInstance(string $className): Object | null {
        $instanceResult = null;
        foreach($this->instances as $instance) {
            if(get_class($instance) === $className){
                $instanceResult = $instance;
            }
        }

        return $instanceResult;
    }

    public function resolve(string $className)
    {

        $instance = $this->findInstance($className);
        if($instance){
            return $instance;
        }

        $reflectionClass = new ReflectionClass($className);

        $constructor = $reflectionClass->getConstructor();

        //yapıcı metod yoksa nesnesi de yoktur. nesne olşutur
        if ($constructor === null) {
            $generatedInstance = $reflectionClass->newInstance();
            $this->instances[] = $generatedInstance;
            return $generatedInstance;
        }
        //yapıcının parametreleri alınır yoksa yeni nesne olştur / bağımlılığı olamamış oluyor parametre yoksa
        $params = $constructor->getParameters();
        if ($params === []) {
            $generatedInstance = $reflectionClass->newInstance();
            $this->instances[] = $generatedInstance;

            return $generatedInstance;
        }

        //parametrelerin türüne göre bak. parametreler çözülür
        $newInstanceParams = [];
        foreach ($params as $param) {
            
            if( $param->getClass() != null){
                // parametre sınıf türünde ise o sınıf için adımları tekrarla
                $newInstanceParams[] = $this->resolve($param->getClass()->getName());
            }
        }

        $generatedInstance = $reflectionClass->newInstanceArgs(
            $newInstanceParams
        );

        $this->instances[] = $generatedInstance;

        return $generatedInstance;
    }
}

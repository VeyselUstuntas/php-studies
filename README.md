
# PHP Studies

Bu proje, PHP ile çeşitli uygulama örnekleri geliştirmek ve PHP'nin temel ve ileri düzey konularını keşfetmek amacıyla tasarlanmıştır. Nesne Yönelimli Programlama, algoritmalar, bağımlılık enjeksiyonu (DI), middleware, routing, composer, reflection class ve event gibi konulara odaklanılmıştır.

## İçindekiler
1. [Genel Bakış](#genel-bakış)
2. [Kullanılan Teknolojiler](#kullanılan-teknolojiler)
3. [Proje Yapısı](#proje-yapısı)
4. [Kurulum](#kurulum)
5. [Özellikler](#özellikler)
6. [Kullanım](#kullanım)
7. [Katkıda Bulunma](#katkıda-bulunma)
8. [Lisans](#lisans)

## Genel Bakış
Bu proje, PHP ile çeşitli yapıların ve tasarım desenlerinin bir demosudur. Router, middleware, DI gibi bileşenler kullanarak PHP uygulamalarında en iyi uygulamalar ve verimli yapılar gösterilmektedir.

## Kullanılan Teknolojiler
- **PHP 8**: Temel geliştirme dili.
- **Nesne Yönelimli Programlama (OOP)**: Modülerlik ve ölçeklenebilirlik sağlamak için.
- **Özel Bağımlılık Enjeksiyonu (DI)**: Kontrolcülerde bağımlılıkları otomatik çözümleyen özel DI sistemi.
- **Middleware Stack**: İstek günlüğe alma, veri işleme ve JSON encode işlemlerini gerçekleştiren middleware yapısı.
- **Routing Sistemi**: Route tanımları ve middleware işleyişi ile GET/POST desteği.
- **PHP Dahili Sunucu**: Yerel geliştirme/test için.
- **Composer**: Projeye gerekli bağımlılıkları yüklemek için.

## Proje Yapısı
Proje dosya yapısı şu şekildedir:

### Ana Bileşenler
- **Router.php**: Route tanımları, GET/POST işlemleri ve middleware’leri yönetir.
- **DIManager.php**: Yansıma (reflection) kullanarak bağımlılıkları otomatik çözen özel DI sistemi.
- **Middleware**: İstek günlüğe alma, sipariş işleme ve JSON encode işlemlerini gerçekleştiren middleware sınıfları.

## Kurulum
1. Bu projeyi klonlayın:
    ```bash
    git clone https://github.com/VeyselUstuntas/php-studies.git
    ```
2. Proje dizinine gidin:
    ```bash
    cd php-studies
    ```
3. Composer ile bağımlılıkları yükleyin:
    ```bash
    composer install
    ```
4. PHP dahili sunucuyu başlatın:
    ```bash
    php -S localhost:8000 -t public
    ```

## Özellikler
- **Özel Routing Sistemi**: GET/POST yöntemleri için middleware destekli route kaydı.
- **Middleware Stack**: İstek verilerini günlüğe alma, sipariş işleme ve JSON encode etme işlemlerini içerir.
- **Algoritmalar**: Fibonacci ve asal sayı gibi klasik algoritma örnekleri içerir.
- **DI Sistemi**: Yansıma kullanarak bağımlılıkları otomatik olarak kontrolcülere enjekte eder.

## Kullanım
1. Sunucuyu başlattıktan sonra tarayıcınızda [http://localhost](http://localhost) adresine gidin.
2. Middleware işleyişini görmek ve özellikleri keşfetmek için belirli route’ları test edin.
3. İlgili route’ları ve middleware’leri projenizi genişletmek için düzenleyin.

### Örnek Route
Sipariş işleme rotasını test etmek için:
```bash
http://localhost:8000/orders
```

## Katkıda Bulunma
Bu projeye katkıda bulunmak için pull request gönderebilirsiniz.

## Lisans
MIT Lisansı.

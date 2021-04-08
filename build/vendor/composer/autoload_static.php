<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfb80eb8e6c481fa9157dbd5f389dad5e
{
    public static $files = array (
        'be8785f285476d960a9374d1a827f21a' => __DIR__ . '/..' . '/pinkcrab/hook-loader/tests/Fixtures/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PinkCrab\\Headless_Blog\\Tests\\' => 29,
            'PinkCrab\\Headless_Blog\\' => 23,
            'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\' => 38,
            'PC_Headless_Blog_1AA\\Psr\\Container\\' => 35,
            'PC_Headless_Blog_1AA\\PinkCrab\\Registerables\\' => 44,
            'PC_Headless_Blog_1AA\\PinkCrab\\Loader\\' => 37,
            'PC_Headless_Blog_1AA\\PinkCrab\\HTTP\\' => 35,
            'PC_Headless_Blog_1AA\\PinkCrab\\Enqueue\\' => 38,
            'PC_Headless_Blog_1AA\\PinkCrab\\Core\\' => 35,
            'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\' => 33,
            'PC_Headless_Blog_1AA\\Nyholm\\Psr7Server\\' => 39,
            'PC_Headless_Blog_1AA\\Http\\Message\\' => 34,
            'PC_Headless_Blog_1AA\\Gin0115\\WPUnit_Helpers\\' => 44,
            'PC_Headless_Blog_1AA\\Dice\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PinkCrab\\Headless_Blog\\Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../tests',
        ),
        'PinkCrab\\Headless_Blog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../src',
        ),
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'PC_Headless_Blog_1AA\\Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'PC_Headless_Blog_1AA\\PinkCrab\\Registerables\\' => 
        array (
            0 => __DIR__ . '/..' . '/pinkcrab/registerables/src',
        ),
        'PC_Headless_Blog_1AA\\PinkCrab\\Loader\\' => 
        array (
            0 => __DIR__ . '/..' . '/pinkcrab/hook-loader/src',
        ),
        'PC_Headless_Blog_1AA\\PinkCrab\\HTTP\\' => 
        array (
            0 => __DIR__ . '/..' . '/pinkcrab/http/src',
        ),
        'PC_Headless_Blog_1AA\\PinkCrab\\Enqueue\\' => 
        array (
            0 => __DIR__ . '/..' . '/pinkcrab/enqueue/src',
        ),
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\' => 
        array (
            0 => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src',
        ),
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/nyholm/psr7/src',
        ),
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7Server\\' => 
        array (
            0 => __DIR__ . '/..' . '/nyholm/psr7-server/src',
        ),
        'PC_Headless_Blog_1AA\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/message-factory/src',
        ),
        'PC_Headless_Blog_1AA\\Gin0115\\WPUnit_Helpers\\' => 
        array (
            0 => __DIR__ . '/..' . '/pinkcrab/registerables/WPUnit_Helpers',
        ),
        'PC_Headless_Blog_1AA\\Dice\\' => 
        array (
            0 => __DIR__ . '/..' . '/level-2/dice',
        ),
    );

    public static $classMap = array (
        'PC_Headless_Blog_1AA\\Dice\\Dice' => __DIR__ . '/..' . '/level-2/dice/Dice.php',
        'PC_Headless_Blog_1AA\\Dice\\Extra\\RuleValidator' => __DIR__ . '/..' . '/level-2/dice/Extra/RuleValidator.php',
        'PC_Headless_Blog_1AA\\Dice\\Loader\\Xml' => __DIR__ . '/..' . '/level-2/dice/Loader/Xml.php',
        'PC_Headless_Blog_1AA\\Http\\Message\\MessageFactory' => __DIR__ . '/..' . '/php-http/message-factory/src/MessageFactory.php',
        'PC_Headless_Blog_1AA\\Http\\Message\\RequestFactory' => __DIR__ . '/..' . '/php-http/message-factory/src/RequestFactory.php',
        'PC_Headless_Blog_1AA\\Http\\Message\\ResponseFactory' => __DIR__ . '/..' . '/php-http/message-factory/src/ResponseFactory.php',
        'PC_Headless_Blog_1AA\\Http\\Message\\StreamFactory' => __DIR__ . '/..' . '/php-http/message-factory/src/StreamFactory.php',
        'PC_Headless_Blog_1AA\\Http\\Message\\UriFactory' => __DIR__ . '/..' . '/php-http/message-factory/src/UriFactory.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7Server\\ServerRequestCreator' => __DIR__ . '/..' . '/nyholm/psr7-server/src/ServerRequestCreator.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7Server\\ServerRequestCreatorInterface' => __DIR__ . '/..' . '/nyholm/psr7-server/src/ServerRequestCreatorInterface.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\Factory\\HttplugFactory' => __DIR__ . '/..' . '/nyholm/psr7/src/Factory/HttplugFactory.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\Factory\\Psr17Factory' => __DIR__ . '/..' . '/nyholm/psr7/src/Factory/Psr17Factory.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\MessageTrait' => __DIR__ . '/..' . '/nyholm/psr7/src/MessageTrait.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\Request' => __DIR__ . '/..' . '/nyholm/psr7/src/Request.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\RequestTrait' => __DIR__ . '/..' . '/nyholm/psr7/src/RequestTrait.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\Response' => __DIR__ . '/..' . '/nyholm/psr7/src/Response.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\ServerRequest' => __DIR__ . '/..' . '/nyholm/psr7/src/ServerRequest.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\Stream' => __DIR__ . '/..' . '/nyholm/psr7/src/Stream.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\UploadedFile' => __DIR__ . '/..' . '/nyholm/psr7/src/UploadedFile.php',
        'PC_Headless_Blog_1AA\\Nyholm\\Psr7\\Uri' => __DIR__ . '/..' . '/nyholm/psr7/src/Uri.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Application\\App' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Application/App.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Application\\App_Config' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Application/App_Config.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Application\\App_Factory' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Application/App_Factory.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Application\\App_Validation' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Application/App_Validation.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Application\\Config' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Application/Config.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Application\\Hooks' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Application/Hooks.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Collection\\Collection' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Collection/Collection.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Collection\\Traits\\Indexed' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Collection/Traits/Indexed.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Collection\\Traits\\JsonSerialize' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Collection/Traits/JsonSerialize.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Collection\\Traits\\Sequence' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Collection/Traits/Sequence.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Exceptions\\App_Initialization_Exception' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Exceptions/App_Initialization_Exception.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Exceptions\\DI_Container_Exception' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Exceptions/DI_Container_Exception.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Interfaces\\DI_Container' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Interfaces/DI_Container.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Interfaces\\Registerable' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Interfaces/Registerable.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Interfaces\\Registration_Middleware' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Interfaces/Registration_Middleware.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Interfaces\\Renderable' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Interfaces/Renderable.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Interfaces\\Service_Container' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Interfaces/Service_Container.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Services\\Dice\\PinkCrab_Dice' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Services/Dice/PinkCrab_Dice.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Services\\Registration\\Middleware\\Registerable_Middleware' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Services/Registration/Middleware/Registerable_Middleware.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Services\\Registration\\Registration_Service' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Services/Registration/Registration_Service.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Services\\View\\PHP_Engine' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Services/View/PHP_Engine.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Core\\Services\\View\\View' => __DIR__ . '/..' . '/pinkcrab/plugin-framework/src/Services/View/View.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Enqueue\\Enqueue' => __DIR__ . '/..' . '/pinkcrab/enqueue/src/Enqueue.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\HTTP\\HTTP' => __DIR__ . '/..' . '/pinkcrab/http/src/HTTP.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\HTTP\\HTTP_Helper' => __DIR__ . '/..' . '/pinkcrab/http/src/HTTP_Helper.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Loader\\Hook_Collection' => __DIR__ . '/..' . '/pinkcrab/hook-loader/src/Hook_Collection.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Loader\\Hook_Removal' => __DIR__ . '/..' . '/pinkcrab/hook-loader/src/Hook_Removal.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Loader\\Loader' => __DIR__ . '/..' . '/pinkcrab/hook-loader/src/Loader.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Registerables\\Ajax' => __DIR__ . '/..' . '/pinkcrab/registerables/src/Ajax.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Registerables\\MetaBox' => __DIR__ . '/..' . '/pinkcrab/registerables/src/MetaBox.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Registerables\\Post_Type' => __DIR__ . '/..' . '/pinkcrab/registerables/src/Post_Type.php',
        'PC_Headless_Blog_1AA\\PinkCrab\\Registerables\\Taxonomy' => __DIR__ . '/..' . '/pinkcrab/registerables/src/Taxonomy.php',
        'PC_Headless_Blog_1AA\\Psr\\Container\\ContainerExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerExceptionInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Container\\ContainerInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Container\\NotFoundExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/NotFoundExceptionInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\MessageInterface' => __DIR__ . '/..' . '/psr/http-message/src/MessageInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\RequestFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/RequestFactoryInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\RequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/RequestInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\ResponseFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/ResponseFactoryInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\ResponseInterface' => __DIR__ . '/..' . '/psr/http-message/src/ResponseInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\ServerRequestFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/ServerRequestFactoryInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\ServerRequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/ServerRequestInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\StreamFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/StreamFactoryInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\StreamInterface' => __DIR__ . '/..' . '/psr/http-message/src/StreamInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\UploadedFileFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/UploadedFileFactoryInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\UploadedFileInterface' => __DIR__ . '/..' . '/psr/http-message/src/UploadedFileInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\UriFactoryInterface' => __DIR__ . '/..' . '/psr/http-factory/src/UriFactoryInterface.php',
        'PC_Headless_Blog_1AA\\Psr\\Http\\Message\\UriInterface' => __DIR__ . '/..' . '/psr/http-message/src/UriInterface.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfb80eb8e6c481fa9157dbd5f389dad5e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfb80eb8e6c481fa9157dbd5f389dad5e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfb80eb8e6c481fa9157dbd5f389dad5e::$classMap;

        }, null, ClassLoader::class);
    }
}

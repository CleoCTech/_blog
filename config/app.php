<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Variables
    |--------------------------------------------------------------------------
    |*/
    'reportsPath' => 'storage/reports/',
    'storagePaths' => [
        'users' => [
            'profPics' => ["storePath" => "users/prof_pics/","readPath" => "/storage/users/prof_pics/",'disk' => "public"],
        ],
        'industries' => [
            'cover_images' => ["storePath" => "industries/cover_images/","readPath" => "/storage/industries/cover_images/",'disk' => "public"],
        ],
        'solutions' => [
            'cover_images' => ["storePath" => "solutions/cover_images/","readPath" => "/storage/solutions/cover_images/",'disk' => "public"],
        ],
        'posts' => [
            'posts' => ["storePath" => "posts/cover_images/","readPath" => "/storage/posts/cover_images/",'disk' => "public"],
        ],
        'steps' => [
            'cover_images' => ["storePath" => "steps/cover_images/","readPath" => "/storage/steps/cover_images/",'disk' => "public"],
        ],
        'clients' => [
            'logos' => ["storePath" => "clients/logos/","readPath" => "/storage/clients/logos/",'disk' => "public"],
        ],
        'sectionimages' => [
            'cover_images' => ["storePath" => "sectionimages/cover_images/","readPath" => "/storage/sectionimages/cover_images/",'disk' => "public"],
        ],
        'adverts' => [
            'cover_images' => ["storePath" => "adverts/cover_images/","readPath" => "/storage/adverts/cover_images/",'disk' => "public"],
        ],
        'companyInfo' => [
            'images' => ["storePath" => "companyInfo/images/","readPath" => "/storage/companyInfo/images/",'disk' => "public"],
            'manager' => ["storePath" => "companyInfo/manager/","readPath" => "/storage/companyInfo/manager/",'disk' => "public"],
        ],
        'adminAttachments' => [
            'attachments' => ["storePath" => "attachments/admin/","readPath" => "/storage/attachments/admin/",'disk' => "public"],
        ],
    ],
    'defaultErrors' => [
        'default' => 'Oops! something went wrong. If the error persists, kindly contact us for help.',
        'permission' => 'Oops! authorization failed.',
        'crud' => [
            'created' => 'Record created successfully',
            'updated' => 'Record updated successfully',
            'deleted' => 'Record Deleted successfully',
        ],
    ],
    'maxRecsPerPage' => 30,

    'company' => [
        'name' => env('COMPANY_NAME'),
        'shortName' => env('COMPANY_SHORT_NAME'),
        'website' => env('APP_URL'),
        'COMPANY_PASS' => 'adm1n#2023',
        'COMPANY_USER' => 'DNS',
        'COMPANY_EMAIL' => 'info@dailynotifications.com',
    ],
    'developer' => [
        'name' => env('DEV_COMPANY_NAME', 'Wenla Systems & Solutions Ltd.'),
        'shortName' => env('DEV_COMPANY_SHORT_NAME', ''),
        'website' => env('DEV_URL', 'http://wenlasystems.com/'),
        'DEV_PASS' => '@dm1n321#',
        'DEV_USER' => 'Wenla Systems',
        'DEV_EMAIL' => 'admin@wenlasystems.com',
    ],
    'metaDescription' => env('COMPANY_NAME')." gives you an insightful articles on a variety of topics, from technology to lifestyle and everything in between. Join our community of avid readers and engage in thought-provoking discussions. Visit us today and stay informed, inspired, and entertained.",
    'metaKeywords' => '',
    'serverType' => env('SERVER_TYPE'),

    
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\FortifyServiceProvider::class,
        App\Providers\JetstreamServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
    ])->toArray(),

];

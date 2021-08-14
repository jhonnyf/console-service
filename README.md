# Console Service
Console service by laravel

Terminal

```sh
php artisan vendor:publish --tag=migrations --force
```

```sh
php artisan vendor:publish --tag=public --force
```

```sh
php artisan storage:link
```

# Laravel excel

config/app.php

'providers' => [
    /*
     * Package Service Providers...
     */
    Maatwebsite\Excel\ExcelServiceProvider::class,
]

'aliases' => [
    ...
    'Excel' => Maatwebsite\Excel\Facades\Excel::class,
]

Terminal

```sh
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
```
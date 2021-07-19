# console-service
Console service by laravel


php artisan vendor:publish --tag=migrations --force

php artisan vendor:publish --tag=public --force

php artisan storage:link

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

php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
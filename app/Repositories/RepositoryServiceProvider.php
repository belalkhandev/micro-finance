<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $models = [
            'User' => 'User',
        ];

        foreach ($models as $dir => $model) {
            if (!is_int($dir)) {
                $this->app->bind("App\Repositories\\{$dir}\\{$model}RepositoryInterface", "App\Repositories\\{$dir}\\{$model}Repository");
            } else {
                $this->app->bind("App\Repositories\\{$model}RepositoryInterface", "App\Repositories\\{$model}Repository");
            }
        }
    }
}

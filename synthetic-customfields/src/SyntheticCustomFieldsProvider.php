<?php

namespace SyntheticCustomFields;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Database\Eloquent\Builder;
// use SyntheticCustomFields\Models\CustomCollection;

class SyntheticCustomFieldsProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->publishes([
            __DIR__ . '/config/synthetic-customfields.php' => config_path('synthetic-customfields.php'),
        ], 'synthetic-customfields');
    }
}

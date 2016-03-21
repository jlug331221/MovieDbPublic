<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Custom validation field for testing greater than or equal to.
         */
        Validator::extend('greater_or_equal', function($attribute, $value, $parameters, $validator) {
            $comparison_field = $parameters[0];
            $data = $validator->getData();
            $comparison_value = $data[$comparison_field];
            return $value >= $comparison_value;
        });

        /**
         * Custom replacer for greater_or_equal error message. It replaces the comparison field.
         */
        Validator::replacer('greater_or_equal', function($message, $attribute, $rule, $parameters) {
            return str_replace(':comparison_field', $parameters[0], $message);
        });

        /**
         * Custom validation field for testing that one date occurs on or before another date.
         */
        Validator::extend('on_or_before', function($attribute, $value, $parameters, $validator) {
            $limit_field = $parameters[0];
            $data = $validator->getData();
            $limit_value = $data[$limit_field];
            return strtotime($value) <= strtotime($limit_value);
        });

        /**
         * Custom replacer for on_or_before error message. It replaces the limit field.
         */
        Validator::replacer('on_or_before', function($message, $attribute, $rule, $parameters) {
            return str_replace(':limit_field', $parameters[0], $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

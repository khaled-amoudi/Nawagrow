<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data) {
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        });

        Response::macro('fail', function ($status_code, $errors) {
            return response()->json([
                'status' => false,
                'error' => $errors,
            ], $status_code);
        });

        Response::macro('returnData', function ($data) {
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        });
    }
}

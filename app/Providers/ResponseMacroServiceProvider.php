<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
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
        Response::macro('success', function ($data, $message = 'Ok', $code = 200) {
            return response()->json([
                'status' => true,
                'message' => $message,
                'data' => $data,
            ], $code);
        });

        Response::macro('sendData', function ($data, $code = 200) {
            return response()->json([
                'data' => $data,
            ], $code);
        });

        Response::macro('sendResponse', function ($message, $result) {
            return response()->json([
                'message' => $message,
                'result' => $result,
            ]);
        });

        Response::macro('sendError', function ($message, $code = 404) {
            return response()->json([
                'message' => $message,
            ], $code);
        });

    }
}

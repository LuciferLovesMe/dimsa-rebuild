<?php

if (!function_exists('apiSuccess')) {
    function apiSuccess($data = null, $msg = null)
    {
        return response()->json([
            "status" => "success",
            "data" => $data,
            "message" => $msg
        ]);
    }
}

if (!function_exists('apiFailed')) {
    function apiFailed($msg = null, $data = null, $code = 500, $debug = null)
    {
        $res = [
            "status" => "failed",
            "data" => $data,
            "message" => $msg
        ];
        if (config('app.debug')) {
            $res['debug'] = $debug;
        }
        if ($code) {
            return response()->json($res, $code);
        }
        return response()->json($res);
    }
}

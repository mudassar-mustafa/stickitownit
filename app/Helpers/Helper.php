<?php

namespace App\Helpers;
class Helper
{
    public static function jsonMessage($success, $redirect_url = NULL, $input_message = NULL, $url_params = array()): \Illuminate\Http\JsonResponse
    {
        if ($success) {
            $message['type'] = 'Success';
            $message['message'] = 'Record successfully added';
            $message['icon'] = 'check';
        } else {
            $message['type'] = 'Error';
            $message['message'] = 'Unable to save record';
            $message['icon'] = 'warning';
        }
        if ($redirect_url !== NULL) {
            if (request()->has('save_button') && request()->input('save_button') === 'save_new') {
                $redirect_url .= '.create';
            }
            $message['redirect_url'] = route($redirect_url, $url_params);
        }
        if ($input_message !== NULL) {
            $message['message'] = $input_message;
        }
        return response()->json($message);
    }


}

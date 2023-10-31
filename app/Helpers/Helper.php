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

    public static function getGenerations($generationId){
        dd("sdasds");
        $curl = curl_init();
        $token = 'Bearer ' . config('services.leonardo')['LEONARDO_API_KEY'];
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://cloud.leonardo.ai/api/rest/v1/generations/c99e7e5a-01ba-4394-bf74-ba8c58e08290",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: $token"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response,true);
        }
    }

    public static function createGeneration(array $params){

        dd("11111");

        $curl = curl_init();
        $token = 'Bearer ' . config('services.leonardo')['LEONARDO_API_KEY'];
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://cloud.leonardo.ai/api/rest/v1/generations",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'height' => $params['height'],
                'modelId' => $params['modelId'],
                'prompt' => $params['prompt'],
                'width' => $params['width'],
                'num_images' => $params['num_images']
            ]),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: $token",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response,true);
        }
    }


}

<?php

namespace App\Services;

use App\Http\Enums\CommonEnum;
use Illuminate\Http\RedirectResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class UtilService
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $routeName
     * @param string $message
     * @return RedirectResponse
     */
    public function logErrorAndRedirectToBack(string $routeName, string $message): RedirectResponse
    {
        $this->logger->error("['". $routeName ."']: ". $message);
        return back()->with([
           'status' => CommonEnum::FAIL_STATUS,
           'message' => app()->environment('local') ? $message : CommonEnum::GENERAL_ERROR_MESSAGE
        ]);
    }

    /**
     * @param $statusCode
     * @param null $message
     * @param null $data
     * @param string $type
     * @return JsonResponse
     */
    public function makeResponse($statusCode, $message = null, $data = null, string $type = CommonEnum::FAIL_STATUS): JsonResponse
    {
        $response['data'] = $data;
        $response['code'] = $statusCode;
        $response['message'] = app()->environment('local') ? $message : CommonEnum::GENERAL_ERROR_MESSAGE;
        $response['status'] = $type;
        return response()->json($response, $statusCode);
    }
}

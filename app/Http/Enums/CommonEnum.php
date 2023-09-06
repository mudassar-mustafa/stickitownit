<?php

namespace App\Http\Enums;

class CommonEnum
{
    CONST DELETE_CONFIRMATION_MESSAGE = "Do you want to delete this?";
    CONST GENERAL_ERROR_MESSAGE = "Something went wrong, Try again.";
    CONST FORBIDDEN_ERROR_MESSAGE = "This transaction does not belong to specific Store.";
    CONST SUCCESS_STATUS = "success";
    CONST FAIL_STATUS = "error";
    CONST GENERAL_PASSWORD = "secret123";
    CONST FILE_SIZE = 10000;
    CONST IMAGES_SIZE = [[300,300]];
    CONST DEFAULT_PAGINATION_SIZE = 10;
}

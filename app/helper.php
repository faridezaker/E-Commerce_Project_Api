<?php
namespace Zaker\User\Helpers;

if (!function_exists('to_valid_mobile_number')) {
    function to_valid_mobile_number(string $mobile)
    {
        return $mobile = '+98' . substr($mobile, -10, 10);
    }
}

if (!function_exists('random_verification_code')) {
    function random_verification_code()
    {
        return  random_int(100000, 999999);
    }
}


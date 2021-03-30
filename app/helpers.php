<?php

if (!function_exists('authCustomer')) {
    function authCustomer()
    {
        return auth()->guard('customer')->user();
    }
}


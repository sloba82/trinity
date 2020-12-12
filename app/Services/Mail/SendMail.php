<?php

namespace App\Services\Mail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendMail
{

    public static function send(string $address, string $object,  array $data)
    {
        try {
            $object = '\App\Mail\\' . $object;
            Mail::to($address)->send(new $object($data));
        } catch (\Exception $exception) {
            Log::error('Error while sending email ' . $exception);
            return false;
        }
        return true;
    }

}

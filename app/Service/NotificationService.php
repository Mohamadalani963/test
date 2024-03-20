<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public static function sendNotification($data, $fcmTokens, $notification)
    {
        if (! is_null($fcmTokens)) {
            try {
                $fcm = Fcm()
                    ->to($fcmTokens) // $recipients must an array
                    ->data($data)->notification($notification)->enableResponseLog()
                    ->send();
                Log::info($fcm);
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}

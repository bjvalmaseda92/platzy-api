<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NotificationController extends Controller
{
    public function send()
    {
        Artisan::command(SendEmailVerificationNotification::class);

        return response()->json(["message" => "Reminders send successfully"]);
    }
}

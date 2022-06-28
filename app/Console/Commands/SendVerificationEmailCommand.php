<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendVerificationEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "send:reminder";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command description";

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        User::query()
            ->whereDate(
                "created_at",
                "=",
                Carbon::now()
                    ->subDays(7)
                    ->format("Y-m-d")
            )
            ->whereNull("email_verified_at")
            ->each(function (User $user) {
                // Equivalente a $this->notify(new VerifyEmail);
                $user->sendEmailVerificationNotification();
            });
    }
}

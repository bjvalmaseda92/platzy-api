<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NewsletterNotification;
use Illuminate\Console\Command;

class SendNewslatterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "send:newsletter {emails?*}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Send a email with the newsletter";

    public function handle()
    {
        $argumentsEmail = $this->argument("emails"); //obtengo los email que pasan como argumento

        $users = User::query(); // obtengos todos los usuarios

        if ($argumentsEmail) {
            $users->whereIn("email", $argumentsEmail);
        }

        $users->whereNotNull("email_verified_at"); //solo email verificados

        if ($count = $users->count()) {
            $this->info("Se enviaran {$count} correos");

            $bar = $this->output->createProgressBar($count);
            $bar->start();

            $users->each(function (User $user) use ($bar) {
                //enviando correo a cada usuario
                $user->notify(new NewsletterNotification());
                $bar->advance();
            });
            $bar->finish();
            $this->info("Correos enviados");
            return;
        }

        $this->info("No se enviaron correos");
    }
}

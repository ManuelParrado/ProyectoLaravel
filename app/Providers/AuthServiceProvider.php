<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Email Verification - YourExpenseApp')
                ->greeting('Hello!')
                ->line('Welcome to YourExpenseApp, the application for efficiently managing your expenses.')
                ->line('To activate your account and start using all the features, please verify your email address.')
                ->action('Verify Email', $url)
                ->line('Thank you for choosing YourExpenseApp. If you have any questions, feel free to contact our support team.')
                ->salutation('Regards, The YourExpenseApp Team');
        });
    }
}

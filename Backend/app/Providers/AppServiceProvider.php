<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-admin',function(User $user){
            return $user->role === 'admin'
           ? Response::allow() : Response::deny('Nincs jogosultságod az oldal megtekintéséhez!');
        });

        VerifyEmail::toMailUsing(function(object $notifiable,string $url){

            return (new MailMessage)
            ->subject('Email cím megerősítés')
            ->greeting('Kedves '.$notifiable->FullName.'!')
            ->line('Kérlek erősítsd meg az email címedet a lenti gombra kattintva!')
            ->action('Email cím megerősítése',$url)
            ->line('Ha nem te regisztráltál, kérjük, hagyd figyelmen kívül ezt az üzenetet.')
            ->salutation('Üdvözlettel, Scriptum');
        });



    }
}

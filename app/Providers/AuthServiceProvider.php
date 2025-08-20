<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

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
       // $this->registerPolicies();
        Gate::define('can-subscribe-to-event', function(User $user, Event $event) {
            if ($event->hasPassed()){
                return false;
            } 
            if ($event->isFull()){
                return false;
            } 
            if ($user->id == $event->user_id){
                return false;
            } 
            if ($user->subscribedEvents()->where('event_id', $event->id)->exists()){
                return false;
            } 
            return true;
        });
        
        Gate::define('is-subscribed-to-event', function(User $user, Event $event) {
            if ($user->subscribedEvents()->where('event_id', $event->id)->exists()){
                return false;
            } 
            return true;
        });
    }
}

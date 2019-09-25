<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });

        Gate::define("exists-product", function ($user, $productId) {
            $flag = false;
            dump($flag);
            dump($productId);
            if ($product = \DB::table('products')->where('id', $productId)->first()) {
                if ($product->price_main > 0 && $product->number > 0)
                    $flag = true;
            } else {
                //  $flag is false
            }
            return $flag;
        });
    }
}

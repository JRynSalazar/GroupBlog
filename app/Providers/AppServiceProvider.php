<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\PostComment;

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
        View::composer('*', function ($view) {
            $view->with('user', Auth::user()); 

            if (Auth::check()) {
                $user = Auth::user();
                $postCount = PostComment::where('user_id', $user->id)->count();
                $view->with('postCount', $postCount);
            } else {
               
                $view->with('postCount', 0);
            }
        });
    }
}

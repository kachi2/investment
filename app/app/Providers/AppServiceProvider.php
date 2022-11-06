<?php

namespace App\Providers;

use App\Http\View\Composers\AdminSidebarComposer;
use App\Http\View\Composers\AdminWarningComposer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\AgentActivity;
use App\Models\Agent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('*', function($view){
            if (Auth::guard('agent')->check()) {
            $activity = AgentActivity::where('agent_id', agent_user()->id)->latest()->first();
            $view->with('agent_activity', $activity);
            $img = Agent::where('id', agent_user()->id)->first();
            $view->with('user_profile',$img->img, );
            $view->with('working_hours',$img->working_hours);
            }
            });
        

        Schema::defaultStringLength(191);

        View::composer('admin.layouts.sidebar', AdminSidebarComposer::class);
        View::composer(['misc.message-admin'], AdminWarningComposer::class);

        Blade::directive('showError', function ($expression) {
            return "
                <?php if(\$errors->has($expression)): ?>
                    <div class=\"invalid-feedback\">
                        <?php echo e(\$errors->first($expression)); ?>
                    </div>
                <?php endif; ?>
            ";
        });

        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, current($parameters));
        });
    }
}

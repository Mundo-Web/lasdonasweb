<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\General;
use App\Models\Message;
use App\Models\PoliticaDatos;
use App\Models\TermsAndCondition;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        View::composer('auth.register', function ($view) {
            $termsAndCondicitions = TermsAndCondition::first();
            $politicas = PoliticaDatos::first() ?? new PoliticaDatos();
            $view->with(['politicas'=> $politicas , 'terminos' => $termsAndCondicitions]);
        });

        View::composer('components.public.footer', function ($view) {
            // Obtener los datos del footer
            $datosgenerales = General::all(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            // Pasar los datos a la vista
            $view->with('datosgenerales', $datosgenerales);
        });

        View::composer('components.public.header', function ($view) {
            // Obtener los datos del footer
            $submenucategorias = Category::with(['subcategories'])->where('status', true)->get(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            $submenucolecciones = Collection::all();
            $appUrl = env('APP_URL');
            // Pasar los datos a la vista
            $view
                ->with('submenucategorias', $submenucategorias)
                ->with('appUrl', $appUrl)
                ->with('submenucolecciones', $submenucolecciones)
                ->with('points', Auth::check() ? Auth::user()->points : 0);
        });

        View::composer('components.app.sidebar', function ($view) {
            // Obtener los datos del footer
            $mensajes = Message::where('is_read', '!=', 1)->where('status', '!=', 0)->count(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            // Pasar los datos a la vista
            $view->with('mensajes', $mensajes);
        });

        PaginationPaginator::useTailwind();
    }
}

<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\General;
use App\Models\Message;
use App\Models\Ordenes;
use App\Models\PoliticaDatos;
use App\Models\PolyticsCondition;
use App\Models\TermsAndCondition;
use App\Models\TipoFlor;
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
            $categories = Category::where('status', true)->where('visible', true)->get();
            $politicDev = PolyticsCondition::first();
            $termsAndCondicitions = TermsAndCondition::first();
            $bioseguridad = PoliticaDatos::first();
            $view
            ->with('datosgenerales', $datosgenerales)
            ->with('categories', $categories)
            ->with([ 'politicas' => $politicDev, 'terminos' => $termsAndCondicitions , 'bioseguridad' => $bioseguridad]);
        });

        View::composer('components.public.header', function ($view) {
            // Obtener los datos del footer
            $submenucategorias = Category::with(['subcategories'])->where('status', true)->get(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            $submenucolecciones = Collection::all();
            $appUrl = env('APP_URL');
            $tipoFlores = TipoFlor::select('tipo_flors.*')->join('products', 'products.tipo_flor_id', '=', 'tipo_flors.id')->where('tipo_flors.status', '=', 1)->groupBy('tipo_flors.id')->get();
            // Pasar los datos a la vista
            $view
                ->with('tipoFlores', $tipoFlores)
                ->with('submenucategorias', $submenucategorias)
                ->with('appUrl', $appUrl)
                ->with('submenucolecciones', $submenucolecciones)
                ->with('points', Auth::check() ? Auth::user()->points : 0);
        });

        View::composer('components.app.sidebar', function ($view) {
            $salesCount = Ordenes::where('status_id', 3)->count();
            // Obtener los datos del footer
            $mensajes = Message::where('is_read', '!=', 1)->where('status', '!=', 0)->count(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            // Pasar los datos a la vista
            $view->with('mensajes', $mensajes)
            ->with('salesCount', $salesCount);
        });

        PaginationPaginator::useTailwind();
    }
}

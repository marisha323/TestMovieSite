<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */

    public function handle(Request $request, Closure $next)
    {
        // Отримуємо параметр locale з URL, якщо він є
        $locale = $request->get('locale');

        // Список підтримуваних мов
        $supportedLocales = ['en', 'uk'];

        // Якщо локаль передана і вона є в списку підтримуваних мов
        if ($locale && in_array($locale, $supportedLocales)) {
            // Зберігаємо локаль у сесії
            session(['locale' => $locale]);

            // Встановлюємо локаль додатку
            app()->setLocale($locale);
        } elseif (session('locale')) {
            // Якщо локаль є в сесії, встановлюємо її
            app()->setLocale(session('locale'));
        }

        return $next($request);

    }
}

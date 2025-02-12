<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPlanLimits
{
    public function handle(Request $request, Closure $next, $type)
    {
        $user = auth()->user();
        
        if (!$user->plan) {
            return redirect()->route('plans.index')
                ->with('error', 'Você precisa contratar um plano para realizar esta ação.');
        }

        switch ($type) {
            case 'anuncios':
                if ($user->anuncios()->count() >= $user->plan->max_ads) {
                    return redirect()->back()
                        ->with('error', 'Você atingiu o limite de anúncios do seu plano.');
                }
                break;
            
            case 'fotos':
                // Implementar verificação de fotos
                break;
                
            case 'videos':
                // Implementar verificação de vídeos
                break;
        }

        return $next($request);
    }
} 
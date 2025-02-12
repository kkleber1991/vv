<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanSubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:acompanhante']);
    }

    public function subscribe(Request $request, Plan $plan)
    {
        $user = Auth::user();
        
        // Verifica se o usuário já tem um plano ativo e não é o plano Free
        if ($user->plan_id && $user->plan->price > 0) {
            return redirect()->back()
                ->with('error', 'Você já possui um plano ativo. Entre em contato com o suporte para alterá-lo.');
        }

        // Atualiza o plano do usuário
        $user->update([
            'plan_id' => $plan->id
        ]);

        return redirect()->route('dashboard')
            ->with('success', "Plano {$plan->name} contratado com sucesso!");
    }

    public function showSubscriptionForm(Plan $plan)
    {
        if (!Auth::user()->hasRole('acompanhante')) {
            return redirect()->route('plans.index')
                ->with('error', 'Apenas acompanhantes podem contratar planos.');
        }

        return view('plans.subscribe', compact('plan'));
    }
} 
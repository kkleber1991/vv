<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Models\Anuncio;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Métricas de Usuários
        $totalUsers = User::count();
        $totalAcompanhantes = User::role('acompanhante')->count();
        $totalClientes = User::role('cliente')->count();
        $usuariosUltimos30Dias = User::where('created_at', '>=', now()->subDays(30))->count();

        // Métricas de Anúncios
        $totalAnuncios = Anuncio::count();
        $anunciosAtivos = Anuncio::where('status', 'ativo')->count();
        $anunciosDestaque = Anuncio::where('is_destaque', true)->count();
        $anunciosUltimos30Dias = Anuncio::where('created_at', '>=', now()->subDays(30))->count();

        // Métricas de Planos
        $planosAtivos = DB::table('users')
            ->join('plans', 'users.plan_id', '=', 'plans.id')
            ->where('plans.price', '>', 0)
            ->count();
        
        $planoMaisPopular = Plan::withCount('users')
            ->orderBy('users_count', 'desc')
            ->first();

        // Distribuição de planos
        $distribuicaoPlanos = Plan::withCount('users')
            ->get()
            ->map(function ($plan) {
                return [
                    'name' => $plan->name,
                    'users' => $plan->users_count,
                ];
            });

        // Anúncios por cidade (top 5)
        $anunciosPorCidade = Anuncio::select('cidade', DB::raw('count(*) as total'))
            ->groupBy('cidade')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAcompanhantes',
            'totalClientes',
            'usuariosUltimos30Dias',
            'totalAnuncios',
            'anunciosAtivos',
            'anunciosDestaque',
            'anunciosUltimos30Dias',
            'planosAtivos',
            'planoMaisPopular',
            'distribuicaoPlanos',
            'anunciosPorCidade'
        ));
    }
} 
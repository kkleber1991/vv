<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plan;
use App\Models\Anuncio;
use App\Models\AnuncioView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            // Métricas para Admin
            $data = [
                'totalUsers' => User::count(),
                'totalAcompanhantes' => User::role('acompanhante')->count(),
                'totalClientes' => User::role('cliente')->count(),
                'usuariosUltimos30Dias' => User::where('created_at', '>=', now()->subDays(30))->count(),
                'totalAnuncios' => Anuncio::count(),
                'anunciosAtivos' => Anuncio::where('status', 'ativo')->count(),
                'anunciosDestaque' => Anuncio::where('is_destaque', true)->count(),
                'anunciosUltimos30Dias' => Anuncio::where('created_at', '>=', now()->subDays(30))->count(),
                'totalPosts' => DB::table('posts')->count(),
                'postsPublicados' => DB::table('posts')->where('status', 'published')->count(),
                'postsUltimos30Dias' => DB::table('posts')
                    ->where('created_at', '>=', now()->subDays(30))
                    ->count(),
                'planosAtivos' => DB::table('users')
                    ->join('plans', 'users.plan_id', '=', 'plans.id')
                    ->where('plans.price', '>', 0)
                    ->count(),
                'receitaMensal' => DB::table('users')
                    ->join('plans', 'users.plan_id', '=', 'plans.id')
                    ->where('plans.price', '>', 0)
                    ->sum('plans.price'),
                'distribuicaoPlanos' => Plan::withCount('users')
                    ->get()
                    ->map(function ($plan) {
                        return [
                            'name' => $plan->name,
                            'users' => $plan->users_count,
                        ];
                    }),
                'planoMaisPopular' => Plan::withCount('users')
                    ->orderBy('users_count', 'desc')
                    ->first(),
                'anunciosPorCidade' => Anuncio::select('cidade', DB::raw('count(*) as total'))
                    ->groupBy('cidade')
                    ->orderBy('total', 'desc')
                    ->limit(5)
                    ->get()
            ];
        } elseif ($user->hasRole('acompanhante')) {
            // Métricas para Acompanhante
            $anunciosIds = Anuncio::where('user_id', $user->id)->pluck('id');
            
            $data = [
                'totalAnuncios' => Anuncio::where('user_id', $user->id)->count(),
                'anunciosAtivos' => Anuncio::where('user_id', $user->id)
                    ->where('status', 'ativo')
                    ->count(),
                'anunciosDestaque' => Anuncio::where('user_id', $user->id)
                    ->where('is_destaque', true)
                    ->count(),
                'visualizacoes30Dias' => AnuncioView::whereIn('anuncio_id', $anunciosIds)
                    ->where('created_at', '>=', now()->subDays(30))
                    ->count(),
                'visualizacoesTotal' => AnuncioView::whereIn('anuncio_id', $anunciosIds)->count(),
                'visualizacoesHoje' => AnuncioView::whereIn('anuncio_id', $anunciosIds)
                    ->whereDate('created_at', today())
                    ->count(),
                'planoAtual' => $user->plan,
                'diasRestantes' => $user->plan_expires_at 
                    ? now()->diffInDays($user->plan_expires_at, false) 
                    : null
            ];
        } else {
            // Métricas para Cliente
            $data = [
                'anunciosVistos' => DB::table('anuncio_views')
                    ->where('user_id', $user->id)
                    ->count(),
                'anunciosFavoritos' => DB::table('favoritos')
                    ->where('user_id', $user->id)
                    ->count(),
                'ultimosAnuncios' => Anuncio::where('status', 'ativo')
                    ->latest()
                    ->take(5)
                    ->get()
            ];
        }

        return view('dashboard', compact('data'));
    }
} 
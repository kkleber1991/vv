<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function index()
    {
        // Lista de cidades (temporária - depois pode vir do banco de dados)
        $cidades = [
            'São Paulo',
            'Rio de Janeiro',
            'Belo Horizonte',
            'Salvador',
            'Brasília',
            'Curitiba',
            'Fortaleza',
            'Recife',
            'Porto Alegre',
            'Manaus'
        ];

        // Lista de categorias (temporária - depois pode vir do banco de dados)
        $categorias = [
            'Loiras',
            'Morenas',
            'Ruivas',
            'Trans',
            'Massagistas',
            'Iniciantes',
            'Premium'
        ];

        // Busca anúncios em destaque (com booster ativo)
        $anunciosDestaque = Anuncio::where('status', 'ativo')
            ->where('is_destaque', true)
            ->latest()
            ->take(4)
            ->get();

        // Busca anúncios normais
        $anuncios = Anuncio::where('status', 'ativo')
            ->where('is_destaque', false)
            ->latest()
            ->paginate(12);

        return view('anuncios.index', compact('anuncios', 'anunciosDestaque', 'cidades', 'categorias'));
    }

    public function show($slug)
    {
        $anuncio = Anuncio::where('slug', $slug)
            ->where('status', 'ativo')
            ->firstOrFail();

        return view('anuncios.show', compact('anuncio'));
    }
} 
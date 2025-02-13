<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Support\EstadosCidades;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function index(Request $request)
    {
        // Busca estados do EstadosCidades
        $estados = EstadosCidades::$estados;
        
        // Tipos disponíveis
        $tipos = [
            'mulher' => 'Mulher',
            'homem' => 'Homem',
            'trans' => 'Trans'
        ];
        
        // Serviços disponíveis
        $servicos = Anuncio::$servicosDisponiveis;

        // Faixas de valores
        $faixasValores = [
            '0-100' => 'Até R$ 100',
            '100-200' => 'R$ 100 - R$ 200',
            '200-300' => 'R$ 200 - R$ 300',
            '300-500' => 'R$ 300 - R$ 500',
            '500+' => 'Acima de R$ 500'
        ];

        // Query base
        $query = Anuncio::where('status', 'ativo');

        // Aplica os filtros
        if ($request->estado) {
            $query->where('estado', $request->estado);
        }

        if ($request->cidade) {
            $query->where('cidade', $request->cidade);
        }

        if ($request->tipo) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->servico) {
            $query->whereJsonContains('servicos', $request->servico);
        }

        if ($request->valor) {
            list($min, $max) = explode('-', $request->valor);
            if ($max === '+') {
                $query->where(function($q) use ($min) {
                    $q->where('valor_30min', '>=', $min)
                        ->orWhere('valor_1hr', '>=', $min)
                        ->orWhere('valor_2hr', '>=', $min)
                        ->orWhere('valor_3hr', '>=', $min);
                });
            } else {
                $query->where(function($q) use ($min, $max) {
                    $q->whereBetween('valor_30min', [$min, $max])
                        ->orWhereBetween('valor_1hr', [$min, $max])
                        ->orWhereBetween('valor_2hr', [$min, $max])
                        ->orWhereBetween('valor_3hr', [$min, $max]);
                });
            }
        }

        // Busca anúncios em destaque
        $anunciosDestaque = $query->clone()
            ->where('is_destaque', true)
            ->latest()
            ->take(4)
            ->get();

        // Busca anúncios normais
        $anuncios = $query->where('is_destaque', false)
            ->latest()
            ->paginate(12);

        return view('anuncios.index', compact(
            'anuncios',
            'anunciosDestaque',
            'estados',
            'tipos',
            'servicos',
            'faixasValores'
        ));
    }

    public function show($slug)
    {
        $anuncio = Anuncio::where('slug', $slug)
            ->where('status', 'ativo')
            ->firstOrFail();

        // Registra a visualização
        $anuncio->registerView();

        return view('anuncios.show', compact('anuncio'));
    }
} 
<?php

namespace App\Livewire\Anuncios;

use App\Models\Anuncio;
use Livewire\Component;
use Livewire\WithPagination;

class GerenciarAnuncios extends Component
{
    use WithPagination;

    // Campos básicos
    public $anuncioId;
    public $titulo;
    public $descricao;
    public $nome;
    public $idade;
    public $peso;
    public $tipo = 'mulher';
    public $nacionalidade = 'Brasileira';
    public $whatsapp;
    public $cidade;
    public $estado;
    public $status = 'ativo';
    public $isEditing = false;

    // Valores
    public $valor_30min;
    public $valor_1hr;
    public $valor_2hr;
    public $valor_3hr;

    // Horários
    public $horario_inicio;
    public $horario_fim;

    // Arrays de múltipla escolha
    public $servicos = [];
    public $extras = [];
    public $locais_atendimento = [];
    public $formas_pagamento = [];
    public $linguas = [];
    public $atende = [];

    protected $rules = [
        'titulo' => 'required|min:6',
        'descricao' => 'required|min:20',
        'nome' => 'required|min:2',
        'idade' => 'required|integer|min:18',
        'peso' => 'nullable|numeric|min:30|max:200',
        'tipo' => 'required|in:homem,mulher,trans',
        'nacionalidade' => 'required',
        'whatsapp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'cidade' => 'required',
        'estado' => 'required',
        'status' => 'required|in:ativo,inativo',
        'valor_30min' => 'nullable|numeric|min:0',
        'valor_1hr' => 'nullable|numeric|min:0',
        'valor_2hr' => 'nullable|numeric|min:0',
        'valor_3hr' => 'nullable|numeric|min:0',
        'horario_inicio' => 'required',
        'horario_fim' => 'required',
        'servicos' => 'required|array|min:1',
        'extras' => 'required|array|min:1',
        'locais_atendimento' => 'required|array|min:1',
        'formas_pagamento' => 'required|array|min:1',
        'linguas' => 'required|array|min:1',
        'atende' => 'required|array|min:1',
    ];

    public function save()
    {
        $this->validate();

        $data = [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'nome' => $this->nome,
            'idade' => $this->idade,
            'peso' => $this->peso,
            'tipo' => $this->tipo,
            'nacionalidade' => $this->nacionalidade,
            'whatsapp' => $this->whatsapp,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'status' => $this->status,
            'valor_30min' => $this->valor_30min,
            'valor_1hr' => $this->valor_1hr,
            'valor_2hr' => $this->valor_2hr,
            'valor_3hr' => $this->valor_3hr,
            'horario_inicio' => $this->horario_inicio,
            'horario_fim' => $this->horario_fim,
            'servicos' => $this->servicos,
            'extras' => $this->extras,
            'locais_atendimento' => $this->locais_atendimento,
            'formas_pagamento' => $this->formas_pagamento,
            'linguas' => $this->linguas,
            'atende' => $this->atende,
            'user_id' => auth()->id(),
        ];

        if ($this->isEditing) {
            $anuncio = Anuncio::find($this->anuncioId);
            if ($anuncio->user_id === auth()->id() || auth()->user()->can('editar anuncios')) {
                $anuncio->update($data);
            }
        } else {
            if (auth()->user()->can('criar anuncios')) {
                Anuncio::create($data);
            }
        }

        $this->reset();
        session()->flash('message', 'Anúncio salvo com sucesso!');
    }

    public function edit(Anuncio $anuncio)
    {
        if ($anuncio->user_id === auth()->id() || auth()->user()->can('editar anuncios')) {
            $this->anuncioId = $anuncio->id;
            $this->titulo = $anuncio->titulo;
            $this->descricao = $anuncio->descricao;
            $this->nome = $anuncio->nome;
            $this->idade = $anuncio->idade;
            $this->peso = $anuncio->peso;
            $this->tipo = $anuncio->tipo;
            $this->nacionalidade = $anuncio->nacionalidade;
            $this->whatsapp = $anuncio->whatsapp;
            $this->cidade = $anuncio->cidade;
            $this->estado = $anuncio->estado;
            $this->status = $anuncio->status;
            $this->valor_30min = $anuncio->valor_30min;
            $this->valor_1hr = $anuncio->valor_1hr;
            $this->valor_2hr = $anuncio->valor_2hr;
            $this->valor_3hr = $anuncio->valor_3hr;
            $this->horario_inicio = $anuncio->horario_inicio?->format('H:i');
            $this->horario_fim = $anuncio->horario_fim?->format('H:i');
            $this->servicos = $anuncio->servicos;
            $this->extras = $anuncio->extras;
            $this->locais_atendimento = $anuncio->locais_atendimento;
            $this->formas_pagamento = $anuncio->formas_pagamento;
            $this->linguas = $anuncio->linguas;
            $this->atende = $anuncio->atende;
            $this->isEditing = true;
        }
    }

    public function delete(Anuncio $anuncio)
    {
        if ($anuncio->user_id === auth()->id() || auth()->user()->can('excluir anuncios')) {
            $anuncio->delete();
            session()->flash('message', 'Anúncio excluído com sucesso!');
        }
    }

    public function render()
    {
        $anuncios = auth()->user()->hasRole('admin') 
            ? Anuncio::latest()->paginate(10)
            : Anuncio::where('user_id', auth()->id())->latest()->paginate(10);

        return view('livewire.anuncios.gerenciar-anuncios', [
            'anuncios' => $anuncios,
            'servicosDisponiveis' => Anuncio::$servicosDisponiveis,
            'extrasDisponiveis' => Anuncio::$extrasDisponiveis,
            'locaisAtendimentoDisponiveis' => Anuncio::$locaisAtendimentoDisponiveis,
            'formasPagamentoDisponiveis' => Anuncio::$formasPagamentoDisponiveis,
            'linguasDisponiveis' => Anuncio::$linguasDisponiveis,
            'atendeDisponiveis' => Anuncio::$atendeDisponiveis,
        ])->layout('layouts.app');
    }
} 
<?php

namespace App\Livewire\Anuncios;

use App\Models\Anuncio;
use Livewire\Component;
use Livewire\WithPagination;

class GerenciarAnuncios extends Component
{
    use WithPagination;

    public $titulo;
    public $descricao;
    public $valor;
    public $whatsapp;
    public $cidade;
    public $estado;
    public $status = 'ativo';
    public $anuncioId;
    public $isEditing = false;

    protected $rules = [
        'titulo' => 'required|min:6',
        'descricao' => 'required|min:20',
        'valor' => 'required|numeric|min:0',
        'whatsapp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'cidade' => 'required',
        'estado' => 'required',
        'status' => 'required|in:ativo,inativo'
    ];

    public function save()
    {
        $this->validate();

        $data = [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'valor' => $this->valor,
            'whatsapp' => $this->whatsapp,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'status' => $this->status,
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
            $this->valor = $anuncio->valor;
            $this->whatsapp = $anuncio->whatsapp;
            $this->cidade = $anuncio->cidade;
            $this->estado = $anuncio->estado;
            $this->status = $anuncio->status;
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
            'anuncios' => $anuncios
        ])->layout('layouts.app');
    }
} 
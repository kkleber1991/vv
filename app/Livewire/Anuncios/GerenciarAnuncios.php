<?php

namespace App\Livewire\Anuncios;

use App\Models\Anuncio;
use App\Models\AnuncioFoto;
use App\Models\AnuncioVideo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Support\EstadosCidades;

class GerenciarAnuncios extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Adicione esta propriedade
    public ?Anuncio $currentAnuncio = null;

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

    public $foto_principal;
    public $fotos = [];
    public $videos = [];
    public $fotosAtuais = [];
    public $videosAtuais = [];

    public $showLimitModal = false;
    public $limitMessage = '';

    // Adicione estas propriedades
    public $estados;
    public $cidades = [];

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
        'foto_principal' => 'nullable|image|max:2048', // 2MB max
        'fotos.*' => 'nullable|image|max:2048',
        'videos.*' => 'mimes:mp4,avi,mov|max:50000', // Validação para vídeos
    ];

    protected $messages = [
        'foto_principal.image' => 'O arquivo deve ser uma imagem.',
        'foto_principal.max' => 'A imagem não pode ter mais que 2MB.',
        'fotos.*.image' => 'Todos os arquivos devem ser imagens.',
        'fotos.*.max' => 'As imagens não podem ter mais que 2MB.',
        'videos.*.mimes' => 'O arquivo deve ser um vídeo (mp4, avi ou mov)',
        'videos.*.max' => 'O vídeo não pode ser maior que 50MB'
    ];

    public function mount()
    {
        // Verifica se o usuário tem um plano
        if (!auth()->user()->plan) {
            session()->flash('error', 'Você precisa escolher um plano para criar anúncios.');
            return redirect()->route('plans.index');
        }

        // Verifica o limite de anúncios
        $user = auth()->user();
        if ($user->anuncios()->count() >= $user->plan->max_ads) {
            $this->showLimitModal = true;
            $this->limitMessage = "Você atingiu o limite de {$user->plan->max_ads} anúncios do seu plano atual.";
        }

        // Inicializa os estados
        $this->estados = EstadosCidades::$estados;
    }

    public function updatedFotos()
    {
        $maxPhotos = auth()->user()->plan->max_photos;
        $currentPhotos = $this->isEditing ? $this->currentAnuncio->fotos()->count() : 0;
        
        if (count($this->fotos) + $currentPhotos > $maxPhotos) {
            $this->fotos = [];
            session()->flash('error', "Seu plano permite apenas {$maxPhotos} fotos por anúncio.");
        }
    }

    public function updatedEstado($value)
    {
        $this->cidade = ''; // Reseta a cidade selecionada
        if ($value) {
            $this->cidades = EstadosCidades::$cidades[$value] ?? [];
        } else {
            $this->cidades = [];
        }
    }

    public function updatedVideos()
    {
        $this->validate([
            'videos.*' => 'mimes:mp4,avi,mov|max:50000', // Validação para vídeos
        ], [
            'videos.*.mimes' => 'O arquivo deve ser um vídeo (mp4, avi ou mov)',
            'videos.*.max' => 'O vídeo não pode ser maior que 50MB'
        ]);
    }

    public function save()
    {
        $data = $this->validate([
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
            'foto_principal' => 'nullable|image|max:2048', // 2MB max
            'fotos.*' => 'nullable|image|max:2048',
            'videos.*' => 'mimes:mp4,avi,mov|max:50000', // Validação para vídeos
        ]);

        try {
            DB::beginTransaction();
            
            // Verifica os limites do plano
            $user = auth()->user();
            
            // Verifica se o usuário tem um plano
            if (!$user->plan) {
                session()->flash('error', 'Você precisa escolher um plano para criar anúncios.');
                return;
            }

            // Se estiver editando, não verifica o limite de anúncios
            if (!$this->isEditing && $user->anuncios()->count() >= $user->plan->max_ads) {
                session()->flash('error', 'Você atingiu o limite de anúncios do seu plano.');
                return;
            }

            // Verifica o limite total de fotos (existentes + novas)
            $totalFotos = count($this->fotosAtuais) + count($this->fotos);
            if ($totalFotos > $user->plan->max_photos) {
                session()->flash('error', 'Você excedeu o limite de fotos do seu plano.');
                return;
            }

            // Verifica o limite total de vídeos (existentes + novos)
            $totalVideos = count($this->videosAtuais) + count($this->videos);
            if ($totalVideos > $user->plan->max_videos) {
                session()->flash('error', 'Você excedeu o limite de vídeos do seu plano.');
                return;
            }

            $data['user_id'] = auth()->id();

            // Upload da foto principal
            if ($this->foto_principal && !is_string($this->foto_principal)) {
                if ($this->isEditing && $this->currentAnuncio->foto_principal) {
                    Storage::disk('public')->delete($this->currentAnuncio->foto_principal);
                }
                $data['foto_principal'] = $this->foto_principal->store('anuncios/fotos', 'public');
            } elseif ($this->isEditing) {
                // Mantém a foto principal existente removendo-a dos dados a serem atualizados
                unset($data['foto_principal']);
            }

            if ($this->isEditing) {
                $anuncio = Anuncio::find($this->anuncioId);
                if ($anuncio->user_id === auth()->id() || auth()->user()->can('editar anuncios')) {
                    $anuncio->update($data);
                    
                    // Upload das novas fotos
                    if ($this->fotos) {
                        foreach ($this->fotos as $foto) {
                            $anuncio->fotos()->create([
                                'path' => $foto->store('anuncios/fotos', 'public')
                            ]);
                        }
                    }

                    // Upload dos novos vídeos
                    if ($this->videos) {
                        foreach ($this->videos as $video) {
                            $videoPath = $video->store('anuncios/videos', 'public');
                            
                            $anuncio->videos()->create([
                                'path' => $videoPath
                            ]);
                        }
                    }

                    session()->flash('message', 'Anúncio atualizado com sucesso!');
                }
            } else {
                if (auth()->user()->can('criar anuncios')) {
                    $anuncio = Anuncio::create($data);
                    
                    // Upload das fotos
                    if ($this->fotos) {
                        foreach ($this->fotos as $foto) {
                            $anuncio->fotos()->create([
                                'path' => $foto->store('anuncios/fotos', 'public')
                            ]);
                        }
                    }

                    // Upload dos vídeos
                    if ($this->videos) {
                        foreach ($this->videos as $video) {
                            $videoPath = $video->store('anuncios/videos', 'public');
                            
                            $anuncio->videos()->create([
                                'path' => $videoPath
                            ]);
                        }
                    }

                    session()->flash('message', 'Anúncio criado com sucesso!');
                }
            }

            DB::commit();
            
            session()->flash('message', $this->isEditing ? 'Anúncio atualizado com sucesso!' : 'Anúncio criado com sucesso!');
            
            if (!$this->isEditing) {
                $this->reset();
                $this->currentAnuncio = null;
                return redirect()->route('anuncios.index');
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erro ao salvar o anúncio. Tente novamente.');
        }
    }

    public function edit(Anuncio $anuncio)
    {
        // Limpa qualquer estado anterior
        $this->reset();
        
        if ($anuncio->user_id === auth()->id() || auth()->user()->can('editar anuncios')) {
            // Inicializa os estados
            $this->estados = EstadosCidades::$estados;
            
            $this->currentAnuncio = $anuncio; // Armazena o anúncio atual
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
            
            // Carrega as cidades do estado selecionado
            if ($anuncio->estado) {
                $this->cidades = EstadosCidades::$cidades[$anuncio->estado] ?? [];
            }
            
            $this->status = $anuncio->status;
            $this->valor_30min = $anuncio->valor_30min;
            $this->valor_1hr = $anuncio->valor_1hr;
            $this->valor_2hr = $anuncio->valor_2hr;
            $this->valor_3hr = $anuncio->valor_3hr;
            $this->horario_inicio = $anuncio->horario_inicio?->format('H:i');
            $this->horario_fim = $anuncio->horario_fim?->format('H:i');
            $this->servicos = $anuncio->servicos ?? [];
            $this->extras = $anuncio->extras ?? [];
            $this->locais_atendimento = $anuncio->locais_atendimento ?? [];
            $this->formas_pagamento = $anuncio->formas_pagamento ?? [];
            $this->linguas = $anuncio->linguas ?? [];
            $this->atende = $anuncio->atende ?? [];
            
            // Carrega as fotos e vídeos existentes
            $this->fotosAtuais = $anuncio->fotos()->get();
            $this->videosAtuais = $anuncio->videos()->get();
            
            $this->isEditing = true;

            // Retorna false para evitar que o método save seja chamado
            return false;
        }
    }

    public function delete(Anuncio $anuncio)
    {
        if ($anuncio->user_id === auth()->id() || auth()->user()->can('excluir anuncios')) {
            $anuncio->delete();
            session()->flash('message', 'Anúncio excluído com sucesso!');
        }
    }

    public function removePhoto($index)
    {
        unset($this->fotos[$index]);
        $this->fotos = array_values($this->fotos);
    }

    public function removeVideo($index)
    {
        unset($this->videos[$index]);
        $this->videos = array_values($this->videos);
    }

    public function removeFoto($index)
    {
        unset($this->fotos[$index]);
        $this->fotos = array_values($this->fotos);
    }

    public function deleteFoto($id)
    {
        $foto = AnuncioFoto::find($id);
        if ($foto && $foto->anuncio->user_id === auth()->id()) {
            Storage::disk('public')->delete($foto->path);
            $foto->delete();
            // Atualiza a lista de fotos atuais sem salvar o anúncio
            $this->fotosAtuais = $this->currentAnuncio->fotos()->get();
        }
    }

    public function deleteVideo($id)
    {
        $video = AnuncioVideo::find($id);
        if ($video && $video->anuncio->user_id === auth()->id()) {
            Storage::disk('public')->delete($video->path);
            $video->delete();
            // Atualiza a lista de vídeos atuais sem salvar o anúncio
            $this->videosAtuais = $this->currentAnuncio->videos()->get();
        }
    }

    public function render()
    {
        // Se o usuário logado for o criador do anúncio ou admin, mostra o anúncio
        $anuncios = Anuncio::when(!auth()->user()->hasRole('admin'), function ($query) {
            return $query->where('user_id', auth()->id());
        })->latest()->paginate(10);

        return view('livewire.anuncios.gerenciar-anuncios', [
            'anuncios' => $anuncios,
            'servicosDisponiveis' => Anuncio::$servicosDisponiveis,
            'extrasDisponiveis' => Anuncio::$extrasDisponiveis,
            'locaisAtendimentoDisponiveis' => Anuncio::$locaisAtendimentoDisponiveis,
            'formasPagamentoDisponiveis' => Anuncio::$formasPagamentoDisponiveis,
            'linguasDisponiveis' => Anuncio::$linguasDisponiveis,
            'atendeDisponiveis' => Anuncio::$atendeDisponiveis,
            'estados' => $this->estados,
            'cidadesDisponiveis' => $this->cidades,
        ])->layout('layouts.app');
    }
} 
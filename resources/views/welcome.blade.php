@extends('layouts.app')

@section('title', 'Agenda de Eventos')

@section('content')
<header>
    <div class="container">
        <h1>Bem-vindo à nossa Agenda</h1>
        <p class="text-muted">Confira os eventos mais relevantes para sua comunidade</p>
    </div>
</header>

<div class="container py-4">

    <!-- Barra de Pesquisa -->
    <div class="search-box">
      <div class="input-group input-group-lg">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <form action="{{ route('events.index') }}" method="GET">  
            <input 
                type="text" 
                id="searchEvent" 
                name="searchEvent" 
                value="{{ old('searchEvent', $searchEvent ?? '') }}" 
                class="form-control" 
                placeholder="Pesquisar evento...">
        </form>
      </div>
    </div>

    <!-- Mensagens de busca -->
    <div class="container">
        @if($searchEvent && $events->count() > 0)
            <div class="text-center my-5 text-muted">
                <i class="bi bi-search fs-2 text-secondary mb-3"></i>
                <h5>Você está procurando por: <span class="text-dark fw-semibold">"{{ $searchEvent }}"</span></h5>
                <p class="small">{{ $events->count() }} evento(s) encontrado(s). 
                    <a href="{{ route('events.index') }}" class="text-decoration-none text-primary">Ver todos</a>
                </p>
            </div>
        @elseif($searchEvent && $events->count() == 0)
            <div class="text-center my-5 text-muted">
                <i class="bi bi-search fs-2 text-secondary mb-3"></i>
                <h5>Nenhum evento encontrado para: <span class="text-dark fw-semibold">"{{ $searchEvent }}"</span></h5>
                <p class="small">Tente outro termo. 
                    <a href="{{ route('events.index') }}" class="text-decoration-none text-primary">Ver todos eventos</a>
                </p>
            </div>
        @elseif(!$searchEvent && $events->count() == 0)
            <div class="text-center my-5 text-muted">
                <i class="bi bi-calendar-x fs-1 text-secondary mb-3"></i>
                <h4>Nenhum evento</h4>
                <p class="small">
                    Nenhum evento disponível no momento.
                    <a href="{{ route('events.create') }}" class="text-decoration-none text-primary">Criar evento</a>
                </p>
            </div>
        @endif
    </div>

    <!-- Lista de Eventos -->
    @if($events->count() > 0)
        <div class="container">
            @if(!$searchEvent)
            <h3>Próximos Eventos</h3>
            <p>Veja os eventos dos próximos dias</p>
            @endif
            <div class="row">
                @foreach($events as $event)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('img/events/' . ($event->image ?? 'default.jpg')) }}" 
                                 class="card-img-top" 
                                 alt="{{ $event->title }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="small text-muted mb-2">
                                    <i class="bi bi-building me-1"></i>
                                    Publicado por: <strong>{{ $event->user->name }}</strong>
                                </p>
                                <p class="card-text text-muted mb-2">
                                    <i class="bi bi-calendar-event-fill"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} |
                                    <i class="bi bi-geo-alt-fill"></i> {{ $event->location }} |
                                    <i class="bi bi-ticket-detailed-fill"></i> {{ $event->available_slots }} vaga(s)
                                </p>
                                <div class="small text-success mb-3">
                                    @if(($event->isfull()) && (auth()->check()))
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ $event->available_slots - count($event->subscribers) }} Vagas disponíveis
                                    @endif
                                </div>
                                
                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="{{ route('events.show', $event->id) }}" class="text-primary text-decoration-none fw-semibold">
                                        Ver detalhes
                                    </a>

                                    @if(Gate::allows('can-subscribe-to-event', $event) || (!auth()->check()))
                                        <form action="{{ route('events.join', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="bi bi-check2-circle me-1"></i> Inscrever-se
                                            </button>
                                        </form>
                                    @elseif(!Gate::allows('is-subscribed-to-event', $event))
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDeixarEvento{{ $event->id }}">
                                            <i class="bi bi-x-circle"></i> Sair do evento
                                        </button>
                                    @else
                                        @if($event->hasPassed())
                                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-2" disabled>
                                                <i class="bi bi-clock-history"></i> Evento já passou
                                            </button> 
                                        @elseif($event->isfull())   
                                            <button class="btn btn-sm btn-outline-warning rounded-pill px-3" disabled>
                                                <i class="bi bi-people-fill"></i> Evento Lotado
                                            </button>  
                                        @endif  
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                        @include('events.partials.modal-leave', ['event' => $event])    
                    @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
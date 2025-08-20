@extends('layouts.app')

@section('title', 'Ver Evento ' . $event->title)

@section('content')

<!-- Imagem de fundo -->
<div class="event-header" style="background-image: url('{{ asset('img/events/' . ($event->image ?? 'default.jpg')) }}')"></div>
  
    <div class="event-details">
        <h2 class="mb-3">{{ $event->title }}</h2>
        
        <p class="text-muted mb-3">
            <i class="bi bi-geo-alt-fill"></i> {{ $event->location }} -
            <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }},
            {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
        </p>

        @if($event->description)
            <p>{{ $event->description }}</p>
        @endif
        <p><i class="bi bi-building"></i> <strong>Local:</strong> {{ $event->location }}</p>
        <p><i class="bi bi-people-fill"></i> <strong>Inscrito(s):</strong>  {{ count($event->subscribers) }}</p>
        <p><i class="bi bi-ticket-detailed"></i> <strong>Vaga(s) disponíveis(s):</strong> {{ $event->available_slots - count($event->subscribers) }}</p>
        <p><i class="bi bi-bank"></i> <strong>Publicado por:</strong> {{ $event->user->name }}</p>
        <p><i class="bi bi-person-badge"></i> <strong>Inscrição:</strong> Entrada gratuita com credenciamento prévio</p>
        <div class="d-flex justify-content-between align-items-center mt-4">


        @if(Gate::allows('can-subscribe-to-event', $event) || (!auth()->check()))
            <form action="{{ route('events.join', $event->id) }}" method="POST">
                @csrf
                <button type="submit" id="event-submit" class="btn btn-lg btn-success fw-bold px-4 py-2 shadow-sm">
                    <i class="bi bi-check2-circle me-1"></i> Inscreva-se agora
                </button>
            </form>
        @elseif(!Gate::allows('is-subscribed-to-event', $event))
            <button class="btn btn-lg btn-danger fw-bold px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalDeixarEvento{{ $event->id }}">
            <i class="bi bi-x-circle"></i> Sair do evento
            </button>
        @else
            @if($event->hasPassed())
                <button class="btn btn-lg btn-success fw-bold px-4 py-2 shadow-sm" disabled>
                    <i class="bi bi-clock-history"></i> Evento já passou
                </button>  
            @elseif($event->isfull())
                <button class="btn btn-lg btn-success fw-bold px-4 py-2 shadow-sm" disabled>
                    <i class="bi bi-people-fill"></i> Evento Lotado
                </button>   
            @endif  
        @endif
            <a href="{{ route('events.index') }}" class="text-decoration-none text-primary">
                <i class="bi bi-arrow-left-circle"></i> Voltar à lista de eventos
            </a>
        </div>
    </div>
    
    @include('events.partials.modal-leave', ['event' => $event])   
@endsection
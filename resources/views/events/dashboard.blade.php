@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container my-5">

 
    <div class="mb-4">
        <h2><i class="bi bi-speedometer2 me-2"></i> Painel de Controle</h2>
        <p class="text-muted">Resumo das minhas atividades e ações disponíveis</p>
    </div>


    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-calendar-event fs-2 text-primary"></i>
                    <h5 class="mt-2 mb-0">{{ count($events) }}</h5>
                    <small class="text-muted">Eventos Criados</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-person-check fs-2 text-success"></i>
                    <h5 class="mt-2 mb-0">{{ count($subscribed) }}</h5>
                    <small class="text-muted">Eventos Inscritos</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-ticket fs-2 text-warning"></i>
                    <h5 class="mt-2 mb-0">{{ $events->sum('available_slots') - count($subscribed) }}</h5>
                    <small class="text-muted">Vagas Disponíveis</small>
                </div>
            </div>
        </div>
    </div>

   <h3 class="mb-3"><i class="bi bi-person-lines-fill me-2"></i> Meus eventos</h3>

    @if($events->count() > 0)
        <div class="table-responsive mb-5">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>
                                <a href="{{ route('events.show', $event->id) }}" class="text-primary text-decoration-none">
                                    {{ $event->title }}
                                </a>
                            </td>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->location }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalVerEvento{{ $event->id }}">
                                  <i class="bi bi-eye"></i> Ver
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalEditarEvento{{ $event->id }}">
                                  <i class="bi bi-pencil"></i> Editar
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalExcluirEvento{{ $event->id }}">
                                  <i class="bi bi-trash me-1"></i> Excluir
                                </button>
                            </td>
                        </tr>
                        @include('events.partials.modal-view', ['event' => $event])
                        @include('events.partials.modal-edit', ['event' => $event])
                        @include('events.partials.modal-delete', ['event' => $event])
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert">Você ainda não criou nenhum evento. 
            <a href="{{ route('events.create') }}" class="text-decoration-none text-primary"> Criar evento</a>
        </div>
    @endif

    <!-- Eventos Inscritos -->
    <h3 class="mb-3"><i class="bi bi-person-lines-fill me-2"></i> Eventos que estou inscrito</h3>

    @if($subscribed->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Organizador</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscribed as $event)
                        <tr>
                            <td>
                                <a href="{{ route('events.show', $event->id) }}" class="text-primary text-decoration-none">
                                    {{ $event->title }}
                                </a>
                            </td>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->user->name }}</td>
                            <td>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalVerEvento{{ $event->id }}">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeixarEvento{{ $event->id }}">
                                    <i class="bi bi-x-circle"></i> Sair do evento
                                </button>
                            </td>
                        </tr>
                        @include('events.partials.modal-view', ['event' => $event])
                        @include('events.partials.modal-leave', ['event' => $event])
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert">
          Você não está inscrito em nenhum evento.
          <a href="{{ route('events.index') }}" class="text-decoration-none text-primary"> Ver todos eventos</a>
        </div>
    @endif

</div>
@endsection

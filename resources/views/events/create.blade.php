@extends('layouts.app')

@section('title', 'Criar Eventos')

@section('content')

<div class="container my-5">

  <div class="form-section">
    <h2><i class="bi bi-calendar-plus"></i> Criar Novo Evento</h2>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="mb-3">
        <label for="title" class="form-label"><i class="bi bi-pencil-square"></i> Nome do Evento</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o nome do evento">
        @error('title')
        <div>{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="date" class="form-label"><i class="bi bi-calendar-event"></i> Data</label>
        <input type="date" class="form-control" id="date" name="date">
        @error('location')
        <div>{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="time" class="form-label"><i class="bi bi-clock"></i> Horário</label>
        <input type="time" class="form-control" id="time" name="time">
        @error('time')
        <div>{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="location" class="form-label"><i class="bi bi-geo-alt"></i> Local</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Onde será o evento?">
        @error('location')
        <div>{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="slots" class="form-label"><i class="bi bi-ticket-detailed"></i> Vagas disponíveis</label>
        <input type="number" class="form-control" id="available_slots" name="available_slots" placeholder="Número de vagas">
        @error('available_slots')
        <div>{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="image" class="form-label"><i class="bi bi-card-image"></i> Imagem do Evento</label>
        <input type="file" class="form-control" id="image" name="image">
        @error('image')
        <div>{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label"><i class="bi bi-info-circle"></i> Descrição</label>
        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Conte um pouco sobre o evento...">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ut consequatur tempore, aliquid itaque ullam, eveniet blanditiis iusto esse minima culpa eius ipsum cupiditate non et ipsa sunt accusantium. Distinctio?</textarea>
        @error('description')
        <div>{{ $message }}</div>
        @enderror
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary btn-publish">
          <i class="bi bi-send-plus me-1"></i> Publicar Evento
        </button>
      </div>
    </form>
  </div>
</div>

@endsection
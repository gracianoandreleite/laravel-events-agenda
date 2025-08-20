<!-- MODAL: Editar Evento -->
<div class="modal fade overflow-scroll" id="modalEditarEvento{{ $event->id }}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i> Editar Evento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="modal-body">
              <div class="mb-3">
                <label for="title" class="form-label"><i class="bi bi-pencil-square"></i> Nome do Evento</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" placeholder="Digite o nome do evento">
              </div>

              <div class="mb-3">
                <label for="date" class="form-label"><i class="bi bi-calendar-event"></i> Data</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $event->date }}">
              </div>

              <div class="mb-3">
                <label for="time" class="form-label"><i class="bi bi-clock"></i> Horário</label>
                <input type="time" class="form-control" id="time" name="time" value="{{ $event->time }}">
              </div>

              <div class="mb-3">
                <label for="location" class="form-label"><i class="bi bi-geo-alt"></i> Local</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" placeholder="Onde será o evento?">
              </div>

              <div class="mb-3">
                <label for="slots" class="form-label"><i class="bi bi-ticket-detailed"></i> Vagas disponíveis</label>
                <input type="number" class="form-control" id="available_slots" name="available_slots" value="{{ $event->available_slots }}" placeholder="Número de vagas">
              </div>

              <div class="mb-3">
                <label for="image" class="form-label"><i class="bi bi-card-image"></i> Imagem do Evento</label>
                <input type="file" class="form-control" id="image" name="image">
              </div>

              <div class="mb-3">
                <label for="description" class="form-label"><i class="bi bi-info-circle"></i></label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Conte um pouco sobre o evento...">{{ $event->description }}</textarea>
              </div>
        
              </div>
              <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Salvar</button>
              </div>
          </div>
        </form>
      </div>
    </div>
</div>
<!-- MODAL: Ver Evento -->
<div class="modal fade" id="modalVerEvento{{ $event->id }}" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-eye me-2"></i> Detalhes do Evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <h4>{{ $event->title }}</h4>
        <p><i class="bi bi-calendar-event text-primary me-2"></i> Publicado por {{ $event->user->name }}</p>
        <p><i class="bi bi-calendar-event text-primary me-2"></i> {{ $event->date }}, {{ $event->time }}</p>
        <p><i class="bi bi-geo-alt text-primary me-2"></i> {{ $event->location }} </p>
        <p><i class="bi bi-people text-primary me-2"></i>  {{ $event->user_id }} inscrito(s) •  {{ $event->available_slots }} vaga(s) • {{ $event->available_slots - count($event->subscribers) }} sobrando</p>
        <hr>
        <p>{{ $event->description }}</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
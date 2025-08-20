<!-- MODAL: Excluir Evento -->
<div class="modal fade" id="modalExcluirEvento{{ $event->id }}" tabindex="-1" aria-labelledby="modalExcluirLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger-subtle">
        <h5 class="modal-title text-danger"><i class="bi bi-trash3 me-2"></i> Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Deseja excluir o evento <strong>"{{ $event->title}}"</strong>? Esta ação não pode ser desfeita.</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
        @csrf
        @method('DELETE')
              <button class="btn btn-danger" id="btnDeleteEvent"><i class="bi bi-trash-fill me-1"></i> Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>
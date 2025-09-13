<!-- Modal Encuesta Sencillo -->
<button type="button" class="btn btn-info mb-3 float-end" data-bs-toggle="modal" data-bs-target="#encuestaModal">
    Encuesta de Satisfacción
</button>

<div class="modal fade" id="encuestaModal" tabindex="-1" aria-labelledby="encuestaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="encuestaModalLabel">Encuesta de Satisfacción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form id="encuestaForm" action="{{ route('surveys.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">¿Cómo calificaría nuestro servicio?</label>
                        <select name="satisfaction_level" class="form-select" required>
                            <option value="">Seleccione una calificación</option>
                            <option value="5">Excelente (5)</option>
                            <option value="4">Muy Bueno (4)</option>
                            <option value="3">Bueno (3)</option>
                            <option value="2">Regular (2)</option>
                            <option value="1">Malo (1)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Área evaluada</label>
                        <select name="service_area" class="form-select" required>
                            <option value="">Seleccione un área</option>
                            <option value="ventas">Ventas</option>
                            <option value="servicio_tecnico">Servicio Técnico</option>
                            <option value="atencion_cliente">Atención al Cliente</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">¿Recomendaría nuestros servicios?</label>
                        <select name="recommendation_level" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                            <option value="talvez">Tal vez</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comentarios (opcional)</label>
                        <textarea name="feedback" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="enviarEncuestaBtn">Enviar Encuesta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast de éxito -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div id="toastEncuesta" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                ¡Gracias por tu opinión!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('enviarEncuestaBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const form = document.getElementById('encuestaForm');
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en la respuesta');
            return response.json();
        })
        .then(data => {
            // Mostrar el toast
            var toastEl = document.getElementById('toastEncuesta');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();

            bootstrap.Modal.getInstance(document.getElementById('encuestaModal')).hide();
            form.reset();
        })
        .catch(error => {
            alert('Error al enviar la encuesta');
            console.error(error);
        });
    });
});
</script>
@endpush
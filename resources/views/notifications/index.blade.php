<!-- Contenedor del ícono de notificación -->
<div class="position-relative">
    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#notificationsModal">
        <i class="fas fa-bell"></i>
        <!-- Contador de notificaciones -->
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ count($notifications) }} <!-- Contador -->
        </span>
    </button>
</div>

<!-- Modal de Notificaciones -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="notificationsModalLabel">Notificaciones</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach($notifications as $notification)
                        <li class="list-group-item mb-3 shadow-sm p-3 rounded" style="border-left: 5px solid #007bff;">
                            <div class="notification-content">
                                <p><strong>Nombre:</strong> {{ $notification->nombre }}</p>
                                <p><strong>Email:</strong> {{ $notification->email }}</p>
                                <p><strong>Teléfono:</strong> {{ $notification->telefono }}</p>
                                <p><strong>Tipo de consulta:</strong> {{ $notification->tipo_consulta }}</p>
                                <p><strong>Mensaje:</strong> {{ $notification->mensaje }}</p>
                            </div>
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Marcar como leída</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
                @if($notifications->isEmpty())
                    <div class="alert alert-info text-center" role="alert">
                        No hay notificaciones nuevas.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
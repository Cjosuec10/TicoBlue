<div id="notificationModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notificaciones</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="notification-list">
                <!-- Notificaciones no leídas -->
                @foreach ($unreadNotifications as $notification)
                    @php
                        $data = json_decode($notification->data, true); // Decodifica el campo `data`
                    @endphp
                    <div class="notification-item">
                        <h6>{{ $data['title'] ?? 'Notificación' }}</h6>
                        <p>{{ $data['message'] ?? 'Mensaje no disponible' }}</p>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
                @if ($unreadNotifications->isEmpty())
                    <p class="text-center">No hay notificaciones nuevas</p>
                @endif
            </div>
        </div>
    </div>
</div>

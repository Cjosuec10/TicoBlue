<!-- Contenedor de todas las notificaciones -->
<div class="container mt-5">
    <h3 class="mb-4">Todas las Notificaciones</h3>

    <ul class="list-group">
        @foreach($allNotifications as $notification)
            <li class="list-group-item mb-3 p-3 rounded shadow-sm notification-item"
                style="border-left: 8px solid {{ $notification->leido ? '#28a745' : '#007bff' }}; background-color: {{ $notification->leido ? '#f9f9f9' : '#e9f5ff' }};">
                
                <div class="notification-content">
                    <p class="fw-bold text-dark"><strong>Nombre:</strong> {{ $notification->nombre }}</p>
                    <p><strong>Email:</strong> <a href="mailto:{{ $notification->email }}" class="text-decoration-none">{{ $notification->email }}</a></p>
                    <p><strong>Teléfono:</strong> {{ $notification->telefono }}</p>
                    <p><strong>Tipo de consulta:</strong> {{ $notification->tipo_consulta }}</p>
                    <p><strong>Mensaje:</strong> {{ $notification->mensaje }}</p>
                    <p class="mt-2"><span class="badge {{ $notification->leido ? 'bg-success' : 'bg-primary' }}">{{ $notification->leido ? 'Leído' : 'No leído' }}</span></p>
                </div>
            </li>
        @endforeach
    </ul>

    @if($allNotifications->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No hay notificaciones.
        </div>
    @endif
</div>

<!-- CSS Adicional -->
<style>
    .notification-item {
        transition: box-shadow 0.3s ease;
    }
    .notification-item:hover {
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
    }
    .notification-content p {
        margin-bottom: 0.5rem;
    }
    .notification-content p strong {
        color: #495057;
    }
    .notification-content a {
        color: #007bff;
        text-decoration: underline;
    }
    .notification-content a:hover {
        color: #0056b3;
    }
</style>

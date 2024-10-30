@extends('layout.administracion')

@section('content')
<!-- Contenedor de todas las notificaciones -->
<div class="container mt-5">
    <h3 class="mb-4">Todas las Notificaciones</h3>

    <ul class="list-group">
        @forelse($allNotifications as $notification)
            <li class="list-group-item mb-3 p-3 rounded shadow-sm notification-item"
                style="border-left: 8px solid {{ $notification->leido ? '#28a745' : '#007bff' }};
                       background-color: {{ $notification->leido ? '#f9f9f9' : '#e9f5ff' }};">
                
                <div class="notification-content">
                    <p class="fw-bold text-dark">
                        <strong>Nombre:</strong> {{ $notification->nombre }}
                    </p>
                    <p>
                        <strong>Email:</strong> 
                        <a href="mailto:{{ $notification->email }}" class="text-decoration-none">
                            {{ $notification->email }}
                        </a>
                    </p>
                    <p><strong>Teléfono:</strong> {{ $notification->telefono }}</p>
                    <p><strong>Tipo de consulta:</strong> {{ $notification->tipo_consulta }}</p>
                    
                    <!-- Contenedor del mensaje con límites de tamaño -->
                    <p class="message-content"><strong>Mensaje:</strong> {{ $notification->mensaje }}</p>

                    <p class="mt-2">
                        <span class="badge {{ $notification->leido ? 'bg-success' : 'bg-primary' }}">
                            {{ $notification->leido ? 'Leído' : 'No leído' }}
                        </span>
                    </p>
                </div>
            </li>
        @empty
            <div class="alert alert-info text-center" role="alert">
                No hay notificaciones.
            </div>
        @endforelse
    </ul>
</div>
@endsection

<!-- CSS Adicional -->
@push('styles')
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
    .message-content {
        white-space: pre-wrap; /* Permite que el texto largo se ajuste */
        word-break: break-word; /* Corta palabras largas */
        max-height: 80px; /* Altura máxima del mensaje */
        overflow: hidden; /* Oculta el contenido adicional */
        text-overflow: ellipsis; /* Añade puntos suspensivos al final si el contenido es largo */
    }
</style>
@endpush

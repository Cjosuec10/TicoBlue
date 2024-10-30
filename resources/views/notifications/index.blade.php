
@extends('layout.administracion')

@section('content')
<h1>Lista de notificaciones</h1>


<!-- Modal de Notificaciones -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white text-center">
                <h5 class="modal-title w-100" id="notificationsModalLabel">Notificaciones</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach($notifications as $notification)
                        <li class="list-group-item mb-3 shadow-sm p-3 rounded text-center" style="border-left: 5px solid #007bff;">
                            <div class="notification-content">
                                <p><strong>Nombre:</strong> {{ $notification->nombre }}</p>
                                <p><strong>Email:</strong> {{ $notification->email }}</p>
                                <p><strong>Teléfono:</strong> {{ $notification->telefono }}</p>
                                <p><strong>Tipo de consulta:</strong> {{ $notification->tipo_consulta }}</p>
                                <p><strong>Mensaje:</strong> {{ $notification->mensaje }}</p>
                            </div>
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="mt-2 d-flex justify-content-center">
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
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection
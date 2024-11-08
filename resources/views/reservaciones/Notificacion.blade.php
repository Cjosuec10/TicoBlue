@foreach($unreadNotifications as $notification)
    <div class="notification-item">
        <h6>{{ $notification->title }}</h6>
        <p>{{ $notification->message }}</p>
    </div>
@endforeach

@if ($message)
    <div class="mb-4 alert alert-{{ $type }} alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            {{ $message }}
        </div>
    </div>
@endif

@if ($type && $message)
    <div >
        <div class="alert alert-{{$type}} alert-dismissible fade show mt-2 container" role="alert">
            <strong>{{$type}}</strong> {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
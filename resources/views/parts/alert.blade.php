@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('studentNotFound'))
    <div class="alert alert-danger mt-3" role="alert">
        {{ session('studentNotFound') }}
    </div>
@endif
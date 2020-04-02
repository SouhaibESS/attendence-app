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

@if(session('userDeleted'))
    <div class="alert alert-warning mt-3" role="alert">
        {{ session('userDeleted') }}
    </div>
@endif
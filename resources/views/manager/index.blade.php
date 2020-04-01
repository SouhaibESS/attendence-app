@extends('layouts.app')

@section('loginLinks')
    @include('parts.loginLinks')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold h3">Filieres :</div>

                <div class="card-body">
                    <div class="list-group">
                        @foreach ($filieres as $filiere)
                            <a class="mb-1" href="{{ route('manager.filiere.show', $filiere) }}"><button type="button" class="list-group-item list-group-item-action" disabled>{{ $filiere->filiere }}</button></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

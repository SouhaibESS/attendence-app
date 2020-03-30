@extends('layouts.app')

@section('loginLinks')
    @include('parts.loginLinks')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header font-weight-bold h3">Matieres :</div>
                <div class="card-body">
                    <button type="button" class="list-group-item list-group-item-action active h4">Please <strong><u>click</u></strong> on the current session matiere :</button>
                    <div class="accordion" id="accordionExample">
                        @foreach ($matieres as $key => $matiere)
                        <div class="card mb-3 rounded shadow-sm">
                            <div class="card-header" id="headingOne">
                                <h1 class="mb-0">
                                <button style="font-size:.6em" class=" btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">
                                    {{ $matiere->matiere_name }}
                                </button>
                                </h1>
                            </div>
                        
                            <div id="collapseOne{{ $key }}" class="collapse show" aria-labelledby="headingOne{{ $key }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="list-group">
                                        @foreach ($matiere->filieres as $filiere)
                                            <a class="mb-1" href="{{ route('filiere.show', [$filiere->id, $matiere->id]) }}"><button type="button" class="list-group-item list-group-item-action" disabled>{{ $filiere->filiere }}</button></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

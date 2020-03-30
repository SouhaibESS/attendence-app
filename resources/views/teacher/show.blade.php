@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold h3">Filieres associated to this matiere :</div>

                <div class="card-body">
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active h4">Please <strong><u>click</u></strong> on the current session filiere :</button>
                        @foreach ($matiere->filieres as $filiere)
                            <a class="mb-1" href="{{ route('filiere.show', [$filiere->id, $matiere->id]) }}"><button type="button" class="list-group-item list-group-item-action" disabled>{{ $filiere->filiere }}</button></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

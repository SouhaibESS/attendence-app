@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="matieres" class="col-md-4 col-form-label text-md-right">Asigne Matieres :</label>

                            <div id="matieres" class="col-md-6">
                                @foreach ($matieres as $matiere)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="matieres[]" id="{{ $matiere->id }}" value="{{ $matiere->id }}"
                                            @if ($user->hasMatiere($matiere->id))
                                                checked
                                            @endif
                                        >
                                        <label class="form-check-label" for="{{ $matiere->id }}">
                                            {{ $matiere->matiere_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

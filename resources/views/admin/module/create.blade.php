@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Module</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('modules.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Module Name :</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="module_name" value="{{ old('module_name') }}" required autocomplete="module_name" autofocus>

                                @error('module_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Semestre </label>

                            <div class="col-md-6">
                                <select name="semestre" class="custom-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="S1">semestre 1</option>
                                    <option value="S2">semestre 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="name" class="col-md-4 col-form-label text-md-right">Matiere 1 :</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="matieres[]" value="{{ old('matieres[0]') }}" autofocus>
                            </div>

                            <hr>

                            <label for="name" class="col-md-4 col-form-label text-md-right">Matiere 2 :</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="matieres[]" value="{{ old('matieres[1]') }}" autofocus>
                            </div>

                            <hr>

                            <label for="name" class="col-md-4 col-form-label text-md-right">Matiere 3 :</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="matieres[]" value="{{ old('matieres[2]') }}" autofocus>
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
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

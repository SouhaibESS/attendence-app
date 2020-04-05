@extends('layouts.app')

@section('loginLinks')
    @include('parts.loginLinks')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New User</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('students.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cne" class="col-md-4 col-form-label text-md-right">CNE </label>
    
                                <div class="col-md-6">
                                    <input id="cne" type="text" class="form-control @error('cne') is-invalid @enderror" name="cne" value="{{ old('cne') }}" required autocomplete="cne">
    
                                    @error('cne')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputGroupSelect01" class="col-md-4 col-form-label text-md-right">Filiere</label>

                                <div class="col-md-6">
                                    <select name="filiere_id" class="custom-select" id="inputGroupSelect01">
                                        <option selected>Choose...</option>
                                        @foreach ($filieres as $filiere)
                                            <option value="{{ $filiere->id }}">{{ $filiere->filiere }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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

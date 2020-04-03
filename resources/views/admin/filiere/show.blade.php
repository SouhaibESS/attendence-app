@extends('layouts.app')

@section('loginLinks')
    @include('parts.loginLinks')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('parts.alert')

            <div class="card mb-3">
                <a class="mb-3 btn btn-primary" href="{{ route('users.index') }}" role="button">
                    <svg class="bi bi-chevron-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 010 .708L5.707 8l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                    </svg>
                    Go back
                </a>
                <div class="card-header">Create New Student</div>

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
                        <input type="hidden" name="filiere_id" value="{{ $filiere->id }}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Student 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header font-weight-bold h3">{{ $filiere->filiere }} student's List :</div>

                <div class="card-body">
                    @empty ($filiere->students)
                        No students are asigned for this filiere.
                    @else
                        <table class="table table-hover table-bordered" >
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">CNE</th>
                                    <th scope="col">Name</th>
                                    <th class="text-center" scope="row">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filiere->students as $key => $student)
                                <tr>
                                    <a href="">
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $student->cne }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td class="text-center justify-content-around d-flex">
                                        <a href="{{ route('students.edit', $student) }}">
                                            <button type="button" class="btn btn-md btn-info">Update</button>
                                        </a>
                                        
                                        <form method="post" action="{{ route('students.destroy', $student) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-md btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    </a>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endempty
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
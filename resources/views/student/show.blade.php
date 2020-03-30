@extends('layouts.app')

@section('studentInfos')
    <li class="nav-item">
        <a id="navbarDropdown" class="nav-link" href="{{ route('student.show', $student->id) }}">{{ $student->name }}</a>
    </li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="jumbotron">
                <h1 class="display-4">Hello, {{ $student->name }}</h1>
                <br>
                <p class="lead">
                    <div>
                        <span class="col justify-content-between w-75 d-flex h4">
                            <span class="float-left">CNE :</span>
                            <span class="ml-4 float-right">{{ $student->cne }}</span>
                        </span>
                        <span class="col justify-content-between w-75 d-flex h4">
                            <span class="float-left">Name :</span>
                            <span class="ml-4 float-right">{{ $student->name }}</span>
                        </span>
                        <span class="col justify-content-between w-75 d-flex h4">
                            <span class="float-left">Total Absences Number :</span>
                            <span class="ml-4 float-right">{{ $student->totalAbsenceNumbre() }}</span>
                        </span>
                    </div>
                </p>
                <hr class="my-4">
                @if($student->totalAbsenceNumbre() == 0 )
                    <p class="h5 alert alert-success">Well Done! no absence you are a good student.</p>
                @else
                    <p class="h5">
                        The following list shows the number of absences per matiere. <br>
                        <small class="ml-2 alert-danger"><strong>if the number is colored in red you have to consult that matiere's teacher</strong></small>
                    </p>
                    <ul class="list-group">
                        @foreach ($student->matiereAbsenceNumbre() as $matiere)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $matiere->matiere_name }}
                                <span class="badge @if($matiere->nbrAbsencePerMatiere >= 3) badge-danger @else badge-primary @endif badge-pill">{{ $matiere->nbrAbsencePerMatiere }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <a class="mt-3 btn btn-primary btn-lg" href="/" role="button">Go back</a>
            </div>
            {{-- <div class="card">
                <div class="card-header font-weight-bold h3">Student Description Card:</div>

                <div class="card-body">
                    
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
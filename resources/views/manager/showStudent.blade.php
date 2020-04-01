@extends('layouts.app')

@section('checkboxStyle')
  <style>
            /* Customize the label (the container) */
    .container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }
  </style>
@endsection

@section('loginLinks')
    @include('parts.loginLinks')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            @include('parts.alert')

            <div class="jumbotron pt-n4">
                <a class="mb-3 btn btn-primary" href="{{ route('manager.filiere.show', $student->filiere) }}" role="button">
                    <svg class="bi bi-chevron-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 010 .708L5.707 8l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                    </svg>
                    Go back
                </a>
                <h1 class="display-4">{{ $student->name }}</h1>
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
                            <span class="ml-4 float-right">{{ $student->totalAbsenceNumber() }}</span>
                        </span>
                        <span class="col justify-content-between w-75 d-flex h4">
                            <span class="float-left">Unjustified Absences Number :</span>
                            <span class="ml-4 float-right">{{ $student->unjustifiedAbsencesNumber() }}</span>
                        </span>
                    </div>
                </p>
                <hr class="my-4">
                @if($student->totalAbsenceNumber() == 0 )
                    <p class="h5 alert alert-success">Well Done! no absence you are a good student.</p>
                @else
                    <p class="h5">
                        The following list shows the number of absences per matiere. <br>
                        <small class="ml-2 alert-danger"><strong>if the number is colored in red you have to consult that matiere's teacher</strong></small>
                    </p>
                    <ul class="list-group">
                        @foreach ($student->matiereAbsenceNumber() as $matiere)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $matiere->matiere_name }}
                                <span class="badge @if($matiere->nbrAbsencePerMatiere >= 3) badge-danger @else badge-primary @endif badge-pill">{{ $matiere->nbrAbsencePerMatiere }}</span>
                            </li>
                        @endforeach
                    </ul>
                    @if ($student->unjustifiedAbsencesNumber() != 0)
                        <hr>
                        <p class="h3">Unjustified Absence :</p>
                        <form action="{{ route('manager.justify', $student) }}" method="POST">
                            @method('put')
                            @csrf
                            <table class="table table-hover table-bordered bg-light" >
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Matiere</th>
                                        <th scope="col">Session Date</th>
                                        <th scope="col">Begins At</th>
                                        <th scope="col">Ends At</th>
                                        <th scope="col">Justified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->unjustifiedAbsences() as $key => $session)
                                        <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $session->matiere->matiere_name }}</td>
                                        <td>{{ $session->date }}</td>
                                        <td>{{ $session->begins_at }}</td>
                                        <td>{{ $session->ends_at }}</td>
                                        <td class="text-center" title="click to justify absence">
                                            <label class="container">
                                                <input type="checkbox" name="absences[]" value="{{ $session->id }}">
                                                <span class="checkmark"></span>
                                            </label>
                                            <!--
                                                <button type="button" id="absent[{{ $key }}]" class="btn btn-outline-info"><input name="students[]" value="{{ $student->id }}" type="checkbox"> absent</button>
                                            -->
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-dark float-right mr-4">Justify</button>
                        </form>
                    @endif
                @endif
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
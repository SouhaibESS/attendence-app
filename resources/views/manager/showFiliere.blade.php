@extends('layouts.app')

@section('loginLinks')
    @include('parts.loginLinks')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('parts.alert')
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
                                    <td class="text-center">
                                        <a href="{{ route('manager.student.show', $student) }}">
                                            <button type="button" class="btn btn-md btn-info">Info</button>
                                        </a>
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
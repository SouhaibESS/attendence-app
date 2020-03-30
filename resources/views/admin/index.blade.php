@extends('layouts.app')

@section('loginLinks')
    @include('parts.loginLinks')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header font-weight-bold h3">Teacher's List :</div>

                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($teachers as $key => $teacher)
                            <tr title="click to edit user">
                              <th scope="row">{{ $key + 1 }}</th>
                              <td>{{ $teacher->name }}</td>
                              <td>{{ $teacher->email }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
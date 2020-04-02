@extends('layouts.app')

@section('loginLinks')
    @include('parts.loginLinks')
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
        @include('parts.alert')

        <div class="card mb-4 mt-3">

          <div class="card-header font-weight-bold-h3">Links :</div>

          <div class="card-body">
            Create New (Admin/Teacher/Manager) : 
            <a href="{{ route('users.create') }}" class="btn float-right btn-primary ">
              <svg class="bi bi-person-plus-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7.5-3a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
              </svg>
              Create New User
            </a>
          </div>
        </div>
          
        <div class="card">

          <div class="card-header font-weight-bold h3">Teacher's List :</div>

          <div class="card-body">

            <table class="table table-hover table-bordered">

              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($teachers as $key => $teacher)
                  <tr title="click to edit user">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td class="text-center justify-content-around d-flex">

                      <a href="{{ route('users.edit', $teacher) }}">
                          <button type="submit" class="btn btn-md btn-info">Update</button>
                      </a>
                      
                      <form method="post" action="{{ route('users.destroy', $teacher) }}">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-md btn-danger">Delete</button>
                      </form>

                  </td>
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
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
            <div>
              (Admin/Teacher/Manager) : 
              <a href="{{ route('users.create') }}" class="btn float-right btn-primary mb-2">
                <svg class="bi bi-person-plus-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7.5-3a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
                </svg>
                Create New
              </a>
            </div>
            <hr>
            <div>
              Student : 
              <a href="{{ route('students.create') }}" class="btn float-right btn-primary ">
                <svg class="bi bi-person-plus-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7.5-3a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
                </svg>
                Create New
              </a>
            </div>
            <hr>
            <div>
              Modules : 
              <a href="{{ route('modules.create') }}" class="btn float-right btn-primary ">
                <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>
                </svg>
                Create New
              </a>
            </div>
          </div>
        </div>

        <div class="card mb-4">

          <div class="card-header font-weight-bold h3">Admin's List :</div>

          <div class="card-body">

            @if ($admins)
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
                @foreach ($admins as $key => $admin)
                  <tr title="click to edit user">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td class="text-center justify-content-around d-flex">

                      <a href="{{ route('users.edit', $admin) }}">
                          <button type="submit" class="btn btn-md btn-info">Update</button>
                      </a>
                      
                      <form method="post" action="{{ route('users.destroy', $admin) }}">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-md btn-danger">Delete</button>
                      </form>

                  </td>
                  </tr>
                @endforeach
              </tbody>

            </table>
            @else
              You are the only admin for the moment you can create new ones the by clicking this button
              <a href="{{ route('users.create') }}" class="btn float-right btn-primary ">
                <svg class="bi bi-person-plus-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7.5-3a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
                </svg>
                Create New User
              </a>

            @endif
            
          </div>
        </div>
          
        <div class="card mb-4">

          <div class="card-header font-weight-bold h3">Manager's List :</div>

          <div class="card-body">

            @if ($managers)
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
                @foreach ($managers as $key => $manager)
                  <tr title="click to edit user">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td class="text-center justify-content-around d-flex">

                      <a href="{{ route('users.edit', $manager) }}">
                          <button type="submit" class="btn btn-md btn-info">Update</button>
                      </a>
                      
                      <form method="post" action="{{ route('users.destroy', $manager) }}">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-md btn-danger">Delete</button>
                      </form>

                  </td>
                  </tr>
                @endforeach
              </tbody>

            </table>
            @else
              No managers were found in the database you can create new ones the by clicking this button
              <a href="{{ route('users.create') }}" class="btn float-right btn-primary ">
                <svg class="bi bi-person-plus-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7.5-3a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
                </svg>
                Create New User
              </a>

            @endif
            
          </div>
        </div>

        <div class="card mb-4">

          <div class="card-header font-weight-bold h3">Teacher's List :</div>

          <div class="card-body">

            @if ($teachers)
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
            @else
              No teachers were found in the database you can create nes ones the by clicking this button
              <a href="{{ route('users.create') }}" class="btn float-right btn-primary ">
                <svg class="bi bi-person-plus-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7.5-3a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
                </svg>
                Create New User
              </a>

            @endif
            
          </div>
        </div>

        <div class="card mb-4">

          <div class="card-header font-weight-bold h3">Filiere's List :</div>

            @if ($filieres)

              <div class="card-body">
                  <div class="list-group">
                      @foreach ($filieres as $filiere)
                          <a class="mb-1" href="{{ route('filieres.show', $filiere) }}"><button type="button" class="list-group-item list-group-item-action" disabled>{{ $filiere->filiere }}</button></a>
                      @endforeach
                  </div>
                  <a href="{{ route('filieres.create') }}" class="btn float-left btn-primary mt-3 mr-4">
                    <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                      <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"/>
                      <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>
                    </svg>
                    Create New Filiere
                  </a>
              </div>

            @else
              No filieres were found in the database you can create new ones the by clicking this button
              <a href="{{ route('filieres.create') }}" class="btn float-right btn-primary ">
                <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>
                </svg>
                Create New Filiere
              </a>

            @endif
            
          </div>

        <div class="card w-100">
          <div class="card-header font-weight-bold h3">Matieres :</div>
          <div class="card-body">
              <div class="accordion" id="accordionExample">
                  @foreach ($modules as $key => $module)
                    <div class="mb-3">
                      <div id="headingOne">
                        <h1 class="mb-0">
                        <button style="font-size:.6em" class="list-group-item list-group-item-action" type="button" data-toggle="collapse" data-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">
                            {{ $module->module_name }}
                        </button>
                        </h1>
                      </div>
                  
                      <div id="collapseOne{{ $key }}" class="collapse show" aria-labelledby="headingOne{{ $key }}" data-parent="#accordionExample">
                        <ul class="list-group list-group-flush">
                          @foreach ($module->matieres as $matiere)
                              <li class="ml-3 mb-1 list-group-item list-group-item-action" href="#">{{ $matiere->matiere_name }}</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    <hr>
                  @endforeach
              </div>
          </div>
      </div>

    </div>
  </div>
</div>
@endsection
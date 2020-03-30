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
            <div class="card">
                <div class="card-header font-weight-bold h3">{{ $filiere->filiere }} student's List :</div>

                <div class="card-body">
                    <form action="{{ route('absence.store',[ $filiere->id , $matiere->id ]) }}" method="post">
                        @csrf
                        @error('timestamps')
                            <div class="alert-danger mb-3 p-2">{{ $message }}</div>
                        @enderror
                        @error('students')
                            <div class="alert-danger mb-3 p-2">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <select name="timestamps" class="custom-select" id="inputGroupSelect02">
                              <option selected>Choose session time...</option>  
                              <option value="1">09:00-10:30</option>
                              <option value="2">10:30-12:15</option>
                              <option value="3">13:30-15:00</option>
                              <option value="4">15:15-16:45</option>
                              <option value="5">09:00-12:15</option>
                              <option value="6">13:30-16:45</option>
                            </select>
                            <div class="input-group-append">
                              <label class="input-group-text" for="inputGroupSelect02">Options</label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered" >
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">CNE</th>
                                <th scope="col">Name</th>
                                <th scope="col">Absent</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($filiere->students as $key => $student)
                                <tr>
                                  <th scope="row">{{ $key + 1 }}</th>
                                  <td>{{ $student->cne }}</td>
                                  <td>{{ $student->name }}</td>
                                  <td class="text-center" onclick="dangerFunction({{ $key }})" title="click if the student is absent">
                                    <label class="container">
                                        <input type="checkbox" name="students[]" value="{{ $student->id }}">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function dangerFunction(key)
    {
        var isActive = false;
        if(document.getElementById("absent[" + key + "]").classList.contains(("btn-danger")))
        {
            isActive = true;
        }


        if(isActive)
        {
            console.log("absent")
            document.getElementById("absent[" + key + "]").classList.remove("btn-danger"); 
            document.getElementById("absent[" + key + "]").classList.add("btn-outline-info");
        }
        else if(!isActive)
        {
            document.getElementById("absent[" + key + "]").classList.add("btn-danger");
            document.getElementById("absent[" + key + "]").classList.remove("btn-outline-info"); 
            console.log("not absent");
        }
    }
</script>

@endsection
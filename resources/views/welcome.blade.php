<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right:10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 130px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a title="Go to Home page" href="{{ url('/home') }}" style="font-size:20px;">Home</a>
            @else
            <a title="Login as a Teacher or Admin" href="{{ route('login') }}" style="font-size:20px;">Login</a>
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title mt-n5">
                ENSAT
            </div>

            <div class="card shadow-lg">

                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Fill in the form to consult your absence</strong>
                </h5>

                <div class="card-body pt-0 ">
                    @include('parts.alert')
                    <form class="text-center" style="color: #757575;" method="POST" action="{{ route('student.find') }}">
                        @csrf
                        <div class="md-form mt-3">
                            <label for="materialLoginFormEmail">Full Name</label>
                            <input value="{{ old('name') }}" name="name" type="text" id="materialLoginFormEmail" class="form-control mt-n1
                                @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="md-form mt-2">
                            <label for="materialLoginFormPassword">CNE</label>
                            <input value="{{ old('cne') }}" name="cne" type="text" id="materialLoginFormPassword" class="form-control mt-n1
                                @error('cne') is-invalid @enderror">
                            @error('cne')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-outline-primary btn-rounded my-4 waves-effect z-depth-0" type="submit">Submit</button>
                    </form>
                </div>

            </div>

            <!-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> -->
        </div>
    </div>
</body>

</html>
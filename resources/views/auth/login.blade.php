<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Myapps | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body style="background: #dfdfdf">
    <div class="container">
        <div class="row" style="margin-top: 10%">
            <div class="card mx-auto" style="width: 30%">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-info">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="text-center">LOGIN MYAPPS</h4>
                    <form class="needs-validation" method="post">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" autocomplete="off" value="{{ old('username') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" autocomplete="off" value="{{ old('password') }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <form action="{{ route('login.auth') }}" class="card p-4 m-3" method="POST">
        <h1>Login</h1>
        @csrf
        @if (Session::get('failed'))
            <div class="alert alert-danger mt-3">{{ Session::get('failed') }}</div>
        @endif
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label @error('email') is-innvalid @enderror">Email :</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label @error('password') is-innvalid @enderror">password
                :</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">login</button>
    </form>
</body>
</html>




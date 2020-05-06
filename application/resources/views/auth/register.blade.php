@extends('layouts.auth')

@section('content')
<body class="text-center">
    <form method="POST" action="{{ route('register') }}" class="form-signin">
        @csrf
        <img class="mb-4" src="{{asset('images/logo.png')}}" alt="ActualSales" width="180">
        <hr>
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

        <label for="name" class="sr-only">Name</label>
        <input id="name" type="text" class="form-control mb-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="email" class="sr-only">Email address</label>
        <input type="email" id="email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email" >
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password-confirm" class="sr-only">Confirm Password</label>
        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Register</button>

        <p>Already member ? Please <a href="{{route('login')}}">sign in</a></p>
        <hr>
        <p class="mt-3 mb-3 text-muted">ActualSales &copy; {{date('Y')}}</p>
    </form>
</body>
@endsection

@extends('layouts.auth')

@section('content')
<body class="text-center">
    <form method="POST" action="{{ route('login') }}" class="form-signin">
        @csrf
        <img class="mb-4" src="{{asset('images/logo.png')}}" alt="ActualSales" width="180">
        <hr>
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="email" class="sr-only">Email address</label>
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="checkbox mb-3">
            <label for="remember">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Sign in</button>

        <p>New member ? Please <a href="{{route('register')}}">sign up</a></p>
        <hr>
        <p class="mt-3 mb-3 text-muted">ActualSales &copy; {{date('Y')}}</p>
    </form>
</body>
@endsection

@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <form id="loginForm">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="button" class="btn btn-primary w-100" onclick="submitLogin()">Login</button>

        <div id="error-message" class="mt-3 text-danger"></div>
    </form>
@endsection

@section('footer')
    {{-- <a href="{{ route('register') }}">Don't have an account? Register here</a> --}}
@endsection

<script>
    function submitLogin() {
        axios.post("{{ route('login') }}", {
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        })
        .then(response => {
            window.location.href = response.data.redirect || '/dashboard';
        })
        .catch(error => {
            document.getElementById('error-message').textContent =
                error.response?.data?.message || 'Login failed. Please try again.';
        });
    }
</script>

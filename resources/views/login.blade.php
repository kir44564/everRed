<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"></html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/authAndReg.css') }}">
</head>
<body>
  <div class="container-anim">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center-anim">
    <!--header -->
      <h2 class="mb-4 text-center">Please Sign In</h2>

    <!--form begin -->
      <form method="POST" action="{{ route('login.attempt') }}" class="w-100">
        @csrf
        <x-form-errors></x-form-errors>
        <div class="mb-3">
          <input type="email" name="email" placeholder="Email" required class="form-control border-0 shadow-sm"/>
        </div>
        <div class="mb-3">
          <input type="password" name="password" placeholder="Password" required class="form-control border-0 shadow-sm"/>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check mb-0">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label class="form-check-label" for="remember">Remember Me</label>
          </div>
          <a href="#" class="text-decoration-none">Forgot Password?</a>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
      </form>
    <!--form end -->
    </div>
  </div>
</body>
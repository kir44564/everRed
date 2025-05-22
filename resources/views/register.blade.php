<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/authAndReg.css') }}">
</head>
<body>
<div class="container-anim">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center-anim">
      <h2 class="mb-4 text-center">Register</h2>
      <form method="POST" action="{{ route('register.store') }}" class="w-100">
        @csrf
        <x-form-errors></x-form-errors>
        <div class="mb-3">
          <input type="text" name="name" placeholder="Name" required class="form-control border-0 shadow-sm"/>
        </div>
        <div class="mb-3">
          <input type="email" name="email" placeholder="Email" required class="form-control border-0 shadow-sm"/>
        </div>
        <div class="mb-3">
          <input type="password" name="password" placeholder="Password" required class="form-control border-0 shadow-sm"/>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2">Register</button>
      </form>
    </div>
  </div>
</body>
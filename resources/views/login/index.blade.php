@extends('layouts.main')

@section('container')

<div class="row justify-content-center mt-5">
    <div class="col-md-4 mt-5">
      {{-- alerts jika sukses login--}}
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      
      {{-- alerts jika gagal login --}}
      @if (session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

        {{-- form login --}}
        <main class="form-signin w-100 m-auto">
          <form action="/login" method="POST">
            @csrf
            <h1 class="h3 mb-3 fw-normal text-center"><strong>Please Log In</strong></h1>
            <div class="form-floating">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"  placeholder="name@example.com" autofocus required value="{{ old('email') }}">
              <label for="floatingInput">Email address</label>
              {{-- Pesan Error --}}
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-floating">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
              <label for="floatingPassword">Password</label>
              {{-- Pesan Error --}}
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Log in</button>
          </form>
          <small class="d-block text-center mt-3">
            Not Registered? <a href="/register">Register Now</a>
          </small>
        </main>       
    </div>
</div>


@endsection
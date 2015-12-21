@extends('layouts.master')

@section('content')

    <p>Don't have an account? <a href='/register'>Register here</a></p>

    <h2>Login</h2>

    @include('errors')

     <form method='POST' action='/login'>

      {{-- line below i the equivalent to   <input type='hidden' value='{{ csrf_token() }}' name='_token'> --}}
        {!! csrf_field() !!}

        <div class='form-group'>
          <div class='col-sm-offset-2 col-sm-10'>
            <label for='email'>Email</label>
            <input type='text' name='email' id='email' value='{{ old('email') }}'>
          </div>
        </div>

        <div class='form-group'>
          <div class='col-sm-offset-2 col-sm-10'>
            <label for='password'>Password</label>
            <input type='password' name='password' id='password' value='{{ old('password') }}'>
          </div>
        </div>

        <div class='form-group'>
          <div class='col-sm-offset-2 col-sm-10'>
            <input type='checkbox' name='remember' id='remember'>
            <label for='remember' class='checkboxLabel'>Remember me</label>
          </div>
        </div>
        <div class='col-sm-offset-2 col-sm-10'>
        <br>
          <button type='submit' class='btn btn-warning'>Login</button>
        </div>

    </form>
@stop

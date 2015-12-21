@extends('layouts.master')

@section('content')

    <p>Already have an account? <a href='/login'>Login here</a></p>

    <h2>Register</h2>

    @include('errors')

    <form method='POST' action='/register'>
        {!! csrf_field() !!}

        <div class='form-group'>
          <div class='col-sm-offset-2 col-sm-10'>
            <label for='name'>Name</label>
            <input type='text' name='name' id='name' value='{{ old('name') }}'>
          </div>
        </div>

        <div class='form-group'>
          <div class='col-sm-offset-2 col-sm-10'>
              <label for='email'>Email</label>
              <input type='text' name='email' id='email' value='{{ old('email') }}'>
          </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-offset-2 col-sm-10'>
              <label for='password'>Password</label>
              <input type='password' name='password' id='password'>
            </div>
        </div>

        <div class='form-group'>
          <div class='col-sm-offset-2 col-sm-10'>
              <label for='password_confirmation'>Confirm Password</label>
              <input type='password' name='password_confirmation' id='password_confirmation'>
          </div>
        </div>
        <div class='col-sm-offset-2 col-sm-10'>
          <br>
            <button type='submit' class='btn btn-warning'>Register</button>
        </div>
    </form>

@stop

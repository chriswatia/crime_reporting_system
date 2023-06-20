@extends('layouts.frontend')

@section('body')
<!-- start banner Area -->
<section class="banner-area relative top-section signin-section home-section" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-start">
            <div class="signin-container">
                <div class="section-title">
                    <h4>COMPLETE REGISTRATION</h4>
                  
                </div>
                <div class="signin-form-container row" >

  <form method='POST' action='/api/school/completeRegistration/{{ $user->id }}'>
    @csrf
  <div class="input-field col s12" >
  <label for="email">Email</label>
    <input type="email" value="{{ $user->email }}" class="form-control" readonly background-color="grey darken-4">
  </div>
  <div class="input-field col s12">
    <label class="form-label">Password</label>
    <input id="password" type="password" class="validate @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
    <span class="helper-text" data-error="wrong">{{$message}}</span>
            @enderror
  </div>

  <div class="input-field col s12">
    <input id="password-confirm" type="password" class="validate" name="confirm_password" required autocomplete="new-password">
    {!!$errors->first("confirm_password", "<span class='text-danger'>:message</span>")!!}
    <label for="password-confirm">{{ __('Confirm Password') }}</label>
 </div>
  <button type="submit" class="waves-effect waves-light btn btn-large btn-primary right">Submit</button>

</form>



</div>

            </div>
        </div>
    </div>
</section>


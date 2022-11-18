@extends('auth.layouts.master')

@section('title', 'Register')

@section('content')
<div class="card card-bordered">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">{{ __('Create an Account') }}</h4>
                <div class="nk-block-des mt-2">
                    @if($user_counts!=0)
                    <p>{{ __('Sign up with your email and get started with your free account.') }}</p>
                    @endif
                </div>
                @if($user_counts==0)
                <div class="alert alert-fill alert-primary alert-icon mt-3">
                    <em class="icon ni ni-user"></em> {{ __("Register a regular admin account first.") }}
                </div>
                @endif
            </div>
        </div>
        @include('auth.partials.error')
        <form action="{{ route('auth.register') }}" autocomplete="off" method="POST" id="registerForm" class="form-validate is-alter" autocomplete="off">
            @csrf
            <div class="form-group">
                <label class="form-label" for="full-name">{{ __('Full Name') }}<span class="text-danger"> &nbsp;*</span></label>
                <div class="form-control-wrap">
                    <input type="text" id="full-name" name="name" value="{{ old('name') }}" class="form-control form-control-lg{{ ($errors->has('name')) ? ' error' : '' }}" minlength="3" data-msg-required="{{ __('Required.') }}" data-msg-minlength="{{ __('At least :num chars.', ['num' => 3]) }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="email-address">{{ __('Email Address') }}<span class="text-danger"> &nbsp;*</span></label>
                <div class="form-control-wrap">
                    <input type="email" id="email-address" name="email" value="{{ old('email') }}" class="form-control form-control-lg{{ ($errors->has('email')) ? ' error' : '' }}" autocomplete="off" data-msg-email="{{ __('Enter a valid email.') }}" data-msg-required="{{ __('Required.') }}" required>
                </div>
            </div>
           @if(\Request::has('agentCode'))
            <div class="form-group">
                <label class="form-label" for="email-address">{{ __('Agent Code') }}<span class="text-danger"> &nbsp;*</span></label>
                <div class="form-control-wrap">
                    <input type="text" id="email-address" name="agentCode" class="form-control form-control-lg"  value="{{\Request::get('agentCode')}}" readonly> 
                </div>
            </div>
            @endif
            <div class="form-group">
                <label class="form-label" for="passcode">{{ __('Password') }}<span class="text-danger"> &nbsp;*</span></label>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="passcode">
                        <em class="passcode-icon icon-show icon ni ni-eye-off"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye"></em>
                    </a>
                    <input name="password" id="passcode" type="password" autocomplete="new-password" class="form-control form-control-lg" minlength="6" data-msg-required="{{ __('Required.') }}" data-msg-minlength="{{ __('At least :num chars.', ['num' => 6]) }}" required>
                </div>
            </div>
            @if($user_counts!=0)
            <div class="form-group">
                <div class="custom-control custom-control-xs custom-checkbox">
                    <input type="checkbox" name="confirmation" class="custom-control-input{{ $errors->has('confirmation') ? ' error' : ''}}" id="checkbox" data-msg-required=" {{ __("You should accept our terms.") }}" required>
                    <label class="custom-control-label" for="checkbox">{!! __('I have agree to the :terms', ['terms' => get_page_link('terms', __("Terms & Condition"), true)]) !!}</label>
                </div>
            </div>
            @endif

          

           
               
                
                    {{-- <label class="form-label" for="captcha"  >{{ __('') }}<span class="text-danger"> &nbsp;*</span></label>
                     --}}
                    <div class="col-md-12 p-2">
                        <span class="captcha-image">{!! Captcha::img() !!}</span> &nbsp;&nbsp;
                        <a href="" class="btn btn-success refresh-button">Refresh</a>
                        <input id="captcha" type="text" class="form-control form-control-lg @error('captcha') is-invalid @enderror" name="captcha" required>
                        @error('captcha')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
          
                @if($user_counts==0)
                <input type="hidden" name="confirmation" value="on">
                @endif
                <button class="btn btn-lg btn-primary btn-block">{{ __('Register') }}</button>
            </div>
        </form>
        @if($user_counts > 0)
        <div class="form-note-s2 text-center pt-4">
            {{ __('Already have an account?') }} <a href="{{ route('auth.login.form') }}"><strong>{{ __('Sign in instead') }}</strong></a>
        </div>
        @endif
        @include('auth.partials.socials')
    </div>
</div>
@endsection

@if (has_recaptcha())
@push('scripts')
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{recaptcha_key("site")}}', {action: 'register'}).then(function(token) {
            document.getElementById('recaptcha').value=token;
        });
    });
</script>
@endpush
@endif

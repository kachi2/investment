@extends('emails.layouts.master')

@section('body')
    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
        <tbody>
        <tr>
            <td style="padding: 30px 30px 20px">
                {{ 'Hi'.$user->name}}
            </td>
        </tr>
        <tr>
            <td style="padding: 0 30px 20px">
               <p>Thank you for registering on our platform. You're almost ready to start.

                Simply click the button below to confirm your email address and active your account.</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 30px 20px">
                <p style="margin-bottom: 25px;">{{ __('This link will expire in 30 minutes and can only be used once.') }}</p>
                <a href="{{ route('auth.email.verify', [ 'token' => data_get($user, 'verify_token.token').md5($user->email) ]) }}" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 30px">{{ __('Verify Email') }}</a>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 30px">
                <h4 style="font-size: 15px; color: #000000; font-weight: 600; margin: 0; text-transform: uppercase; margin-bottom: 10px">or</h4>
                <p style="margin-bottom: 10px;">{{ __('If the button above does not work, paste this link into your web browser:') }}</p>
                <a href="#" style="color: #6576ff; text-decoration:none;word-break: break-all;">{{ route('auth.email.verify', [ 'token' => data_get($user, 'verify_token.token').md5($user->email) ]) }}</a>
            </td>
        </tr>

       
            <tr>
                <td style="padding: 20px 30px 30px">
                    All Rights Reserved. Mazeoptions @ 2022
                </td>
            </tr>
        
        </tbody>
    </table>
@endsection

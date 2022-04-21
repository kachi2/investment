@extends('admin.layouts.modules')
@section('title', __('Crypto Wallet - Payment Method'))

@section('content')
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">{{ __('Payment Methods') }}</h3>
                    <p>{{ __('Manage payment methods to receive payment from user.') }}</p>
                </div>
                <div class="nk-block-head-content">
                    <ul class="nk-block-tools gx-1">
                        <li class="d-lg-none">
                            <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle" data-target="pageSidebar"><em class="icon ni ni-menu-right"></em></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nk-block card card-bordered nk-block-mh">
            <div class="card-inner">
                <div class="justify-between">
                    <h5 class="title">{{ __('Crypto Wallets') }} <span class="meta ml-1"><span class="badge badge-pill badge-xs badge-light">{{ __('Core') }}</span></span></h5>
                    <div class="go-back"><a class="back-to" href="{{ route('admin.settings.gateway.payment.list') }}"><em class="icon ni ni-arrow-left"> </em> {{ __('Back') }}</a></div>
                </div>
                <p>{{ __('Receive crypto (ETH, BTC, LTC, etc) payment manually on the platform.') }}</p>
                <div class="divider"></div>
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.settings.gateway.payment.crypto-wallet.save') }}" class="form-settings" method="POST">
                            <div class="form-set wide-md">
                                <h6 class="title mb-3">{{ __('Method Setting') }}</h6>
                                <div class="row gy-3">
                                    <div class="col-12 col-xxl-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Method Title') }} <span class="text-danger">*</span></label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="name" class="form-control" value="{{ data_get($settings, 'name', __('Pay with Crypto')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="desc" value="{{ data_get($settings, 'desc', __('Send your payment direct to our wallet.')) }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-4 col-xl-6 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Minimum Deposit') }} <small><sup>1</sup></small></label>
                                            <div class="form-control-wrap">
                                                <div class="form-text-hint"><span>{{ base_currency() }}</span></div>
                                                <input type="number" class="form-control" name="min_amount" value="{{ data_get($settings, 'min_amount', '1') }}" min="0">
                                            </div>
                                            <div class="form-note">{{ __('Amount will be convert') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-xl-6 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Secondary Currency') }}</label>
                                            <div class="form-control-wrap">
                                                <select name="config[meta][fiat]" class="form-select">
                                                    <option{{ (data_get($settings, 'config.meta.fiat')=='alter') ? ' selected ' : '' }} value="alter">{{ __('Secondary Currency') }}</option>
                                                    @foreach($fiat_currencies as $code => $name)
                                                        <option{{ (data_get($settings, 'config.meta.fiat')==$code) ? ' selected ' : '' }} value="{{ $code }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-note">{{ __('Crypto amount show in currency') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xl-6 col-xxl-3">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Max Time for Payment') }}<span class="text-danger"></span></label>
                                            <div class="form-control-wrap">
                                                <select name="config[meta][timeout]" class="form-select">
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='0') ? ' selected ' : '' }} value="0">{{ __('No Limit') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='30') ? ' selected ' : '' }} value="30">{{ __('Max 30 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='60') ? ' selected ' : '' }} value="60">{{ __('Max 60 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='90') ? ' selected ' : '' }} value="90">{{ __('Max 90 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='120') ? ' selected ' : '' }} value="120">{{ __('Max 120 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='150') ? ' selected ' : '' }} value="150">{{ __('Max 150 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='180') ? ' selected ' : '' }} value="180">{{ __('Max 180 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='210') ? ' selected ' : '' }} value="210">{{ __('Max 210 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='240') ? ' selected ' : '' }} value="240">{{ __('Max 240 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='300') ? ' selected ' : '' }} value="300">{{ __('Max 300 Minutes') }}</option>
                                                    <option{{ (data_get($settings, 'config.meta.timeout')=='360') ? ' selected ' : '' }} value="360">{{ __('Max 360 Minutes') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-note">{{ __('An expiry countdown will display.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Method Name') }} <span class="small">{{ __('Alternet') }}</span></label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="config[meta][title]" class="form-control" value="{{ data_get($settings, 'config.meta.title') }}">
                                            </div>
                                            <div class="form-note">{{ __('Method title will use if leave blank.') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="currency-supported">{{ __('Supported Wallet') }}</label>
                                        <div class="form-control-group">
                                            <ul class="custom-control-group g-2 align-center flex-wrap li-w225">
                                                @foreach($currencies as $currency)
                                                <li>
                                                    <div class="custom-control custom-control-sm custom-switch">
                                                        <input type="checkbox" class="custom-control-input toggle-switch-opt" name="currencies[]" data-switch="switch-to-wallet-{{ strtolower(data_get($currency, 'code')) }}" value="{{ data_get($currency, 'code') }}" id="cur-{{data_get($currency, 'code')}}"{{ !is_active_currency(data_get($currency, 'code')) ? ' disabled' : '' }} @if(in_array(data_get($currency, 'code'), data_get($settings, 'currencies', []))) checked @endif>
                                                        <label class="custom-control-label" for="cur-{{data_get($currency, 'code')}}">{{ __(':name (:code)', ["name" => data_get($currency, 'name'), "code" => data_get($currency, 'code')]) }}</label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="note mt-4 pl-2 border-left border-primary">
                                            <p>
                                                <strong>{{ __('Please Note:') }}</strong><br>
                                                <em class="icon ni ni-dot"></em> {{ __('Ensure you have access of your wallet and entered correct address.') }}<br>
                                                <em class="icon ni ni-dot"></em> {{ __('The address will display to user when they going to deposit / payment.') }}<br>
                                                <em class="icon ni ni-dot"></em> {{ __('A payment reference (optional) form will display to user if field set show.') }}<br>
                                                <em class="icon ni ni-dot"></em> {{ __('If enable supported wallet but did not add address then it will inactive automatically.') }}</p>
                                        </div> 
                                        <div class="note mt-2 pl-2 border-left border-primary">
                                            <p><small><sup>1</sup></small> 
                                                {{ __("The amount will apply only if its more than the base minimum deposit amount.") }}<br>
                                                <small><sup>2</sup></small> 
                                                {{ __("The fixed minimum amount will be set and override to any minimum deposit amount.") }}<br>
                                            </p>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-set wide-md">
                                @foreach ($currencies as $currency)
                                @php $code = $currency['code']; $code_lower = strtolower($currency['code']); @endphp
                                <div class="switch-content switch-to-wallet-{{ $code_lower }}{{ (in_array(data_get($currency, 'code'), data_get($settings, 'currencies', []))) ? ' switch-active' : '' }}">
                                    <div class="card bg-lighter p-3 pb-4 mt-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="wallet-{{ $code_lower }}">{{ __(':name Payment Address', ['name' => data_get($currency, 'name')]) }}</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em class="icon ni {{ data_get($currency, 'symbol') }}"></em></div>
                                                        <input id="wallet-{{ $code_lower }}" type="text" placeholder="{{ __('Enter your :currency wallet address', ['currency' => data_get($currency, 'code') ]) }}" class="form-control" name="config[wallet][{{ $code }}][address]" value="{{ data_get($settings, 'config.wallet.'.$code.'.address') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row g-3">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Minimum') }} <small><sup>2</sup></small> </label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-text-hint"><span>{{ $code }}</span></div>
                                                                <input type="number" class="form-control" name="config[wallet][{{ $code }}][min]" value="{{ data_get($settings, 'config.wallet.'.$code.'.min', '0') }}" min="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="wallet-{{ $code_lower }}-ref">{{ __('Reference Field') }}</label>
                                                            <div class="form-control-wrap">
                                                                <select name="config[wallet][{{ $code }}][ref]" class="form-select" id="wallet-{{ $code_lower }}-ref">
                                                                    <option{{ (data_get($settings, 'config.wallet.'.$code.'.ref')=='no') ? ' selected ' : '' }} value="no">{{ __('Hide') }}</option>
                                                                    <option{{ (data_get($settings, 'config.wallet.'.$code.'.ref')=='yes') ? ' selected ' : '' }} value="yes">{{ __('Show') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($code=='ETH')
                                            <div class="col-12">
                                                <div class="row g-3">
                                                    <div class="col-6 col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Gas Limit') }}</label>
                                                            <div class="form-control-wrap">
                                                                <input class="form-control" placeholder="Optional" type="text" name="config[wallet][{{ $code }}][limit]" value="{{ data_get($settings, 'config.wallet.'.$code.'.limit') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label">{{ __('Gas Price') }}</label>
                                                            <div class="form-control-wrap">
                                                                <input class="form-control" placeholder="Optional" type="text" name="config[wallet][{{ $code }}][price]" value="{{ data_get($settings, 'config.wallet.'.$code.'.price') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="divider"></div>
                            <div class="d-flex justify-between">
                                @csrf
                                <input type="hidden" name="slug" value="{{ data_get($config, 'slug') }}">
                                <div class="custom-control custom-switch">
                                    <input class="switch-option-value" type="hidden" name="status" value="{{ data_get($settings, 'status') ?? 'inactive' }}">
                                    <input type="checkbox" class="custom-control-input switch-option" data-switch="active"{{ (data_get($settings, 'status', 'inactive') == 'active') ? ' checked' : ''}}  id="enable-method">
                                    <label class="custom-control-label" for="enable-method"><span class="over"></span><span>{{ __('Enable Method') }}</span></label>
                                </div>
                                <button type="button" class="btn btn-primary submit-settings" disabled="">
                                    <span class="spinner-border spinner-border-sm hide" role="status" aria-hidden="true"></span>
                                    <span>{{ __('Update') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

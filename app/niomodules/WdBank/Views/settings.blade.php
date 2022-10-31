@extends('admin.layouts.modules')
@section('title', __('Bank Transfer - Withdraw Method'))

@php
$formFieldMap = [
    [
        'label' => __('Account Type'),
        'name' => 'acc_type',
        'show' => 'disabled',
        'required' => 'disabled',
        'default' => 'yes',
    ],
    [
        'label' => __('Account Holder Name'),
        'name' => 'acc_name',
        'show' => 'disabled',
        'default' => 'yes',
    ],
    [
        'label' => __('Account Number'),
        'name' => 'acc_no',
        'show' => 'disabled',
        'required' => 'disabled',
        'default' => 'yes',
    ],
    [
        'label' => __('Name of Bank'),
        'name' => 'bank_name',
        'show' => 'disabled',
        'required' => 'disabled',
        'default' => 'yes',
    ],
    [
        'label' => __('Branch Name'),
        'name' => 'bank_branch',
        'default' => 'yes',
    ],
    [
        'label' => __('Bank Address'),
        'name' => 'bank_address',
        'default' => 'no',
    ],
    [
        'label' => __('Bank Currency'),
        'name' => 'currency',
        'show' => 'disabled',
        'required' => 'disabled',
        'default' => 'yes',
    ],
    [
        'label' => __('Bank Country'),
        'name' => 'country',
        'default' => 'yes',
    ],
    [
        'label' => __('Sort code'),
        'name' => 'sortcode',
        'default' => 'no',
    ],
    [
        'label' => __('IBAN Number'),
        'name' => 'iban',
        'default' => 'no',
    ],
    [
        'label' => __('Routing Number'),
        'name' => 'routing',
        'default' => 'no',
    ],
    [
        'label' => __('Swift / BIC'),
        'name' => 'swift',
        'default' => 'yes',
    ]
];
@endphp

@section('content')
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">{{ __('Withdraw Methods') }}</h3>
                    <p>{{ __('Manage withdraw methods for user.') }}</p>
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
                    <h5 class="title">{{ __('Bank Transfer - Withdraw') }} <span class="meta ml-1"><span class="badge badge-pill badge-xs badge-light">{{ __('Core') }}</span></span></h5>
                    <div class="go-back"><a class="back-to" href="{{ route('admin.settings.gateway.withdraw.list') }}"><em class="icon ni ni-arrow-left"> </em> {{ __('Back') }}</a></div>
                </div>
                <p>{{ __('Get the bank details from user for withdrawal funds.') }}</p>
                <div class="divider"></div>
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.settings.gateway.withdraw.wd-bank-transfer.save') }}" class="form-settings" method="POST">
                            <div class="form-set wide-md">
                                <h6 class="title mb-3">{{ __('Method Setting') }}</h6>
                                <div class="row gy-3">
                                    <div class="col-12 col-xxl-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Method Title') }}</label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="name" class="form-control" value="{{ data_get($settings, 'name', __('Wire Transfer')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xxl-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Description') }}</label>
                                            <div class="form-control-group">
                                                <input type="text" name="desc" value="{{ data_get($settings, 'desc', __('Withdraw your funds directly on your bank.')) }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-8 col-xxl-6">
                                        <div class="form-group opt-disable" title="{{ __('Upcoming future update for extended license.') }}" data-toggle="tooltip">
                                            <label class="form-label" for="gateway-fee">{{ __('Fees') }} <span>({{ __('per transaction') }})</span></label>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <div class="form-control-wrap">
                                                        <div class="form-text-hint">
                                                            <span class="overline-title">P</span>
                                                        </div>
                                                        <input type="text" disabled="" class="form-control" id="gateway-fee-percent" placeholder="0">
                                                    </div>
                                                    <div class="form-note">{{ __('Percent Fee') }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-control-wrap">
                                                        <div class="form-text-hint">
                                                            <span class="overline-title">F</span>
                                                        </div>
                                                        <input type="text" disabled="" class="form-control" id="gateway-fee-flat" placeholder="0">
                                                    </div>
                                                    <div class="form-note">{{ __('Flat Fee') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xxl-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Minimum Amount') }}</label>
                                            <div class="form-control-wrap">
                                                <div class="form-text-hint"><span>{{ base_currency() }}</span></div>
                                                <input type="number" class="form-control" name="min_amount" value="{{ data_get($settings, 'min_amount', '0') }}" min="0">
                                            </div>
                                            <div class="form-note">{{ __('Amount will be convert.') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Method Name') }} <span class="small">{{ __('Alternet') }}</span></label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="config[meta][title]" class="form-control" value="{{ data_get($settings, 'config.meta.title') }}">
                                            </div>
                                            <div class="form-note">{{ __('Method title will use if leave blank. Use as short name in transaction record.') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="currency-supported">{{ __('Supported Currency') }}</label>
                                        <div class="form-control-group">
                                            <ul class="custom-control-group g-2 align-center flex-wrap li-w225">
                                                @foreach($currencies as $currency)
                                                <li>
                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="currencies[]" value="{{ data_get($currency, 'code') }}" id="cur-{{data_get($currency, 'code')}}"{{ !is_active_currency(data_get($currency, 'code')) ? ' disabled' : '' }} @if(in_array(data_get($currency, 'code'), data_get($settings, 'currencies', []))) checked @endif>
                                                        <label class="custom-control-label" for="cur-{{data_get($currency, 'code')}}">{{ __(':name (:code)', ["name" => data_get($currency, 'name'), "code" => data_get($currency, 'code')]) }}</label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="default-currency">{{ __('Default Currency') }}</label>
                                            <div class="form-control-wrap w-max-250px">
                                                <select name="config[meta][currency]" class="form-select" id="default-currency">
                                                    @foreach($currencies as $currency)
                                                        <option value="{{ data_get($currency, 'code') }}"{{ (data_get($currency, 'code')==data_get($settings, 'config.meta.currency')) ? ' selected' : '' }}{{ !is_active_currency(data_get($currency, 'code')) ? ' disabled' : '' }}>
                                                            {{ __(':name (:code)', ["name" => data_get($currency, 'name'), "code" => data_get($currency, 'code')]) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-note">{{ __('Default currency will be selected by default when user add account for withdraw.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="minimum-override">{{ __('Minimum Amount') }} <span>/ {{ __('To Specific') }}</span></label>
                                            <div class="form-control-wrap w-max-250px">
                                                <input type="number" class="form-control" name="config[meta][min]" value="{{ data_get($settings, 'config.meta.min', '0') }}" min="0" id="minimum-override">
                                            </div>
                                            <div class="form-note">{{ __('Override base minimum and amount will same for all currencies.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="form-set wide-sm">
                                <h6 class="title mb-3">{{ __('Display Form Fields') }}</h6>
                                <div class="row gy-2">
                                    @foreach($formFieldMap as $field)
                                    <div class="col-12">
                                        <div class="row align-center">
                                            <div class="col-12 col-sm-6">
                                                <p class="title">{{ $field['label'] }}</p>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="custom-control custom-control-sm custom-switch">
                                                    <input class="switch-option-value" type="hidden" name="form-fields[{{ $field['name'] }}][show]" value="{{ data_get($settings, 'config.form.'.$field['name'].'.show') ?? data_get($field, 'default') }}">
                                                    <input type="checkbox" class="custom-control-input switch-option" {{ data_get($field, 'show') }} data-switch="yes"{{ (data_get($settings, 'config.form.'.$field['name'].'.show', data_get($field, 'default')) == 'yes') ? ' checked' : ''}} id="bank-{{ $field['name'] }}">
                                                    <label class="custom-control-label" for="bank-{{ $field['name'] }}"><span class="over"></span><span>{{ __('Show') }}</span></label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                    <input class="switch-option-value" type="hidden" name="form-fields[{{ $field['name'] }}][req]" value="{{ data_get($settings, 'config.form.'.$field['name'].'.req') ?? data_get($field, 'default') }}">
                                                    <input type="checkbox" class="custom-control-input switch-option" {{ data_get($field, 'required') }} data-switch="yes"{{ (data_get($settings, 'config.form.'.$field['name'].'.req', data_get($field, 'default')) == 'yes') ? ' checked' : ''}}  id="bank-{{ $field['name'] }}-req">
                                                    <label class="custom-control-label" for="bank-{{ $field['name'] }}-req"><span class="over"></span><span>{{ __('Required') }}</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-12">
                                        <div class="notes mt-4">
                                            <ul>
                                                <li class="alert-note is-plain text-danger">
                                                    <em class="icon ni ni-alert-circle"></em>
                                                    <p>{{ __("Changes any fields does not affect on existing account as it only applicable for new account.") }}</p>
                                                </li>
                                                <li class="alert-note is-plain">
                                                    <em class="icon ni ni-info"></em>
                                                    <p>{{ __('These form fields will show to user when they are adding an account for withdraw.') }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
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
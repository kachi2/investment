<div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
        <a href="javascript:void(0)" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
        <div class="modal-body modal-body-md">
            <div class="nk-modal-title">
                <h4 class="title mb-3">{!! __('Process your profit') !!}</h4>
                <p>{!! __('Clicking on process profit will transfer funds from profit to investment wallet') !!}</p>
               
            </div>
            <div class="nk-block">
                <div class="progress-wrap">
                    <div class="progress-text">
                        <div class="label text-base fw-medium">
                            {{ __('Profit amount to procces') }}
                        </div>
                        <div class="amount text-base fw-medium">{{ money($amount, base_currency()) }}</div>
                    </div>
                    <div class="progress-text">
                        <div class="label text-base fw-medium">
                            {{ __('Total Profits Entries') }}
                        </div>
                        <div class="amount text-base fw-medium">{{ $total ?? 0 }}</div>
                    </div>
                  
                    <div class="progress progress-lg">
                        <div class="progress-bar progress-bar-striped progress-bar-animated pup-status"></div>
                    </div>
                </div>
                <form action="{{ route('user.investment.process.profits.payout') }}" method="POST">
                    @csrf
                    @foreach ($payouts as $value)
                    @foreach ($value as $values)
                   
                    <input type="hidden" name="payouts[]" value="{{$values}}">
                    @endforeach
                    @endforeach
                    
                <ul class="align-center flex-nowrap mt-4 pb-2 pt-1">
                    <li>
                        <button type="submit" class="btn btn-primary m-ivs-sync">{{ __('Process Profits') }}</button>
                    </li>
                </ul>
                </form>
                <div class="divider md stretched"></div>
                <div class="notes">
                    <ul>
                        <li class="alert-note is-plain">
                            <em class="icon ni ni-help"></em>
                            <p>{{ __("You can transfer funds from investment wallet to main wallet") }}</p>
                        </li>
                        <li class="alert-note is-plain text-danger">
                            <em class="icon ni ni-alert"></em>
                            <p>{{ __("Note: This applies to only completed investments") }}</p>
                        </li>
                    </ul>
                </div>
              
            </div>
           
        </div>
    </div>
</div>

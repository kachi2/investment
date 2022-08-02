@extends('frontend.layouts.master')

@section('title', gss('front_page_title', __("Welcome")))
@section('desc', gss('seo_description_home', gss('seo_description', '')))
@section('keyword', gss('seo_keyword_home', gss('seo_keyword', '')))

@section('content')
<section id="main-content" class="">
<div id="demos">
    <h2 style="display:none;">heading</h2>
    <div id="carouselTicker" class="carouselTicker">
       <ul class="carouselTicker__list">
       @if(count($coins) > 0)
       @foreach ($coins as $coin)
          <li class="carouselTicker__item">
             <div class="coin_info">
                <div class="inner">
                   <div class="coin_name">
                      {{$coin['name']}}
                      @if($coin['market_cap_change_percentage_24h'] > 0)
                      <span class="update_change_plus" style="color:lightgreen">{{$coin['market_cap_change_percentage_24h']}}%</span>
                      @else
                      <span class="update_change_minus">{{$coin['market_cap_change_percentage_24h']}}%</span>
                      @endif
                   </div>
                   <div class="coin_price">
                     ${{number_format($coin['current_price'],2)}}
                     @if($coin['price_change_24h'] > 0) 
                     <span class="scsl__change_plus" style="color:lightgreen">{{round($coin['price_change_24h'],2)}}</span>
                     @else
                     <span class="scsl__change_minus">{{round($coin['price_change_24h'],2)}}</span>
                     @endif
                   </div>
                   <div class="coin_time">
                      ${{number_format($coin['market_cap'])}}
                   </div>
                </div>
             </div>
          </li>  
       @endforeach
       @endif
       </ul>
    </div>
 </div>
</section>
<section id="slider" style="height: 700px;" class="section slider-area">
    <div class="container text-center">

        <!-- intro text -->
        <div class="intro-text clearfix">
            <h2 style="color: #fff;">Maze Options a Trading company You Can Trust</h2>
            <p>Maze Options Limited is a highly trusted crypto Trading comapany, helping millions of individuals and firms across the globe to safely Trade and earn more with crypto currency.</p>
            <div class="btn-set">
                <a href="{{ route('auth.register.form') }}" class="btn btn-dark">SignUp Now</a>
                <a href="{{ route('auth.login.form') }}" class="btn btn-white">Login Now</a>
            </div>
        </div>

    </div>
</section>
<section id="about" class="about-area section-big">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-sm-6">
                <div class="about-content">
                    <h2>Join Thousands of Brokers and Trade Live</h2>
                    <p>Maze Options Limited As a client- oriented company, we embrace the needs of the traders whom expect and demand tight spread, fast execution, and Transparency of operation.</p><br>
                    <p>
                        Whether you are an experienced trader or new into currency trading, our user-friendly trading platforms are simple yet sophisticated enough to give you the best Trading experience and provide quality trading infrastructure for all types of clients
                    </p>
                    <a href="https://live.mazeoptions.com" class="btn">Join Now</a>
                </div>
            </div>
            <div class="col-sm-6 fw-col about-bg">
                <div class="about-img">
                </div>
            </div>

        
        </div>
    </div>
</section>
<!-- About area ends -->
<!-- Counter area starts -->
<section class="counter-area section-big">
    <div class="container">
        <!-- Counter starts -->
        <div class="row fun-fact-area">
            <div class="col-sm-6 col-md-3 col-xs-6 col-xxs-12">
                <div class="fun-fact tab-margin-bottom">
                    <img src="assets/img/counter/1.png" alt="">
                    <h3><span class="cp-counter">300k+</span></h3>
                    <p>Total Investors</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-xs-6 col-xxs-12">
                <div class="fun-fact tab-margin-bottom">
                    <img src="assets/img/counter/2.png" alt="">
                    <h3> <span class="cp-counter">$550M+</span></h3>
                    <p>Investments</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-xs-6 col-xxs-12">
                <div class="fun-fact">
                    <img src="assets/img/counter/3.png" alt="">
                    <h3> <span class="cp-counter">$187M+</span></h3>
                    <p>Total profits</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-xs-6 col-xxs-12">
                <div class="fun-fact">
                    <img src="assets/img/counter/4.png" alt="">
                    <h3> <span class="cp-counter">75M+</span></h3>
                    <p>Total Withdrawal</p>
                </div>
            </div>
        </div>
        <!-- Counter ends -->
    </div>
    <a class="btn btn-white" href="{{ route('auth.register.form') }}">Get Started Now</a>
</section>
<!-- Counter area ends -->

@if(!empty($schemes))
<section class="section bg-lighter pt-5 py-1">
    <div class="container wide-lg text-center">
        <h2>Investment Plans</h2>
        <p>Choose from one of our Investment packages, and start investing with ease!</p>
        <div class="row justify-content-center g-gs">

            <div class="col-lg-4 order-lg-2">
                <div class="pricing card card-shadow h-100 is-dark round-lg text-center">
                    <div class="card-inner card-inner-lg h-100 d-flex flex-column">
                        <h5 class="pricing-title">{{ data_get($schemes['highlight'], 'name') }}</h5>
                        <span class="fs-20px">{{ data_get($schemes['highlight'], 'total_return') }}% {{ __("ROI") }}</span>
                        <div class="pricing-parcent">
                            <h3 class="percent">{{ data_get($schemes['highlight'], 'rate_text') }}</h3>
                            <h5 class="text">{{ data_get($schemes['highlight'], 'calc_period') }}</h5>
                        </div>
                        <ul class="pricing-feature">
                            <li>
                                <span>{{ __("Investment Period") }}</span>
                                <span>{{ data_get($schemes['highlight'], 'term_text') }}</span>
                            </li>
                            <li>
                                <span>{{ __("Investments") }}</span>
                                @if(data_get($schemes['highlight'], 'is_fixed'))
                                <span>{{ money(data_get($schemes['highlight'], 'amount'), base_currency()) }}</span>
                                @else
                                <span>{{ money(data_get($schemes['highlight'], 'amount'),  base_currency()) }} - {{ data_get($schemes['highlight'], 'maximum') ? money(data_get($schemes['highlight'], 'maximum'),  base_currency()) : __("Unlimited") }}</span>
                                @endif
                            </li>
                            <li>
                                <span>{{ __("Capital Return") }}</span>
                                <span>{{ (data_get($schemes['highlight'], 'capital') == 1) ? __("End of Term") : "Each Term" }}</span>
                            </li>
                        </ul>
                        <div class="pricing-action mt-auto">
                            @if (!auth()->check())
                            <a class="btn btn-primary btn-lg btn-block" href="{{ route('auth.register.form') }}">{{ __("Make a deposit") }}</a>
                            @else
                            <a class="btn btn-primary btn-lg btn-block" href="{{ route('user.investment.invest', data_get($schemes['highlight'], 'uid_code')) }}">{{ __("Invest Now") }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="pricing card card-shadow h-100 round-lg text-center">
                    <div class="card-inner card-inner-lg h-100 d-flex flex-column">
                        <h5 class="pricing-title">{{ data_get($schemes['one'], 'name') }}</h5>
                        <span class="fs-20px">{{ data_get($schemes['one'], 'total_return') }}% {{ __("ROI") }}</span>
                        <div class="pricing-parcent">
                            <h3 class="percent">{{ data_get($schemes['one'], 'rate_text') }}</h3>
                            <h5 class="text">{{ data_get($schemes['one'], 'calc_period') }}</h5>
                        </div>
                        <ul class="pricing-feature">
                            <li>
                                <span>{{ __("Investment Period") }}</span>
                                <span>{{ data_get($schemes['one'], 'term_text') }}</span>
                            </li>
                            <li>
                                <span>{{ __("Investments") }}</span>
                                @if(data_get($schemes['one'], 'is_fixed'))
                                <span>{{ money(data_get($schemes['one'], 'amount'), base_currency()) }}</span>
                                @else
                                <span>{{ money(data_get($schemes['one'], 'amount'),  base_currency()) }} - {{ data_get($schemes['one'], 'maximum') ? money(data_get($schemes['one'], 'maximum'),  base_currency()) : __("Unlimited") }}</span>
                                @endif
                            </li>
                            <li>
                                <span>{{ __("Capital Return") }}</span>
                                <span>{{ (data_get($schemes['one'], 'capital') == 1) ? __("End of Term") : "Each Term" }}</span>
                            </li>
                        </ul>
                        <div class="pricing-action mt-auto">
                            @if (!auth()->check())
                            <a class="btn btn-light btn-lg btn-block" href="{{ route('auth.register.form') }}">{{ __("Make a deposit") }}</a>
                            @else
                            <a class="btn btn-light btn-lg btn-block" href="{{ route('user.investment.invest', data_get($schemes['one'], 'uid_code')) }}">{{ __("Invest Now") }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="pricing card card-shadow h-100 round-lg text-center">
                    <div class="card-inner card-inner-lg h-100 d-flex flex-column">
                        <h5 class="pricing-title">{{ data_get($schemes['two'], 'name') }}</h5>
                        <span class="fs-20px">{{ data_get($schemes['two'], 'total_return') }}% {{ __("ROI") }}</span>
                        <div class="pricing-parcent">
                            <h3 class="percent">{{ data_get($schemes['two'], 'rate_text') }}</h3>
                            <h5 class="text">{{ data_get($schemes['two'], 'calc_period') }}</h5>
                        </div>
                        <ul class="pricing-feature">
                            <li>
                                <span>{{ __("Investment Period") }}</span>
                                <span>{{ data_get($schemes['two'], 'term_text') }}</span>
                            </li>
                            <li>
                                <span>{{ __("Investments") }}</span>
                                @if(data_get($schemes['two'], 'is_fixed'))
                                <span>{{ money(data_get($schemes['two'], 'amount'), base_currency()) }}</span>
                                @else
                                <span>{{ money(data_get($schemes['two'], 'amount'),  base_currency()) }} - {{ data_get($schemes['two'], 'maximum') ? money(data_get($schemes['two'], 'maximum'),  base_currency()) : __("Unlimited") }}</span>
                                @endif
                            </li>
                            <li>
                                <span>{{ __("Capital Return") }}</span>
                                <span>{{ (data_get($schemes['one'], 'capital') == 1) ? __("End of Term") : "Each Term" }}</span>
                            </li>
                        </ul>
                        <div class="pricing-action mt-auto">
                            @if (!auth()->check())
                            <a class="btn btn-light btn-lg btn-block" href="{{ route('auth.register.form') }}">{{ __("Make a deposit") }}</a>
                            @else
                            <a class="btn btn-light btn-lg btn-block" href="{{ route('user.investment.invest', data_get($schemes['two'], 'uid_code')) }}">{{ __("Invest Now") }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- .row --}}
    </div>{{-- .container --}}
</section>
@endif

<!-- Feature area starts -->
<section id="feature" class="feature-area section-big">
    <div class="container">

        <div class="row">

            <div class="col-sm-6">
                <div class="feture-img">    
                    <img src="assets/img/feature/feature.png" alt="">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="feature-box">
                    <img src="assets/img/feature/icon-1.png" alt="">
                    <div class="feature-content">
                        <h3>Our Mission</h3>
                        <p>To make cryptocurrency Trading easy and simple for everyone, by empowering individuals, Tradeors, and developers to join the revolution.</p>
                    </div>
                </div>
                <div class="feature-box">
                    <img src="assets/img/feature/icon-2.png" alt="">
                    <div class="feature-content">
                        <h3>Our Advantages</h3>
                        <p>Our Organisation employs the best analyst and professional crypto traders who works with modern trends to bring more returns to your Trading.</p>
                    </div>
                </div>
                <div class="feature-box">
                    <img src="assets/img/feature/icon-3.png" alt="">
                    <div class="feature-content">
                        <h3>Our Values</h3>
                        <p>At Maze Options Limited, we belive that everyone should have an unmetered access to explore the wonderful world of crypto with all of its benefits.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Feature area ends -->

<!-- howitwork area starts -->
<section class="howitwork-area section-big">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Why Choose Us?</h2>
                    <p>         Round-the-Clock Support.

                        5 days a week and 24 hours a day easy accessibility by phone, email or live chat. Schedule a meeting with our trading professionals via our callback service.
                        Our service is competent and certified. Experienced traders are available to answer your questions.
                        Our staff will help you in a targeted manner even in tricky matters - if desired and required, for example by possible connection to your system.
                        Low Cost - Fair Trading Conditions and Transparency</p>
               
                        <p>
                        Trade with Mazeoptions at low costs.
                        We have received high customer satisfaction, among other things also thanks to the favorable Trading conditions..
                        The large product variety of Mazeoptions offers countless possibilities on the markets worldwide </p>
                </div>
            </div>
        </div>        

        <div class="row">

            <div class="col-md-3 col-sm-6">
                <div class="how-box">
                    <span>1</span>
                    <h3>STRONG SECURITY</h3>
                    <p>Our user data and digital assets are secure stored military grade protection against DDoS attacks and full data encryption</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="how-box">
                    <span>2</span>
                    <h3>AMAZING RETURNS</h3>
                    <p>We work with professional Bitcoin analysts with years of experience in Bitcoin trading to bring more returns to your Trading.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="how-box">
                    <span>3</span>
                    <h3>TRUSTED</h3>
                    <p>We Trade and processed millions of dollars in transactions daily with happy customers in over 90 countries.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="how-box">
                    <span>4</span>
                    <h3>YOUR FUNDS ARE INSURED</h3>
                    <p>Your digital assets stored on our servers is covered by world class insurance policy to help keep your assets safe.</p>
                </div>
            </div>

        </div>
    </div>
</section>


<div id="video" class="video-area section-big">
    <div class="container">
        <div class="row hr-center">

            <div class="col-md-4 col-sm-8">
                <div class="video-text">
                    <h4>Learn more about Mazeoptions</h4>
                    <h2>We are committed to what we say</h2>
                    <p>With over 200 support team, we are committed to making sure our clients are happy always.</p>
                </div>
            </div>
    
            <div class="col-md-8 col-sm-4">
                <div class="video-content">
                    <!--<video  controls width="100%" height="auto"  src="{{asset('/Mazeoptions.mp4')}}"   playsinline>-->
                    <!--  Your browser does not support the video tag.-->
                    <!--</video>-->
                    <video controls width="100%" height="auto" playsinline >
                  <source src="{{asset('Mazeoptions.mp4')}}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- video area ends -->

@if(gss('front_page_extra', 'on')=='on' && (!auth()->check() || (auth()->check() && auth()->user()->role=='user')))
<section class="section">
    <div class="container wide-lg">
        <div class="row g-gs">

            <div class="col-lg-8">
                <div class="row g-gs">
                    @if(!auth()->check())
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-shadow text-center h-100">
                            <div class="card-inner">
                                <div class="card-image">
                                    <img src="{{ asset('images/icon-a.png') }}" alt="">
                                </div>
                                <div class="card-text mt-4">
                                    <h6 class="title fs-14px">{{ (gss('extra_step1_title')) ? __(gss('extra_step1_title')) : __("Register your free account") }}</h6>
                                    <p>{{ (gss('extra_step1_text')) ? __(gss('extra_step1_text')) : __("Sign up with your email and get started!") }}</p>
                                </div>
                            </div>
                            <div class="card-inner py-2 border-top mt-auto">
                                <a class="link" href="{{ route('auth.register.form') }}">{{ __("Create an account") }}</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="{{ (auth()->check()) ? 'col-md-6' : 'col-md-4 col-sm-6' }}">
                        <div class="card card-shadow text-center h-100">
                            <div class="card-inner">
                                <div class="card-image">
                                    <img src="{{ asset('/images/icon-b.png') }}" alt="">
                                </div>
                                <div class="card-text mt-4">
                                    <h6 class="title fs-14px">{{ (gss('extra_step2_title')) ? __(gss('extra_step2_title')) : __("Deposit fund and invest") }}</h6>
                                    <p>{{ (gss('extra_step2_text')) ? __(gss('extra_step2_text')) : __("Just top up your balance & select your desired plan.") }}</p>
                                </div>
                            </div>
                            <div class="card-inner py-2 border-top mt-auto">
                                @if (!auth()->check())
                                <a class="link" href="{{ route('auth.register.form') }}">{{ __("Make a deposit") }}</a>
                                @else
                                <a class="link" href="{{ route('deposit') }}">{{ __("Make a deposit") }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="{{ (auth()->check()) ? 'col-md-6' : 'col-md-4' }}">
                        <div class="card card-shadow text-center h-100">
                            <div class="card-inner">
                                <div class="card-image">
                                    <img src="{{ asset('/images/icon-c.png') }}" alt="">
                                </div>
                                <div class="card-text mt-4">
                                    <h6 class="title fs-14px">{{ (gss('extra_step3_title')) ? __(gss('extra_step3_title')) : __("Payout your profits") }}</h6>
                                    <p>{{ (gss('extra_step3_text')) ? __(gss('extra_step3_text')) : __("Withdraw your funds to your account once earn profit.") }}</p>
                                </div>
                            </div>
                            <div class="card-inner py-2 border-top mt-auto">
                                @if (!auth()->check())
                                <a class="link" href="{{ route('auth.register.form') }}">{{ __("Withdraw profits") }}</a>
                                @else
                                <a class="link" href="{{ route('deposit') }}">{{ __("Withdraw profits") }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-shadow text-center h-100">
                    <div class="card-inner card-inner-lg my-auto">
                        <div class="card-text my-lg-n2">
                            <h6 class="title fs-14px">{{ (gss('extra_step4_title')) ? __(gss('extra_step4_title')) : __("Payment processors we accept") }}</h6>
                            <p>{{ (gss('extra_step4_text')) ? __(gss('extra_step4_text')) : __("We accept paypal, cryptocurrencies such as Bitcoin, Litecoin, Ethereum more.") }}</p>
                            <ul class="icon-list icon-bordered icon-rounded mb-3">
                                <li><em class="icon ni ni-paypal-alt"></em></li>
                                <li><em class="icon ni ni-bitcoin"></em></li>
                                <li><em class="icon ni ni-sign-eth"></em></li>
                                <li><em class="icon ni ni-sign-ltc"></em></li>
                            </ul>
                            <div class="payment-action">
                                @if (!auth()->check())
                                <a href="{{ route('auth.register.form') }}" class="btn btn-lg btn-primary btn-block"><span>{{ __("Join now") }} {{ __("and") }} {{ __("make deposit") }}</span></a>
                                @else
                                <a class="btn btn-lg btn-primary btn-block" href="{{ route('deposit') }}">{{ __("Make a deposit") }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<div class="gap gap-lg"></div>
@endif

@endsection

@push('scripts')
    <script>

    </script>
@endpush
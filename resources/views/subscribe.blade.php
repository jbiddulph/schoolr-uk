@extends('layouts.subscription')

@section('head')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
            margin-bottom: 20px;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
        select.form-control, input.form-control {
            margin-bottom:20px;
        }
    </style>
@endsection

@section('content')

<div class="container subscription-page">
    <div class="row">
        <div class="col-md-8 offset-sm-2">
            <h2>Customise your venue page and start listing events now</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Choose your subscription type below</div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif

                        <select name="plan" class="form-control" id="subscription-plan">
                            @foreach($plans as $key=>$plan)
                                <option value="{{$key}}">{{$plan}}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" id="card-holder-name" placeholder="Card Holders Name">

                        <div id="card-element"></div>
                        <button id="card-button" class="btn btn-sm btn-primary" data-secret="{{ $intent->client_secret }}">
                            Subscribe
                        </button>
                        <br />
                        <div id="errormessage"></div>
                    <p>Click Subscribe once and wait to be redirected</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 justify-content-center">
            <div id="monthly-option">
                <img src="{{asset('assets/media/misc/monthly-option.jpg')}}" alt="" width="100%" align="right">
            </div>
            <div id="three-option">
                <img src="{{asset('assets/media/misc/yearly-option.jpg')}}" alt="" width="100%" align="right">
            </div>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        window.addEventListener('load', function () {
            const stripe = Stripe('{{env('STRIPE_KEY')}}');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            const plan = document.getElementById('subscription-plan').value;

            cardButton.addEventListener('click', async (e) => {
                const { setupIntent, error } = await  stripe.handleCardSetup(
                    clientSecret, cardElement, {
                        payment_method_data: {
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if(error) {
                    console.log(error)
                } else {

                    console.log('handling success', setupIntent.payment_method);
                    axios.post('/subscribe',{
                        payment_method: setupIntent.payment_method,
                        plan: plan
                    }).then((data)=>{
                        console.log(data.message)
                        $('#errormessage').text(data.message);
                        location.replace(data.data.success)
                    });
                }
            });
        });
    </script>
@endsection

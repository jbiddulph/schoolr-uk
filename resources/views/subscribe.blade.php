@extends('layouts.app')

@section('head')
    <script src="https://js.stripe.com/v3/"></script>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Subscribe</h3>
            <div class="card">
                <div class="card-header">Subscribe</div>
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
                </div>
            </div>
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

                } else {
                    console.log('handling success', setupIntent.payment_method);
                    axios.post('/subscribe',{
                        payment_method: setupIntent.payment_method,
                        plan: plan
                    }).then((data)=>{
                        location.replace(data.data.success)
                    });
                }
            });
        });
    </script>
@endsection
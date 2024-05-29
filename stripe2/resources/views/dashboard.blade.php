@section('style')
<style>
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
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
</style>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
    <input id="card-holder-name" type="text"><label for="card-holder-name">Card Holder Name</label>
    @csrf
    <div class="form-row">
        <label for="card-element">Credit or debit card</label>
        <div id="card-element" class="form-control">
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <div class="stripe-errors"></div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
    @endif
    <div class="form-group text-center">
        <button  id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success btn-block">SUBMIT</button>
    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.confirmCardSetup(
                '{{ $intent->client_secret }}',
                {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: 'Customer Name',
                        },
                    },
                }
            ).then(function (result) {
                if (result.error) {
                    // Display error.message in your UI.
                } else {
                    // The setup has succeeded. Send the payment method ID to your server.
                }
            });
        });
    });
</script>

<form id="payment-form">
    <div id="card-element"></div>
    <button type="submit">Submit Payment</button>
</form>

@endsection

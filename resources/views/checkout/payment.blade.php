@extends('layouts.app')

@section('title', 'Complete Payment | Nami Lontar')

@section('content')
<main class="payment-container container" style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
    <div class="payment-card" style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); text-align: center; max-width: 500px; width: 100%;">
        <div class="payment-icon" style="font-size: 4rem; color: #d4af37; margin-bottom: 1.5rem;">
            <i class="fa-solid fa-credit-card"></i>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; margin-bottom: 1rem;">Complete Your Order</h1>
        <p style="color: #666; margin-bottom: 2rem;">Please complete your payment to finalize your artisanal selection. You will be redirected to our secure payment gateway.</p>
        
        <div class="order-details" style="background: #fdfaf5; padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; text-align: left;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="color: #888;">Order ID</span>
                <span style="font-weight: 600;">#{{ $order->id }}</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="color: #888;">Total Amount</span>
                <span style="font-weight: 600; color: #d4af37;">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <button id="pay-button" class="btn-checkout" style="width: 100%; border: none; cursor: pointer; padding: 1.2rem; font-size: 1rem; border-radius: 12px;"> PAY NOW </button>
        
        <p style="font-size: 0.8rem; color: #888; margin-top: 1.5rem;">
            <i class="fa-solid fa-shield-halved"></i> Secure payment processed by Midtrans
        </p>
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    const payButton = document.getElementById('pay-button');
    payButton.onclick = function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                /* You may add your own implementation here */
                alert("payment success!"); 
                console.log(result);
                // Clear cart
                cartManager.clearCart();
                window.location.href = "{{ route('orders') }}";
            },
            onPending: function (result) {
                /* You may add your own implementation here */
                alert("wating your payment!"); 
                console.log(result);
                cartManager.clearCart();
                window.location.href = "{{ route('orders') }}";
            },
            onError: function (result) {
                /* You may add your own implementation here */
                alert("payment failed!"); 
                console.log(result);
            },
            onClose: function () {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        });
    };
</script>
@endpush

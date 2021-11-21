@extends('templates.layout')

@section('title', __('titles.donate'))

@section('content')
    <script src="https://www.paypal.com/sdk/js?client-id={{Config::get('paypal.sandbox.client_id')}}&currency=USD"></script>
    <div class="container">
        <div class="row justify-content-center" id='donation'>
            <div class="col-md-5">
                <div class="card mb-3 shadow">
                    <div class="card-header">
                        <h3 class="card-title">Help us to improve our services</h3>
                    </div>
                    <div class="card-body justify-content-center">
                            <div id="inputs">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="input-group" id='amountField'>
                                    <span class="input-group-text">$</span>
                                    <input type="number" name='amount' class="form-control" min="1" value='1' id='amount' aria-label="Amount (to the nearest dollar)">
                                </div>
                                <div class="form-floating mt-2">
                                    <textarea class="form-control" placeholder="Leave a message here" name="message" id="message" id="floatingTextarea2" style="height: 200px"></textarea>
                                    <label for="floatingTextarea2">Your Message</label>
                                </div>
                            </div>
                            <div class='d-flex justify-content-center mt-2'>
                                <div id="paypal-button-container"></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var clicked = false
        paypal.Buttons({
             createOrder: function(data, actions) {
                return fetch('{{route("donation.create")}}', {
                    method: 'POST',
                    body:JSON.stringify({
                        'amount' : $("#amount").val(),
                        'message': $("#message").val(),
                    })
                }).then(function(res) {
                    //res.json();
                    return res.json();
                }).then(function(orderData) {
                    //console.log(orderData);
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('{{route("donation.capture")}}' , {
                    method: 'POST',
                    body :JSON.stringify({
                        orderId : data.orderID,
                        message: $("#message").val(),
                    })
                }).then(function(res) {
                    $('#donation').html(`
                        <div class="col-md-8">
                            <div class="card mb-3 shadow">
                                <div class="card-body justify-content-center">
                                    <h3 class='text-center'><i class="fas fa-heart" style='font-size: 72px;color:#e31b23;'></i></h3></br>
                                    <h3 class='card-title text-center'>Thank you for your donation!</h3>
                                </div>
                            </div>
                        </div>
                    `)
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
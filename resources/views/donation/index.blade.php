@extends('templates.layout')

@section('title', __('titles.donate'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5" id='donation'>
                <div class="card mb-3 shadow">
                    <div class="card-header">
                        <h3 class="card-title">Help us to improve our services</h3>
                    </div>
                    <div class="card-body justify-content-center">
                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method='POST'>
                            @csrf
                            <div id="inputs">
                            <input name="cmd" value="_donations" hidden>
                            <input name='business' value='sb-l6cpl8598274@business.example.com' hidden>
                            <input name='item_name' value='Donation' hidden>
                            <input name='currency_code' value='USD' hidden>
                            <input name='notify_url' value='{{ route("donation.notify") }}' hidden>
                            <input name='cancel_return' value='{{ route("donation.cancelled") }}' hidden>
                            <input name='return' value='{{ route("donation.success") }}' hidden>
                                <label for="amount" class="form-label">Amount</label>
                                <div class="input-group" id='amountField'>
                                    <span class="input-group-text">$</span>
                                    <input type="number" name='amount' class="form-control" min="1" value='1' id='amount' aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                            <div class='d-flex justify-content-center'>
                                <button type='submit' id='check' class="btn btn-warning mt-2 check">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var clicked = false
            $(document).on('click', '#check', function(event){
                if(!clicked){
                    event.preventDefault();
                    $('#amount').removeClass('is-invalid')
                    $('#alert').remove()
                    var amount = $('#amount').val()
                    if(amount<1)
                    {
                        $('#amountField').append(`<span class="invalid-feedback" id='alert' role="alert">
                            <strong>Wrong amount</strong>
                        </span>`)
                        $('#amount').addClass('is-invalid')
                    }else{
                        $('#amount').prop('disabled', true);
                        $('#inputs').append(`
                            <div class="form-group">
                                <label for="name" class="form-label">Message</label>
                                <textarea type="text" name='custom' style='height:200px;' placeholder='You can keep it empty' class="form-control" id="message"></textarea>
                            </div>
                        `)
                        $('#check').html('Donate Now');
                        clicked = true;
                    }
                }
            })
    </script>
@endsection
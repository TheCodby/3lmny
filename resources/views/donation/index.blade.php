@extends('templates.layout')

@section('title', __('titles.donate'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card mb-3 shadow">
                    <div class="card-header">
                    <h3 class="card-title">Help us to improve our services</h3>
                    </div>
                    <div class="card-body justify-content-center">
                    <label for="amount" class="form-label">Amount</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" min="1" value='1' id='amount' aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="btn btn-warning mt-2">Donate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
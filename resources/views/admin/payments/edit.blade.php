@extends('admin.layouts.app')
@section('title', 'Payment / Edit')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Edit Payment</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="brand_key" class="form-label">Brand</label>
                                <select class="form-control" id="brand_key" name="brand_key" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->brand_key }}" {{ old('brand_key', $payment->brand_key) == $brand->brand_key ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_key')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="team_key" class="form-label">Team</label>
                                <select class="form-control" id="team_key" name="team_key" required>
                                    <option value="">Select Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->team_key }}" {{ old('team_key', $payment->team_key) == $team->team_key ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('team_key')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="agent_id" class="form-label">Agent</label>
                                <select class="form-control" id="agent_id" name="agent_id" required>
                                    <option value="">Select Agent</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}" {{ old('agent_id', $payment->agent_id) == $agent->id ? 'selected' : '' }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agent_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="payment_type" class="form-label">Payment Type</label>
                                <div>
                                    <label>
                                        <input type="radio" name="payment_type" value="fresh" required
                                            {{ old('payment_type', $payment->payment_type) == 0 ? 'checked' : '' }}> Fresh
                                    </label>
                                    <label>
                                        <input type="radio" name="payment_type" value="upsale"
                                            {{ old('payment_type', $payment->payment_type) == 1 ? 'checked' : '' }}> Upsale
                                    </label>
                                </div>
                            </div>

                            <div class="fresh-fields mb-3" style="display: {{ old('payment_type', $payment->payment_type) == 'fresh' ? 'block' : 'none' }}">
                                <label for="client_name" class="form-label">Client Name</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" value="{{ old('client_name', $payment->client_name) }}">
                                @error('client_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="fresh-fields mb-3" style="display: {{ old('payment_type', $payment->payment_type) == 'fresh' ? 'block' : 'none' }}">
                                <label for="client_email" class="form-label">Client Email</label>
                                <input type="email" class="form-control" id="client_email" name="client_email" value="{{ old('client_email', $payment->client_email) }}">
                                @error('client_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="fresh-fields mb-3" style="display: {{ old('payment_type', $payment->payment_type) == 'fresh' ? 'block' : 'none' }}">
                                <label for="client_phone" class="form-label">Client Phone</label>
                                <input type="text" class="form-control" id="client_phone" name="client_phone" value="{{ old('client_phone', $payment->client_phone) }}">
                                @error('client_phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="upsale-fields mb-3" style="display: {{ old('payment_type', $payment->payment_type) == 'upsale' ? 'block' : 'none' }}">
                                <label for="client_key" class="form-label">Select Client</label>
                                <select class="form-control" id="client_key" name="client_key">
                                    <option value="">Select Client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->client_key }}" {{ old('client_key', $payment->client_key) == $client->client_key ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('client_key')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="1" value="{{ old('amount', $payment->amount) }}" required>
                                @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', optional($payment->invoice)->description) }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-control" id="payment_method" name="payment_method" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="credit_card" {{ old('payment_method', $payment->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="bank_transfer" {{ old('payment_method', $payment->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="paypal" {{ old('payment_method', $payment->payment_method) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="cash" {{ old('payment_method', $payment->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="other" {{ old('payment_method', $payment->payment_method) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('payment_method')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="transaction_id" class="form-label">Transaction ID</label>
                                <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{ old('transaction_id', $payment->transaction_id) }}">
                                @error('transaction_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="payment_type"]').on('change', function() {
                if ($(this).val() == 'fresh') {
                    $('.fresh-fields').show();
                    $('.upsale-fields').hide();
                } else if ($(this).val() == 'upsale') {
                    $('.fresh-fields').hide();
                    $('.upsale-fields').show();
                }
            });

            $('input[name="payment_type"]:checked').trigger('change');
        });
    </script>
@endsection

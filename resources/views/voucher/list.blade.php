@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between">
        <h3>{{ __('vouchers.list.title') }}</h3>
        <a class="btn btn-secondary btn-sm" href="{{ route('export') }}">{{ __("vouchers.list.export_btn") }}</a>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form id="filter-form" role="form" action="{{ route("vouchers") }}" method="GET" >
                @csrf
                <input id="order_col" type="hidden" name="order_col" value="{{ old('order_col', 'voucher') }}">
                <input id="order" type="hidden" name="order" value="{{ old('order', 'desc') }}">
                <div class="row row-cols-lg-4 row-cols-sm-1 row-cols-md-2">
                    <div class="col mt-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="voucher_num" class="col-form-label">{{ __('vouchers.list.filters.voucher') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" name="voucher_num" id="voucher_num" class="form-control @error('voucher_num') is-invalid @enderror"
                                       placeholder="{{ __('vouchers.list.filters.placeholder') }}" value="{{ old('voucher_num') }}">
                                @error('voucher_num')
                                    <div id="" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="cba" class="col-form-label">{{ __('vouchers.list.filters.cba') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="cba" name="cba" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}" value="{{ old('cba') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="payment_file_status" class="col-form-label">{{ __('vouchers.list.filters.payment_file_status') }}</label>
                            </div>
                            <div class="col">
                                <select class="form-select" id="payment_file_status" name="payment_file_status" aria-label="{{ __('vouchers.list.filters.payment_file_status') }}">
                                    <option selected>{{ __('vouchers.list.filters.payment_file_status_option_selected') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="confirmation" class="col-form-label">{{ __('vouchers.list.filters.confirmation') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" name="confirmation" id="confirmation" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}"
                                       value="{{ old('confirmation') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="customer_last_name" class="col-form-label">{{ __('vouchers.list.filters.customer_last_name') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}"
                                       value="{{ old('customer_last_name') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="brand" class="col-form-label">{{ __('vouchers.list.filters.brand') }}</label>
                            </div>
                            <div class="col">
                                <select class="form-select @error('brand') is-invalid @enderror" id="brand" name="brand" aria-label="{{ __('vouchers.list.filters.brand') }}">
                                    <option value="-1">{{ __('vouchers.list.filters.brand_option_selected') }}</option>
                                    @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" @if( old('brand', -1) == $brand->id) selected @endif>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                    <div id="" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="account" class="col-form-label">{{ __('vouchers.list.filters.account') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="account" name="account" class="form-control @error('account') is-invalid @enderror"
                                       placeholder="{{ __('vouchers.list.filters.placeholder') }}" value="{{ old('account') }}">
                                @error('account')
                                    <div id="" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="user" class="col-form-label">{{ __('vouchers.list.filters.user') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="user" name="user" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}" value="{{ old('user') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="status" class="col-form-label">{{ __('vouchers.list.filters.status') }}</label>
                            </div>
                            <div class="col">
                                <select class="form-select" id="status" name="status" aria-label="{{ __('vouchers.list.filters.status') }}">
                                    <option selected>{{ __('vouchers.list.filters.status_option_selected') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="issuer_account" class="col-form-label">{{ __('vouchers.list.filters.issuer_account') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="issuer_account" name="issuer_account" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}"
                                       value="{{ old('issuer_account') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">{{ __('vouchers.list.filters.create_date') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="create_date_from" name="create_date_from" class="form-control @error('create_date_from') is-invalid @enderror"
                                       placeholder="{{ __('vouchers.list.filters.create_date_from_placeholder') }}" value="{{ old('create_date_from') }}">
                                @error('create_date_from')
                                    <div id="" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="text" id="create_date_to" name="create_date_to" class="form-control @error('create_date_to') is-invalid @enderror"
                                       placeholder="{{ __('vouchers.list.filters.create_date_to_placeholder') }}" value="{{ old('create_date_to') }}">
                                @error('create_date_to')
                                    <div id="" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="past_due" class="col-form-label">{{ __('vouchers.list.filters.past_due') }}</label>
                            </div>
                            <div class="col form-check form-switch">
                                <input type="checkbox" id="past_due" name="past_due" class="form-check-input">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary me-3">{{ __('vouchers.list.submit') }}</button>
                    <a class="btn btn-sm btn-secondary" href="{{ route('vouchers') }}">{{ __('vouchers.list.clear') }}</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table id="vouchers-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-nowrap" onclick="orderBy('voucher')">
                                {{ __('vouchers.list.table.voucher') }}
                                @if($order_col == 'voucher')
                                    @if($order == 'asc') &#8593 @else &#8595 @endif
                                @endif
                            </th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.cba') }}</th>
                            <th class="text-nowrap" onclick="orderBy('brand')">
                                {{ __('vouchers.list.table.brand') }}
                                @if($order_col == 'brand')
                                    @if($order == 'asc') &#8593 @else &#8595 @endif
                                @endif
                            </th>
                            <th class="text-nowrap" onclick="orderBy('account')">
                                {{ __('vouchers.list.table.account_name') }}
                                @if($order_col == 'account')
                                    @if($order == 'asc') &#8593 @else &#8595 @endif
                                @endif
                            </th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.issuer_name') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.voucher_status') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.past_due') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.payment_file') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.customer_last_name') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.confirmation') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.issue_iata') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.gross_amount') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.gsa_net_amount') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.abg_net_amount') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.user') }}</th>
                            <th class="text-nowrap" onclick="orderBy('issue_date')">
                                {{ __('vouchers.list.table.create_date') }}
                                @if($order_col == 'issue_date')
                                    @if($order == 'asc') &#8593 @else &#8595 @endif
                                @endif
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($vouchers) > 0)
                            @foreach($vouchers as $voucher)
                                <tr class="text-nowrap">
                                    <th class="text-primary">{{ $voucher->voucher }}</th>
                                    <th>{{ $voucher->cba }}</th>
                                    <th>{{ $voucher->brand }}</th>
                                    <th>{{ $voucher->account_name }}</th>
                                    <th>{{ $voucher->issuer_name }}</th>
                                    <th>{{ $voucher->voucher_status }}</th>
                                    <th>{{ $voucher->past_due == 1 ? "Past Due": "" }}</th>
                                    <th>{{ $voucher->payment_file }}</th>
                                    <th>{{ $voucher->customer_last_name }}</th>
                                    <th>{{ $voucher->confirmation }}</th>
                                    <th>{{ $voucher->issue_iata }}</th>
                                    <th>{{ $voucher->gross_amount }}</th>
                                    <th>{{ $voucher->gsa_amount }}</th>
                                    <th>{{ $voucher->abg_amount }}</th>
                                    <th>{{ $voucher->user }}</th>
                                    <th>{{ \Carbon\Carbon::parse($voucher->create_date)->format("d-M-Y") }}</th>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="16">
                                    <H1>{{ __('vouchers.list.table.empty_results') }}</H1>
                                </th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $vouchers->appends(request()->all())->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
    <script>
        let orderBy = function (column) {
            let order = document.getElementById('order').value;
            document.getElementById('order').value = (order === 'asc') ? 'desc': 'asc';
            document.getElementById('order_col').value = column;
            document.getElementById('filter-form').submit();
            console.log(document.getElementById('order_col').value, document.getElementById('order').value);
        }
    </script>
@endsection

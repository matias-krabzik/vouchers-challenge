@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between">
        <h3>{{ __('vouchers.list.title') }}</h3>
        <button class="btn btn-secondary btn-sm">{{ __("vouchers.list.export_btn") }}</button>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route("vouchers.search") }}" method="POST">
                @csrf
                <div class="row row-cols-lg-4 row-cols-sm-1 row-cols-md-2">
                    <div class="col mt-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="voucher_num" class="col-form-label">{{ __('vouchers.list.filters.voucher') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="voucher_num" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="cba" class="col-form-label">{{ __('vouchers.list.filters.cba') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="cba" name="cba" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}">
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
                                <input type="text" name="confirmation" id="confirmation" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="customer_last_name" class="col-form-label">{{ __('vouchers.list.filters.customer_last_name') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="brand" class="col-form-label">{{ __('vouchers.list.filters.brand') }}</label>
                            </div>
                            <div class="col">
                                <select class="form-select" id="brand" name="brand" aria-label="{{ __('vouchers.list.filters.brand') }}">
                                    <option selected hidden>{{ __('vouchers.list.filters.brand_option_selected') }}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label for="account" class="col-form-label">{{ __('vouchers.list.filters.account') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="account" name="account" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label for="user" class="col-form-label">{{ __('vouchers.list.filters.user') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="user" name="user" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}">
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
                                <input type="text" id="issuer_account" name="issuer_account" class="form-control" placeholder="{{ __('vouchers.list.filters.placeholder') }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">{{ __('vouchers.list.filters.create_date') }}</label>
                            </div>
                            <div class="col">
                                <input type="text" id="create_date_from" name="create_date_from" class="form-control" placeholder="{{ __('vouchers.list.filters.create_date_from_placeholder') }}">
                            </div>
                            <div class="col">
                                <input type="text" id="create_date_to" name="create_date_to" class="form-control" placeholder="{{ __('vouchers.list.filters.create_date_to_placeholder') }}">
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
                    <button class="btn btn-sm btn-secondary">{{ __('vouchers.list.clear') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-nowrap">{{ __('vouchers.list.table.voucher') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.cba') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.brand') }}</th>
                            <th class="text-nowrap">{{ __('vouchers.list.table.account_name') }}</th>
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
                            <th class="text-nowrap">{{ __('vouchers.list.table.create_date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($vouchers) > 0)
                            <tr>
                                <th scope="row">1</th>
                            </tr>
                        @else
                            <tr>
                                <th colspan="16">
                                    <h1>No hay resultados para esta búsqueda.</h1>
                                </th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

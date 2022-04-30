<?php

namespace App\Http\Controllers;

use App\Http\Requests\Voucher\VoucherFilterRequest;
use App\Models\Company;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function index() {
        $query = DB::table('vouchers');
        $query->leftJoin('organizations', 'vouchers.gsa_organization_id', '=', 'organizations.id');
        $query->leftJoin('companies', 'vouchers.company_id', '=', 'companies.id');
        $query->where('vouchers.number');
        $vouchers = $query->get();

        $brands = Company::all();
        return view('voucher.list')->with("vouchers", $vouchers)->with("brands", $brands);
    }

    public function search(VoucherFilterRequest $request) {
        $request->input("voucher", null);
        return view('voucher.list')->with("vouchers", $vouchers);
    }
}

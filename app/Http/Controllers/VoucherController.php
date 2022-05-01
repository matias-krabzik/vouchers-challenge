<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Voucher\VoucherFilterRequest;

class VoucherController extends Controller
{
    public function index(VoucherFilterRequest $request) {
        $vouchers = $this->getVouchers(
            $request->input("voucher_num"),
            $request->input("account"),
            $request->input("create_date_from"),
            $request->input("create_date_to"),
            $request->input("brand", -1),
            $request->input("order_col", "voucher"),
            $request->input("order", "desc"),
            true
        );
        $brands = Company::all();

        session()->flashInput($request->input());

        return view('voucher.list')->with("vouchers", $vouchers)
            ->with("brands", $brands)
            ->with("order_col", $request->input("order_col", "voucher"))
            ->with("order", $request->input("order", "desc"));
    }

    public function export() {
        $filename = "exports.csv";
        $vouchers = $this->getVouchers(
            session()->getOldInput("voucher_num"),
            session()->getOldInput("account"),
            session()->getOldInput("create_date_from"),
            session()->getOldInput("create_date_to"),
            session()->getOldInput("brand", -1),
            session()->getOldInput("order_col", "voucher"),
            session()->getOldInput("order", "desc"),
            false
        );
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        $columns = [
            __('vouchers.list.table.voucher'),
            __('vouchers.list.table.cba'),
            __('vouchers.list.table.brand'),
            __('vouchers.list.table.account_name'),
            __('vouchers.list.table.issuer_name'),
            __('vouchers.list.table.voucher_status'),
            __('vouchers.list.table.past_due'),
            __('vouchers.list.table.payment_file'),
            __('vouchers.list.table.customer_last_name'),
            __('vouchers.list.table.confirmation'),
            __('vouchers.list.table.issue_iata'),
            __('vouchers.list.table.gross_amount'),
            __('vouchers.list.table.gsa_net_amount'),
            __('vouchers.list.table.abg_net_amount'),
            __('vouchers.list.table.user'),
            __('vouchers.list.table.create_date'),
        ];

        $callback = function () use ($vouchers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($vouchers as $voucher) {
                fputcsv($file, [
                    $voucher->voucher,
                    $voucher->cba,
                    $voucher->brand,
                    $voucher->account_name,
                    $voucher->issuer_name,
                    $voucher->voucher_status,
                    $voucher->past_due == 1 ? "Past Due": "",
                    $voucher->payment_file,
                    $voucher->customer_last_name,
                    $voucher->confirmation,
                    $voucher->issue_iata,
                    $voucher->gross_amount,
                    $voucher->gsa_amount,
                    $voucher->abg_amount,
                    $voucher->user,
                    Carbon::parse($voucher->create_date)->format("d-M-Y")
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getVouchers($voucher_num, $account,$create_date_from, $create_date_to, $brand, $order_col, $order, $paginated)
    {
        $query = DB::table('vouchers')
            ->select(
                'vouchers.number as voucher',
                'vouchers.account as cba',
                'companies.name as brand',
                'gsao.name as account_name',
                'org.name as issuer_name',
                'voucher_status.name as voucher_status',
                'vouchers.past_due as past_due',
                'payment_file_status.name as payment_file',
                'bookings.last_name as customer_last_name',
                'bookings.number as confirmation',
                'vouchers.iata_code as issue_iata',
                'vouchers.gross_amount as gross_amount',
                'vouchers.gsa_comission_amount as gsa_amount',
                'vouchers.abg_net_amount as abg_amount',
                DB::raw('CONCAT(users.name, " ", users.last_name) as user'),
                'vouchers.issue_date as create_date',
            );

        $query->leftJoin('companies', 'vouchers.company_id', '=', 'companies.id');
        $query->leftJoin('organizations as gsao', 'gsao.id', '=', 'vouchers.gsa_organization_id');
        $query->leftJoin('organizations as org', 'org.id', '=', 'vouchers.organization_id');
        $query->leftJoin('users', 'users.id', '=', 'vouchers.user_id');
        $query->leftJoin('voucher_status', 'voucher_status.id', '=', 'vouchers.voucher_status_id');
        $query->leftJoin('bookings', 'bookings.id', '=', 'vouchers.booking_id');
        $query->leftJoin('payment_files', 'payment_files.id', '=', 'vouchers.payment_file_id');
        $query->leftJoin('payment_file_status', 'payment_file_status.id', '=', 'payment_files.payment_file_status_id');

        // Filtramos por el número del voucher.
        if (!is_null($voucher_num)) {
            $query->where('vouchers.number', $voucher_num);
        }

        // Filtramos por el nombre de la orgacnización
        if (!is_null($account)) {
            $query->where('gsao.name', 'like','%'.$account.'%');
        }

        // Filtramos por Marca
        if ($brand >= 0) {
            $query->where('companies.id', $brand);
        }

        // Filtramos por fechas.
        if (!is_null($create_date_from)) {
            $query->whereDate('vouchers.issue_date', '>', (new Carbon($create_date_from))->toDate());
        }
        if (!is_null($create_date_to)) {
            $query->whereDate('vouchers.issue_date', '<=', (new Carbon($create_date_to))->toDate());
        }

        // Ordenamos por...
        if ($order_col == "voucher") $order_col = 'vouchers.number';
        if ($order_col == "account") $order_col = 'gsao.name';
        if ($order_col == "brand") $order_col = 'companies.id';
        if ($order_col == "issue_date") $order_col = 'vouchers.issue_date';
        $query->orderBy($order_col, $order);

        return $paginated ? $query->paginate(10): $query->get();
    }


}

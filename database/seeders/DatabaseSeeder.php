<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $vouchers = explode("\n", file_get_contents(base_path("database/seeders/vouchers.csv")));
        array_shift($vouchers);

        $this->command->getOutput()->writeln("<info>Vouchers</info>: Start seeding...");
        $output = $this->command->getOutput();
        $output->progressStart(count($vouchers));
        foreach ($vouchers as $voucher) {
            $data = explode(",", $voucher);
            $arr = [
                "booking_id" => $data[0],
                "gsa_organization_id" => $data[1],
                "organization_id" => $data[2],
                "user_id" => $data[3],
                "company_id" => $data[4],
                "iata_code" => $data[5],
                "number" => $data[6],
                "voucher_status_id" => $data[7],
                "voucher_sub_status_id" => $data[8],
                "payment_file_id" => $data[9],
                "past_due" => $data[10],
                "account" => $data[11],
                "booking_base_rate" => $data[12],
                "booking_taxes" => $data[13],
                "booking_total" => $data[14],
                "gross_amount" => $data[15],
                "gsa_comission_rate" => $data[16],
                "gsa_taxes_included" => $data[17],
                "gsa_comission_amount" => $data[18],
                "agency_comission_rate" => $data[19],
                "organizatagency_comission_amountion_id" => $data[20],
                "abg_net_amount" => $data[21],
                "issue_date" => $data[22],
                "agency_file_number" => $data[23],
                "net_rate" => $data[24],
                "manual_voucher" => $data[25],
            ];
            Voucher::create($arr);
            $output->progressAdvance();
        }
        $output->progressFinish();
        $this->command->getOutput()->writeln("<info>Vouchers</info>: End seeding!!!");
    }
}

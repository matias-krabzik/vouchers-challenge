<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Company;
use App\Models\Organization;
use App\Models\PaymentFile;
use App\Models\PaymentFileStatus;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherStatus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use function PHPUnit\Framework\isNull;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "name" => "Usuario",
            "last_name" => "Ejemplo",
            "email" => "example@mail.com",
            "password" => bcrypt("secret1234")
        ]);

        User::factory()->count(5)->create();

        $this->vouchers();
    }

    private function vouchers() {
        $vouchers = explode("\n", file_get_contents(base_path("database/seeders/vouchers.txt")));
        $this->command->getOutput()->writeln("<info>Vouchers</info>: Start seeding...");
        $output = $this->command->getOutput();
        $output->progressStart(count($vouchers));
        $user = User::first();
        foreach ($vouchers as $voucher) {
            $data = explode("\t", $voucher, 18);
            if (count($data) < 18) break;
            $gsaOrganization = $this->getOrganization($data[3], $data[16]);
            $organization = $this->getOrganization($data[4], $data[16]);
            $company = $this->getCompany($data[2]);
            $paymentFile = $this->getPaymentFileFromStatus($data[7], $organization, $company);
            $booking = $this->getBooking($data[9], $data[8], $data[10]);
            $voucherStatus = $this->getVoucherStatus($data[5]);

            $payment_file_id = null;
            if (!is_null($paymentFile)) $payment_file_id = $paymentFile->id;

            $pastDue = 0;
            if ($data[6] == "Past Due") $pastDue = 1;

            // 0  Voucher#
            // 1  CBA
            // 2  Brand
            // 3  Account Name
            // 4  Issuer Account
            // 5  Voucher Status
            // 6  Past Due
            // 7  Payment File
            // 8  Customer's Last Name
            // 9  Customer's First Name
            // 10 Confirmation#
            // 11 Issue IATA
            // 12 Gross Amount
            // 13 GSA Net Amount
            // 14 ABG Net Amount
            // 15 User
            // 16 Country
            // 17 Create Date

            Voucher::create([
                "booking_id" => $booking->id,
                "gsa_organization_id" => $gsaOrganization->id,
                "organization_id" => $organization->id,
                "user_id" => $user->id,
                "company_id" => $company->id,
                "iata_code" => $data[11],
                "number" => $data[0],
                "voucher_status_id" => $voucherStatus->id,
                "payment_file_id" => $payment_file_id,
                "past_due" => $pastDue,
                "account" => $data[1],
                "booking_base_rate" => 1,
                "booking_taxes" => 1,
                "booking_total" => 1,
                "gross_amount" => $data[12],
                "gsa_comission_rate" => 0.12,
                "gsa_taxes_included" => 0.10,
                "gsa_comission_amount"  => $data[13],
                "abg_net_amount" => $data[14],
                "issue_date" => (new Carbon($data[17]))->toDate()
            ]);

            $output->progressAdvance(1);
        }
        $output->progressFinish();
        $this->command->getOutput()->writeln("<info>Vouchers</info>: End seeding!!!");
    }

    /**
     * Devuelve el voucher Status a partir del nombre. Si es null, se devuelve null.
     * Si al buscar por el nombre, este no existe, se crea.
     */
    private function getVoucherStatus($voucherStatusName) {
        if (is_null($voucherStatusName)) return null;

        $voucherStatus = VoucherStatus::where("name", $voucherStatusName)->first();
        if (is_null($voucherStatus)) {
            // Si no existe la organización, la cargamos.
            $voucherStatus = VoucherStatus::factory()->create([
                "name" => $voucherStatusName
            ]);
        }
        return $voucherStatus;
    }

    /**
     *Devuelve la Compania a través del nombre. Si no existe, la crea.
     */
    private function getCompany($companyName) {
        $company = Company::where("name", $companyName)->first();
        if (is_null($company)) {
            // Si no existe la organización, la cargamos.
            $company = Company::factory()->create([
                "name" => $companyName
            ]);
        }
        return $company;
    }

    /**
     * Devuelve la Organización a traves del nombre, si no existe la crea.
     */
    private function getOrganization($organizationName, $state) {
        $organization = Organization::where("name", $organizationName)->first();
        if (is_null($organization)) {
            // Si no existe la organización, la cargamos.
            $organization = Organization::factory()->create([
                "name" => $organizationName,
                "state" => $state
            ]);
        }
        return $organization;
    }

    /**
     * Devuelve un Payment File relacionado con el Payment File Status.
     * Si el Payment File Status no esta en la base de datos, este se crea.
     */
    private function getPaymentFileFromStatus($paymentFileStatusName, $organization, $company) {
        if (is_null($paymentFileStatusName)) return null;

        $paymentFileStatus = PaymentFileStatus::where("name", $paymentFileStatusName)->first();
        if (is_null($paymentFileStatus)) {
            // Si no existe el Payment File Status lo creamos.
            $paymentFileStatus = PaymentFileStatus::factory()->create([ "name" => $paymentFileStatusName ]);
        }

        // Retornamos un PaymentFile enlazado con el Payment File Status.
        return PaymentFile::factory()->create([
            "payment_file_status_id" => $paymentFileStatus->id,
            "organization_id" => $organization->id,
            "company_id" => $company->id
        ]);
    }

    /**
     * Devuelve el Booking por el nombre y el apellido. Si no existe, lo crea.
     */
    private function getBooking($bookingName, $bookingLastName, $bookingNumber)
    {
        $booking = Booking::where("name", $bookingName)->where("last_name", $bookingLastName)->first();
        if (is_null($booking)) {
            // Si no existe la organización, la cargamos.
            $booking = Booking::factory()->create([
                "name" => $bookingName,
                "last_name" => $bookingName,
                "number" => $bookingNumber,
            ]);
        }
        return $booking;
    }
}

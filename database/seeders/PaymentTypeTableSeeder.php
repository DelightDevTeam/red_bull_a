<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'AYA Banking',
                'image' => 'AYA banking.png',
            ],
            [
                'name' => 'AYA Pay',
                'image' => 'Aya pay.png',
            ],
            [
                'name' => 'CB Banking',
                'image' => 'CB banking.png',
            ],
            [
                'name' => 'CB Pay',
                'image' => 'CB pay logo.png',
            ],
            [
                'name' => 'KBZ Banking',
                'image' => 'KBZ banking.png',
            ],
            [
                'name' => 'KBZ Pay',
                'image' => 'Kpay.png',
            ],
            [
                'name' => 'MAB Banking',
                'image' => 'MAB banking.png',
            ],
            [
                'name' => 'UAB Banking',
                'image' => 'UAB banking.png',
            ],
            [
                'name' => 'UAB Pay',
                'image' => 'uab pay.png',
            ],
            [
                'name' => 'Wave Pay',
                'image' => 'wave.png',
            ],
            [
                'name' => 'Yoma Banking',
                'image' => 'Yoma Banking.png',
            ],
        ];

        DB::table('payment_types')->insert($types);
    }
}

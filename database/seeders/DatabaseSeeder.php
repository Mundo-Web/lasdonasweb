<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            /*
            DashboardTableSeeder::class,
            AnalyticsTableSeeder::class,
            FintechTableSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            InvoiceSeeder::class,
            MemberSeeder::class,
            TransactionSeeder::class,
            JobSeeder::class,
            CampaignSeeder::class,
            MarketerSeeder::class,
            CampaignMarketerSeeder::class,
            */
            AboutusSeeder::class,
            SliderSeeder::class,
            ConstantSeeder::class,
            RoleSeeder::class,
            UsersSeeder::class,
            MessageSeeder::class,
            GeneralSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            StatusOrdensSeeder::class,
            StatusSeeder::class,
            AtributosSeeder::class,
            TiposSeeder::class,
            ComplementosSeeder::class,
            HorariosTableSeeder::class,
            //ServiceSeeder::class,
            TiposFlorSeeder::class,
            TagSeeder::class,
            ItemSeeder::class,
            PriceSeeder::class,
        ]);
    }
}

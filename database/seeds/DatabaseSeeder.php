<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StudentsTableSeeder::class);        
        $this->call(LevelsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(Payment_msTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(SubLevelsTableSeeder::class);
        $this->call(VouchersTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(InterestsTableSeeder::class);
    }
}

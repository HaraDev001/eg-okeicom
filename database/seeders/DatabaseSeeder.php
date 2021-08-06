<?php

namespace Database\Seeders;

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
            // ApplicationsTableSeeder::class,
            CategorySeeder::class,
            // CancelsTableSeeder::class,
            CountrySeeder::class,
            // CourseSeeder::class,
            // EvaluationsTableSeeder::class,
            // LessonSeeder::class,
            // MessagesTableSeeder::class,
            ManageSeeder::class,
            // PaymentsTableSeeder::class,
            PrefectureSeeder::class,
            // UserSeeder::class,
            // WithdrawalTableSeeder::class,
            // AnnouncementSeeder::class,
        ]);
    }
}

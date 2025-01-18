<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Load Job listings from file
        $jobListings = include database_path('seeders/data/job_listings.php');

        //Get user ids from user model
        $userIds = User::pluck('id')->toArray();

        //Loop through job listings and assign random user ids to each job listing
        foreach ($jobListings as &$listing) {
            $listing['user_id'] = $userIds[array_rand($userIds)];

            //Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }
        DB::table('job_listings')->insert($jobListings);
    }
}

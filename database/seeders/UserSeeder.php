<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'username' => $faker->userName,
                'instagram_username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'password' => Hash::make('password'), // Default password for all seeded users
                'mobile_number' => $faker->numerify('##########'), // 10-digit random number
                'price' => $faker->numberBetween(100, 1000),
                'profile_picture' => $this->fetchPicsumImageUrl(),
            ]);
        }
    }

    /**
     * Fetch a resolved Picsum image URL.
     *
     * @return string
     */
    private function fetchPicsumImageUrl()
    {
        $picsumBaseUrl = 'https://picsum.photos/200';
        $headers = get_headers($picsumBaseUrl, 1);

        if (isset($headers['Location'])) {
            return is_array($headers['Location']) ? end($headers['Location']) : $headers['Location'];
        }
        return $picsumBaseUrl;
    }
}

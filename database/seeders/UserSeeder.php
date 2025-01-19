<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hobby;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
// <!-- database/seeder/userseeder -->
class UserSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $user = User::create([
                'username' => $faker->userName,
                'instagram_username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'password' => Hash::make('password'), // Default password for all seeded users
                'mobile_number' => $faker->numerify('##########'), // 10-digit random number
                'price' => $faker->numberBetween(20000, 25000),
                'profile_picture' => $this->fetchPicsumImageUrl(),
            ]);
            $numberOfHobbies = $faker->numberBetween(2, 5);
            for ($j = 0; $j < $numberOfHobbies; $j++) {
                $user->hobbies()->create([
                    'name' => $faker->word(),
                ]);
            }
        }
    }

    private function fetchPicsumImageUrl()
    {
        $picsumBaseUrl = 'https://picsum.photos/200';
        $ch = curl_init($picsumBaseUrl);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        $urlParts = parse_url($finalUrl);

        if (isset($urlParts['path'])) {
            return 'https://picsum.photos' . $urlParts['path'];
        }
        return $picsumBaseUrl;
    }



}

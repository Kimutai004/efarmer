<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\Goat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@efarmer.co.ke',
            'phone' => '0712345678',
            'national_id' => '12345678',
            'gender' => 'male',
            'password' => Hash::make('password'),
            'email_verified' => true,
            'email_verified_at' => now(),
            'status' => 'active',
        ]);

        // Create breeds
        $breeds = [
            ['name' => 'Boer', 'description' => 'A popular meat goat breed known for fast growth and quality meat.', 'status' => 'active'],
            ['name' => 'Galla', 'description' => 'Indigenous Kenyan white goat, well adapted to arid areas.', 'status' => 'active'],
            ['name' => 'Alpine', 'description' => 'A dairy goat breed known for high milk production.', 'status' => 'active'],
            ['name' => 'Saanen', 'description' => 'The most productive dairy goat breed, white in color.', 'status' => 'active'],
            ['name' => 'Toggenburg', 'description' => 'A Swiss dairy goat breed with excellent milk yield.', 'status' => 'active'],
            ['name' => 'Anglo-Nubian', 'description' => 'A dual-purpose breed known for quality milk and meat.', 'status' => 'active'],
        ];

        foreach ($breeds as $breed) {
            Breed::create($breed);
        }

        // Create sample goats
        $goats = [
            [
                'tag_number' => 'EF-001',
                'name' => 'Boer Male Goat',
                'breed_id' => 1,
                'category' => 'Meat',
                'gender' => 'male',
                'date_of_birth' => now()->subYear(),
                'color' => 'Brown & White',
                'weight' => 45,
                'purchase_price' => 12000,
                'selling_price' => 6500,
                'status' => 'available',
                'location' => 'Nakuru',
                'description' => 'Healthy Boer male goat, vaccinated and ready for breeding or meat. Excellent body conformation.',
                'featured' => true,
            ],
            [
                'tag_number' => 'EF-002',
                'name' => 'Alpine Female Goat',
                'breed_id' => 3,
                'category' => 'Dairy',
                'gender' => 'female',
                'date_of_birth' => now()->subMonths(18),
                'color' => 'Grey',
                'weight' => 40,
                'purchase_price' => 10000,
                'selling_price' => 6500,
                'status' => 'available',
                'location' => 'Kiambu',
                'description' => 'Productive Alpine doe, gives 3-4 liters of milk daily. Great for dairy farming.',
                'featured' => true,
            ],
            [
                'tag_number' => 'EF-003',
                'name' => 'Galla Buck',
                'breed_id' => 2,
                'category' => 'Meat',
                'gender' => 'male',
                'date_of_birth' => now()->subYear(),
                'color' => 'White',
                'weight' => 50,
                'purchase_price' => 14000,
                'selling_price' => 6500,
                'status' => 'available',
                'location' => 'Machakos',
                'description' => 'Pure Galla buck, well adapted to dry conditions. Excellent for meat production.',
                'featured' => true,
            ],
            [
                'tag_number' => 'EF-004',
                'name' => 'Saanen Female',
                'breed_id' => 4,
                'category' => 'Dairy',
                'gender' => 'female',
                'date_of_birth' => now()->subYear(),
                'color' => 'White',
                'weight' => 38,
                'purchase_price' => 11000,
                'selling_price' => 16500,
                'status' => 'available',
                'location' => 'Nyeri',
                'description' => 'Pure Saanen doe with excellent dairy traits. Produces up to 4 liters daily.',
                'featured' => true,
            ],
            [
                'tag_number' => 'EF-005',
                'name' => 'Premium Boer Buck',
                'breed_id' => 1,
                'category' => 'Breeding',
                'gender' => 'male',
                'date_of_birth' => now()->subYears(2),
                'color' => 'Red Brown',
                'weight' => 65,
                'purchase_price' => 25000,
                'selling_price' => 35000,
                'status' => 'available',
                'location' => 'Kajiado',
                'description' => 'Champion Boer buck with proven genetics. Ideal for upgrading your herd.',
                'featured' => true,
            ],
            [
                'tag_number' => 'EF-006',
                'name' => 'Healthy Dairy Goat',
                'breed_id' => 3,
                'category' => 'Dairy',
                'gender' => 'female',
                'date_of_birth' => now()->subYears(2),
                'color' => 'Brown',
                'weight' => 42,
                'purchase_price' => 15000,
                'selling_price' => 22000,
                'status' => 'available',
                'location' => 'Nairobi',
                'description' => 'Mature Alpine doe, heavy milker. Perfect for commercial dairy goat farming.',
                'featured' => false,
            ],
        ];

        foreach ($goats as $goat) {
            Goat::create($goat);
        }
    }
}
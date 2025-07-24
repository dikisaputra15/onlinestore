<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teknisi;

class TeknisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teknisi::create([
            'name' => 'Teknisi A',
            'phone' => '08123456789',
            'alamat' => 'cipocok jaya',
            'latitude' => -6.140557951027566,
            'longitude' => 106.18230007972369,
            'image' => 'https://www.netcomputer.id/wp-content/uploads/2019/01/net-computer-depok.jpg',
        ]);

        Teknisi::create([
            'name' => 'Teknisi B',
            'phone' => '08129876543',
            'alamat' => 'jl pertigaan petir',
            'latitude' => -6.231826016262392,
            'longitude' => 106.19219686069651,
            'image' => 'https://batamtoday.com/media/news/De-High-Computer.jpg',
        ]);

        Teknisi::create([
            'name' => 'Teknisi C',
            'phone' => '08129876876',
            'alamat' => 'jl raya palima',
            'latitude' => -6.178374246599478,
            'longitude' => 106.14999117322974,
            'image' => 'https://cdn.idntimes.com/content-images/community/2024/10/img-20241013-205430-e9bcc5c22df04bbb7b7ea75cad9b0208.jpg',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Gelas Mug Keramik Custom',
                'description' => 'Gelas mug keramik berkualitas tinggi dengan printing custom sesuai keinginan. Cocok untuk souvenir pernikahan yang elegan.',
                'price' => 15000,
                'category' => 'Gelas',
                'stock' => 500,
            ],
            [
                'name' => 'Tas Pouch Kanvas Aesthetic',
                'description' => 'Pouch serbaguna bahan kanvas tebal dengan desain minimalis. Praktis dan disukai banyak tamu.',
                'price' => 8500,
                'category' => 'Tas/Pouch',
                'stock' => 1000,
            ],
            [
                'name' => 'Kipas Bambu Tradisional',
                'description' => 'Kipas tangan dari bambu pilihan dengan balutan kain motif batik. Memberikan kesan klasik dan fungsional.',
                'price' => 5000,
                'category' => 'Kipas',
                'stock' => 1500,
            ],
            [
                'name' => 'Gantungan Kunci Kayu Ukir',
                'description' => 'Gantungan kunci estetis dari kayu jati Belanda dengan ukiran inisial nama. Souvenir unik dan tahan lama.',
                'price' => 3500,
                'category' => 'Gantungan Kunci',
                'stock' => 2000,
            ],
            [
                'name' => 'Pouch Blacu Serut',
                'description' => 'Pouch bahan blacu ramah lingkungan dengan tali serut kuat. Cocok untuk wadah bingkisan kecil.',
                'price' => 4500,
                'category' => 'Tas/Pouch',
                'stock' => 800,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'category' => $product['category'],
                'stock' => $product['stock'],
                'image' => null, // Placeholder
            ]);
        }
    }
}

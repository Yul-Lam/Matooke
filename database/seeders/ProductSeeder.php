<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Arabica Premium',
            'price' => 25000,
            'quantity' => 100,
            'description' => 'A smooth, aromatic cup of Ugandan Arabica coffee with floral notes and a chocolatey finish. Hand-picked from high-altitude farms — perfect for refined palates.'
        ]);
        Product::create([
            'name' => 'Robusta Strong',
            'price' => 20000,
            'quantity' => 80,
            'description' => 'Bold and full-bodied, this Robusta delivers a deep, rich flavor with hints of dark cocoa. Ideal for espresso lovers who crave intensity and strength.'
        ]);
        Product::create([
            'name' => 'Sun-Dried Cherry Roast',
            'price' => 22000,
            'quantity' => 60,
            'description' => 'Sun-dried on raised beds for a fruit-forward flavor. A juicy roast with notes of berries, caramel, and toasted nuts — a favorite among artisan cafes.'
        ]);
        Product::create([
            'name' => 'Classic FarmHouse Blend',
            'price' => 18000,
            'quantity' => 120,
            'description' => 'A balanced, everyday coffee sourced from local cooperatives. Medium roast, smooth body, and a sweet finish that keeps you coming back for more.'
        ]);
    }
}

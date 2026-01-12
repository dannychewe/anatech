<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Brand 1',
                'logo' => 'assets/img/brand/brand-01.png',
                'website_url' => 'https://example1.com',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Brand 2',
                'logo' => 'assets/img/brand/brand-02.png',
                'website_url' => 'https://example2.com',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Brand 3',
                'logo' => 'assets/img/brand/brand-03.png',
                'website_url' => 'https://example3.com',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Brand 4',
                'logo' => 'assets/img/brand/brand-04.png',
                'website_url' => 'https://example4.com',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Brand 5',
                'logo' => 'assets/img/brand/brand-05.png',
                'website_url' => 'https://example5.com',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brand) {
            \App\Models\Brand::create($brand);
        }
    }
}

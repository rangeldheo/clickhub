<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Eletrônicos',
            'Eletrodomésticos',
            'Roupas e Acessórios',
            'Calçados',
            'Livros',
            'Móveis',
            'Brinquedos',
            'Esporte e Lazer',
            'Alimentos e Bebidas',
            'Beleza e Cuidados Pessoais'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category) // Gerando o slug automaticamente
            ]);
        }
    }
}

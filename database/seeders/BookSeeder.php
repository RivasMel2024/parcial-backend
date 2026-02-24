<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory()->count(90)->create();

        Book::create([
            'title' => 'The Great Gatsby',
            'description' => 'A novel about the American dream and the decadence of the 1920s.',
            'isbn' => '9780743273565',
            'total_copies' => 5,
            'available_copies' => 5,
            'is_available' => true,
        ]);
    }
}

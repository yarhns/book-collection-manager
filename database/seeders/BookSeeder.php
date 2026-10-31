<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Kategori
        $categories = [
            'Fiksi', 'Non-Fiksi', 'Teknologi', 'Sejarah', 'Sains', 
            'Bisnis', 'Komik', 'Pengembangan Diri'
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }

        // 2. Daftar Buku Realistis (Judul, Penulis, Tahun, Kategori)
        $books = [
            // Fiksi
            ['Bumi Manusia', 'Pramoedya Ananta Toer', 1980, 'Fiksi'],
            ['Laskar Pelangi', 'Andrea Hirata', 2005, 'Fiksi'],
            ['Hujan', 'Tere Liye', 2016, 'Fiksi'],
            ['Ronggeng Dukuh Paruk', 'Ahmad Tohari', 1982, 'Fiksi'],
            ['Perahu Kertas', 'Dee Lestari', 2009, 'Fiksi'],
            ['Pulang', 'Leila S. Chudori', 2012, 'Fiksi'],
            ['Cantik Itu Luka', 'Eka Kurniawan', 2002, 'Fiksi'],
            ['Hujan Kepagian', 'Nugroho Notosusanto', 1958, 'Fiksi'],
            
            // Non-Fiksi
            ['Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 2011, 'Non-Fiksi'],
            ['Homo Deus', 'Yuval Noah Harari', 2015, 'Non-Fiksi'],
            ['Filosofi Teras', 'Henry Manampiring', 2018, 'Non-Fiksi'],
            ['Madilog', 'Tan Malaka', 1943, 'Non-Fiksi'],
            
            // Teknologi
            ['Clean Code', 'Robert C. Martin', 2008, 'Teknologi'],
            ['The Pragmatic Programmer', 'Andrew Hunt', 1999, 'Teknologi'],
            ['Laravel: Up & Running', 'Matt Stauffer', 2019, 'Teknologi'],
            ['Design Patterns', 'Erich Gamma', 1994, 'Teknologi'],
            ['You Don\'t Know JS', 'Kyle Simpson', 2015, 'Teknologi'],
            ['Eloquent JavaScript', 'Marijn Haverbeke', 2018, 'Teknologi'],
            
            // Sejarah
            ['Sejarah Indonesia Modern', 'M.C. Ricklefs', 1981, 'Sejarah'],
            ['Nusantara: Sejarah Indonesia', 'Bernard H.M. Vlekke', 1943, 'Sejarah'],
            ['Api Sejarah', 'Ahmad Mansur Suryanegara', 2009, 'Sejarah'],
            
            // Sains
            ['A Brief History of Time', 'Stephen Hawking', 1988, 'Sains'],
            ['Cosmos', 'Carl Sagan', 1980, 'Sains'],
            ['The Selfish Gene', 'Richard Dawkins', 1976, 'Sains'],
            ['Astrofisika untuk Orang Sibuk', 'Neil deGrasse Tyson', 2017, 'Sains'],
            
            // Bisnis
            ['Rich Dad Poor Dad', 'Robert T. Kiyosaki', 1997, 'Bisnis'],
            ['The Lean Startup', 'Eric Ries', 2011, 'Bisnis'],
            ['Zero to One', 'Peter Thiel', 2014, 'Bisnis'],
            ['Atomic Habits', 'James Clear', 2018, 'Bisnis'],
            
            // Komik
            ['One Piece Vol. 1', 'Eiichiro Oda', 1997, 'Komik'],
            ['Naruto Vol. 1', 'Masashi Kishimoto', 1999, 'Komik'],
            ['Attack on Titan Vol. 1', 'Hajime Isayama', 2009, 'Komik'],
            ['Demon Slayer Vol. 1', 'Koyoharu Gotouge', 2016, 'Komik'],
            
            // Pengembangan Diri
            ['How to Win Friends and Influence People', 'Dale Carnegie', 1936, 'Pengembangan Diri'],
            ['The 7 Habits of Highly Effective People', 'Stephen Covey', 1989, 'Pengembangan Diri'],
            ['Mindset', 'Carol S. Dweck', 2006, 'Pengembangan Diri'],
        ];

        // 3. Masukkan Buku ke Database
        foreach ($books as $b) {
            $category = Category::where('name', $b[3])->first();
            
            Book::create([
                'title' => $b[0],
                'author' => $b[1],
                'year' => $b[2],
                'category_id' => $category ? $category->id : null,
            ]);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dataDiri extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Menambahkan data ke tabel mahasiswas
        foreach (range(1, 10) as $index) {
            DB::table('mahasiswas')->insert([
                'nama' => "Haykal Hudiya Abiyyu",
                'nim' => 210414020,
                'jurusan' => "Teknik Informatika",
                'tempat' => "Bogor",
                'tanggal_lahir' => '2000-05-26',
                'hobi' => "Menggambar, Gaming",
                'alamat' => "Ujungberung, Bandung",
                'foto' => null,  // Sesuaikan jika foto ingin dimasukkan, misalnya dengan nama file
            ]);
        }
    }
}

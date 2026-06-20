<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jenjang;
use App\Models\KategoriMateri;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\PilihanJawaban;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        User::create([

            'name' => 'Admin',

            'email' => 'admin@edugrow.com',

            'password' => bcrypt('password'),

            'role' => 'admin'

        ]);


        /*
        |--------------------------------------------------------------------------
        | Guru
        |--------------------------------------------------------------------------
        */

        $guru = User::factory(3)->create([

            'role' => 'guru'

        ]);


        /*
        |--------------------------------------------------------------------------
        | Siswa
        |--------------------------------------------------------------------------
        */

        User::factory(10)->create([

            'role' => 'siswa'

        ]);


        /*
        |--------------------------------------------------------------------------
        | Jenjang
        |--------------------------------------------------------------------------
        */

        $sd = Jenjang::create([

            'nama_jenjang' => 'SD'

        ]);


        $smp = Jenjang::create([

            'nama_jenjang' => 'SMP'

        ]);


        $sma = Jenjang::create([

            'nama_jenjang' => 'SMA'

        ]);


        $jenjang = [

            $sd,
            $smp,
            $sma

        ];


        /*
        |--------------------------------------------------------------------------
        | Kategori
        |--------------------------------------------------------------------------
        */

        $ipa = KategoriMateri::create([

            'nama_kategori' => 'IPA'

        ]);


        $mtk = KategoriMateri::create([

            'nama_kategori' => 'Matematika'

        ]);


        $bindo = KategoriMateri::create([

            'nama_kategori' => 'Bahasa Indonesia'

        ]);


        $kategori = [

            $ipa,
            $mtk,
            $bindo

        ];


        /*
        |--------------------------------------------------------------------------
        | Materi
        |--------------------------------------------------------------------------
        */

        foreach ($guru as $pengajar) {


            for ($i = 1; $i <= 2; $i++) {


                $materi = Materi::create([

                    'id_guru' => $pengajar->id_user,


                    'id_jenjang' => collect($jenjang)
                        ->random()
                        ->id_jenjang,


                    'id_kategori_materi' => collect($kategori)
                        ->random()
                        ->id_kategori_materi,


                    'judul' =>

                    "Materi $i",


                    'deskripsi' =>

                    fake()->sentence(),


                    'file_materi' => null,


                    'thumbnail' => null,


                    'is_published' => true

                ]);


                /*
                |--------------------------------------------------------------------------
                | Quiz
                |--------------------------------------------------------------------------
                */


                $quiz = Quiz::create([


                    'id_materi' =>

                    $materi->id_materi,


                    'judul' =>

                    'Quiz ' . $materi->judul,


                    'deskripsi' =>

                    fake()->sentence(),


                    'durasi_menit' => 15


                ]);


                /*
                |--------------------------------------------------------------------------
                | Soal
                |--------------------------------------------------------------------------
                */


                for ($j = 1; $j <= 5; $j++) {


                    $soal = Soal::create([


                        'id_quiz' =>

                        $quiz->id_quiz,


                        'pertanyaan' =>

                        "Pertanyaan nomor $j?"


                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | Pilihan Jawaban
                    |--------------------------------------------------------------------------
                    */


                    for ($k = 1; $k <= 4; $k++) {


                        PilihanJawaban::create([


                            'id_soal' =>

                            $soal->id_soal,


                            'jawaban' =>

                            "Pilihan $k",


                            'is_correct' =>

                            $k == 1


                        ]);
                    }
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\Training;
use Illuminate\Support\Facades\DB;

class PegawaiTrainingSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua ID pegawai dan training yang benar-benar ada di database
        $pegawaiIds = Pegawai::pluck('id')->toArray();
        $trainingIds = Training::pluck('id')->toArray();

        // Pastikan dulu data pegawai dan training tidak kosong
        if (count($pegawaiIds) >= 3 && count($trainingIds) >= 3) {
            DB::table('pegawai_training')->insert([
                [
                    'pegawai_id'  => $pegawaiIds[0], // Mengambil ID pegawai pertama yang ada
                    'training_id' => $trainingIds[0],
                    'status'      => 'Selesai',
                ],
                [
                    'pegawai_id'  => $pegawaiIds[1], // Mengambil ID pegawai kedua yang ada
                    'training_id' => $trainingIds[1],
                    'status'      => 'Mengikuti',
                ],
                [
                    'pegawai_id'  => $pegawaiIds[2], // Mengambil ID pegawai ketiga yang ada
                    'training_id' => $trainingIds[2],
                    'status'      => 'Terdaftar',
                ],
            ]);
        } else {
            // Jika data di seeder sebelumnya kurang dari 3, pasang fallback acak
            $pegawai = Pegawai::first();
            $training = Training::first();
            
            if ($pegawai && $training) {
                DB::table('pegawai_training')->insert([
                    'pegawai_id'  => $pegawai->id,
                    'training_id' => $training->id,
                    'status'      => 'Mengikuti',
                ]);
            }
        }
    }
}
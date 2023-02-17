<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //pendidikan ->sd
        Map::create([
            'child_id' => '1',
            'map_title' => 'SD NEGERI JAMBON',
            'map_address' => 'Jambon, Donomulyo, Kec. Nanggulan, Kab. Kulon Progo',
            'map_pimpinan' => 'Partini',
            'map_url' => 'https://data.sekolah-kita.net/sekolah/SD%20NEGERI%20JAMBON_18311',
            'pend_akredit' => 'B',
            'pend_kurikulum' => 'Kurikulum 2013',
            'pend_waktu' => '5 Hari Setiap Minggu',
            'map_latitude' => -7.8152384494776,
            'map_longitude' => 110.18494712154352
        ]);

        Map::create([
            'child_id' => '1',
            'map_title' => 'SD NEGERI SENDANGSARI',
            'map_address' => 'Mrunggi, Sendangsari, Kec. Pengasih, Kab. Kulon Progo',
            'map_pimpinan' => 'Nurmahani',
            'map_url' => 'https://data.sekolah-kita.net/sekolah/SD%20NEGERI%20SENDANGSARI_18208',
            'pend_akredit' => 'A',
            'pend_kurikulum' => 'KTSP',
            'pend_waktu' => '5 Hari Setiap Minggu',
            'map_latitude' => -7.828342307319447,
            'map_longitude' => 110.15387159411998 , 
        ]);

        Map::create([
            'child_id' => '1',
            'map_title' => 'SD NEGERI GRAULAN',
            'map_address' => 'Tegallembut, Giripeni, Kec. Wates, Kab. Kulon Progo',
            'map_pimpinan' => 'Sugeng Purwojiono',
            'map_url' => 'https://data.sekolah-kita.net/sekolah/SD%20NEGERI%20GRAULAN_255894',
            'pend_akredit' => 'B',
            'pend_kurikulum' => 'Kurikulum 2013',
            'pend_waktu' => '5 Hari Setiap Minggu',
            'map_latitude' => -7.8152384494776,
            'map_longitude' => 110.18494712154352
        ]);

        //pendidikan ->smp
        Map::create([
            'child_id' => '2',
            'map_title' => 'SMP NEGERI 3 WATES',
            'map_address' => 'Jln. Purworejo KM 7, Sogan, Kec. Wates, Kab. Kulon Progo',
            'map_pimpinan' => 'Agus Sutik Dwiartanta',
            'map_url' => 'https://data.sekolah-kita.net/sekolah/SMP%20NEGERI%201%20WATES_255930',
            'pend_akredit' => 'A',
            'pend_kurikulum' => 'KTSP',
            'pend_waktu' => '5 Hari Setiap Minggu',
            'map_latitude' => -7.889394837008143,
            'map_longitude' => 110.11231128029014 
        ]);

        Map::create([
            'child_id' => '2',
            'map_title' => 'SMP MUHAMMADIYAH 1 WATES',
            'map_address' => 'Kemiri, Margosari, Kec. Pengasih, Kab. Kulon Progo, Di Yogyakarta',
            'map_pimpinan' => 'Agus Wiratna',
            'map_url' => 'https://data.sekolah-kita.net/sekolah/SMP%20MUHAMMADIYAH%201%20WATES_18216',
            'pend_akredit' => 'A',
            'pend_kurikulum' => 'Kurikulum 2013',
            'pend_waktu' => '5 Hari Setiap Minggu',
            'map_latitude' => -7.857219762963533,
            'map_longitude' => 110.1646102644114
        ]);

        //kesehatan ->rsud
        Map::create([
            'child_id' => '6',
            'map_title' => 'RSUD Wates',
            'map_address' => 'Jalan Tentara Pelajar Km. 1 No. 5, Beji, Kec. Wates, Kabupaten Kulon Progo',
            'map_url' => 'https://rsud.kulonprogokab.go.id',
            'map_postcode' => '55651',
            'map_telp' => '0274-773169',
            'map_email' => 'rsud@kulonprogokab.go.id',
            'map_jambuka' => '24 Jam',
            'kes_rawatinap' => 1,
            'kes_igd' => '24 Jam',
            'kes_harilayanan' => 'Hari Senin - Sabtu',
            'map_latitude' => -7.858538486650797, 
            'map_longitude' => 110.14808333444826
        ]);

        Map::create([
            'child_id' => '6',
            'map_title' => 'RSUD Nyi Ageng Serang',
            'map_address' => 'Jl. Sentolo Nanggulan, Bantar Kulon, Banguncipto, Kec. Sentolo, Kabupaten Kulon Progo',
            'map_url' => 'http://rsnas.kulonprogokab.go.id',
            'map_postcode' => '55651',
            'map_telp' => '0274-7880912',
            'map_email' => 'rsnas@kulonprogokab.go.id',
            'map_jambuka' => '24 Jam',
            'kes_rawatinap' => 1,
            'kes_igd' => '24 Jam',
            'map_pimpinan' => 'dr. SANDRAWATI SAID, M.Kes',
            'map_latitude' => -7.820067573227586, 
            'map_longitude' => 110.22589541837377
        ]);

        //kesehatan ->puskesmas
        Map::create([
            'child_id' => '7',
            'map_title' => 'Puskesmas Girimulyo I',
            'map_address' => 'Nglengkong, Giripurwo, Kec. Girimulyo, Kabupaten Kulon Progo',
            'map_postcode' => '55674',
            'map_telp' => '082324858628',
            'map_jambuka' => '08:00 WIB',
            'kes_harilayanan' => 'Hari Senin - Sabtu',
            'kes_pasien' => 0,
            'map_latitude' => -7.770030824660838, 
            'map_longitude' => 110.1842711183658
        ]);

        Map::create([
            'child_id' => '7',
            'map_title' => 'Puskesmas Lendah I',
            'map_address' => 'Pereng, Bumirejo, Kec. Lendah, Kabupaten Kulon Progo',
            'map_postcode' => '55663',
            'map_telp' => '08112642500',
            'map_jambuka' => '08:00 WIB',
            'map_email' => 'puskesmas1lendah@gmail.com',
            'kes_harilayanan' => 'Hari Senin - Sabtu',
            'kes_pasien' => 0,
            'map_latitude' => -7.90184558399364,
            'map_longitude' => 110.2030797570114
        ]);
    }
}

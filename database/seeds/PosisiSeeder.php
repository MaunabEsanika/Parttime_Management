<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posisi')->insert([
           'nama_posisi'=>'Laundry'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Pool Maintenance'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Equipment Maintenance'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Receptionist'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Porter'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Security'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Valet'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Concierge'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Housekeeping'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Room Service'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Waiter/Waitress'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Crew Restaurant'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Barista'
        ]);
        DB::table('posisi')->insert([
            'nama_posisi'=>'Photographer'
        ]);

    }
}

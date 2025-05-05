<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
               DB::table('servers')->insert([
            [
                'name' => 'Server Web 1',
                'ip_address' => '192.168.1.10',
                'location' => 'Data Center Untad',
                'memory_gb' => 16,
                'storage_gb' => 512,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Server Database',
                'ip_address' => '192.168.1.11',
                'location' => 'Data Center Untad',
                'memory_gb' => 32,
                'storage_gb' => 1024,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Server Backup',
                'ip_address' => '192.168.1.12',
                'location' => 'Data Center Untad',
                'memory_gb' => 8,
                'storage_gb' => 2048,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('infrastrukturs')->insert([
            [
                'name' => 'Router Kantor Pusat',
                'type' => 'Router',
                'ip_address' => '192.168.100.1',
                'location' => 'UPA TIK',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Switch Gedung A',
                'type' => 'Switch',
                'ip_address' => '192.168.100.2',
                'location' => 'UPA TIK',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Firewall Internal',
                'type' => 'Firewall',
                'ip_address' => '192.168.100.3',
                'location' => 'Data Center',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Access Point Lobi',
                'type' => 'Access Point',
                'ip_address' => '192.168.100.4',
                'location' => 'UPA TIK',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LAN Backup Area',
                'type' => 'LAN',
                'ip_address' => null,
                'location' => 'UPA TIK',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
        DB::table('users')->insert([
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'lokasi' => 'UPA TIK' ,
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Unit 1',
                'email' => 'unit1@gmail.com',
                'password' => bcrypt('unit123'),
                'lokasi' => 'FKIP',
                'role' => 'unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Unit 2',
                'email' => 'unit2@gmail.com',
                'password' => bcrypt('unit123'),
                'lokasi' => 'FISIP',
                'role' => 'unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}

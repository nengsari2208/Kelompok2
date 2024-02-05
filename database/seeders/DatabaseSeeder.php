<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use App\Models\Reimbursement;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Seed departments
        Department::create([
            'nama_departemen' => 'HR',
            'deskripsi' => 'Human Resources Department'
        ]);

        Department::create([
            'nama_departemen' => 'FINANCE',
            'deskripsi' => 'Finance Department'
        ]);

        Department::create([
            'nama_departemen' => 'IT',
            'deskripsi' => 'Information Technology Department'
        ]);

        Department::create([
            'nama_departemen' => 'MARKETING',
            'deskripsi' => 'Marketing Department'
        ]);

        // Seed positions
        Position::create([
            'nama_jabatan' => 'HR Manager',
            'deskripsi' => 'Manager of HR Department'
        ]);

        Position::create([
            'nama_jabatan' => 'HR Officer',
            'deskripsi' => 'Officer of HR Department'
        ]);

        Position::create([
            'nama_jabatan' => 'Finance Manager',
            'deskripsi' => 'Manager of Finance Department'
        ]);

        Position::create([
            'nama_jabatan' => 'Finance Officer',
            'deskripsi' => 'Officer of Finance Department'
        ]);

        Position::create([
            'nama_jabatan' => 'Programmer',
            'deskripsi' => 'IT Programmer'
        ]);

        Position::create([
            'nama_jabatan' => 'Marketing Officer',
            'deskripsi' => 'Marketing Officer'
        ]);

        // Seed Pegawai
        User::create([
            'NIP' => '19930513201501003',
            'nama' => 'Budi Setiawan',
            'id_jabatan' => 5,
            'id_departemen' => 3,
            'telepon' => '081234567890',
            'alamat' => 'Jl. HR Boulevard No. 1',
            'email' => 'budi@it.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'NIP' => '19980622201717045',
            'nama' => 'Ratih Kumala Sari',
            'id_jabatan' => 6,
            'id_departemen' => 4,
            'telepon' => '081234567891',
            'alamat' => 'Jl. HR Boulevard No. 2',
            'email' => 'ratih@marketing.com',
            'password' => bcrypt('password')
        ]);

        //seed HR Manager
        User::create([
            'NIP' => '19890425201924056',
            'nama' => 'Dewi Kusuma Wardhani',
            'id_jabatan' => 1,
            'id_departemen' => 1,
            'telepon' => '081234567890',
            'alamat' => 'Jl. Sudirman No. 123, Jakarta',
            'email' => 'dewi@hr.com',
            'password' => bcrypt('password'),
        ]);

        //seed Finance Manager
        User::create([
            'NIP' => '19990308201705075',
            'nama' => 'Rizky Fadhillah Putra',
            'id_jabatan' => 3,
            'id_departemen' => 2,
            'telepon' => '087654321098',
            'alamat' => 'Jl. Thamrin No. 456, Jakarta',
            'email' => 'rizky@finance.com',
            'password' => bcrypt('password'),
        ]);

    }
}

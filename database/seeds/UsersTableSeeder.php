<?php

use CEFE\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['enrollment' => '191000.40.1000', 'name' => 'Maycon Medeiros', 'email' => 'Maycon@admin.com', 'password' => Hash::make('123'), 'level' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.1001', 'name' => 'Andrey Dario', 'email' => 'Andrey@admin.com', 'password' => Hash::make('123'), 'level' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.1002', 'name' => 'Arthur Xavier', 'email' => 'Arthur@admin.com', 'password' => Hash::make('123'), 'level' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.1003', 'name' => 'Aluno', 'email' => 'user@user.com', 'password' => Hash::make('123'), 'level' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1000', 'name' => 'Paulo de Aguiar', 'email' => 'futebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1001', 'name' => 'Carolina Grego', 'email' => 'basquetebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1002', 'name' => 'Sérgio Saraiva', 'email' => 'tenis@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1003', 'name' => 'Vitória Flores', 'email' => 'nat1@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1004', 'name' => 'Francisco Batista', 'email' => 'nat2@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1005', 'name' => 'Allison Salazar', 'email' => 'handebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1006', 'name' => 'Paulo Lovato	', 'email' => 'xadrez@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1007', 'name' => 'Luciano Medina', 'email' => 'alongamento@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);

        // factory(User::class, 10)->create();
    }
}

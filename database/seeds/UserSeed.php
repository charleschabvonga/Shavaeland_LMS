<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Charles Chabvonga', 'email' => 'charles@shavaeland.co.za', 'password' => '$2y$10$7oqcR9B2f/I/B9xP/Xmt8.1nejg.zzjmQAytQ7hicCYF9Qz56U/lu', 'remember_token' => '', 'approved' => 1,],
            ['id' => 2, 'name' => 'Desmond Nyagumbo', 'email' => 'desmond@shavaeland.co.za', 'password' => '$2y$10$bjPNprZlKUCjcGxFOOSmEuFVaAhpiRurhbu0BeUg1LvDhZ2z6Yyb6', 'remember_token' => null, 'approved' => 1,],
            ['id' => 3, 'name' => 'Hillary Mubanga', 'email' => 'hillary@shavaeland.co.za', 'password' => '$2y$10$hZEEuCS3.dLvfRcYRUA4ae8snNVHdaYNt/TB1xQPce.5gqQAR3Bfq', 'remember_token' => null, 'approved' => 1,],
            ['id' => 4, 'name' => 'Tafadzwa Nyagumbo', 'email' => 'tafadzwa@shavaeland.co.za', 'password' => '$2y$10$7jdTnVNmuSLc1ZC.swyiPOuUdr/CNsYS2ylw5.YxU.InheUFN4CDu', 'remember_token' => null, 'approved' => 1,],
            ['id' => 5, 'name' => 'Fungai T.H. Nyagumbo', 'email' => 'fungai@shavaeland.co.za', 'password' => '$2y$10$7wMe69ON9JVRmaPBYKmb7O3IF4O16Aj3k.kZIBWngQqH3HpZW2bOa', 'remember_token' => null, 'approved' => 1,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('pt_BR');

        $seed = [];

        for ($i = 0; $i <= 100; $i++ ) {
            $seed[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'cpf' => $faker->cpf,
                'message' => $faker->text,
                'created_at' => $faker->dateTime
            ];
        }

        DB::table('contacts')->insert($seed);
    }
}

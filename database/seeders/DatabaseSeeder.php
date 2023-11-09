<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $first_name = [
            'Алексей',
            'Артём',
            'Вадим',
            'Владимир',
            'Валентин',
            'Данил',
            'Денис',
            'Дмитрий',
            'Егор',
            'Кирилл',
            'Леонид',
            'Максим',
            'Матвей',
            'Никита',
            'Олег',
            'Павел',
            'Пётр',
            'Роман',
            'Сергей',
            'Станислав',
        ];

        $last_name = [
            'Иванов',
            'Смирнов',
            'Кузнецов',
            'Попов',
            'Васильев',
            'Петров',
            'Соколов',
            'Михайлов',
            'Новиков',
            'Фёдоров',
            'Морозов',
            'Волков',
            'Алексеев',
            'Лебедев',
            'Семёнов',
            'Егоров',
            'Павлов',
            'Козлов',
            'Степанов',
            'Николаев',
        ];

        $otchestvo = [
            'Александрович',
            'Алексеевич',
            'Даниилович',
            'Данилович',
            'Демидович',
            'Демьянович',
            'Денисович',
            'Максимович',
            'Маркович',
            'Егорович',
            'Артемьевич',
            'Артурович',
            'Семёнович',
            'Сергеевич',
            'Сидорович',
            'Павлович',
            'Петрович',
            'Романович',
            'Ростиславович',
            'Тимофеевич',
            'Тимурович',
            'Всеволодович',
            'Вячеславович',
        ];
        $supplier = [
                0 => [
                    1,
                    'Королев Алексей Игоревич',
                    'Невролог',
                ],
                1 => [
                    2,
                    'Соколов Вадим Всеволодович',
                    'Терапевт',
                ]
            ];

        for($i = 1; $i < 30; $i++) {
            $full_name = 
            $last_name[rand(0, (count($last_name)-1))]. ' '.
            $first_name[rand(0, (count($first_name)-1))]. ' '.
            $otchestvo[rand(0, (count($otchestvo)-1))];
            $time = Carbon::create(2023, 9, rand(26, 29), rand(8, 19), rand(1, 60), 00);
            $rand_supplier = $supplier[rand(0,(count($supplier) - 1))];

            Customer::query()->insertOrIgnore([
                'supplier_id' => $rand_supplier[0],
                'supplier_name' => $rand_supplier[1],
                'speciality' => $rand_supplier[2],
                'customer_name' => $full_name,
                'email' => "example-example@example.com",
                'number' => '+79686112007',
                'comment' => 'В Ожидании Подтверждения',
                'time' => $time,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        // \App\Models\User::factory()->create([
            
        //     'name' => 'Henry Mann',
        //     'email' => 'henry@mail.com',
        //     'email_verified_at' => now(),
        //     'status' => 'admin',
        //     'password' => Hash::make('123'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}

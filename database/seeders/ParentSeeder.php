<?php

namespace Database\Seeders;

use App\Models\BloodType;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('my_parents')->delete();
        $my_parents = new MyParent();
        $my_parents->email = 'samir.gamal77@yahoo.com';
        $my_parents->password = Hash::make('12345678');
        $my_parents->Name_Father = ['en' => 'samirgamal', 'ar' => 'سمير جمال'];
        $my_parents->National_ID_Father = '1234567816';
        $my_parents->Passport_ID_Father = '1234567815';
        $my_parents->Phone_Father = '1234567814';
        $my_parents->Job_Father = ['en' => 'programmer', 'ar' => 'مبرمج'];
        $my_parents->nationality_Father_id = Nationality::all()->unique()->random()->id;
        $my_parents->blood_type_Father_id =BloodType::all()->unique()->random()->id;
        $my_parents->religion_Father_id = Religion::all()->unique()->random()->id;
        $my_parents->Address_Father ='القاهرة';
        $my_parents->Name_Mother = ['en' => 'ٍSoaad jeha', 'ar' => 'سعاد جحا'];
        $my_parents->National_ID_Mother = '1234567819';
        $my_parents->Passport_ID_Mother = '1234567818';
        $my_parents->Phone_Mother = '1234567817';
        $my_parents->Job_Mother = ['en' => 'Teacher', 'ar' => 'معلمة'];
        $my_parents->nationality_Mother_id = Nationality::all()->unique()->random()->id;
        $my_parents->blood_type_Mother_id =BloodType::all()->unique()->random()->id;
        $my_parents->religion_Mother_id = Religion::all()->unique()->random()->id;
        $my_parents->Address_Mother ='القاهرة';
        $my_parents->save();

    }
}

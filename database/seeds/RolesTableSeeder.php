<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pupil = new Role;
        $pupil->name = 'Pupil';
        $pupil->slug = 'pupil';
        $pupil->save();

        $company = new Role;
        $company->name = 'Company';
        $company->slug = 'company';
        $company->save();

        $teacher = new Role;
        $teacher->name = 'Teacher';
        $teacher->slug = 'teacher';
        $teacher->save();
    }
}

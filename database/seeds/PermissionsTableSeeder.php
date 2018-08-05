<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'request-new-password',
            'update-profile',
            'view-schools',
            'view-school',
            'create-school',
            'update-school',
            'delete-school',
            'view-teachers',
            'view-teacher',
            'create-teacher',
            'update-teacher',
            'delete-teacher',
            'view-users',
            'view-user',
            'create-user',
            'update-user',
            'delete-user',
            'view-teams',
            'view-team',
            'create-team',
            'update-team',
            'add-student-to-team',
            'remove-student-from-team',
            'view-bookings',
            'view-booking',
            'create-booking',
            'update-booking',
            'delete-booking',
            'view-categories',
            'view-category',
            'create-category',
            'update-category',
            'delete-category',
            'view-lessons',
            'view-lesson',
            'create-lesson',
            'update-lesson',
            'delete-lesson',
            'view-modules',
            'view-module',
            'create-module',
            'update-module',
            'delete-module',
            'add-module-to-lesson',
            'remove-module-from-lesson',
            'view-legalitems',
            'view-legalitem',
            'create-legalitem',
            'update-legalitem',
            'delete-legalitem',
            'add-legalitem-to-module',
            'remove-legalitem-from-module',
            'reserve-booking',
            'unreserve-booking',
            'confirm-booking-reservation',
        ];

        for ($i = 0; $i < count($names); $i++) {
            Permission::create([
                'name' => $names[$i],
            ]);
        }
    }
}

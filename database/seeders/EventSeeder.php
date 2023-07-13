<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Event;
use App\Models\MasterClass;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'Magang Online Academy',
                'slug' => Str::slug('Magang Online Academy'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 'active',
                'active_dashboard' => true,
                'image' => 'https://media.istockphoto.com/id/653949062/vector/boot-camp-square-grunge-stamp.jpg?s=612x612&w=0&k=20&c=h8Vim0zzESlRyS0LaQ-X8aevVTpFRQZ3D7RnoPuphYQ='
            ],
            [
                'name' => 'Pelatihan Online',
                'slug' => Str::slug('Pelatihan Online'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 'active',
                'active_dashboard' => true,
                'image' => 'https://media.istockphoto.com/id/653949062/vector/boot-camp-square-grunge-stamp.jpg?s=612x612&w=0&k=20&c=h8Vim0zzESlRyS0LaQ-X8aevVTpFRQZ3D7RnoPuphYQ='
            ],
            [
                'name' => 'Coorporate Training',
                'slug' => Str::slug('Coorporate Training'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 'active',
                'active_dashboard' => true,
                'image' => 'https://media.istockphoto.com/id/653949062/vector/boot-camp-square-grunge-stamp.jpg?s=612x612&w=0&k=20&c=h8Vim0zzESlRyS0LaQ-X8aevVTpFRQZ3D7RnoPuphYQ='
            ],
            [
                'name' => 'Webinar Karir',
                'slug' => Str::slug('Webinar Karir'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'status' => 'active',
                'active_dashboard' => false,
                'image' => 'https://media.istockphoto.com/id/653949062/vector/boot-camp-square-grunge-stamp.jpg?s=612x612&w=0&k=20&c=h8Vim0zzESlRyS0LaQ-X8aevVTpFRQZ3D7RnoPuphYQ='
            ],
        ];

        foreach ($data as $event){
            $create = Event::create([
                'name' => $event['name'],
                'slug' => $event['slug'],
                'description' => $event['description'],
                'status' => $event['status'],
                'image' => $event['image']
            ]);

            // MasterClass::factory(2)->count(5)->create([
            //     'event_id' => $create->id,
            //     'active_dashboard' => $event['active_dashboard']
            // ])->each(function($class){
            //     ClassModel::factory(3)->create([
            //         'master_class_id' => $class->id
            //     ]);
            // });
        }
    }
}

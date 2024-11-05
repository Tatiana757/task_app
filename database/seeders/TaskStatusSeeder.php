<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pending = new TaskStatus();
        $pending->slug = 'pending';
        $pending->name = 'В ожидании';
        $pending->save();
        
        $active = new TaskStatus();
        $active->slug = 'active';
        $active->name = 'Активно';
        $active->save();

        $done = new TaskStatus();
        $done->slug = 'done';
        $done->name = 'Выполнено';
        $done->save();

        $expired = new TaskStatus();
        $expired->slug = 'expired';
        $expired->name = 'Просрочено';
        $expired->save();
    }
}
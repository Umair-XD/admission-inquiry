<?php

namespace Database\Seeders;

use App\Models\Degree;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    public function run(): void
    {
        $degrees = [
            ['id' => 1, 'name' => 'Matric'],
            ['id' => 2, 'name' => 'Intermediate'],
            ['id' => 3, 'name' => 'BS / Bachelors'],
            ['id' => 4, 'name' => 'MS / Masters'],
        ];

        foreach ($degrees as $degree) {
            Degree::updateOrCreate(['id' => $degree['id']], ['name' => $degree['name']]);
        }

        $this->command->info('Degrees seeded.');
    }
}

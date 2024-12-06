<?php

namespace Database\Factories;

use App\Models\StaffAkademik;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffAkademik>
 */
class StaffAkademikFactory extends Factory
{
    protected $model = StaffAkademik::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_staff_akademik' => $this->faker->uuid(),
            'username' => $this->faker->userName(),
            'password' => bcrypt('password'),
            'email' => $this->faker->unique()->safeEmail(),
            // 'staff_akademik_google_key' => null,
        ];
    }
}

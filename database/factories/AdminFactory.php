<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => 'admin',
            'username' => 'admin',
            'email' => 'admin#gmail.com',
            'password' => Hash::make('admin')
        ];
    }
}

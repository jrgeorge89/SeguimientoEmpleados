<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $area = $this->faker->randomElement(['Informática','RRHH','Contabilidad','Gerencia','Mercadeo','Cartera']);
        $categorie_id = $this->faker->randomElement(['1','2','3']);
        $logo = $this->faker->imageUrl(400, 300, null, false);
        // $logo = $this->faker->image('public/storage/companylogo', 400, 300, null, false);
        $satisfaction = $this->faker->numberBetween(0, 100);
        $favorite = $this->faker->randomElement(['0','1']);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'area' => $area,
            'categorie_id' => $categorie_id,
            'companie' => $this->faker->company(),
            'url_logo' => $logo,
            'satisfaction' => $satisfaction,
            'favorite' => $favorite
        ];
    }
}

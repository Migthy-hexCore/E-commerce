<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'Talla',
                'type' => 1,
                'features' => [
                    [
                        'value' => 'S',
                        'description' => 'Small',
                    ],
                    [
                        'value' => 'M',
                        'description' => 'Medium',
                    ],
                    [
                        'value' => 'L',
                        'description' => 'Large',
                    ],
                    [
                        'value' => 'XL',
                        'description' => 'Extra Large',
                    ],
                    [
                        'value' => 'XS',
                        'description' => 'Extra Small',
                    ],
                ],
            ],
            [
                'name' => 'Color',
                'type' => 2,
                'features' => [
                    [
                        'value' => '#000000',
                        'description' => 'black',
                    ],
                    [
                        'value' => '#FFFFFF',
                        'description' => 'white',
                    ],
                    [
                        'value' => '#FF0000',
                        'description' => 'red',
                    ],
                    [
                        'value' => '#00FF00',
                        'description' => 'green',
                    ],
                    [
                        'value' => '#0000FF',
                        'description' => 'blue',
                    ],
                ],
            ],
            [
                'name' => 'Sexo',
                'type' => 3,
                'features' => [
                    [
                        'value' => 'M',
                        'description' => 'Masculino',
                    ],
                    [
                        'value' => 'F',
                        'description' => 'Femenino',
                    ],
                ],
            ]
        ];

        foreach ($options as $option) {
            $optionModel = Option::create([
                'name' => $option['name'],
                'type' => $option['type'],
            ]);

            foreach ($option['features'] as $feature) {
                $optionModel->features()->create([
                    'value' => $feature['value'],
                    'description' => $feature['description'],
                ]);
            }
        }
    }
}

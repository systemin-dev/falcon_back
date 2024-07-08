<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boat;
use App\Models\Dimension;
use App\Models\BoatRange;
use App\Models\BoatTranslation;

class BoatSeeder extends Seeder
{
    public function run()
    {
        $boats = [
            [
                'category' => '1',
                'image' => 'seed/boats/1x.jpeg',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Skiff',
                        'base' => 'Carbone',
                        'construction_type' => 'Peinture, sous-couche, carbone prepreg unidirectionnel (2 couches croisées), carbone tissé prepreg, noyau en nid d\'abeille Nomex, carbone prepreg unidirectionnel',
                        'flat_board' => 'Carbone',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Single',
                        'base' => 'Carbon',
                        'construction_type' => 'Paint, undercoat, unidirectional prepreg carbon (2 crossed layers), woven prepreg carbon, Nomex honeycomb core, unidirectional prepreg carbon',
                        'flat_board' => 'Carbon',
                    ]
                ]
            ],
            [
                'category' => '2',
                'image' => 'seed/boats/2x.png',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Deux de couple/Deux sans barreur',
                        'base' => 'Carbone',
                        'construction_type' => 'Peinture, sous-couche, carbone prepreg unidirectionnel (2 couches croisées), carbone tissé prepreg, noyau en nid d\'abeille Nomex, carbone prepreg unidirectionnel',
                        'flat_board' => 'Carbone',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Double scull/Pair without coxswain',
                        'base' => 'Carbon',
                        'construction_type' => 'Paint, undercoat, unidirectional prepreg carbon (2 crossed layers), woven prepreg carbon, Nomex honeycomb core, unidirectional prepreg carbon',
                        'flat_board' => 'Carbon',
                    ]
                ]
            ],
            [
                'category' => '4',
                'image' => 'seed/boats/4x-.png',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Quatre de couple/Quatre avec barreur',
                        'base' => 'Carbone',
                        'construction_type' => 'Peinture, sous-couche, carbone prepreg unidirectionnel (2 couches croisées), carbone tissé prepreg, noyau en nid d\'abeille Nomex, carbone prepreg unidirectionnel',
                        'flat_board' => 'Carbone',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Quad scull/Four with coxswain',
                        'base' => 'Carbon',
                        'construction_type' => 'Paint, undercoat, unidirectional prepreg carbon (2 crossed layers), woven prepreg carbon, Nomex honeycomb core, unidirectional prepreg carbon',
                        'flat_board' => 'Carbon',
                    ]
                ]
            ],
            [
                'category' => '8',
                'image' => 'seed/boats/8.jpeg',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Huit',
                        'base' => 'Carbone',
                        'construction_type' => 'Peinture, sous-couche, carbone prepreg unidirectionnel (2 couches croisées), carbone tissé prepreg, noyau en nid d\'abeille Nomex, carbone prepreg unidirectionnel',
                        'flat_board' => 'Carbone',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Eight',
                        'base' => 'Carbon',
                        'construction_type' => 'Paint, undercoat, unidirectional prepreg carbon (2 crossed layers), woven prepreg carbon, Nomex honeycomb core, unidirectional prepreg carbon',
                        'flat_board' => 'Carbon',
                    ]
                ]
            ],
        ];

        foreach ($boats as $boatData) {
            $translations = $boatData['translations'];
            unset($boatData['translations']);

            $boat = Boat::create($boatData);

            foreach ($translations as $translation) {
                $translation['boat_id'] = $boat->id;
                BoatTranslation::create($translation);
            }

            $dimensions = [];
            $boatRanges = [];

            switch ($boatData['category']) {
                case '1':
                    $dimensions = [
                        ['boat_type' => '1×', 'weight_range' => '55-65', 'mold_number' => 210, 'length_cm' => 7370, 'shape' => 'S'],
                        ['boat_type' => '1×', 'weight_range' => '60-75', 'mold_number' => 115, 'length_cm' => 7630, 'shape' => 'P'],
                        ['boat_type' => '1×', 'weight_range' => '65-75', 'mold_number' => 212, 'length_cm' => 7800, 'shape' => 'S'],
                        ['boat_type' => '1×', 'weight_range' => '65-75', 'mold_number' => 114, 'length_cm' => 7775, 'shape' => 'P'],
                        ['boat_type' => '1×', 'weight_range' => '70-85', 'mold_number' => 120, 'length_cm' => 7860, 'shape' => 'P'],
                        ['boat_type' => '1×', 'weight_range' => '75-85', 'mold_number' => 116, 'length_cm' => 7800, 'shape' => 'P'],
                        ['boat_type' => '1×', 'weight_range' => '85-100', 'mold_number' => 113, 'length_cm' => 8440, 'shape' => 'P'],
                        ['boat_type' => '1×', 'weight_range' => '85-100', 'mold_number' => 211, 'length_cm' => 8356, 'shape' => 'S'],
                        ['boat_type' => '1×', 'weight_range' => '100-120', 'mold_number' => 119, 'length_cm' => 8330, 'shape' => 'P'],
                    ];

                    $boatRanges = [
                        ['name' => 'Gold Plus A+', 'weight' => 14],
                        ['name' => 'Gold A', 'weight' => 14],
                        ['name' => 'Silver B', 'weight' => 15],
                    ];
                    break;

                case '2':
                    $dimensions = [
                        ['boat_type' => '2×/-', 'weight_range' => '60-75', 'mold_number' => 224, 'length_cm' => 8990, 'shape' => 'S'],
                        ['boat_type' => '2×/-', 'weight_range' => '60-80', 'mold_number' => 222, 'length_cm' => 9360, 'shape' => 'S'],
                        ['boat_type' => '2×/-', 'weight_range' => '65-80', 'mold_number' => 125, 'length_cm' => 9420, 'shape' => 'P'],
                        ['boat_type' => '2×/-', 'weight_range' => '75-85', 'mold_number' => 121, 'length_cm' => 9600, 'shape' => 'P'],
                        ['boat_type' => '2×/-', 'weight_range' => '85-100', 'mold_number' => 127, 'length_cm' => 9803, 'shape' => 'P'],
                        ['boat_type' => '2×/-', 'weight_range' => '85-100', 'mold_number' => 229, 'length_cm' => 10000, 'shape' => 'S'],
                    ];

                    $boatRanges = [
                        ['name' => 'Gold Plus A+', 'weight' => 27],
                        ['name' => 'Gold A', 'weight' => 27],
                        ['name' => 'Silver B', 'weight' => 29],
                    ];
                    break;

                case '4':
                    $dimensions = [
                        ['boat_type' => '4×/-/+', 'weight_range' => '60-80', 'mold_number' => 142, 'length_cm' => 11780, 'shape' => 'P'],
                        ['boat_type' => '4×/-/+', 'weight_range' => '75-95', 'mold_number' => 145, 'length_cm' => 12000, 'shape' => 'P'],
                        ['boat_type' => '4×/-/+', 'weight_range' => '90-100', 'mold_number' => 143, 'length_cm' => 12250, 'shape' => 'P'],
                    ];

                    $boatRanges = [
                        ['name' => 'Gold Plus A+', 'weight' => 50],
                        ['name' => 'Gold A', 'weight' => 50],
                        ['name' => 'Silver B', 'weight' => 53],
                    ];
                    break;

                case '8':
                    $dimensions = [
                        ['boat_type' => '8+', 'weight_range' => '80-', 'mold_number' => 184, 'length_cm' => 16700, 'shape' => 'P'],
                        ['boat_type' => '8+', 'weight_range' => '80-90', 'mold_number' => 183, 'length_cm' => 17560, 'shape' => 'P'],
                        ['boat_type' => '8+', 'weight_range' => '95+', 'mold_number' => 181, 'length_cm' => 17570, 'shape' => 'P'],
                    ];

                    $boatRanges = [
                        ['name' => 'Gold Plus A+', 'weight' => 96],
                        ['name' => 'Gold A', 'weight' => 96],
                        ['name' => 'Silver B', 'weight' => 100],
                    ];
                    break;
            }

            foreach ($dimensions as $dimensionData) {
                $dimensionData['boat_id'] = $boat->id;
                Dimension::create($dimensionData);
            }

            foreach ($boatRanges as $rangeData) {
                $rangeData['boat_id'] = $boat->id;
                BoatRange::create($rangeData);
            }
        }
    }
}

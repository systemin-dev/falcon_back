<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boat;
use App\Models\Dimension;
use App\Models\BoatRange;
use App\Models\BoatTranslation;

class OtherBoatSeeder extends Seeder
{
    public function run()
    {
        $boats = [
            [
                'category' => 'g1',
                'image' => 'seed/boats/gig1x.jpeg',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Gig Boat (1x)',
                        'base' => 'Composite',
                        'construction_type' => 'Construction de coque et de plat-bord, intérieur en fibre de verre, extérieur en fibre de verre, sandwich en mousse, construction de plat-bord mixte avec fibre de carbone et kevlar.',
                        'flat_board' => 'Composite',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Gig Boat (1x)',
                        'base' => 'Composite',
                        'construction_type' => 'Hull and gunwale construction, fiberglass interior, fiberglass exterior, foam sandwich, mixed gunwale construction with carbon fiber and kevlar.',
                        'flat_board' => 'Composite',
                    ]
                ]
            ],
            [
                'category' => 'g2',
                'image' => 'seed/boats/gig1x.jpeg',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Gig Boat (2x)',
                        'base' => 'Composite',
                        'construction_type' => 'Construction de coque et de plat-bord, intérieur en fibre de verre, extérieur en fibre de verre, sandwich en mousse, construction de plat-bord mixte avec fibre de carbone et kevlar.',
                        'flat_board' => 'Composite',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Gig Boat (2x)',
                        'base' => 'Composite',
                        'construction_type' => 'Hull and gunwale construction, fiberglass interior, fiberglass exterior, foam sandwich, mixed gunwale construction with carbon fiber and kevlar.',
                        'flat_board' => 'Composite',
                    ]
                ]
            ],
            [
                'category' => 'g4',
                'image' => 'seed/boats/gig1x.jpeg',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Gig Boat (4x)',
                        'base' => 'Composite',
                        'construction_type' => 'Construction de coque et de plat-bord, intérieur en fibre de verre, extérieur en fibre de verre, sandwich en mousse, construction de plat-bord mixte avec fibre de carbone et kevlar.',
                        'flat_board' => 'Composite',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Gig Boat (4x)',
                        'base' => 'Composite',
                        'construction_type' => 'Hull and gunwale construction, fiberglass interior, fiberglass exterior, foam sandwich, mixed gunwale construction with carbon fiber and kevlar.',
                        'flat_board' => 'Composite',
                    ]
                ]
            ],
            [
                'category' => 'c1',
                'image' => 'seed/boats/coastal1x.jpeg',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Coastal (1x)',
                        'base' => 'Composite',
                        'construction_type' => 'Construction de coque et de plat-bord, intérieur en fibre de verre, extérieur en fibre de verre, sandwich en mousse, construction de plat-bord mixte avec fibre de carbone et kevlar.',
                        'flat_board' => 'Composite',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Coastal (1x)',
                        'base' => 'Composite',
                        'construction_type' => 'Hull and gunwale construction, fiberglass interior, fiberglass exterior, foam sandwich, mixed gunwale construction with carbon fiber and kevlar.',
                        'flat_board' => 'Composite',
                    ]
                ]
            ],
            [
                'category' => 'c2',
                'image' => 'seed/boats/coastal2x.jpeg',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Coastal (2x)',
                        'base' => 'Composite',
                        'construction_type' => 'Construction de coque et de plat-bord, intérieur en fibre de verre, extérieur en fibre de verre, sandwich en mousse, construction de plat-bord mixte avec fibre de carbone et kevlar.',
                        'flat_board' => 'Composite',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Coastal (2x)',
                        'base' => 'Composite',
                        'construction_type' => 'Hull and gunwale construction, fiberglass interior, fiberglass exterior, foam sandwich, mixed gunwale construction with carbon fiber and kevlar.',
                        'flat_board' => 'Composite',
                    ]
                ]
            ],
            [
                'category' => 'c2',
                'image' => 'seed/boats/coastal2x.jpeg',
                'condition' => 'new',
                'translations' => [
                    'fr' => [
                        'locale' => 'fr',
                        'description' => 'Coastal (4x)',
                        'base' => 'Composite',
                        'construction_type' => 'Construction de coque et de plat-bord, intérieur en fibre de verre, extérieur en fibre de verre, sandwich en mousse, construction de plat-bord mixte avec fibre de carbone et kevlar.',
                        'flat_board' => 'Composite',
                    ],
                    'en' => [
                        'locale' => 'en',
                        'description' => 'Coastal (4x)',
                        'base' => 'Composite',
                        'construction_type' => 'Hull and gunwale construction, fiberglass interior, fiberglass exterior, foam sandwich, mixed gunwale construction with carbon fiber and kevlar.',
                        'flat_board' => 'Composite',
                    ]
                ]
            ]
        ];

        foreach ($boats as $boatData) {
            $translations = $boatData['translations'];
            unset($boatData['translations']);

            $boat = Boat::create($boatData);

            foreach ($translations as $translation) {
                $translation['boat_id'] = $boat->id;
                BoatTranslation::create($translation);
            }

            $dimensionData = [
                'boat_id' => $boat->id,
                'boat_type' => $boatData['category'],
                'weight_range' => '60-100',
                'mold_number' => 0,
                'length_cm' => 0,
                'shape' => 0
            ];

            Dimension::create($dimensionData);

            $rangeData = [
                'boat_id' => $boat->id,
                'name' => 'General',
                'weight' => '100'
            ];

            BoatRange::create($rangeData);
        }
    }
}

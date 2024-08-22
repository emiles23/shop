<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('products')->insert([]);
        $brands = [
            (object) [
                'name' => 'Shein',
                'products' => [
                    (object) [
                        'name' => 'Franela',
                        'price' => 12,
                    ],
                    (object) [
                        'name' => 'Camisa sin manga',
                        'price' => 12,
                    ],
                    (object) [
                        'name' => 'Blazer unicolor',
                        'price' => 11,
                        'discounts' => [
                            (object) [
                                'value' => 5,
                            ]
                        ]
                    ],
                    (object) [
                        'name' => 'Pantalones jogger',
                        'price' => 18,
                        'discounts' => [
                            (object) [
                                'value' => 5,
                                'type' => 1
                            ]
                        ]
                    ],
                ],

                'discounts' => [
                    (object) [
                        // 'min' => 45,
                        'value' => 30,
                    ]
                ]
            ],

            (object) [
                'name' => 'Samsung',
                'products' => [
                    (object) [
                        'name' => '55 pulgadas Smart tv 4k',
                        'price' => 799,
                    ],
                    (object) [
                        'name' => '32 pulgadas SFire TV Omni Series',
                        'price' => 325,
                    ],
                    (object) [
                        'name' => '75 pulgadas, clase Crystal UHD, serie AU8000, 4K, UHD, HDR, Smart TV',
                        'price' => 500,
                    ],
                ],

                'discounts' => [
                    (object) [
                        // 'min' => 1000,
                        'value' => 10,
                    ]
                ]
            ],

            (object) [
                'name' => 'Dell',
                'products' => [

                    (object) [
                        'name' => 'AMD Ryzen 5 5600X, RTX 3060, 16GB 3600Mhz',
                        'price' => 300,
                    ],
                    (object) [
                        'name' => 'Computadora OptiPlex personalizada de escritorio Intel Core i5-6500',
                        'price' => 325,
                        'discounts' => [
                            (object) [
                                'value' => 30,
                                'type' => 1
                            ]
                        ]
                    ],
                    (object) [
                        'name' => 'procesador Intel Core i7-11700F, GeForce RTX 3060, 32 GB de RAM, 1 TB ',
                        'price' => 600,
                    ],
                ],

                'discounts' => [
                    (object) [
                        // 'min' => 800,
                        'value' => 12,
                    ]
                ]
            ],

            (object) [
                'name' => 'Adidas',
                'products' => [

                    (object) [
                        'name' => 'Zapatos deportivos de correr para hombre',
                        'price' => 300,
                    ],
                    (object) [
                        'name' => 'Tenis para correr para mujer',
                        'price' => 150,
                    ],
                    (object) [
                        'name' => 'Zapatos planos Belice estilo ballet para mujer',
                        'price' => 185,
                    ],

                ],

                'discounts' => [
                    (object) [
                        // 'min' => 300,
                        'value' => 15,
                    ]
                ]
            ],

            (object) [
                'name' => 'Rucha',
                'products' => [

                    (object) [
                        'name' => 'Plancha De Cabello Professional 450°F, plancha de pelo de cerámica ',
                        'price' => 260,
                    ],
                    (object) [
                        'name' => 'Conair Plancha plana de cerámica doble, 1 pulgada',
                        'price' => 200,
                    ],
                    (object) [
                        'name' => 'Titanium Ionic Hair Straightener, Professional Flat Iron For All Hair+ Types',
                        'price' => 100,
                    ],
                ],
                'discounts' => [
                    (object) [
                        // 'min' => 100,
                        'value' => 5,
                    ]
                ]
            ],

        ];

        foreach ($brands as $brand) {
            // dd($brand);
            $brandCreated = Brand::create(['name' => $brand->name]);
            if (isset($brand->discounts)) {
                foreach ($brand->discounts as $discount) {
                    $discountCreated = Discount::create(collect($discount)->toArray());
                    $brandCreated->discounts()->attach($discountCreated->id);
                }
            
            }
            foreach ($brand->products as $product) {
                // dd($brand);
                $product->brand_id = $brandCreated->id;
                $productCreated = Product::create(collect($product)->except('discounts')->toArray());

                if (isset($product->discounts)) {
                    foreach ($product->discounts as $discount) {
                        $discountCreated = Discount::create(collect($discount)->toArray());
                        $productCreated->discounts()->attach($discountCreated->id);
                    }
                }
            }
        }
    }
}
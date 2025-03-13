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
        // $discountGroups = [
        //     [
        //         'brands' => ['Shein', 'Rucha', 'Adidas'],
        //         'quantity' => 3,
        //         'value' => 5,
        //         'min' => 400           
        //     ],
        //     [
        //         'brands' => ['Samsung', 'Adidas', 'Shein'],
        //         'quantity' => 2,
        //         'value' => 200,
        //         'min' => 1500,
        //         'type' => 1
        //     ]
        // ];

        $brands = [
            (object) [
                'name' => 'Shein',
                'products' => [
                    (object) [
                        'name' => 'Franela',
                        'price' => 12,
                        'img' => '/img/products/product.jpg',
                    ],
                    (object) [
                        'name' => 'Camisa sin manga',
                        'price' => 12,
                        'img' => '/img/products/img1.png',
                    ],
                    (object) [
                        'name' => 'Blazer unicolor',
                        'price' => 20,
                        'img' => '/img/products/img2.png',
                        'discounts' => [
                            (object) [
                                'value' => 5,
                                'type' => 1
                            ]
                        ]
                    ],
                    (object) [
                        'name' => 'Pantalones jogger',
                        'price' => 21.6,
                        'img' => '/img/products/img3.png',
                        'discounts' => [
                            (object) [
                                'value' => 20,                              
                            ]
                        ]
                    ],
                ],

                'discounts' => [
                    (object) [
                        'min' => 45,
                        'value' => 3,
                        'type' => 1
                    ]
                ]
            ],

            (object) [
                'name' => 'Samsung',
                'products' => [
                    (object) [
                        'name' => '55 pulgadas Smart tv 4k',
                        'price' => 799,
                        'img' => '/img/products/img4.png',
                    ],
                    (object) [
                        'name' => '32 pulgadas SFire TV Omni Series',
                        'price' => 325,
                        'img' => '/img/products/img5.png',
                    ],
                    (object) [
                        'name' => '75 pulgadas, clase Crystal UHD, serie AU8000, 4K, UHD, HDR, Smart TV',
                        'price' => 500,
                        'img' => '/img/products/img5.png',
                    ],
                ],

                'discounts' => [
                    (object) [
                        'min' => 1000,
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
                        'img' => '/img/products/img7.png',
                    ],
                    (object) [
                        'name' => 'Computadora OptiPlex personalizada de escritorio Intel Core i5-6500',
                        'price' => 325,
                        'img' => '/img/products/img8.png',
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
                        'img' => '/img/products/img9.png',
                    ],
                ],

                'discounts' => [
                    (object) [
                        'min' => 800,
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
                        'img' => '/img/products/img10.png',
                    ],
                    (object) [
                        'name' => 'Tenis para correr para mujer',
                        'price' => 150,
                        'img' => '/img/products/img11.png',
                    ],
                    (object) [
                        'name' => 'Zapatos planos Belice estilo ballet para mujer',
                        'price' => 185,
                        'img' => '/img/products/img12.png',
                    ],

                ],

                'discounts' => [
                    (object) [
                        'min' => 300,
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
                        'img' => '/img/products/img13.png',
                    ],
                    (object) [
                        'name' => 'Conair Plancha plana de cerámica doble, 1 pulgada',
                        'price' => 200,
                        'img' => '/img/products/img14.png',
                    ],
                    (object) [
                        'name' => 'Titanium Ionic Hair Straightener, Professional Flat Iron For All Hair+ Types',
                        'price' => 100,
                        'img' => '/img/products/img15.png',
                    ],
                ],
                'discounts' => [
                    (object) [
                        'min' => 100,
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
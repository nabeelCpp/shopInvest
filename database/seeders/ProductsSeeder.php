<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id' => 3,
                'name' => "Air Jordan 1 Mid SE Big Kids' Shoes",
                'price' => 120,
                'description' => '<h1 id="pdp_product_title" class="headline-2 css-16cqcdq" data-test="product-title">Air Jordan 1 Mid SE</h1>
                <h2 class="headline-5 pb1-sm d-sm-ib" data-test="product-sub-title">Big Kids\' Shoes</h2>
                <p>Rock some retro colors and look good doin\' it. This pair of kicks has nubuck leather and suede in the upper for a plush look and feel. Nike Air in the sole keeps your every step light as&amp;&hellip;well, air.</p>
                <ul class="description-preview__features pt8-sm pb6-sm ncss-list-ul">
                <li class="description-preview__color-description ncss-li">Shown: Black/Cardinal Red/White/Vivid Orange</li>
                <li class="description-preview__style-color ncss-li">Style: FJ4924-008</li>
                </ul>',
                'brand_id' => 2
            ],
            [
                'id' => 5,
                'name' => "Puma Sweaterssss",
                'price' => 15,
                'description' => '<div class="col-span-full">
                <div>
                <h3>PRODUCT STORY</h3>
                </div>
                <div>
                <p>Our Classics collection is filled with no-frills items, including this relaxed hoodie that\'s perfect for both the home and the city.</p>
                </div>
                </div>
                <div>
                <h3>FEATURES &amp; BENEFITS</h3>
                <ul>
                <li>Recycled Content: Made with at least 20% recycled material as a step toward a better future</li>
                <li>Cotton: Cotton in PUMA products comes from farms with a focus on sustainable farming such as water efficiency and soil health protection. Learn more: https://about.puma.com/forever-better</li>
                </ul>
                </div>
                <div>
                <h3>DETAILS</h3>
                <ul>
                <li>Relaxed fit</li>
                <li>Crossover hood construction</li>
                <li>Kangaroo pocket for storage solution</li>
                <li>Ribbed cuffs and hem</li>
                <li>PUMA Archive No. 1 Logo embroidered on left chest</li>
                <li>Brushed jersey</li>
                </ul>
                </div>
                <div>
                <h3 class="capitalize">Material Information</h3>
                <ul>
                <li>HOOD LINING: 66% cotton, 34% polyester</li>
                <li>RIB: 96% cotton, 4% elastane</li>
                <li>SHELL: 66% cotton, 34% polyester</li>
                </ul>
                </div>
                <div>
                <h3 class="capitalize">Care Instructions</h3>
                <ul>
                <li>Use detergent for colours</li>
                <li>Wash with similar colours</li>
                <li>Wash and iron inside out</li>
                <li>Exclusive of Decoration</li>
                </ul>
                </div>',
                'brand_id' => 9
            ],
            [
                'id' => 6,
                'name' => "Men's Nike Air Barrage Low Sneakers Navy / White / Red / Navy | PK4257452",
                'price' => 67,
                'description' => '<p>With its iconic "AIR" branding on the midsole and distinct lacing system, Nike Air Barrage Low backs up its street legend status. Full-length Nike Air cushioning takes you in comfort from crossover to city living in untouchable, head-turning style.</p>',
                'brand_id' => 2
            ],
            [
                'id' => 7,
                'name' => 'Puma Fusion EVO 2021 Golf Shoes - Black/Quiet Shade',
                'price' => 45,
                'description' => '<p>The PUMA Fusion Evo Golf Shoes feature super soft FUSIONFOAM that provides unrivaled energy return and ultra-plush cushioning to keep you comfortable all-round long. The shoe\'s PWRStrap Fit System integrates with the laces to wrap your foot for a secure, personalized fit.<br><br><strong>KEY FEATURES</strong></p>
                <ul>
                <li>Bootie construction provides step in comfort and 360 degrees of support around the foot</li>
                <li>FUSIONFOAM mix of super soft EVA foam and ultra-responsive rubber provides extraordinary energy return and cushioning</li>
                <li>SOFTFOAM dual-density insole provides two unique layers of cushioning for customized comfort, fit and durability</li>
                <li>PWRStrap Fit System wraps the foot for a secure, personalized fit</li>
                <li>Traction inspired by nature with strategically designed directional lugs in proper zones for increased grip</li>
                </ul>',
                'brand_id' => 9
            ],
            [
                'id' => 8,
                'name' => 'OKHAMA NYC BLUE WASH DENIM PANT',
                'price' => 5,
                'description' => '<ul>
                <li>Premium Quality Branded Denim Pant</li>
                <li>Original A Leftover</li>
                <li>100% Original Tag</li>
                <li>Slim Fitting (Not Skinny)</li>
                <li>Must Have Denim Pant</li>
                </ul>',
                'brand_id' => 11
            ],
            [
                'id' => 9,
                'name' => 'Sporty stretch fustian shirt with multiple pockets',
                'price' => 1200,
                'description' => '<div class="b-product-info_asset">Import duties included</div>
                <div class="b-product_sku">Art. Nr. G5KV4TFUWD1N0000</div>
                <div class="b-product-info_content"><span class="b-product-info_content-more js-readmore-content">For FW23, Dolce&amp;Gabbana rereads its own historical archive, which is an inexhaustible source of inspiration that is rich in fascination and creativity. The garments accompanied by a &ldquo;Re-Edition&rdquo; label report the dates referenced by the collection. Each look enhances in all its sophistication the concept of timeless relevance of a historical archive allowing new generations to discover a past but always current universe that is rich in creative insights and possible personal interpretations.</span></div>',
                'brand_id' => 12
            ],
            [
                'id' => 10,
                'name' => 'MRF Genius Players Special',
                'price' => 7000,
                'description' => '<ul>
                <li>Made from premium quality English Willow.</li>
                <li>Thick edges, curved blade and higher sweet spot for destructive hitting.</li>
                <li>Handle made from premium imported Sarawak cane to deliver superior power and control.</li>
                </ul>',
                'brand_id' => 13
            ],
            [
                'id' => 11,
                'name' => 'ADIZERO SL RUNNING SHOES',
                'price' => 120,
                'description' => '<h2 class="gl-heading title___1no5t withhtml___2vPJM gl-heading--m">THE DAILY TRAINER</h2>
                <div class="summary___1BV7e withhtml___2vPJM gl-fetched-content gl-body--l">Everyday comfort from training runs to the finish line. The Adizero SL is designed to enable elite runners and anyone who runs for a personal best to set their ambitions higher.</div>
                <div class="summary___1BV7e withhtml___2vPJM gl-fetched-content gl-body--l">&nbsp;</div>
                <div class="summary___1BV7e withhtml___2vPJM gl-fetched-content gl-body--l">
                <h2 class="title___2X-xv">FAQ</h2>
                <div class="gl-accordion gl-accordion--open">
                <div class="gl-accordion__header-text"><span class="gl-accordion__title">1. What records have been broken in Adizero Adios Pro?</span></div>
                <div class="gl-accordion__header-icon">&nbsp;</div>
                <div class="gl-accordion__content">
                <div>
                <div class="gl-fetched-content faq-item___wlBEL">Did you know that Adizero Adios Pro shoes achieved the most major marathon wins in 2022, including 2 world records? Our designers work with insights from some of the fastest professional runners in the world to continuously iterate and improve our racing shoes &ndash; an approach that has helped us to break 12 world records since Adizero was introduced! Here are a few recent records we\'re particularly proud of...
                <ul>
                <li>2021: Gold at Tokyo Summer Games, Peres Jepchirchir.</li>
                <li>2020: World Record at RUNCZECH Half Marathon, Peres Jepchirchir.</li>
                <li>2022: 9 National Records, 1 European Record and 3 World Leads at Adizero Road to Records.</li>
                </ul>
                </div>
                </div>
                </div>
                </div>
                <div class="gl-accordion gl-accordion--open">
                <div class="gl-accordion__header-text"><span class="gl-accordion__title">2. What type of runner would benefit from the Adizero Adios Pro range?</span></div>
                <div class="gl-accordion__header-icon">&nbsp;</div>
                <div class="gl-accordion__content">
                <div>
                <div class="gl-fetched-content faq-item___wlBEL">The Adizero Adios Pro series is designed for runners who aspire to win races and break records - whether it\'s a personal best or even a World Record. These high-performance shoes are optimised for fast-paced racing over the half and full marathon, with a combination of LIGHTSTRIKE PRO cushioning and ENERGYRODS to help runners to achieve their very best results. Lace up in the same record-breaking shoes worn by elite athletes in competition, and chase your next goal.</div>
                </div>
                </div>
                </div>
                <div class="gl-accordion gl-accordion--open">
                <div class="gl-accordion__header-text"><span class="gl-accordion__title">3. What is the legendary legacy of Adizero Adios Pro?</span></div>
                <div class="gl-accordion__header-icon">&nbsp;</div>
                <div class="gl-accordion__content">
                <div>
                <div class="gl-fetched-content faq-item___wlBEL">Adizero entered the world with an ambition to build on the running legacy already established by the adidas family, and set a precedent in competitive world racing that would inspire athletes to run further and faster than ever before.<br>
                <p>In 2008, Haile Gebrselassie introduced the world to Adios Pro 1, when he shattered his own world record to become the first person to break the 2:04hr barrier. Since that day, Adizero has helped some of the world&rsquo;s best runners achieve 12 more world records &ndash; 3 in 2020, 7 in 2021 and 2 in 2022.</p>
                <p>The Adizero range has been developed alongside the world&rsquo;s fastest runners to continuously improve, and deliver elite performances. With the latest technology, Adizero helps every athlete set their sights higher and run after new records.</p>
                </div>
                </div>
                </div>
                </div>
                </div>',
                'brand_id' => 10
            ]
        ];
        \App\Models\Product::factory()->create($products);


        $images = [
            ['filename' => '1695300425_png-clipart-sneakers-basketball-shoe-sportswear-nike-shoe-outdoor-shoe-running.png', 'product_id' => 3],
            ['filename' => '1695328910_43258.jpg', 'product_id' => 5],
            ['filename' => '1695328910_160555.jpg', 'product_id' => 5],
            ['filename' => '1695574823_4.jpg', 'product_id' => 6],
            ['filename' => '1695574823_3.jpg', 'product_id' => 6],
            ['filename' => '1695574823_2.jpg' , 'product_id' => 6],
            ['filename' => '1695574823_1.jpg' , 'product_id' => 6],
            ['filename' => '1695575114_p-2.png', 'product_id' => 7],
            ['filename' => '1695575114_p-1.png', 'product_id' => 7],
            ['filename' => '1695624959_denim-1.jpg', 'product_id' => 8],
            ['filename' => '1695625156_dg-4.jpg', 'product_id' => 9],
            ['filename' => '1695625156_dg-3.jpg', 'product_id' => 9],
            ['filename' => '1695625156_dg-2.jpg', 'product_id' => 9],
            ['filename' => '1695625156_dg-1.jpg', 'product_id' => 9],
            ['filename' => '1695625290_2 MRF Genius Players Special.jpg', 'product_id' => 10],
            ['filename' => '1695625699_adidas1.jpg', 'product_id' => 11]
        ];

        \App\Models\Image::factory()->create($images);
    }
}

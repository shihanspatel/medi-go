<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductDescriptionSeeder extends Seeder
{
    public function run(): void
    {
        $descriptions = [
            1 => [
                'description' => 'Premium quality almonds rich in vitamin E and antioxidants. Perfect for daily snacking and adding to your diet for better health. These almonds are carefully selected and processed to maintain their nutritional value.',
                'ingredients' => 'Almonds (100%)'
            ],
            2 => [
                'description' => 'Amoxicillin is a penicillin-type antibiotic used to treat bacterial infections. It works by stopping the growth of bacteria. This medication is commonly prescribed for ear infections, bladder infections, pneumonia, strep throat, and other bacterial infections.',
                'ingredients' => 'Amoxicillin Trihydrate USP'
            ],
            3 => [
                'description' => 'Blood pressure monitoring device for accurate and reliable readings. Easy to use with digital display. Suitable for home use and medical professionals. Comes with adjustable cuff for comfortable fit.',
                'ingredients' => 'Electronic Components, Cuff, Display'
            ],
            4 => [
                'description' => 'Butter is a dairy product made from churning milk or cream. Rich in fat-soluble vitamins A, D, E, and K. Perfect for cooking, baking, and spreading. Our butter is made from fresh cream with no additives.',
                'ingredients' => 'Cream (100%), Salt'
            ],
            5 => [
                'description' => 'Disposable medical gloves for protection and hygiene. Latex-free and powder-free for sensitive skin. Suitable for medical professionals, food handlers, and general use. Provides excellent barrier protection.',
                'ingredients' => 'Nitrile Rubber'
            ],
            6 => [
                'description' => 'Disprin is an aspirin-based pain reliever and fever reducer. Fast-acting formula for quick relief from headaches, body aches, and fever. Suitable for adults and children above 12 years.',
                'ingredients' => 'Aspirin 500mg'
            ],
            7 => [
                'description' => 'Glucoz is a glucose supplement for instant energy. Perfect for athletes, students, and anyone needing quick energy boost. Contains natural sugars and essential minerals for better absorption.',
                'ingredients' => 'Glucose, Dextrose, Minerals'
            ],
            8 => [
                'description' => 'Premium quality lotion for soft and moisturized skin. Contains natural ingredients and vitamin E. Suitable for all skin types. Non-greasy formula that absorbs quickly.',
                'ingredients' => 'Water, Glycerin, Vitamin E, Natural Oils'
            ],
            9 => [
                'description' => 'Metformin is an oral medication used to treat type 2 diabetes. It helps control blood sugar levels by decreasing glucose production in the liver. Take as prescribed by your healthcare provider.',
                'ingredients' => 'Metformin Hydrochloride USP'
            ],
            10 => [
                'description' => 'OTS (Over The Shoulder) support for back pain relief. Provides compression and support for better posture. Adjustable straps for comfortable fit. Suitable for daily wear.',
                'ingredients' => 'Neoprene, Elastic, Velcro'
            ],
            11 => [
                'description' => 'Professional stethoscope for accurate heart and lung sound detection. Dual-sided chest piece for versatile use. Comfortable earpieces and tubing. Essential tool for medical professionals.',
                'ingredients' => 'Stainless Steel, Rubber, Plastic'
            ],
            12 => [
                'description' => 'Premium quality shampoo for healthy and shiny hair. Contains natural ingredients and essential oils. Suitable for all hair types. Gentle formula that cleanses without stripping natural oils.',
                'ingredients' => 'Water, Surfactants, Essential Oils, Conditioners'
            ],
            13 => [
                'description' => 'Gentle soap for daily cleansing. Made with natural ingredients and moisturizers. Suitable for sensitive skin. Leaves skin soft and refreshed without drying.',
                'ingredients' => 'Soap Base, Glycerin, Natural Oils'
            ],
            14 => [
                'description' => 'Premium quality walnuts rich in omega-3 fatty acids. Great for brain health and heart health. Perfect for snacking or adding to recipes. Carefully selected and processed.',
                'ingredients' => 'Walnuts (100%)'
            ],
            15 => [
                'description' => 'Powder for various uses - talc powder, medicinal powder, or cosmetic powder. Smooth texture and long-lasting effect. Suitable for daily use. Keeps skin dry and comfortable.',
                'ingredients' => 'Talc, Zinc Oxide, Fragrance'
            ]
        ];

        foreach ($descriptions as $productId => $data) {
            Product::where('id', $productId)->update([
                'description' => $data['description'],
                'ingredients' => $data['ingredients']
            ], ['timestamps' => false]);
        }
    }
}

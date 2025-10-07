<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $restaurants = Restaurant::all();

        // Tant Bakiza
        $tantBakiza = $restaurants->where('name', 'Tant Bakiza')->first();
        $delawa = $restaurants->where('name', 'Delawa')->first();

        if (!$tantBakiza) {
            return; // Exit if restaurant not found
        }

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Tutti Frutti - Totii Froti Smart Size',
            'description' => 'Luxurious layers of smooth vanilla cream embrace a delicate sponge cake, complemented by the rich flavors of peach and pineapple, with a luxurious raspberry filling with its distinctive touch... an elegant tropical combination that awakens the senses and provides an unparalleled dessert experience. serves 3 to 4 people.',
            'price' => 94.00,
            'image' => 'menu/delawa/1.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Tiramisu Delawa - Delawa Tramisu Smart Size',
            'price' => 94.00,
            'description' => 'Silky layers of rich espresso cream envelop delicate biscuits soaked in premium coffee creating a perfect harmony of smoothness and depth an authentic italian dessert that speaks of luxury and lingers with unforgettable flavors',
            'image' => 'menu/delawa/2.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Cheesy Lotus Cherry - Cheesy Lotus Cherry Smart Size',
            'price' => 79.00,
            'description' => 'A luxurious harmony of velvety cream cheese and premium cherry pieces with their refreshing touch, crowned by a layer of caramelized lotus biscuit with its unique aroma… an indulgent experience that captivates the senses, blending smoothness and richness in every spoonful.',
            'image' => 'menu/delawa/3.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Verry Berry - Verry Berry Smart Size',
            'price' => 79.00,
            'description' => 'A delicate sponge cake, harmonized with soft vanilla cream, and interspersed with a luxurious strawberry filling with a refreshing natural touch... an elegant blend that combines sophisticated simplicity with captivating taste.',
            'image' => 'menu/delawa/4.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Mango Pavlova - Mango Pavlova Smart Size',
            'price' => 79.00,
            'description' => 'Layers of light vanilla sponge cake, layered with smooth vanilla cream and enhanced with ripe mango pieces. serves 3 to 4.',
            'image' => 'menu/delawa/5.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Dulce De Leche - Dulce De Leche Smart Size',
            'price' => 94.00,
            'description' => 'Luxurious layers of smooth cream cheese intertwined with crispy bites enveloped in rich nutella and finished with a touch of premium valrhona dulcey chocolate a decadent dessert experience blending softness crunch and golden elegance in every bite',
            'image' => 'menu/delawa/6.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Tutti Frutti - Totii Frotii Big Size',
            'price' => 194.00,
            'description' => 'Tutti Frutti - Totii Frotii Big Size',
            'image' => 'menu/delawa/7.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Tiramisu Delawa - Delawa Tramisu Big Size',
            'price' => 194.00,
            'description' => 'Silky layers of rich espresso cream envelop delicate biscuits soaked in premium coffee creating a perfect harmony of smoothness and depth an authentic italian dessert that speaks of luxury and lingers with unforgettable flavors',
            'image' => 'menu/delawa/8.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Cheesy Lotus Cherry - Cheesy Lotus Cherry Big Size',
            'price' => 179.00,
            'description' => 'A luxurious harmony of velvety cream cheese and premium cherry pieces with their refreshing touch, crowned by a layer of caramelized lotus biscuit with its unique aroma… an indulgent experience that captivates the senses, blending smoothness and richness in every spoonful.',
            'image' => 'menu/delawa/9.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Dulce De Leche - Dulce De Leche Big Size',
            'price' => 194.00,
            'description' => 'Luxurious layers of smooth cream cheese intertwined with crispy bites enveloped in rich nutella and finished with a touch of premium valrhona dulcey chocolate a decadent dessert experience blending softness crunch and golden elegance in every bite',
            'image' => 'menu/delawa/10.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Verry Berry - Verry Berry Big Size',
            'price' => 179.00,
            'description' => 'A delicate sponge cake, harmonized with soft vanilla cream, and interspersed with a luxurious strawberry filling with a refreshing natural touch... an elegant blend that combines sophisticated simplicity with captivating taste.',
            'image' => 'menu/delawa/11.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Mango Pavlova - Mango Pavlova Big Size',
            'price' => 179.00,
            'description' => 'Layers of light vanilla sponge cake, layered with smooth vanilla cream and enhanced with ripe mango pieces. serves 3 to 4.',
            'image' => 'menu/delawa/12.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Gatherings Box',
            'price' => 189.00,
            'description' => 'We ve put together a select package of 3 delawa products for you, one unforgettable experience. combine the luxury of cherry lotus, the freshness of mango pavlova, and the magic of very berry in one package that combines smoothness, fruity flavors, and the perfect refreshment for summer. this package is ideal for lovers of luxury desserts. serves 7 to 10 people.',
            'image' => 'menu/delawa/13.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Cheese Cake Madrid Mix Berry',
            'price' => 235.00,
            'description' => 'A true embodiment of luxury in every detail a smooth creamy layer made from the finest cheese resting on a golden crispy base and adorned with carefully selected fruits that add a refreshing touch',
            'image' => 'menu/delawa/14.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Monamour Chocolate Cake',
            'price' => 195.00,
            'description' => 'For lovers of fine chocolate and a deep fruity touchlayers of rich chocolate cake with a moist texture and distinctive flavorfilled with natural cherries that bring a perfect balance between sweetness and tartnesscovered with a smooth layer of premium chocolate that flows over the surface completing the experience with irresistible elegance',
            'image' => 'menu/delawa/15.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Crunchy Pistachio Cake',
            'price' => 235.00,
            'description' => 'Luxurious pistachio flavored sponge layers blend harmoniously with a refreshing natural cherry layer filled with a smooth pistachio cream that creates perfect harmony in every bite the cake is adorned on the sides with crunchy biscuits that add an elegant texture and a touch of sophistication while it is enveloped in a coat of premium white chocolate that balances sweetness with elegance',
            'image' => 'menu/delawa/16.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Wild Berry Cake',
            'price' => 349.00,
            'description' => 'Mixed fruit cake – nature’s flavor, elegantly served enjoy a soft sponge cake layered with creamy filling, fresh pineapple, juicy peaches, and a medley of wild berries—red berries, blueberries, and raspberries—for a naturally sweet, refreshing treat. ask chatgpt',
            'image' => 'menu/delawa/17.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Delawa Millefeuille',
            'price' => 189.00,
            'description' => 'Delicately baked thin layers of pastry embrace a rich velvety cream crowned with a vibrant medley of fresh fruits bursting with color and life a dessert experience that weaves luxury into every flavor and simplicity into every charm millefeuille that caresses the senses and leaves an unforgettable impression on the memory',
            'image' => 'menu/delawa/18.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $delawa->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'Labubu Chocolate Mousse',
            'price' => 18.00,
            'description' => 'Labubu the summer star that descended from a world of dreams for the first time it steps into your world with the bold elegance of delawa not just a passing dessert but a velvety legend that melts slowly whispering an unforgettable melody on your tongue with every spoonful labubu tells the story of a summer filled with surprises',
            'image' => 'menu/delawa/19.webp', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'بسبوسة',
            'description' => 'بسبوسة مصرية أصيلة، سادة طرية طعمها يجنن من غير أي اضافات',
            'price' => 79.00,
            'image' => 'menu/basbosa.png', // ضع هنا مسار الصورة مثل: 'images/basbousa.jpg'
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'كنافة',
            'description' => 'كنافة بالفستق والقشطة البلدي > حلوة وجميلة ومقرمشة ومعمولة بالسمنة البلدي > محشية فستق وقشظة بلدي طازة وعليها شربات تقيل مظبوط بيدوب في القلب قبل البق',
            'price' => 109.00,
            'image' => 'menu/konafa.png', // ضع هنا مسار الصورة مثل: 'images/konafa.jpg'
            'sort_order' => 2,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'كحك',
            'description' => 'كحك مصري بوصفة بكيزة اللي مايختلفش عليها اتنين <<< يدوب في البق ومن اول قطمة هاتعمل معاكم ذكري مش هاتنسوها طول العمر',
            'price' => 123.00,
            'image' => 'menu/kahk.png', // ضع هنا مسار الصورة مثل: 'images/kahk.jpg'
            'sort_order' => 3,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'رز بلبن',
            'description' => 'زي مابتحبوه معمول علي طريقة طنط بكيزة <<< ناعم وسكره موزون ومن اول معلقة هادوق الرز بلبن بتاع زمان',
            'price' => 9.00,
            'image' => 'menu/roz1.png', // ضع هنا مسار الصورة مثل: 'images/roz-bel-laban.jpg'
            'sort_order' => 4,
        ]);

        Product::create([
            'restaurant_id' => $tantBakiza->id,
            'category_id' => $categories->where('name', 'الوجبات الرئيسية')->first()->id,
            'name' => 'رز بلبن (3 حبات)',
            'description' => '3 حبات ليك ولكل حبايبك علشان تكمل الفرحة وتشاركهم جمال الطعم',
            'price' => 25.00,
            'image' => 'menu/roz2.png', // ضع هنا مسار الصورة مثل: 'images/roz-bel-laban-3.jpg'
            'sort_order' => 5,
        ]);
    }
}

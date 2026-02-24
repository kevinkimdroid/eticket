<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'eTicket KE Logo T-Shirt', 'category' => 'apparel', 'price' => 1200, 'desc' => 'Comfortable cotton t-shirt with the eTicket KE logo. Unisex sizing. Ideal for event staff and supporters. Made in Kenya.'],
            ['name' => 'Event Lanyard', 'category' => 'accessories', 'price' => 350, 'desc' => 'Durable polyester lanyard for holding tickets and badges. Standard clip included. Available in navy.'],
            ['name' => 'Event Hoodie - Black', 'category' => 'apparel', 'price' => 2500, 'desc' => 'Warm fleece-lined hoodie. Perfect for outdoor events and cool evenings. 80% cotton, 20% polyester.'],
            ['name' => 'Wristband Pack (5)', 'category' => 'merchandise', 'price' => 800, 'desc' => 'Set of 5 silicone wristbands for event access control. Reusable and waterproof.'],
            ['name' => 'Event Cap - Navy', 'category' => 'accessories', 'price' => 950, 'desc' => 'Adjustable cotton cap with embroidered logo. One size fits all.'],
            ['name' => 'Event Poster A3', 'category' => 'collectibles', 'price' => 450, 'desc' => 'Quality A3 print poster. Great for framing or display.'],
            ['name' => 'Canvas Tote Bag', 'category' => 'accessories', 'price' => 650, 'desc' => 'Sturdy canvas tote with screen-printed design. Eco-friendly and reusable.'],
            ['name' => 'Stadium Blanket', 'category' => 'merchandise', 'price' => 1800, 'desc' => 'Soft fleece blanket for outdoor events. 150cm x 120cm. Machine washable.'],
            ['name' => 'Insulated Water Bottle', 'category' => 'merchandise', 'price' => 750, 'desc' => '500ml stainless steel bottle. Keeps drinks cold for 12 hours. BPA-free.'],
            ['name' => 'Keychain Set (3)', 'category' => 'collectibles', 'price' => 400, 'desc' => 'Set of 3 metal keychains with event branding.'],
            ['name' => 'Polo Shirt - White', 'category' => 'apparel', 'price' => 1600, 'desc' => 'Classic polo shirt. Breathable piqué cotton. Smart casual for events.'],
            ['name' => 'Phone Grip', 'category' => 'accessories', 'price' => 280, 'desc' => 'Adhesive phone grip for secure handling. Fits most smartphones.'],
            ['name' => 'Event Programme', 'category' => 'collectibles', 'price' => 550, 'desc' => 'Printed event programme with schedule and artist information.'],
            ['name' => 'Beanie - Black', 'category' => 'apparel', 'price' => 900, 'desc' => 'Warm knit beanie. Acrylic blend. One size.'],
            ['name' => 'Sticker Pack', 'category' => 'merchandise', 'price' => 150, 'desc' => 'Set of 6 vinyl stickers. Weather-resistant.'],
        ];

        foreach ($items as $item) {
            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'name' => $item['name'],
                    'description' => $item['desc'],
                    'price' => $item['price'],
                    'category' => $item['category'],
                    'stock' => rand(10, 40),
                    'points_cost' => null,
                    'is_active' => true,
                ]
            );
        }
    }
}

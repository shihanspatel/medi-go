<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Footer;

class FooterSeeder extends Seeder
{
    public function run(): void
    {
        Footer::create([
            'title' => 'About Us',
            'content' => 'Medi-Go is your trusted online pharmacy providing quality medicines and healthcare products delivered to your doorstep.'
        ]);

        Footer::create([
            'title' => 'Quick Links',
            'content' => 'Home | About Us | Contact Us | FAQs'
        ]);

        Footer::create([
            'title' => 'Support',
            'content' => 'Privacy Policy | Terms & Conditions | Shipping Info | Returns'
        ]);

        Footer::create([
            'title' => 'Contact',
            'content' => 'Email: support@medigo.com | Phone: +91 98765 43210 | Address: Rajkot, Gujarat, India'
        ]);
    }
}

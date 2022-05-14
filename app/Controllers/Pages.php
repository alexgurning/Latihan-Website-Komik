<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
        // $faker = \Faker\Factory::create();
        // dd($faker->name);

        $data = [
            'judul' => 'Home | Web Komik',
            'tes' => ['satu', 'dua', 'tiga']

        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'judul' => 'About Me'
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'judul' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. Gatot Subroto No. 50',
                    'kota' => 'Medan'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. Seta Budi No. 80',
                    'kota' => 'Medan'
                ]
            ]
        ];

        return view('pages/contact', $data);
    }
}

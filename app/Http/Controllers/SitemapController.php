<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{

    public function index(){

        echo "<h2>Generating <a href='/sitemap.xml' target='_blank'> Sitemap.xml </a></h2>";
        echo "<h3>Generated new Sitemap on date ".date('i h - d, m, Y',time())." <a href='/sitemap.xml' target='_blank'> Sitemap.xml </a></h3>";
         SitemapGenerator::create('https://nextlearnacademy.com')
             ->getSitemap()
             ->writeToFile(public_path('sitemap.xml'));

//        Sitemap::create()
//            ->add(Url::create('/all-courses')
//                ->setLastModificationDate(Carbon::yesterday())
//                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
//                ->setPriority(0.1))
//            ->writeToFile(public_path('sitemap.xml'));
    }
    //
}

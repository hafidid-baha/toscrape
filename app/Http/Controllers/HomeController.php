<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as Goutte;

class HomeController extends Controller
{
    public function index(){
        
        $crawler = Goutte::request('GET', 'http://quotes.toscrape.com/');
        // $crawler->filter('.result__title .result__a')->each(function ($node) {
        //   dd($node->text());
        // });
        $crawler->filter('.quote .text')->each(function ($node) {
          dd($node->text());
        });

        
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as Goutte;

class HomeController extends Controller
{
	public function index()
	{

		// get data from the first page
		$crawler = Goutte::request('GET', 'http://quotes.toscrape.com');
		$crawler->filter('.quote .text')->each(function ($node) {
			echo $node->text().'<br />';
		});

		// get data from page 2 to 10
		foreach (range(2, 10) as $l) {
			// change the fetched url each time to get data from the next page
			$crawler = Goutte::request('GET', 'http://quotes.toscrape.com/page/'.$l.'/');
			$crawler->filter('.quote .text')->each(function ($node) {
				// print each quotes text to the user
				echo $node->text().'<br />';
			});
		}		
	}
}

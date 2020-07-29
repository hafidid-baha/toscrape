<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as Goutte;

class HomeController extends Controller
{
	public function index()
	{
		
		$data = [];
		// get data from the first page
		$crawler = Goutte::request('GET', 'http://quotes.toscrape.com');
		// push the first line to the data array
		$this->fetchCrawler($crawler,$data);
		// dd($data);
		// get data from page 2 to 10
		foreach (range(2, 10) as $l) {
			// change the fetched url each time to get data from the next page
			$crawler = Goutte::request('GET', 'http://quotes.toscrape.com/page/'.$l.'/');
			$this->fetchCrawler($crawler,$data);
		}	

		
		return view("welcome")->with(["data"=>$data]);
	}

	public function fetchCrawler($crawler,&$data){
		$line = "";
		// get the quote text
		$crawler->filter('.quote')->each(function ($node) use(&$line,&$data){

			$node->filter(".text")->each(function($node)use(&$line){
				$line .= $node->text().";";
			});
			$node->filter(".author")->each(function($node)use(&$line){
				$line .= $node->text().";";
			});
			$node->filter(".tags .tag")->each(function($node)use(&$line){
				$line .= $node->text().",";
			});
			array_push($data,$line);
			$line = "";
			
		});
		
		// // get the guote author
		// $crawler->filter('.quote .author')->each(function ($node) use(&$line) {
		// 	// echo $node->text().'<br />';
		// 	$line .= $node->text().";";
		// 	// array_push($data,$node->text());
		// });
		// // get the guote tags
		// $crawler->filter('.quote .tags .tag')->each(function ($node) use(&$line) {
		// 	// echo $node->text().'<br />';
		// 	$line .= $node->text().",";
		// 	// array_push($data,$node->text());
		// });

		// return $line;
	}
}

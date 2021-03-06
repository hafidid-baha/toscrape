<?php

namespace App\Http\Controllers;

use App\Quote;
use Exception;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as Goutte;

use function GuzzleHttp\Promise\queue;

class HomeController extends Controller
{

	public function index()
	{
		
		$data = [];


		// check first if the table is already contain some data
		if(Quote::all()->count() == 0){

			// start the request and intiat the crawler
			$this->fetchDataFromSite($data);
			// add all the quotes to the quotes table
			foreach ($data as $item) {
				$quote =  Quote::create([
					'author'=>explode(';',$item)[1],
					'tags'=>explode(';',$item)[2],
					'quote'=>explode(';',$item)[0]
				]);
				
				//array_push($data,$quote->quote.";".$quote->author.";".$quote->tags);
			}
		}else{
			// $quotes = Quote::all();
			// foreach ($quotes as $quote) {
			// 	array_push($data,$quote->quote.";".$quote->author.";".$quote->tags);
			// }
		}
		
		$quote = $this->shuffle();
		return view("welcome")->with(['quote'=>$quote]);
	}

	public function shuffle(){
		// we know the the number of quotes is 100
		$id = rand(1,100);
		$quote = Quote::find($id);
		// dd($id,$quote->author);
		return $quote;
	}

	public function fetchCrawler($crawler,&$data){
		$line = "";
		$text = "";
		$author = "";
		$tags = "";
		// get the quote text
		$crawler->filter('.quote')->each(function ($node) use(&$line,&$text,&$tags,&$author,&$data){

			$node->filter(".text")->each(function($node)use(&$text){
				$text .= $node->text().";";
			});
			$node->filter(".author")->each(function($node)use(&$author){
				$author .= $node->text().";";
			});
			$node->filter(".tags .tag")->each(function($node)use(&$tags){
				$tags .= $node->text().",";
			});
			$line = $text.$author.$tags;
			array_push($data,$line);
			$line = "";
			$text = "";
			$tags = "";
			$author = "";
			
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

	private function fetchDataFromSite(&$data){
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
	}
}

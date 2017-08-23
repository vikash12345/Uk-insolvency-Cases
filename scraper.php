<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

// require 'scraperwiki.php';
// require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".


require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';

	$site = 'https://www.insolvencydirect.bis.gov.uk/eiir/IIRSearchNames.asp?court=ALL&CourtName=&Office=&OfficeName=&page=';
	//This is for Pagination 
	for($page = 1; $page < 2; $page++){
		$FinalURL	=	$site . $page .'&surnamesearch=A&forenamesearch=ALLFORENAMES&OPTION=NAME&tradingnamesearch=';
		$Html		=	file_get_html($FinalURL);
    		$RowNumb	=	-1;

		if ($Html) {

			foreach ($Html->find("//*[@id='MyTable']/tbody") as $element) {
				$RowNumb	+=	1;
				if ($RowNumb != 0) {
				echo $Link	=	$element->find("//*[@id='navDet']/a", 0);
				}
			}
		}
	
?>



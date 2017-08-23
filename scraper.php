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
	for($page = 1; $page < 10; $page++){
		$FinalURL	=	$site . $page .'&surnamesearch=A&forenamesearch=ALLFORENAMES&OPTION=NAME&tradingnamesearch=';
		$Html		=	file_get_html($FinalURL);
    		$RowNumb	=	-1;

		if ($Html) {

			foreach ($Html->find("//*[@id='MyTable']/tbody/tr") as $element) {
				$RowNumb	+=	1;
				if ($RowNumb != 0) {
					$Link	=	$element->find('a[id="navDet"]', 0)->href;
					$newlink = 'https://www.insolvencydirect.bis.gov.uk/eiir/' . $Link;
				$DetailPg				=	file_get_html($newlink);
					if($DetailPg){
				echo $info['Surname']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[1]/td[2]",0)->plaintext;				
				 $info['Forename']  					= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[2]/td[2]",0)->plaintext;
				 $info['Title'] 						= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[3]/td[2]",0)->plaintext;
				 $info['Gender']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[4]/td[2]",0)->plaintext;
				 $info['Occupation'] 					= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[5]/td[2]",0)->plaintext;
				 $info['DOB']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[6]/td[2]",0)->plaintext;
				 $info['Last_Known_Address']  				= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[7]/td[2]",0)->plaintext;
				 $info['Case_Name']  					= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[1]/td[2]",0)->plaintext;
				 $info['Court']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[2]/td[2]",0)->plaintext;
				 $info['Type']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[4]/td[2]",0)->plaintext;
				 $info['Number'] 						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[5]/td[2]",0)->plaintext;
				 $info['Case_Year']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[6]/td[2]",0)->plaintext;
				 $info['Order_Date']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[7]/td[2]",0)->plaintext;
				 $info['Status'] 						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[8]/td[2]",0)->plaintext;
				 $info['Case_Description']  					= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[9]/td[2]",0)->plaintext;
				 $info['Main_Insolvency_Practitioner']	  			= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[10]/td[2]",0)->plaintext;
				 $info['Firm']							= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[11]/td[2]",0)->plaintext;
				 $info['Address']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[12]/td[2]",0)->plaintext;
				 $info['Post_Code']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[13]/td[2]",0)->plaintext;
				 $info['Telephone']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[14]/td[2]",0)->plaintext;
				 $info['Insolvency_Service_Office']  				= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[17]/td[2]",0)->plaintext;
				 $info['Contact']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[18]/td[2]",0)->plaintext;
				 $info['Address2']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[19]/td[2]",0)->plaintext;
				 $info['Post_Code2'] 						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[20]/td[2]",0)->plaintext;
				 $info['Telephone2']  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[21]/td[2]",0)->plaintext;
						
						scraperwiki::save_sqlite(array('name'), array('name' => $info['Surname'], 
													'Forename'=> $info['Forename'] , 
													'Title' => $info['Title'], 
													'Gender' => $info['Gender'], 
													'Occupation' => $info['Occupation'], 
													'DOB'=> $info['DOB'], 
													'Last_Known_Address' => $info['Last_Known_Address'], 
													'Case_Name'=> $info['Case_Name'], 
													'Court' => $info['Court'], 
													'Type' => $info['Type'], 
													'Number' => $info['Number'] 
													'CaseY' => $info['Case_Year'], 
													'Order_Date' => $info['Order_Date'], 
													'Status' => $info['Status'], 
													'Case_Description' => $info['Case_Description'], 
													'Main_Insolvency_Practitioner' => $info['Main_Insolvency_Practitioner'], 
													'Firm' => $info['Firm'], 
													'Address'=> $info['Address'], 
													'Post_Code' => $info['Post_Code'], 
													'Telephone' => $info['Telephone'], 
													'Insolvency_Service_Office'=> $info['Insolvency_Service_Office'],
													'Contact' => $info['Contact'], 
													'Address2'=> $info['Address2'],
													'Post_Code2' => $info['Post_Code2'],													
													'Telephone2' => $info['Telephone2'] 
													));

    
  //clean out the dom
 $DetailPg->__destruct();}		
					

				}
			
			}
		}}
	
?>



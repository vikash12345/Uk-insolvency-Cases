<?
require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';

	$site = 'https://www.insolvencydirect.bis.gov.uk/eiir/IIRSearchNames.asp?court=ALL&CourtName=&Office=&OfficeName=&page=';
	//This is for Pagination 
	for($page = 1; $page < 2; $page++){
		$FinalURL	=	$site . $page .'&surnamesearch=A&forenamesearch=ALLFORENAMES&OPTION=NAME&tradingnamesearch=';
		$Html		=	file_get_html($FinalURL);
    		$Flag	=	-1;

		if ($Html) {

			foreach ($Html->find("//*[@id='MyTable']/tbody/tr/td") as $element) {
				$Flag	+=	1;
				if ($Flag != 0) {
				$Link	=	$element->find('a[id="navDet"]', 0)->href;
				$newlink = 'https://www.insolvencydirect.bis.gov.uk/eiir/' . $Link;
				$DetailPg				=	file_get_html($newlink);
				 $Surname  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[1]/td[2]",0)->plaintext;				
				 $Forename  					= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[2]/td[2]",0)->plaintext;
				 $Title 						= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[3]/td[2]",0)->plaintext;
				 $Gender  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[4]/td[2]",0)->plaintext;
				 $Occupation 					= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[5]/td[2]",0)->plaintext;
				 $DOB  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[6]/td[2]",0)->plaintext;
				 $Last_Known_Address  				= $DetailPg->find("//*[@id='frmCaseDetail']/table[2]/tbody/tr[7]/td[2]",0)->plaintext;
				 $Case_Name  					= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[1]/td[2]",0)->plaintext;
				 $Court  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[2]/td[2]",0)->plaintext;
				 $Type  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[4]/td[2]",0)->plaintext;
				 $Number 						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[5]/td[2]",0)->plaintext;
				 $Case_Year  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[6]/td[2]",0)->plaintext;
				 $Order_Date  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[7]/td[2]",0)->plaintext;
				 $Status 						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[8]/td[2]",0)->plaintext;
				 $Case_Description  					= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[9]/td[2]",0)->plaintext;
				 $Main_Insolvency_Practitioner	  			= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[10]/td[2]",0)->plaintext;
				 $Firm							= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[11]/td[2]",0)->plaintext;
				 $Address  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[12]/td[2]",0)->plaintext;
				 $Post_Code  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[13]/td[2]",0)->plaintext;
				 $Telephone  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[14]/td[2]",0)->plaintext;
				 $Insolvency_Service_Office  				= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[17]/td[2]",0)->plaintext;
				 $Contact  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[18]/td[2]",0)->plaintext;
				 $Address2  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[19]/td[2]",0)->plaintext;
				 $Post_Code2 						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[20]/td[2]",0)->plaintext;
				 $Telephone2  						= $DetailPg->find("//*[@id='frmCaseDetail']/table[3]/tbody/tr[21]/td[2]",0)->plaintext;
						
						scraperwiki::save_sqlite(array('name'), array('name' => $Surname, 
													'Forename'=> $Forename, 
													'Title' => $Title 
													'Gender' => $Gender, 
													'Occupation' => $Occupation, 
													'DOB'=> $DOB, 
													'Last_Known_Address' => $Last_Known_Address, 
													'Case_Name'=> $Case_Name, 
													'Court' => $Court, 
													'Type' => $Type, 
													'Number' => $Number,
													'Case_Year' => $Case_Year, 
													'Order_Date' => $Order_Date, 
													'Status' => $Status, 
													'Case_Description' => $Case_Description, 
													'Main_Insolvency_Practitioner' => $Main_Insolvency_Practitioner, 
													'Firm' => $Firm, 
													'Address'=> $Address, 
													'Post_Code' => $Post_Code, 
													'Telephone' => $Telephone, 
													'Insolvency_Service_Office'=> $Insolvency_Service_Office,
													'Contact' => $Contact, 
													'Address2'=> $Address2,
													'Post_Code2' => $Post_Code2,													
													'Telephone2' => $Telephone2 
													));

    
  //clean out the dom
					

				}
			
			}
		}}
	
?>



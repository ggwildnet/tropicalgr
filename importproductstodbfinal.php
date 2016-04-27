<?php 
		set_time_limit(0);	
		ini_set('display_errors', 1);
		ini_set('error_reporting', 7);
		ini_set('memory_limit', '2048M');
		include('/var/www/html/elsevierfrance/app/Mage.php');
		class importProduct{
			public $server = 'localhost';
			public $user = 'root';
			public $pass = 'nginxdbpass';
			public $db = 'magento_core'; 
			public $ftp_server1 = "54.77.0.212";
		    public $file_desination1 = "/var/www/html/elsevierfrance/uploadprod/";
		    public $ftp_user_name1 = "isisftp";
		    public $ftp_user_pass1 = "Is!%Ftp#198"; 
		    public $extract_desination1 = "/var/www/html/elsevierfrance/cronfiles/"; 
		    public $archived_desination1 = "/var/www/html/elsevierfrance/cronfiles/archived/"; 
		    public $archived_desination1_zip = "/var/www/html/elsevierfrance/uploadprod/archived/"; 
			
			const DEFAULT_PARENT_CAT_ID   = 2;
			const DEFAULT_STORE_ID   = 2; //For France Site

			const PRODUCT_TYPE_YOUR_STATUS_ID = '177';//For config product status
			const PRODUCT_LOCATION_ID = '178';//For config product region
			const SUBSCRIPTION_MONTH_ID = '179';//For config product subscription 
			
			const PRODUCT_TYPE_YOUR_STATUS_PARTICULAR_ID = '12';//For config product status value
			const PRODUCT_TYPE_YOUR_STATUS_STUDENT_ID = '13';//For config product status value
			const PRODUCT_TYPE_YOUR_STATUS_INSTITUTION_ID = '14';//For config product status value
			const PRODUCT_TYPE_YOUR_STATUS_BELGIQUE_ID = '61';//For config product status value
			const PRODUCT_TYPE_YOUR_STATUS_ALREADY_ID = '72';//For config product status value
			
			const SUBSCRIPTION_MONTH_ONE_YEAR_ID = '18';//For config product subscription value
			const SUBSCRIPTION_MONTH_TWO_YEAR_ID = '19';//For config product subscription value
			const SUBSCRIPTION_MONTH_THREE_YEAR_ID = '20';//For config product subscription value
			const SUBSCRIPTION_MONTH_FOUR_YEAR_ID = '21';//For config product subscription value
			const SUBSCRIPTION_MONTH_FIVE_YEAR_ID = '73';//For config product subscription value
			
			const PRODUCT_LOCATION_FRANCE_ID = '15';//For config product region value
			const PRODUCT_LOCATION_SUISSE_ID = '16';//For config product region value
			const PRODUCT_LOCATION_REST_WORLD_ID = '17';//For config product region value
			const PRODUCT_LOCATION_BELGIQUE_ID = '60';//For config product region value
		
			
			public $confurgable_product_attr_id_arr = array('177','178','179');
			
			public $searchReplaceString = array("&euro;"=>"","&trade;"=>"","&oelig;"=>"","&OElig;"=>"","&tilde;"=>"","&quot;"=>"","&quot;"=>"","&apos;"=>"","&apos;"=>"","&lt;"=>"","&gt;"=>"","&iexcl;"=>"","&cent;"=>"","&pound;"=>"","&curren;"=>"","&yen;"=>"","&brvbar;"=>"","&sect;"=>"","&uml;"=>"","&copy;"=>"","&ordf;"=>"","&laquo;"=>"","&not;"=>"","&reg;"=>"","&macr;"=>"","&deg;"=>"","&plusmn;"=>"","&sup2;"=>"","&sup3;"=>"","&acute;"=>"","&micro;"=>"","&para;"=>"","&middot;"=>"","&cedil;"=>"","&sup1;"=>"","&ordm;"=>"","&raquo;"=>"","&frac14;"=>"","&frac12;"=>"","&frac34;"=>"","&iquest;"=>"","&times;"=>"","&divide;"=>"","&Agrave;"=>"a","&Aacute;"=>"a","&Acirc;"=>"a","&Atilde;"=>"a","&Auml;"=>"a","&Aring;"=>"a","&AElig;"=>"a","&Ccedil;"=>"c","&Egrave;"=>"e","&Eacute;"=>"e","&Ecirc;"=>"e","&Euml;"=>"e","&Igrave;"=>"i","&Iacute;"=>"i","&Icirc;"=>"i","&Iuml;"=>"i","&ETH;"=>"d","&Ntilde;"=>"n","&Ograve;"=>"o","&Oacute;"=>"o","&Ocirc;"=>"o","&Otilde;"=>"o","&Ouml;"=>"o","&Oslash;"=>"o","&Ugrave;"=>"u","&Uacute;"=>"u","&Ucirc;"=>"u","&Uuml;"=>"u","&Yacute;"=>"y","&THORN;"=>"p","&szlig;"=>"b","&agrave;"=>"a","&aacute;"=>"a","&acirc;"=>"a","&atilde;"=>"a","&auml;"=>"a","&aring;"=>"a","&aelig;"=>"a","&ccedil;"=>"c","&egrave;"=>"e","&eacute;"=>"e","&ecirc;"=>"e","&euml;"=>"e","&igrave;"=>"i","&iacute;"=>"i","&icirc;"=>"i","&iuml;"=>"i","&eth;"=>"e","&ntilde;"=>"n","&ograve;"=>"o","&oacute;"=>"o","&ocirc;"=>"o","&otilde;"=>"o","&ouml;"=>"o","&oslash;"=>"o","&ugrave;"=>"u","&uacute;"=>"u","&ucirc;"=>"u","&uuml;"=>"u","&yacute;"=>"y","&thorn;"=>"p","&yuml;"=>"y","~"=>"",","=>"","ñ"=>"n",";"=>"",":"=>"","!"=>"","¡"=>"","."=>"","ª"=>"","º"=>"","$"=>"","("=>"",")"=>"","?"=>"","¿"=>"","*"=>"","?"=>"","¿"=>"","^"=>"","]"=>"","["=>"","}"=>"","{"=>"","`"=>"","´"=>"","#"=>"","/"=>"",'"'=>"","\\"=>"","--"=>'-',"@"=>"","%"=>"","^"=>"","&"=>"",'+'=>"-","_"=>"",","=>"","'"=>""," "=>"-","’"=>"","—"=>"","®"=>"","€"=>"","™"=>"","œ"=>"","Œ"=>"","~"=>"",'"'=>"",'"'=>"","'"=>"","'"=>"",'<'=>"",'>'=>"",'¡'=>"",'¢'=>"",'£'=>"",'¤'=>"",'¥'=>"",'¦'=>"",'§'=>"",'¨'=>"",'©'=>"",'ª'=>"",'«'=>"",'¬'=>"",'®'=>"",'¯'=>"",'°'=>"",'±'=>"",'²'=>"",'³'=>"",'´'=>"",'µ'=>"",'¶'=>"",'•'=>"",'¸'=>"",'¹'=>"",'º'=>"",'»'=>"",'¼'=>"",'½'=>"",'¾'=>"",'¿'=>"",'×'=>"",'÷'=>"",'À'=>"a",'Á'=>"a",'Â'=>"a",'Ã'=>"a",'Ä'=>"a",'Å'=>"a",'Æ'=>"",'Ç'=>"c",'È'=>"e",'É'=>"e",'Ê'=>"e",'Ë'=>"e",'Ì'=>"i",'Í'=>"i",'Î'=>"i",'Ï'=>"i",'Ð'=>"d",'Ñ'=>"n",'Ò'=>"o",'Ó'=>"o",'Ô'=>"o",'Õ'=>"o",'Ö'=>"o",'Ø'=>"",'Ù'=>"u",'Ú'=>"u",'Û'=>"u",'Ü'=>"u",'Ý'=>"y",'Þ'=>"p",'ß'=>"",'à'=>"a",'á'=>"a",'â'=>"a",'ã'=>"a",'ä'=>"a",'å'=>"a",'æ'=>"",'ç'=>"c",'è'=>"e",'é'=>"e",'ê'=>"e",'ë'=>"e",'ì'=>"i",'í'=>"i",'î'=>"i",'ï'=>"i",'ð'=>"o",'ñ'=>"n",'ò'=>"o",'ó'=>"o",'ô'=>"o",'õ'=>"o",'ö'=>"o",'ø'=>"",'ù'=>"u",'ú'=>"u",'û'=>"u",'ü'=>"u",'ý'=>"y",'þ'=>"p",'ÿ'=>"y");
			
			public  $productheaderarr = array('store'=>'admin','websites'=>'frweb','attribute_set'=>'France AttributeSet','type'=>'simple','has_options'=>0,'is_returnable'=>'Use config','msrp_enabled'=>'Use config','msrp_display_actual_price_type'=>'Use config','page_layout'=>'No layout updates','options_container'=>'Block after Info Column','gift_message_available'=>'No','gift_wrapping_available'=>'No','status'=>'Enabled','is_recurring'=>'No','visibility'=>'','enable_googlecheckout'=>'No','tax_class_id'=>'None','qty'=>'100','min_qty'=>0,'use_config_min_qty'=>1,'is_qty_decimal'=>0,'backorders'=>0,'use_config_backorders'=>1,'min_sale_qty'=>1,'use_config_min_sale_qty'=>1,'max_sale_qty'=>0,'use_config_max_sale_qty'=>1,'is_in_stock'=>1,'use_config_notify_stock_qty'=>1,'manage_stock'=>0,'use_config_manage_stock'=>1,'stock_status_changed_auto'=>1,'use_config_qty_increments'=>1,'qty_increments'=>0,'use_config_enable_qty_inc'=>1,'enable_qty_increments'=>0,'is_decimal_divided'=>0,'stock_status_changed_automatically'=>1,'use_config_enable_qty_increments'=>1,'store_id'=>0,'product_type_id'=>'simple','name'=>'','description'=>'','short_description'=>'','sku'=>'','weight'=>'','status'=>'','url_key'=>'','country_of_manufacture'=>'','price'=>'','group_price'=>'','special_price'=>'','special_from_date'=>'','special_to_date'=>'','tier_price'=>'','msrp'=>'','meta_title'=>'','meta_keyword'=>'','meta_description'=>'','external_image'=>'','external_small_image'=>'','external_thumbnail'=>'','custom_design'=>'','custom_design_from'=>'','custom_design_to'=>'','custom_layout_update'=>'','gift_wrapping_price'=>'','your_status'=>'','your_region'=>'','sub_length'=>'','filter_product_type'=>'','filter_productformat'=>'','prd_code'=>'','cat_ids'=>'','isbn'=>'','stock_status'=>'','external_offer_copy'=>'','imprint'=>'','frequency'=>'','link'=>'','core_addon_flag'=>'','pp_toclong'=>'','pp_authoralistbyline'=>'','pp_newtoed'=>'','lepubdate'=>'','edition_text'=>'','edition_number'=>'','mrkt_url'=>'','pub_status'=>'','keywords'=>'','searchable'=>'','part_number'=>'','issn'=>'','available_online'=>'','platform_requirement'=>'','author_alist'=>'','vendor_id'=>'','all_author_desc'=>'','year'=>'','created_by_title'=>'','comments'=>'','product_type'=>'','productfiles'=>'','additional_info'=>'','brochure'=>'','fulfillment_company_code'=>'','restricted_msg'=>'','product_format'=>'','is_core_product'=>'','copyright'=>'','copy_key_feature'=>'','abstract'=>'','available_date'=>'','ext_org_copy'=>'','isbnformatted'=>'','product_lang'=>'','pagecountle'=>'','prod_status'=>'','els_supporting_pro_id'=>'','els_link_for_id'=>'','els_product_id'=>'','els_linkedformats_id'=>'','product_status_changed'=>'','product_changed_websites'=>'','gallery'=>'','minimal_price'=>'','weightuom'=>'','trim'=>'','low_stock_date'=>'','notify_stock_qty'=>'','product_name'=>'','pp_copypsg'=>'','ukpubstatus'=>'','pp_reviews'=>'','covertype'=>'','url_path'=>'','related_tgtr_position_limit'=>''); 

			public $websitecode = array();
			public function __construct(){
				//exec('echo 3 > /proc/sys/vm/drop_caches');
				Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
				$websites = Mage::app()->getWebsites();
				foreach (Mage::app()->getWebsites() as $website) {
					if($website->getCode() =="base"){
						$this->websitecode[] = $website->getCode();
					}
					if($website->getCode() =="jp"){
						$this->websitecode[] = $website->getCode();
					}
					if($website->getCode() =="anz"){
						$this->websitecode[] = $website->getCode();
					}
				}
			}			
	// convert special characters to html
	function removeWordQuote($textString){
				$replaceString = array('<','>',".",".");
                $findString = array("&lt;","&gt;","….","…");
				$textString = str_replace($findString,$replaceString,$textString);
				return $textString;
	}
	// Get product prd_code and sku code
	public function getProductPsku($prd_code)
    {
		$server = $this->server;
		$user = $this->user;
		$pass = $this->pass;
		$db = $this->db;
		$connection = mysql_connect($server, $user, $pass) 
		or die ("Could not connect to server ... \n" . mysql_error ());
		mysql_select_db($db)   ;
		$selectSql="SELECT sku_code FROM tmp_france_product_psku WHERE prd_code='".$prd_code."'";
		$selectqry=mysql_query($selectSql);
		while($selectrows=mysql_fetch_assoc($selectqry))
		{
			$data[] = $selectrows;
		}
        return $data;
    }
	// Get product details
	public function getProduct($prd_code)
    {
		$server = $this->server;
		$user = $this->user;
		$pass = $this->pass;
		$db = $this->db;
		$connection = mysql_connect($server, $user, $pass) 
		or die ("Could not connect to server ... \n" . mysql_error ());
		mysql_select_db($db)   ;
		$selectSql="SELECT * FROM tmp_france_product WHERE prd_code='$prd_code'";
		$selectqry=mysql_query($selectSql);
		while($selectrows=mysql_fetch_assoc($selectqry))
		{
			$data[] = $selectrows;
		}		
        return $data;
    }
	// Get product custom prd_code and sku code
	public function getProductCsku($sku_code)
    {
		$server = $this->server;
		$user = $this->user;
		$pass = $this->pass;
		$db = $this->db;
		$connection = mysql_connect($server, $user, $pass) 
		or die ("Could not connect to server ... \n" . mysql_error ());
		mysql_select_db($db)   ;
		$selectSql="SELECT * FROM tmp_france_product_csku WHERE sku_code='$sku_code'";
		$selectqry=mysql_query($selectSql);
		while($selectrows=mysql_fetch_assoc($selectqry))
		{
			$data[] = $selectrows;
		}		
        return $data;
    }
	// Get product multi link
	public function getProductLinkMulti($prd_code)
    {
		$server = $this->server;
		$user = $this->user;
		$pass = $this->pass;
		$db = $this->db;
		$connection = mysql_connect($server, $user, $pass) 
		or die ("Could not connect to server ... \n" . mysql_error ());
		mysql_select_db($db)   ;
		$selectSql="SELECT * FROM tmp_france_product_link_multi WHERE product_id='$prd_code'";
		$selectqry=mysql_query($selectSql);
		while($selectrows=mysql_fetch_assoc($selectqry))
		{
			$data[] = $selectrows;
		}		
        return $data;
    }
	// Get product link
	public function getProductLink($prd_code)
    {
		$server = $this->server;
		$user = $this->user;
		$pass = $this->pass;
		$db = $this->db;
		$connection = mysql_connect($server, $user, $pass) 
		or die ("Could not connect to server ... \n" . mysql_error ());
		mysql_select_db($db)   ;
		$selectSql="SELECT * FROM tmp_france_product_link WHERE SUPPORTING_PRODUCT_ID='$prd_code'";
		$selectqry=mysql_query($selectSql);
		while($selectrows=mysql_fetch_assoc($selectqry))
		{
			$data[] = $selectrows;
		}		
        return $data;
    }
	// Get product price list
	public function getProductPrice($sku_code)
    {
		$server = $this->server;
		$user = $this->user;
		$pass = $this->pass;
		$db = $this->db;
		$connection = mysql_connect($server, $user, $pass) 
		or die ("Could not connect to server ... \n" . mysql_error ());
		mysql_select_db($db)   ;
		$selectSql="SELECT * FROM tmp_france_product_price WHERE sku_code='$sku_code'";
		$selectqry=mysql_query($selectSql);
		while($selectrows=mysql_fetch_assoc($selectqry))
		{
			$data[] = $selectrows;
		}		
        return $data;
    }
	// Get product status for none simple prodcut
	public function getYourStatus($key)
    {
		$data='';
		if($key!=''){
			if($key=='ind'){
				$data='Particulier';
			}else if($key=='stu'){
				//$data='Étudiant';
				$data='Student';
			}else if($key=='ins'){
				$data='Institution';
			}else if($key=='be'){
				$data='Belgique';
			}else if($key=='a'){
				$data='Already a subscriber to another journal';
			}else{
				$data='';
			}
		}
        return $data;
    }
	// Get product country for none simple prodcut
	public function getCountry($key)
    {
		$data='';
		if($key!=''){
			if($key=='fr'){
				$data='France (+ DOM-TOM)';
			}else if($key=='eu'){
				$data='UE (+ Suisse)';
			}else if($key=='ex'){
				$data='Reste du monde';
			}else if($key=='be'){
				$data='Belgique';
			}else{
				$data='';
			}
		}
        return $data;
    }
	// Get product subscription for none simple prodcut
	public function getSubscriptionTerm($key)
    {
		$data='';
		if($key!=''){
			if($key=='12mo'){
				$data='12 months';
			}else if($key=='24mo'){
				$data='24 months';
			}else if($key=='36mo'){
				$data='36 months';
			}else if($key=='48mo'){
				$data='48 months';
			}else if($key=='13mo'){
				$data='13 months';
			}else{
				$data='';
			}
		}
        return $data;
    }
	// Get product filter format 
	public function getFilterProductFormat($key)
    {
		$data='';
		$key = str_replace(array_keys($this->searchReplaceString),array_values($this->searchReplaceString),$this->removeWordQuote($key));
		if($key!=''){
			if($key=='Revue---Papier' || $key=='Review - Paper'){
				$data='Revue - Papier';
			}else if($key=='Revue---Numarique-Papier' || $key=='Review - Digital + Paper'){
				$data='Review - Digital + Paper';
			}else if($key=='Revue---Numarique' || $key=='Review - Digital'){
				$data='Review - Digital';
			}else if($key=='EMC---Offre-Classique' || $key=='EMC - Offre Classique'){
				$data='EMC - Offre Classique';
			}else if($key=='EMC---Offre-Gold' || $key=='EMC - Gold Offer'){
				$data='EMC - Offre Gold';
			}else if($key=='EMC---Offre-Exclusive' || $key=='EMC - Exclusive Offer'){
				$data='EMC - Offre Exclusive';
			}else if($key=='EMC---Offre-Duo' || $key=='EMC - Duo Offer'){
				$data='EMC - Offre Duo';
			}else{
				$data='';
			}
		}
		
        return $data;
    }
	// for insert temp tables data from xml file
	public function insertTmpProductFromXml($filename){
			//echo $time = "Start Time : ".microtime(true);
			$server = $this->server;
			$user = $this->user;
			$pass = $this->pass;
			$db = $this->db;
			$connection = mysql_connect($server, $user, $pass) 
			or die ("Could not connect to server ... \n" . mysql_error ());
			mysql_select_db($db)   ;
			mysql_query('SET NAMES utf8');
			mysql_query("DELETE FROM tmp_france_product_custom");
			mysql_query("DELETE FROM tmp_france_product");
			mysql_query("DELETE FROM tmp_france_product_sku");
			mysql_query("DELETE FROM tmp_france_product_psku");
			mysql_query("DELETE FROM tmp_france_product_csku");
			mysql_query("DELETE FROM tmp_france_product_price");
			mysql_query("DELETE FROM tmp_france_product_link");
			mysql_query("DELETE FROM tmp_france_product_link_multi");
			if($filename!=''){
				$xmlObj  = simplexml_load_file($filename);
				$productName = array();
				$productattr  = array();
				$skuattr  = array();
				$productskuattr  = array();
				$customskuattr  = array();
				$propriceattr  = array();
				$linkedformateattr  = array();
				$linkedformateattrmulti  = array();
			foreach($xmlObj->children() as $key => $child){
				foreach($child->children() as $values){
					$prd_code='';$isbn='';$isactive='';$title='';$allauthordesc='';$shortdescription='';
					$year='';$createdbytitle='';$comments='';$producttype='';$additional_info='';$brochure='';
					$fulfillment_company_code='';$productformat='';$copyright='';$number_of_pages='';
					$product_desc='';$ext_new_to_edition='';$copy_key_feature='';$ext_org_copy='';
					$abstract='';$author_alist='';$stock_status='';$isbn_13_formatted='';
					$platform_requirement='';$product_lang='';$external_offer_copy='';
					$imprint='';$frequency='';$link='';$coreaddonflag='';
					$toc='';$edition_text='';$edition_number='';$mrkt_url='';
					$pub_status='';$pub_date='';$keywords='';$vendorid='';
					$searchable='';$part_number='';$available_online='';$availabledate='';
					$proratable='';$restricted_msg='';$iscoreproduct='';$issn='';$volume_number='';
					$parent_categories='';$PARENT_CATEGORIES='';$prd_display_name='';$prd_description='';
					$prd_longdescription='';$start_date='';$end_date='';
					$sku_code='';$sku_display_name='';$sku_description='';$fulfiller='';
					$pricing_scheme='';$list_price='';$ID='';$SUPPORTING_PRODUCT_ID='';$priceListId='';
					$active='';$TOPIC='';$sku_type='';
					if('Custom_PRODUCT' == $values->getName()){
						$data = (array)$values;
						$prd_code  = (string) $data['prd_code'];
						$isbn  = (string) $data['isbn'];
						$isActive  = (string) $data['isActive'];
						$title  = (string) $data['title'];
						$allAuthorDesc  = (string) $data['allAuthorDesc'];
						$shortDescription  = (string) $data['shortDescription'];
						$year  = (string) $data['year'];
						$createdByTitle  = (string) $data['createdByTitle'];
						$comments  = (string) $data['comments'];
						$productType  = (string) $data['productType'];
						$additional_info  = (string) $data['additional_info'];
						$brochure  = (string) $data['brochure'];
						$fulfillment_company_code  = (string) $data['fulfillment_company_code'];
						$productFormat  = (string) $data['productFormat'];
						$copyright  = (string) $data['COPYRIGHT'];
						$number_of_pages  = (string) $data['NUMBER_OF_PAGES'];
						$product_desc  = (string) $data['PRODUCT_DESC'];
						$ext_new_to_edition  = (string) $data['EXT_NEW_TO_EDITION'];
						$copy_key_feature  = (string) $data['COPY_KEY_FEATURE'];
						$ext_org_copy  = (string) $data['EXT_ORG_COPY'];
						$abstract  = (string) $data['ABSTRACT'];
						$author_alist  = (string) $data['AUTHOR_ALIST'];
						$stock_status  = (string) $data['STOCK_STATUS'];
						$isbn_13_formatted  = (string) $data['ISBN_13_FORMATTED'];
						$platform_requirement  = (string) $data['PLATFORM_REQUIREMENT'];
						$product_lang  = (string) $data['PRODUCT_LANG'];
						$external_offer_copy  = (string) $data['EXTERNAL_OFFER_COPY'];
						$imprint  = (string) $data['IMPRINT'];
						$frequency  = (string) $data['FREQUENCY'];
						$link  = (string) $data['LINK'];
						$coreAddonFlag  = (string) $data['coreAddonFlag'];
						$toc  = (string) $data['toc'];
						$edition_text  = (string) $data['edition_text'];
						$edition_number  = (string) $data['edition_number'];
						$mrkt_url  = (string) $data['mrkt_url'];
						$pub_status  = (string) $data['pub_status'];
						$pub_date  = (string) $data['pub_date'];
						$keywords  = (string) $data['keywords'];
						$vendorId  = (string) $data['vendorId'];
						$searchable  = (string) $data['searchable'];
						$part_number  = (string) $data['part_number'];
						$available_online  = (string) $data['available_online'];
						$availableDate  = (string) $data['availableDate'];
						$proratable  = (string) $data['proratable'];
						$restricted_msg  = (string) $data['restricted_msg'];
						$isCoreProduct  = (string) $data['isCoreProduct'];
						$issn  = (string) $data['issn'];
						$volume_number  = (string) $data['vendorId'];
						$productattr[] =  "( '".mysql_real_escape_string($prd_code)."','".mysql_real_escape_string($isbn)."','".mysql_real_escape_string($isActive)."','".mysql_real_escape_string($title)."','".mysql_real_escape_string($allAuthorDesc)."','".mysql_real_escape_string($shortDescription)."','".mysql_real_escape_string($year)."','".mysql_real_escape_string($createdByTitle)."','".mysql_real_escape_string($comments)."','".mysql_real_escape_string($productType)."','".mysql_real_escape_string($additional_info)."','".mysql_real_escape_string($brochure)."','".mysql_real_escape_string($fulfillment_company_code)."','".mysql_real_escape_string($productFormat)."','".mysql_real_escape_string($copyright)."','".mysql_real_escape_string($number_of_pages)."','".mysql_real_escape_string($product_desc)."','".mysql_real_escape_string($ext_new_to_edition)."','".mysql_real_escape_string($copy_key_feature)."','".mysql_real_escape_string($ext_org_copy)."','".mysql_real_escape_string($abstract)."','".mysql_real_escape_string($author_alist)."','".mysql_real_escape_string($stock_status)."','".mysql_real_escape_string($isbn_13_formatted)."','".mysql_real_escape_string($platform_requirement)."','".mysql_real_escape_string($product_lang)."','".mysql_real_escape_string($external_offer_copy)."','".mysql_real_escape_string($imprint)."','".mysql_real_escape_string($frequency)."','".mysql_real_escape_string($link)."','".mysql_real_escape_string($coreAddonFlag)."','".mysql_real_escape_string($toc)."','".mysql_real_escape_string($edition_text)."','".mysql_real_escape_string($edition_number)."','".mysql_real_escape_string($mrkt_url)."','".mysql_real_escape_string($pub_status)."','".mysql_real_escape_string($pub_date)."','".mysql_real_escape_string($keywords)."','".mysql_real_escape_string($vendorId)."','".mysql_real_escape_string($searchable)."','".mysql_real_escape_string($part_number)."','".mysql_real_escape_string($available_online)."','".mysql_real_escape_string($availableDate)."','".mysql_real_escape_string($proratable)."','".mysql_real_escape_string($restricted_msg)."','".mysql_real_escape_string($isCoreProduct)."','".mysql_real_escape_string($issn)."','".mysql_real_escape_string($volume_number)."')";
					
					}
					if('PRODUCT' == $values->getName()){
						$parent_categories = (array)$values->PARENT_CATEGORIES;
						$prd_code  = (string) $values->prd_code;
						if(is_array($parent_categories['cat_id'])){
							$PARENT_CATEGORIES  = implode(',',$parent_categories['cat_id']);
						}else{
							$PARENT_CATEGORIES  = $parent_categories['cat_id'];
						}
						$prd_display_name  = (string) $values->prd_display_name;
						$prd_description  = (string) $values->prd_description;
						$prd_longdescription  = (string) $values->prd_longdescription;
						$start_date  = (string) $values->start_date;
						$end_date  = (string) $values->end_date;
						$productName[] =  "( '".mysql_real_escape_string($prd_code)."','".mysql_real_escape_string($PARENT_CATEGORIES)."','".mysql_real_escape_string($prd_display_name)."','".mysql_real_escape_string($prd_description)."','".mysql_real_escape_string($prd_longdescription)."','".mysql_real_escape_string($start_date)."','".mysql_real_escape_string($end_date)."')";
						
					}
					if('SKU' == $values->getName()){
						$sku_code = (string)$values->sku_code;
						$sku_display_name  = (string) $values->sku_display_name;
						$sku_description  = (string) $values->sku_description;
						$fulfiller  = (string) $values->fulfiller;
						$skuattr[] =  "( '".mysql_real_escape_string($sku_code)."','".mysql_real_escape_string($sku_display_name)."','".mysql_real_escape_string($sku_description)."','".mysql_real_escape_string($fulfiller)."')";
						
					}
					if('PRODUCT_SKUS' == $values->getName()){
						$prd_code = (string)$values->prd_code;
						$sku_code  = (string) $values->sku_code;
						$productskuattr[] =  "( '".mysql_real_escape_string($prd_code)."','".mysql_real_escape_string($sku_code)."')";
						
					}
					if('Custom_SKU' == $values->getName()){
						$sku_code = (string)$values->sku_code;
						$isbn  = (string) $values->isbn;
						$active  = (string) $values->active;
						$TOPIC  = (string) $values->TOPIC;
						$sku_type  = (string) $values->sku_type;
						$customskuattr[] =  "( '".mysql_real_escape_string($sku_code)."','".mysql_real_escape_string($isbn)."','".mysql_real_escape_string($active)."','".mysql_real_escape_string($TOPIC)."','".mysql_real_escape_string($sku_type)."')";
						
					}
					if('PRICING_DETAIL' == $values->getName()){
						$data = (array)$values;
						$priceListId = (string)$data['@attributes']['priceListId'];
						$sku_code = (string)$values->sku_code;
						$pricing_scheme  = (string) $values->pricing_scheme;
						$list_price  = (string) $values->list_price;
						$isbn  = (string) $values->isbn;
						$propriceattr[] =  "( '".mysql_real_escape_string($priceListId)."','".mysql_real_escape_string($sku_code)."','".mysql_real_escape_string($pricing_scheme)."','".mysql_real_escape_string($list_price)."','".mysql_real_escape_string($isbn)."')";
						
					}
					if('ELS_LINKED_FORMATS' == $values->getName()){
						$ID = (string)$values->ID;
						$SUPPORTING_PRODUCT_ID  = (string) $values->SUPPORTING_PRODUCT_ID;
						$linkedformateattr[] =  "( '".mysql_real_escape_string($ID)."','".mysql_real_escape_string($SUPPORTING_PRODUCT_ID)."')";
						
					}
					if('ELS_LINKED_FORMATS_MULTI' == $values->getName()){
						$product_id = (string)$values->product_id;
						$linkedFormats_id  = (array) $values->linkedFormats_ID;
						unset($linkedFormats_id['@attributes']);
						if(is_array($linkedFormats_id)){
							$linkedFormats  = implode(',',$linkedFormats_id);
						}else{
							$linkedFormats  = $linkedFormats_id['linkedFormats_ID'];
						}

						$linkedformatemultiattr[] =  "( '".mysql_real_escape_string($product_id)."','".mysql_real_escape_string($linkedFormats)."')";
						
					}
						
				}
				
			}
			if(count($productattr)>1){
				$productdata = array_chunk ($productattr,50);
				foreach($productdata as $data){
					$insertstringcust = implode(',',$data);
					  $insertSqlcust = "Insert into tmp_france_product_custom (prd_code,isbn,isActive,title,allAuthorDesc,shortDescription,year,createdByTitle,comments,productType,additional_info,brochure,fulfillment_company_code,productFormat,copyright,number_of_pages,product_desc,ext_new_to_edition,copy_key_feature,ext_org_copy,abstract,author_alist,stock_status,isbn_13_formatted,platform_requirement,product_lang,external_offer_copy,imprint,frequency,link,coreAddonFlag,toc,edition_text,edition_number,mrkt_url,pub_status,pub_date,keywords,vendorId,searchable,part_number,available_online,availableDate,proratable,restricted_msg,isCoreProduct,issn,volume_number) values ".$insertstringcust;
				$qry = mysql_query($insertSqlcust) or die( mysql_errno() .'--'.mysql_error ());
				}
			}
			if(count($productName)>1){
				$productNameList = array_chunk ($productName,50);
				foreach($productNameList as $data){
					$insertstring = implode(',',$data);
					  $insertSql = "Insert into tmp_france_product (prd_code , PARENT_CATEGORIES, prd_display_name,prd_description,prd_longdescription,start_date,end_date) values ".$insertstring;
				$qry = mysql_query($insertSql) or die( mysql_errno() .'--'.mysql_error ());
				}
			}
			if(count($skuattr)>1){
				$skuattrList = array_chunk ($skuattr,50);
				foreach($skuattrList as $data){
					$insertstringsku = implode(',',$data);
					  $insertSqlsku = "Insert into tmp_france_product_sku (sku_code,sku_display_name,sku_description,fulfiller) values ".$insertstringsku;
				$qry = mysql_query($insertSqlsku) or die( mysql_errno() .'--'.mysql_error ());
				}
			}
			if(count($productskuattr)>1){
				$productskuattrList = array_chunk ($productskuattr,50);
				foreach($productskuattrList as $data){
					$insertstringprosku = implode(',',$data);
					  $insertSqlprosku = "Insert into tmp_france_product_psku (prd_code,sku_code) values ".$insertstringprosku;
				$qry = mysql_query($insertSqlprosku) or die( mysql_errno() .'--'.mysql_error ());
				}
			}
			if(count($customskuattr)>1){
				$customskuattrList = array_chunk ($customskuattr,50);
				foreach($customskuattrList as $data){
					$insertstringcustsku = implode(',',$data);
					  $insertSqlcustsku = "Insert into tmp_france_product_csku (sku_code,isbn,active,TOPIC,sku_type) values ".$insertstringcustsku;
				$qry = mysql_query($insertSqlcustsku) or die( mysql_errno() .'--'.mysql_error ());
				}
			}
			if(count($propriceattr)>1){
				$propriceattrList = array_chunk ($propriceattr,50);
				foreach($propriceattrList as $data){
					$insertstringprice = implode(',',$data);
					  $insertSqlprice = "Insert into tmp_france_product_price (priceListId,sku_code,pricing_scheme,list_price,isbn) values ".$insertstringprice;
				$qry = mysql_query($insertSqlprice) or die( mysql_errno() .'--'.mysql_error ());
				}
			}
			if(count($linkedformateattr)>1){
				$linkedformateattrList = array_chunk ($linkedformateattr,50);
				foreach($linkedformateattrList as $data){
					$insertstringlinked = implode(',',$data);
					  $insertSqllinked = "Insert into tmp_france_product_link (ID,SUPPORTING_PRODUCT_ID) values ".$insertstringlinked;
				$qry = mysql_query($insertSqllinked) or die( mysql_errno() .'--'.mysql_error ());
				}
			}
			if(count($linkedformatemultiattr)>1){
				$linkedformatemultiattrList = array_chunk ($linkedformatemultiattr,50);
				foreach($linkedformatemultiattrList as $data){
					$insertstringlinkedmulti = implode(',',$data);
					  $insertSqllinkedmulti = "Insert into tmp_france_product_link_multi (product_id,linkedFormats) values ".$insertstringlinkedmulti;
				$qry = mysql_query($insertSqllinkedmulti) or die( mysql_errno() .'--'.mysql_error ());
				}
			}
			//echo "End Time : ".microtime(true);
			return 1;
		}else{
			//echo "End Time : ".microtime(true);
			return 0;
		}
		
	}
	// for category update details
	public function  get_categories($categories, $type='name') {
		$array = array();
		foreach($categories as $category) {
			$cat = Mage::getModel('catalog/category')->load($category->getId());
			//var_dump($cat );die;
			
			if($type == 'name'){
				$array[]= $cat->getName();
			}elseif($type == 'external_id'){
				
				$array[]= $cat->getExternalId();
			}else{
				$array[]= $cat->getId();
			}
			
			if($cat->hasChildren()) {
				$children = Mage::getModel('catalog/category')->getCategories($cat->getId());
				 $array[]=  $this->get_categories($children,$type);
				}
			 
		}
		return  $array ;
	}
	
	// for category update id
	public function  getcategoriesids($categories, $type='name') {
		$array = array();
		foreach($categories as $category) {
			$cat = Mage::getModel('catalog/category')->load($category->getId());
			if($type == 'name'){
				$array[]= $category->getName();
			}elseif($type == 'external_id'){
				$array[]= $category->getExternalId();
			}else{
				$array[]= $category->getId();
			}
			
			if($category->hasChildren()) {
				$children = Mage::getModel('catalog/category')->getCategories($category->getId());
				$catarr=  $this->getcategoriesids($children,$type);
				$array = array_merge_recursive($array,$catarr);

				}
			 
		}
		return  $array ;
	}
	// for category update search
	public function recursive_array_search($needle,$categoryExternalIds){
			foreach($categoryExternalIds  as $key=> $extids){
				if(!is_array($extids)){
					if($extids == $needle ){
						$findkey=$key;
						
					}
				}else{
					$key1=$this->recursive_array_search($needle,$extids);
					if($key1!=''){
						$findkey=$key1.','.$key;
					}
				}

			}
			return $findkey;
	}
	// Update store category 
	public function updatecategory(){
		//Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);	
		$rootcatId = 3;
		$categories = Mage::getModel('catalog/category')->getCategories($rootcatId);

		$categoryName = $this->get_categories($categories);
		$categoryId = $this->get_categories($categories,'id');
		$categoryExternalId = $this->get_categories($categories,'external_id');

		
		//For simplae product update
		$productarr =  Mage::getResourceModel('catalog/product_collection')
								   ->addAttributeToSelect('*')
								   ->addAttributeToFilter('type_id', array('eq' => 'simple'))
								   ->addAttributeToFilter('product_type', array('eq' => 'Livre'))
								   ->addAttributeToFilter('status', array('eq' => 1))->getAllIds();
		foreach($productarr as $productId)
		{
			
			$_product = Mage::getModel('catalog/product')->load($productId);
			if(is_object($_product)){	
				$sku = $_product->getSku();
				echo $_product->getId();
				echo "\n";
				$catids = $_product->getCatIds();
				$catidarr  = explode(',',$catids);
				$catidarrs = array();
				if(is_array($catidarr)){
					foreach($catidarr as $catid){
							$keys = $this->recursive_array_search($catid,$categoryExternalId);
							$keyarr = explode(',',$keys);
							if(count($keyarr) == 1){
								$catid1 = 	$categoryId[$keyarr[0]]; 
								$catidarrs[] = $catid1;
							}elseif(count($keyarr) == 2){
								$catid1 = 	$categoryId[$keyarr[1]][$keyarr[0]];
								$catid2 = 	$categoryId[$keyarr[1]-1];
								$catidarrs[] = $catid1;
								$catidarrs[] = $catid2;

							}elseif(count($keyarr) == 3){
								$catid1 = 	$categoryId[$keyarr[2]][$keyarr[1]][$keyarr[0]];
								$catid2 = 	$categoryId[$keyarr[2]][$keyarr[1]-1];
								$catid3 = 	$categoryId[$keyarr[2]-1];
								$catidarrs[] = $catid1;
								$catidarrs[] = $catid2;
								$catidarrs[] = $catid3;
								
							}elseif(count($keyarr) == 4){
								$catid1 = 	$categoryId[$keyarr[3]][$keyarr[2]][$keyarr[1]][$keyarr[0]];
								$catid2 = 	$categoryId[$keyarr[3]][$keyarr[2]][$keyarr[1]-1];
								$catid3 = 	$categoryId[$keyarr[3]][$keyarr[2]-1];
								$catid4 = 	$categoryId[$keyarr[3] -1];
								$catidarrs[] = $catid1;
								$catidarrs[] = $catid2;
								$catidarrs[] = $catid3;
								$catidarrs[] = $catid4;

							}elseif(count($keyarr) == 5){
								$catid1 = 	$categoryId[$keyarr[4]][$keyarr[3]][$keyarr[2]][$keyarr[1]][$keyarr[0]];
								$catid2 = 	$categoryId[$keyarr[4]][$keyarr[3]][$keyarr[2]][$keyarr[1]-1];
								$catid3 = 	$categoryId[$keyarr[4]][$keyarr[3]][$keyarr[2]-1];
								$catid4 = 	$categoryId[$keyarr[4]][$keyarr[3] -1];
								$catid5 = 	$categoryId[$keyarr[4] -1];
								$catidarrs[] = $catid1;
								$catidarrs[] = $catid2;
								$catidarrs[] = $catid3;
								$catidarrs[] = $catid4;
								$catidarrs[] = $catid5;

							}
							
					}	
				
					Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
					$adapter = Mage::getModel('catalog/convert_adapter_product');
					$productdata['sku'] = $sku;
					$productdata['store'] = 'admin';
					$productdata['category_ids'] = $catidarrs;
					$adapter->saveRow($productdata);
					
					}
			}
			
		}

		//For configurable product update
		$productarr =  Mage::getResourceModel('catalog/product_collection')
							   ->addAttributeToSelect('*')
							   ->addAttributeToFilter('type_id', array('eq' => 'configurable'))
							   ->addAttributeToFilter('status', array('eq' => 1))->getAllIds();

		foreach($productarr as $productId)
		{
			
			$_product = Mage::getModel('catalog/product')->load($productId);
			if(is_object($_product)){	
				$sku = $_product->getSku();
				echo $_product->getId();
				echo "\n";
				$catids = $_product->getCatIds();
				$catidarr  = explode(',',$catids);
				$catidarrs = array();
				if(is_array($catidarr)){
					foreach($catidarr as $catid){
							$keys = $this->recursive_array_search($catid,$categoryExternalId);
							$keyarr = explode(',',$keys);
							if(count($keyarr) == 1){
								$catid1 = 	$categoryId[$keyarr[0]]; 
								$catidarrs[] = $catid1;
							}elseif(count($keyarr) == 2){
								$catid1 = 	$categoryId[$keyarr[1]][$keyarr[0]];
								$catid2 = 	$categoryId[$keyarr[1]-1];
								$catidarrs[] = $catid1;
								$catidarrs[] = $catid2;

							}elseif(count($keyarr) == 3){
								$catid1 = 	$categoryId[$keyarr[2]][$keyarr[1]][$keyarr[0]];
								$catid2 = 	$categoryId[$keyarr[2]][$keyarr[1]-1];
								$catid3 = 	$categoryId[$keyarr[2]-1];
								$catidarrs[] = $catid1;
								$catidarrs[] = $catid2;
								$catidarrs[] = $catid3;
								
							}elseif(count($keyarr) == 4){
								$catid1 = 	$categoryId[$keyarr[3]][$keyarr[2]][$keyarr[1]][$keyarr[0]];
								$catid2 = 	$categoryId[$keyarr[3]][$keyarr[2]][$keyarr[1]-1];
								$catid3 = 	$categoryId[$keyarr[3]][$keyarr[2]-1];
								$catid4 = 	$categoryId[$keyarr[3] -1];
								$catidarrs[] = $catid1;
								$catidarrs[] = $catid2;
								$catidarrs[] = $catid3;
								$catidarrs[] = $catid4;

							}elseif(count($keyarr) == 5){
								$catid1 = 	$categoryId[$keyarr[4]][$keyarr[3]][$keyarr[2]][$keyarr[1]][$keyarr[0]];
								$catid2 = 	$categoryId[$keyarr[4]][$keyarr[3]][$keyarr[2]][$keyarr[1]-1];
								$catid3 = 	$categoryId[$keyarr[4]][$keyarr[3]][$keyarr[2]-1];
								$catid4 = 	$categoryId[$keyarr[4]][$keyarr[3] -1];
								$catid5 = 	$categoryId[$keyarr[4] -1];
								$catidarrs[] = $catid1;
								$catidarrs[] = $catid2;
								$catidarrs[] = $catid3;
								$catidarrs[] = $catid4;
								$catidarrs[] = $catid5;

							}
							
					}	
				
					Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
					$adapter = Mage::getModel('catalog/convert_adapter_product');
					$productdata['sku'] = $sku;
					$productdata['store'] = 'admin';
					$productdata['category_ids'] = $catidarrs;
					$adapter->saveRow($productdata);
					
					}
			}
			
		}
	}
	// for connect server and copy file unzip latest zip file
	public function importSimpleFile(){

				//the directory where read file starts
				$startdir = "";
				$files_name1 = "";
				$local_files_name1 = "";
				$connection_time=0;
				// set up basic connection
				$conn_id1 = ftp_connect($this->ftp_server1);
				//login
				$login_result1 = ftp_login($conn_id1, $this->ftp_user_name1, $this->ftp_user_pass1);
				ftp_pasv($conn_id1, true);
				// check connection
				if ((!$conn_id1) || (!$login_result1)) {
					@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - Could not connect to FTP server","ISIS - Could not connect to FTP server");
					echo "ISIS - Could not connect to FTP server";
					exit;
				} else {
					$connection_time=microtime(true);
					echo "\n ISIS - Connected to $this->ftp_server1, for user $this->ftp_user_name1";
				}
				//ftp_chdir($conn_id1, '/');
				
				$list1 = ftp_rawlist($conn_id1, "/ISIS/");
				//print_r($list1);die;
				$filelist1 = array();
				$anzlist1 = count($list1);

				$i1 = 0;
				while ($i1 < $anzlist1){
					$split = preg_split("/[\s]+/", $list1[$i1], 9, PREG_SPLIT_NO_EMPTY);
					
					$ItemName = $split[8];
					//echo "\n";
					//if (substr($list1[$i1], 0, 1) == "d" && substr($ItemName, 0, 1) != "."){
					//}else{
						$timearr = explode('-',$split[0]);
					
						//  @strtotime($timearr[2].'-'.$timearr[1].'-'.$timearr[1]);
						 //"\n";
						$itemdate =  @strtotime($split[5]. " ".$split[6] ." ". $split[7]);
						//$itemdate =  @strtotime($timearr[2].'-'.$timearr[0].'-'.$timearr[1]);
						//echo $ItemName .'---'.$timearr[2].'-'.$timearr[0].'-'.$timearr[1]."---".$itemdate;
						$filelist1[$itemdate] = $ItemName;
					//}
					$i1++;
				}
				if(count($filelist1)>0){
					ksort($filelist1);
					$files_name1 = array_pop($filelist1);
					//$files_name1 = array_pop($filelist1);
				}
				//$files_name1='ATG_CATALOGUE_2014_09_09.zip';
				$files_name2='ISIS/'.$files_name1;
				echo "\nISIS - Selected file to download ".$files_name1;
				if($files_name1!=""){
					$file_dest = $this->file_desination1.$files_name1;
					if (ftp_get($conn_id1,$file_dest , $files_name2, FTP_BINARY)) {
						//ftp_delete($conn_id1, $files_name1);
						echo "\nISIS - Successfully written to $file_desination1$files_name1\n";
						exec('chmod 777 '.$file_dest);
						//exec($file_dest);
						$zipfile=$files_name1;
						$fileext=explode('.',$zipfile);
						//$file_dest = $this->file_desination1.$zipfile;
						if($fileext[1]=='zip'){
							//unzip local file
							$zip = new ZipArchive;
							$res = $zip->open($file_dest);
							if ($res === TRUE) {
								for($i = 0; $i < $zip->numFiles; $i++){  
								  $local_files_name1 =  $zip->getNameIndex($i);
								} 
								/*if(is_file($file_desination1.$local_files_name1)){
									@unlink($file_desination1.$local_files_name1);
								} */
								$zip->extractTo($this->extract_desination1);
								$zip->close();
								echo "\nISIS - unzipped ".$this->extract_desination1.$local_files_name1;
								// for zip file move to archived folder after unzip to cronfiles folder
								$oldfilezip = $file_dest;
								$fileextzip=explode('.',$files_name1);
								if(count($fileextzip)==2){
									$newfilezip = $this->archived_desination1_zip . $fileextzip[0]."_".date('Y_m_d_H_i_s').".".$fileextzip[1];
									rename($oldfilezip, $newfilezip) or die("Failed to move file");
									unset($oldfilezip);
								}else{
									@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - Could not read file","ISIS - Could not read file");
									echo "\nISIS - Could not read file";
									exit;
								}// end file backup process
								// for unzip file move to archived folder after insert all data to DB
								$fileext=explode('.',$local_files_name1);
								if(count($fileext)==2){
									$oldfile = $this->extract_desination1 . $local_files_name1;
									// for insert tmp data from xml to DB
									$this->insertTmpProductFromXml($local_files_name1);
									$newfile = $this->archived_desination1 . $fileext[0]."_".date('Y_m_d_H_i_s').".".$fileext[1];
									rename($oldfile, $newfile) or die("ISIS - Failed to move file");
									unset($oldfile);
									return $connection_time;
								}else{
									@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - could not unzip","ISIS - could not unzip");
									echo "\nISIS - could not unzip";
									exit;
									echo "\nISIS - could not unzip";
									return $connection_time;
								}
								// end file backup process
							} else {
								@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - could not unzip","ISIS - could not unzip");
									echo "\nISIS - could not unzip";
									exit;
							}
						}else{
								echo $oldfilezip = $file_dest;
								$fileextzip=explode('.',$zipfile);
								copy($oldfilezip,$this->extract_desination1.$zipfile);
								if(count($fileextzip)==2){
									echo $newfilezip = $this->archived_desination1_zip . $fileextzip[0]."_".date('Y_m_d_H_i_s').".".$fileextzip[1];
									rename($oldfilezip, $newfilezip) or die("ISIS - Failed to move file");
									unset($oldfilezip);
								}else{
									@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - Could not read file","ISIS - Could not read file");
									echo "\nISIS - Could not read file";
									exit;
								}// end file backup process
								// for unzip file move to archived folder after insert all data to DB
								$fileextuploaded=explode('.',$zipfile);
								if(count($fileextuploaded)==2){
									$oldfile = $this->extract_desination1 . $zipfile;
									// for insert tmp data from xml to DB
									$this->insertTmpProductFromXml($zipfile);
									$newfile = $this->archived_desination1 . $fileextuploaded[0]."_".date('Y_m_d_H_i_s').".".$fileextuploaded[1];
									rename($oldfile, $newfile) or die("ISIS - Failed to move file");
									unset($oldfile);
									return $connection_time;
								}else{
									@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - could not moved file","ISIS - could not moved file");
									echo "\nISIS - could not moved file";
									exit;
									echo "\nISIS - could not moved file";
									return $connection_time;
								}
								// end file backup process
							

						}
						//unlink($file_dest);
					} else {
						@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - There was a problem","ISIS - There was a problem");
						echo "\nISIS - There was a problem";
						exit;
					}
				}else{
					@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - File not found","ISIS - File not found");
					echo "\nISIS - File not found";
					exit;
				}
				
				echo "\nISIS - xml file name ".$local_files_name1;
				ftp_close($conn_id1);
			
			}			
	// Insert product details
	function insertProduct($startlimit=0,$endlimit=50,$filename='')
			{
				$time = "Start Time : ".microtime(true);
				$starttime=microtime(true);
				Mage::log($time , null, 'productimportlog.log');
				$returnvalue=$this->importSimpleFile();
				
				//$returnvalue=100000;
				if($returnvalue>1){
					Mage::log('FTP Connection Time : '.$returnvalue , null, 'productimportlog.log');
					
					$server = $this->server;
					$user = $this->user;
					$pass = $this->pass;
					$db = $this->db;
					$connection = mysql_connect($server, $user, $pass) 
						or die ("Could not connect to server ... \n" . mysql_error ());
					mysql_select_db($db)   ;
					mysql_query('SET NAMES utf8');
					$isndEmpty=array();
					$selectSql="SELECT * FROM tmp_france_product_custom Limit $startlimit,$endlimit";
					$selectqry=mysql_query($selectSql);
					$productcount = 0;
					$countlivreProd=0;
					$countrevueProd=0;
					$countemcProd=0;
					$countrevueProdconfig=0;
					$countemcProdconfig=0;
					$adapter = Mage::getModel('catalog/convert_adapter_product'); 
					while($selectrows=mysql_fetch_assoc($selectqry))
						{
							
							$conditionParm='';
							$prd_code=$selectrows['prd_code'];
							$sku_code='';
							if($prd_code){
								$productdata=array();
								
								$productdata =  $this->productheaderarr;
								$sku_code_arr=$this->getProductPsku($prd_code);
								foreach($sku_code_arr as $sku_codeKey=>$sku_codeValue){
									$sku_code=$sku_codeValue['sku_code'];
									$product_arr=$this->getProduct($prd_code);
									$product_arr_csku=$this->getProductCsku($sku_code);
									$product_arr_link=$this->getProductLink($prd_code);
									$product_arr_price=$this->getProductPrice($sku_code);
									$product_arr_link_multi=$this->getProductLinkMulti($prd_code);
									$productdata['name'] =  $selectrows['title'];
									$productdata['description']=$product_arr[0]['prd_longdescription'];
									$productdata['short_description']=htmlentities($product_arr[0]['prd_description']);
									if($selectrows['isActive']==1){
										$productdata['status']='Enabled';
									}else{
										$productdata['status']='Disabled';
									}
									$productdata['weight'] =  '1';
									$productdata['price'] =  $product_arr_price[0]['list_price'];
									if($product_arr[0]['start_date']!='' && $product_arr[0]['end_date']!=''){
										$productdata['special_from_date'] =  $product_arr[0]['start_date'];
										$productdata['special_to_date'] =  $product_arr[0]['end_date'];
										$productdata['special_price'] =  $product_arr_price[1]['list_price'];
									}
									$productdata['prd_code'] =  $prd_code;
									$productdata['cat_ids'] =  $product_arr[0]['PARENT_CATEGORIES'];
									$productdata['isbn'] =  $selectrows['isbn'];
									$productdata['stock_status'] =  $selectrows['stock_status'];
									$productdata['external_offer_copy'] =  $selectrows['external_offer_copy'];
									$productdata['imprint'] =  $selectrows['imprint'];
									$productdata['frequency'] =  $selectrows['frequency'];
									$productdata['link'] =  $selectrows['link'];
									$productdata['core_addon_flag'] =  $selectrows['coreAddonFlag'];
									$productdata['pp_toclong'] =  $selectrows['toc'];
									$productdata['pp_newtoed'] =  $selectrows['ext_new_to_edition'];
									$productdata['lepubdate'] =  $selectrows['pub_date'];
									$productdata['edition_text'] =  $selectrows['edition_text'];
									$productdata['edition_number'] =  $selectrows['edition_number'];
									$productdata['mrkt_url'] =  $selectrows['mrkt_url'];
									$productdata['pub_status'] =  $selectrows['pub_status'];
									$productdata['keywords'] =  $selectrows['keywords'];
									$productdata['searchable'] =  $selectrows['searchable'];
									$productdata['part_number'] =  $selectrows['part_number'];
									$productdata['issn'] =  $selectrows['issn'];
									$productdata['available_online'] =  $selectrows['available_online'];
									$productdata['platform_requirement'] =  $selectrows['platform_requirement'];
									$productdata['author_alist'] =  $selectrows['author_alist'];
									$productdata['vendor_id'] =  $selectrows['volume_number'];
									$productdata['all_author_desc'] =  $selectrows['allAuthorDesc'];
									$productdata['year'] =  $selectrows['year'];
									$productdata['comments'] =  $selectrows['comments'];
									$productdata['product_type'] =  $selectrows['productType'];
									$productdata['additional_info'] =  $selectrows['additional_info'];
									$productdata['brochure'] =  $selectrows['brochure'];
									$productdata['fulfillment_company_code'] =  $selectrows['fulfillment_company_code'];
									$productdata['restricted_msg'] =  $selectrows['restricted_msg'];
									$productdata['product_format'] =  $selectrows['productFormat'];
									$productdata['copyright'] =  $selectrows['copyright'];
									$productdata['copy_key_feature'] =  $selectrows['copy_key_feature'];
									$productdata['abstract'] =  $selectrows['abstract'];
									$productdata['available_date'] =  $selectrows['availableDate'];
									$productdata['ext_org_copy'] =  $selectrows['ext_org_copy'];
									$productdata['isbnformatted'] =  $selectrows['isbn_13_formatted'];
									$productdata['product_lang'] =  $selectrows['product_lang'];
									$productdata['pagecountle'] =  $selectrows['number_of_pages'];
									$productdata['prod_status'] =  $selectrows['prod_status'];
									$productdata['els_supporting_pro_id'] =  $product_arr_link[0]['ID'];
									$productdata['els_link_for_id'] =  $product_arr_link[0]['SUPPORTING_PRODUCT_ID'];
									$productdata['filter_product_type'] = $selectrows['productType'];
									$productdata['els_product_id'] = $product_arr_link_multi[0]['product_id'];
									$productdata['els_linkedformats_id'] = $product_arr_link_multi[0]['linkedFormats'];
									$urlkey = str_replace(array_keys($this->searchReplaceString),array_values($this->searchReplaceString),$this->removeWordQuote($selectrows['title']));
									$urlkey = str_replace(array_keys($this->searchReplaceString),array_values($this->searchReplaceString),trim($selectrows['title']));
									$urlkey = str_replace('	','-',strtolower($urlkey));
									$urlkey = str_replace('	','-',strtolower($urlkey));
									$urlkey = str_replace('---','-',strtolower($urlkey));
									$urlkey = str_replace('---','-',strtolower($urlkey));
									$urlkey = str_replace('--','-',strtolower($urlkey));
									if($selectrows['productType']=='Livre'){
										$productdata['visibility']='Catalog, Search';//for livre
										$productdata['sku']=$product_arr_csku[0]['isbn'];//for livre
										$productdata['url_key']= $urlkey.'-'.$product_arr_csku[0]['isbn'];//for livre
										$conditionParm=$product_arr_csku[0]['isbn'];//for check save data or not
										$countlivreProd++;
									}else{
										$productdata['visibility']='Not Visible Individually';//for none livre
										if($selectrows['issn']){
											$productdata['sku']=$sku_code.'-'.$selectrows['issn'];
										}else{
											$productdata['sku']=$sku_code;
										}

										//$productdata['sku']=strtolower(str_replace('_','-',$sku_code));//for none livre
										$productdata['url_key']= $urlkey.'-'.$productdata['sku'];//for none livre
										$productdata['filter_productformat'] =  $this->getFilterProductFormat(trim($selectrows['productFormat']));//for none livre
										$explodesku_code=explode('-',$sku_code);//for none livre
										if(count($explodesku_code)==6){
											$productdata['your_status'] = $this->getYourStatus(trim(strtolower($explodesku_code[2])));//for none livre
											$productdata['your_region'] = $this->getCountry(trim(strtolower($explodesku_code[3])));//for none livre
											$productdata['sub_length'] = $this->getSubscriptionTerm(trim(strtolower($explodesku_code[5])));//for none livre
											$conditionParm=$productdata['sku'];//for check save data or not
											if($selectrows['productType']=='Revue'){
												$countrevueProd++;
											}else{
												$countemcProd++;
											}
										}

									}
									if($conditionParm!=''){
										$adapter->saveRow($productdata);
										//unset($adapter);
										echo memory_get_usage() .'----'.$productcount."------".$selectrows['id']."------".$productdata['sku']."------".$productdata['status']."------".$selectrows['productFormat']."\n";
										$log =  memory_get_usage() .'----'.$productcount."------".$selectrows['id']."------".$productdata['sku']."------".$productdata['status']."------".$selectrows['productFormat']."\n";
										Mage::log($log , null, 'productimportlog.log');

									}else{
										$isndEmpty[]=$prd_code;
									}
									$productcount++;
									/*if($selectrows['productType']=='Livre' && count($sku_code_arr)>1){
										break;
									}else{
										$productcount++;
									}*/

								}
								// condition for inster config product
								if($selectrows['productType']!='Livre' && count($sku_code_arr)>1){
									$collectionPosChildren = Mage::getResourceModel('catalog/product_collection')
										->addAttributeToSelect(array('*'))
										->addAttributeToFilter('prd_code', array('eq' =>trim($prd_code)))
										->addAttributeToFilter('type_id', array('neq' =>"configurable"));
										$childIds = array();
										$productyourstatus = array();
										$productyourregion = array();
										$productsublength = array();
									
									foreach ($collectionPosChildren as $product) {							
										if($product->getTypeId() != 'configurable'){
											$childIds[] = $product->getId();
											$productyourstatus[] = $product->getYourStatus();
											$productyourregion[] = $product->getYourRegion();
											$productsublength[] = $product->getSubLength();
											
										}
									}
									$productdata['sku']=strtolower(str_replace('_','-',$prd_code));
									$productdata['price']=0;
									$productdata['visibility']='Catalog, Search';//for none livre config product
									$urlkey = $selectrows['title'].'-'.$selectrows['issn'].'-'.$selectrows['productFormat'];
									$urlkey = str_replace(array_keys($this->searchReplaceString),array_values($this->searchReplaceString),trim($urlkey));
									$urlkey = str_replace('	','-',strtolower($urlkey));
									$urlkey = str_replace('	','-',strtolower($urlkey));
									$urlkey = str_replace('---','-',strtolower($urlkey));
									$urlkey = str_replace('---','-',strtolower($urlkey));
									$urlkey = str_replace('--','-',strtolower($urlkey));
									$productdata['url_key']= $urlkey;
									
									// hard code the value of the attributes needed to be update if new attribute is added
									$productdata['attributes'] =$this->confurgable_product_attr_id_arr;
									$productdata['attribute_ids'] =$this->confurgable_product_attr_id_arr;
									$productdata['product_attribute_ids'] = $this->confurgable_product_attr_id_arr;
									$productdata['used_product_attribute_ids'] = $this->confurgable_product_attr_id_arr;
									$data = array();
									// looping and prepearing the configurable_products_data array have hard code some values and condition which we need to update if there is any change in the product attribure
									for($i=0 ;$i<count($childIds);$i++){
										$productyourstatusarr  = array();
										$subscriptionarr = array();
										$productlocationarr = array();
										
										if($productyourstatus[$i] == self::PRODUCT_TYPE_YOUR_STATUS_PARTICULAR_ID){
											$productyourstatusarr['label'] = 'Particulier';
										}elseif($productyourstatus[$i] == self::PRODUCT_TYPE_YOUR_STATUS_STUDENT_ID){
											$productyourstatusarr['label'] = 'Étudiant';
										}elseif($productyourstatus[$i] == self::PRODUCT_TYPE_YOUR_STATUS_INSTITUTION_ID){
											$productyourstatusarr['label'] = 'Institution';
										}elseif($productyourstatus[$i] == self::PRODUCT_TYPE_YOUR_STATUS_BELGIQUE_ID){
											$productyourstatusarr['label'] = 'Belgique';
										}elseif($productyourstatus[$i] == self::PRODUCT_TYPE_YOUR_STATUS_ALREADY_ID){
											$productyourstatusarr['label'] = 'Déjà abonné à une autre revue';
										}
										
										$productyourstatusarr['attribute_id']=self::PRODUCT_TYPE_YOUR_STATUS_ID;
										$productyourstatusarr['value_index']=$productyourstatus[$i];
										$productyourstatusarr['pricing_value']='0';
										$productyourstatusarr['pricing_value']='';
										if($productsublength[$i] == self::SUBSCRIPTION_MONTH_ONE_YEAR_ID){
											$subscriptionarr['label'] = '12 months';
										}elseif($productsublength[$i] == self::SUBSCRIPTION_MONTH_TWO_YEAR_ID){
											$subscriptionarr['label'] = '24 months';
										}elseif($productsublength[$i] == self::SUBSCRIPTION_MONTH_THREE_YEAR_ID){
											$subscriptionarr['label'] = '36 months';
										}elseif($productsublength[$i] == self::SUBSCRIPTION_MONTH_FOUR_YEAR_ID){
											$subscriptionarr['label'] = '48 months';
										}elseif($productsublength[$i] == self::SUBSCRIPTION_MONTH_FIVE_YEAR_ID){
											$subscriptionarr['label'] = '13 months';
										}
										$subscriptionarr['attribute_id']=self::SUBSCRIPTION_MONTH_ID;
										$subscriptionarr['value_index']=$productsublength[$i];
										$subscriptionarr['pricing_value']='0';
										$subscriptionarr['pricing_value']='';
										
										
										if($productyourregion[$i] == self::PRODUCT_LOCATION_FRANCE_ID){
											$productlocationarr['label'] = 'France (+ DOM-TOM)';
										}elseif($productyourregion[$i] == self::PRODUCT_LOCATION_SUISSE_ID){
											$productlocationarr['label'] = 'UE (+ Suisse)';
										}elseif($productyourregion[$i] == self::PRODUCT_LOCATION_REST_WORLD_ID){
											$productlocationarr['label'] = 'Reste du monde';
										}elseif($productyourregion[$i] == self::PRODUCT_LOCATION_BELGIQUE_ID){
											$productlocationarr['label'] = 'Belgique';
										}
										
										$productlocationarr['attribute_id']=self::PRODUCT_LOCATION_ID;
										$productlocationarr['value_index']=$productyourregion[$i];
										$productlocationarr['pricing_value']='0';
										$productlocationarr['pricing_value']='';
										
										
										$data[$childIds[$i]][0] = $productyourstatusarr;
										$data[$childIds[$i]][1] = $subscriptionarr;
										$data[$childIds[$i]][2] = $productlocationarr;
									
									}
									$productdata['configurable_products_data'] = $data;
									$productuniquesubscription = array_unique($productsublength);
									$producttypeunique = array_unique($productyourstatus);
									$productlocationunique = array_unique($productyourregion);
									$producttypeval = array();
									$productsubscriptionval = array();
									$productlocationval = array();
									$count = 0;
									/* Looping the unique produt type and prepare the array which we need to set fo the 
									configurable_attributes_data
									*/
									foreach($producttypeunique as $key => $product_type){
										 if($product_type == self::PRODUCT_TYPE_YOUR_STATUS_PARTICULAR_ID){
											$producttypeval[$count]['label'] = 'Particulier';
										 }elseif($product_type == self::PRODUCT_TYPE_YOUR_STATUS_STUDENT_ID){
											$producttypeval[$count]['label'] = 'Étudiant';
										 }elseif($product_type == self::PRODUCT_TYPE_YOUR_STATUS_INSTITUTION_ID){
											$producttypeval[$count]['label'] = 'Institution';
										 }elseif($product_type == self::PRODUCT_TYPE_YOUR_STATUS_BELGIQUE_ID){
											$producttypeval[$count]['label'] = 'Belgique';
										 }elseif($product_type == self::PRODUCT_TYPE_YOUR_STATUS_ALREADY_ID){
											$producttypeval[$count]['label'] = 'Déjà abonné à une autre revue';
										 }
										
										$producttypeval[$count]['attribute_id'] = self::PRODUCT_TYPE_YOUR_STATUS_ID;
										$producttypeval[$count]['value_index'] = $product_type;
										$producttypeval[$count]['is_percent'] = '0';
										$producttypeval[$count]['pricing_value'] = '' ;
										$count++;
									}
									$count = 0;
									/* Looping the unique subscription month and prepare the array which we need to set fo the 
									configurable_attributes_data
									*/
									foreach($productuniquesubscription as $key=> $subcription_month){
										if($subcription_month == self::SUBSCRIPTION_MONTH_ONE_YEAR_ID){
											$productsubscriptionval[$count]['label'] = '12 months';
										}elseif($subcription_month == self::SUBSCRIPTION_MONTH_TWO_YEAR_ID){
											$productsubscriptionval[$count]['label'] = '24 months';
										}elseif($subcription_month == self::SUBSCRIPTION_MONTH_THREE_YEAR_ID){
											$productsubscriptionval[$count]['label'] = '36 months';
										}elseif($subcription_month == self::SUBSCRIPTION_MONTH_FOUR_YEAR_ID){
											$productsubscriptionval[$count]['label'] = '48 months';
										}elseif($subcription_month == self::SUBSCRIPTION_MONTH_FIVE_YEAR_ID){
											$productsubscriptionval[$count]['label'] = '13 months';
										}
										$productsubscriptionval[$count]['attribute_id'] = self::SUBSCRIPTION_MONTH_ID;
										$productsubscriptionval[$count]['value_index'] = $subcription_month;
										$productsubscriptionval[$count]['is_percent'] = '0';
										$productsubscriptionval[$count]['pricing_value'] = '' ;
										$count++;
									}
									$count = 0;
									/* Looping the unique Product location and prepare the array which we need to set fo the 
										configurable_attributes_data
									*/
									foreach($productlocationunique as $key=> $product_location){
										if($product_location == self::PRODUCT_LOCATION_FRANCE_ID){
											$productlocationval[$count]['label'] = 'France (+ DOM-TOM)';
										}elseif($product_location == self::PRODUCT_LOCATION_SUISSE_ID){
											$productlocationval[$count]['label'] = 'UE (+ Suisse)';
										}elseif($product_location == self::PRODUCT_LOCATION_REST_WORLD_ID){
											$productlocationval[$count]['label'] = 'Reste du monde';
										}elseif($product_location == self::PRODUCT_LOCATION_BELGIQUE_ID){
											$productlocationval[$count]['label'] = 'Belgique';
										}
										$productlocationval[$count]['attribute_id'] = self::PRODUCT_LOCATION_ID;
										$productlocationval[$count]['value_index'] = $product_location;
										$productlocationval[$count]['is_percent'] = '0';
										$productlocationval[$count]['pricing_value'] = '' ;
										$count++;
									}
									/* preparing the array of the configurable data attribure 
									 if any new attribute is added need to update the array also
									*/
									$dataarray = array();
									$dataarray[0]['id'] = '';
									$dataarray[0]['label'] = 'Your status';
									$dataarray[0]['use_default'] = '';
									$dataarray[0]['position'] = '';
									$dataarray[0]['values'] = $producttypeval;
									$dataarray[0]['attribute_id'] = self::PRODUCT_TYPE_YOUR_STATUS_ID;
									$dataarray[0]['attribute_code'] = 'your_status';
									$dataarray[0]['frontend_label'] = 'Your status';
									$dataarray[0]['store_label'] = 'Your status';
									$dataarray[0]['html_id'] = 'configurable_attribute_0';
							
									$dataarray[1]['id'] = '';
									$dataarray[1]['label'] = 'Subscription Term';
									$dataarray[1]['use_default'] = '';
									$dataarray[1]['position'] = '';
									$dataarray[1]['values'] = $productsubscriptionval;
									$dataarray[1]['attribute_id'] = self::SUBSCRIPTION_MONTH_ID;
									$dataarray[1]['attribute_code'] = 'sub_length';
									$dataarray[1]['frontend_label'] = 'Subscription Term';
									$dataarray[1]['store_label'] = 'Subscription Term';
									$dataarray[1]['html_id'] = 'configurable_attribute_1';
									
									$dataarray[2]['id'] = '';
									$dataarray[2]['label'] = 'Country';
									$dataarray[2]['use_default'] = '';
									$dataarray[2]['position'] = '';
									$dataarray[2]['values'] = $productlocationval;
									$dataarray[2]['attribute_id'] = self::PRODUCT_LOCATION_ID;
									$dataarray[2]['attribute_code'] = 'your_region';
									$dataarray[2]['frontend_label'] = 'Country';
									$dataarray[2]['store_label'] = 'Country';
									$dataarray[2]['html_id'] = 'configurable_attribute_2';
									$productdata['configurable_attributes_data'] = $dataarray; 
									$productdata['associated']= $childIds;
									
									try{
										$adapter->saveRow($productdata);
										//unset($adapter);
										/* Since our code is not inserting the values in the table
										catalog_product_super_attribute we have force fully enter the data in the table. 
										*/
										$products = Mage::getModel('catalog/product');
										$parent = $products->loadByAttribute('sku', $productdata['sku']); 
										$productid  = $parent->getId();
										$read = Mage::getSingleton('core/resource')->getConnection('core_read');
										$query  = "Select * from catalog_product_super_attribute where product_id = ".$productid." and attribute_id in (".self::SUBSCRIPTION_MONTH_ID.",".self::PRODUCT_TYPE_YOUR_STATUS_ID.",".self::PRODUCT_LOCATION_ID.")";
										$data = $read->query($query);
										$arrdb = $data->fetchAll();
										if(count($arrdb)==0){
											$write = Mage::getSingleton('core/resource')->getConnection('core_write');
											$insertquery = "Insert Into catalog_product_super_attribute values (NULL,".$productid.",".self::SUBSCRIPTION_MONTH_ID.",0)";
											$write->query($insertquery);
											$insertquery = "Insert Into catalog_product_super_attribute values (NULL,".$productid.",".self::PRODUCT_TYPE_YOUR_STATUS_ID.",0)";
											$write->query($insertquery);
											$insertquery = "Insert Into catalog_product_super_attribute values (NULL,".$productid.",".self::PRODUCT_LOCATION_ID.",0)";
											$write->query($insertquery);
										}
										echo memory_get_usage() .'----'.$productcount."------".$selectrows['id']."------".$productdata['sku']."------".$productdata['status']."------".$selectrows['productFormat']."\n";
										$log =  memory_get_usage() .'----'.$productcount."------".$selectrows['id']."------".$productdata['sku']."------".$productdata['status']."------".$selectrows['productFormat']."\n";
										Mage::log($log , null, 'productimportlog.log');
										if($selectrows['productType']=='Revue'){
											$countrevueProdconfig++;
										}else{
											$countemcProdconfig++;
										}
									}catch(Exception $e) {
										 echo 'Message: ' .$e->getMessage();
										 $isndEmpty[]=$prd_code;
									}
									$productcount++;
								}
								
							}
							
							
						}
						$this->updatecategory();
						Mage::log(print_r($isndEmpty,true) , null, 'productimportlog.log');
						$endtime = "Finish Time : ".microtime(true);
						$connection_Statr_Time='FTP Connection Time : '.$returnvalue;
						$finishtime=microtime(true);
						Mage::log($endtime , null, 'productimportlog.log');
						$totalcountproductLivre="Total Livre product : ".$countlivreProd."\n";
						$totalcountproductRevue="Total Revue simple product : ".$countrevueProd."\n";
						$totalcountproductEMC="Total EMC simple product : ".$countemcProd."\n";
						$totalcountproductRevueConfig="Total Revue config product : ".$countrevueProdconfig."\n";
						$totalcountproductEMCConfig="Total EMC config product : ".$countemcProdconfig."\n";
						$totaltimemicro=$finishtime - $starttime;
						$totaltime="Exicution Time : ".date("H:i:s",$totaltimemicro)."\n";
						Mage::log($totaltime , null, 'productimportlog.log');
						Mage::log($totalcountproductLivre , null, 'productimportlog.log');
						Mage::log($totalcountproductRevue , null, 'productimportlog.log');
						Mage::log($totalcountproductEMC , null, 'productimportlog.log');
						Mage::log($totalcountproductRevueConfig , null, 'productimportlog.log');
						Mage::log($totalcountproductEMCConfig , null, 'productimportlog.log');
						$errorlog='';
						if(count($isndEmpty)){
						$errorlog='Product not updated list ';
						$countval=1;
						foreach($isndEmpty as $key=>$value){
							$errorlog.="\n".$countval." ".$value;
							$countval++;
						}
						}
						@mail("sanjay.pal@infoprolearning.com,himanshu.kumar@infoprolearning.com,vineet.agarwal@infoprolearning.com,suraj.modi@compunnel.net","ISIS - Product updated on server".date("Y:m:d H:i:s"),$time."\n".$connection_Statr_Time."\n".$totalcountproductLivre."\n".$totalcountproductRevue."\n".$totalcountproductEMC."\n".$totalcountproductRevueConfig."\n".$totalcountproductEMCConfig."\n".$endtime."\n".$totaltime."\n".$errorlog);
						echo "ISIS - Product updated on server".date("Y:m:d H:i:s");
						exit;
						
				}else{
					$connection_Statr_Time='FTP Connection Time : Not connected';
					$endtime = "Finish Time : ".microtime(true);
					$finishtime=microtime(true);
					Mage::log($endtime , null, 'productimportlog.log');
					Mage::log($connection_Statr_Time , null, 'productimportlog.log');
					$latestdatavalue="Latest data Log : faild\n";
					Mage::log($latestdatavalue , null, 'productimportlog.log');
				}
			}
		}
		
$arg = $_SERVER['argv'];

$importObj  = new importProduct();		
//$importObj->insertProduct(0,7000,'Livre');


$importObj->insertProduct($arg[1],$arg[2]);
	
?>

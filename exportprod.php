<?php

// Load the Magento core

require_once 'app/Mage.php';
umask(0);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
$userModel = Mage::getModel('admin/user');
$userModel->setUserId(0);

// Load the product collection

$collection = Mage::getModel('catalog/product')
 ->getCollection()
 ->addAttributeToSelect('*')
 ->addAttributeToFilter('status', array('eq' => 1));
 $filename = time().'products.csv';
$fopen = fopen($filename, 'w');
$csvHeader = array("name", "rw_google_base_12_digit_sku");
fputcsv( $fopen , $csvHeader,",");




// Add the fields you need to export

foreach ($collection as $product){
	//echo '<pre>';print_r($product->getData());exit;
 $name = $product->getName();
 //$sku = $product->getAttributeText('sku');
  $sku = $product->getResource()->getAttribute('rw_google_base_12_digit_sku')->getFrontend()->getValue($product);
  //$sku = $product->getRwGoogleBase12DigitSku();
    fputcsv($fopen, array($name, $sku), ",");//Add the fields you added in csv header
}
fclose($fopen );
//echo 'Products successfully exported';
header('Location: '.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).$filename);

?>
<?php 
 
class PaymentPortalPage extends Page 
{
     private static $db = array(
     );
    
    private static $defaults = array(
    );
}
 
class PaymentPortalPage_Controller extends Page_Controller 
{
    
    public function init() {
        parent::init();
        
        require_once("../../silver/vendor/autoload.php");
        $stripe = array(
            "secret_key" => "sk_test_VUut2eSwowTAAxAzull9MaNW",
            "publishable_key" => "pk_test_ou3rXR9aUIFdtShDbyFDvtig"
        );
    }
}
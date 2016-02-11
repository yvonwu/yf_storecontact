<?php
class Yf_storeContactContactStoreModuleFrontController extends ModuleFrontControllerCore {
   

  	public $ssl = true;


   


	 public function initContent() {


        
    	$this->display_column_left = false;

        parent::initContent();
    	  
       if(Tools::getValue('storeid')){
       
             $stores =  array(Tools::getValue('storeid'));
      
         }else{ 

             $stores = array( array( 'id_store' => 1,'name' =>'store 1'),array( 'id_store' => 2,'name' =>'store 2'),array( 'id_store' => 3,'name' =>'store 3'));
       }


       if(Tools::getValue('subjectMails')){

        $subjectMails = array(Tools::getValue('subjectMails'));
        

       }else{

       $subjectMails = array('store 1','store 2','store 3');

       }

        $this->context->smarty->assign(array(

          'stores' => $stores,
          'subjectMails' => $subjectMails,


          ));

        $this->setTemplate('contactstore.tpl');

    }

    public function postProcess()
	{
	   
       if (Tools::isSubmit('submitMessage')){

              $name = Tools::getValue('name');
              $firstName = Tools::getValue('firstName');
              $telephone = Tools::getValue('telephone');
              $message = Tools::getValue('message');

            //  Mail::Send($this->context->language->id,);
    
       }else{

           /* if (count($this->errors) > 1)
              array_unique($this->errors);
            elseif (!count($this->errors))
              $this->context->smarty->assign('confirmation', 1);*/
       }
	}



    public function setMedia()
	{
	  parent::setMedia();
    //$this->addCSS(_THEME_CSS_DIR_.'contact-form.css');
    //$this->addJS(_THEME_JS_DIR_.'contact-form.js');
    $this->addJS(_PS_JS_DIR_.'validate.js');

	}

}

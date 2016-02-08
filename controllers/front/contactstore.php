<?php
class Yf_storeContactContactStoreModuleFrontController extends ModuleFrontControllerCore {
   

  	public $ssl = true;

  	


	 public function initContent() {
        
    	$this->display_column_left = false;

        parent::initContent();
    	

        $this->setTemplate('contactstore.tpl');

    }

    public function postProcess()
	{
	
     $message = Tools::getValue('message');
	
	}



    public function setMedia()
	{
		parent::setMedia();

	}

}

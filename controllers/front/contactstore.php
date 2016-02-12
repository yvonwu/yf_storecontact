<?php
class Yf_storeContactContactStoreModuleFrontController extends ModuleFrontControllerCore {
   

  	public $ssl = true;


   


	 public function initContent() {


        
    	$this->display_column_left = false;

        parent::initContent();
    	  
       if(Tools::getValue('storeid')){
       
             $stores =  array(Tools::getValue('storeid'));
      
         }else{ 

             $stores = $this->getAllSotres();

        
           //  $stores = array( array( 'id_store' => 1,'name' =>'store 1'),array( 'id_store' => 2,'name' =>'store 2'),array( 'id_store' => 3,'name' =>'store 3'));
       }


       if(Tools::getValue('subjectMails')){

        $subjectMails = array(Tools::getValue('subjectMails'));
        

       }else{
                
            $subjectMails = $this->getContacts((int)$this->context->language->id);    
            p($subjectMails);
         //  $subjectMails = array('store 1','store 2','store 3');

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

            $message = Tools::getValue('message');
            if(!$message)
             $this->errors[] = Tools::displayError('The message cannot be blank.');
            elseif (!Validate::isCleanHtml($message))
             $this->errors[] = Tools::displayError('Invalid message');



            else{


          




              $name = Tools::getValue('name');
              $firstName = Tools::getValue('firstName');
              $telephone = Tools::getValue('telephone');
             // $message = Tools::getValue('message');

              $var_list = array(
                  '{order_name}' => '-',
                  '{attached_file}' => '-',
                  '{message}' => Tools::nl2br(stripslashes($message)),
                  '{email}' =>  'wuyifan2003@hotmail.com',
                  '{product_name}' => '',
                );

             Mail::Send($this->context->language->id,'contact_form', Mail::l('Your message has been correctly sent'),$var_list, 'wuyifan2003@hotmail.com', null, null, null, null);
        
    
      
           // p($this->errors);
            if (count($this->errors) > 1)
              array_unique($this->errors);
            elseif (!count($this->errors))
              $this->context->smarty->assign('confirmation', 1);

          }
       }
	}



    public function setMedia()
	{
	  parent::setMedia();
    $this->addCSS(_THEME_CSS_DIR_.'contact-form.css');
    $this->addJS(_THEME_JS_DIR_.'contact-form.js');
    $this->addJS(_PS_JS_DIR_.'validate.js');

	}

   public function getAllSotres(){

      $stores = Db::getInstance()->executeS('
      SELECT s.*, cl.name country, st.iso_code state
      FROM '._DB_PREFIX_.'store s
      '.Shop::addSqlAssociation('store', 's').'
      LEFT JOIN '._DB_PREFIX_.'country_lang cl ON (cl.id_country = s.id_country)
      LEFT JOIN '._DB_PREFIX_.'state st ON (st.id_state = s.id_state)
      WHERE s.active = 1 AND cl.id_lang = '.(int)$this->context->language->id);


     return $stores;
   }

   public function getContacts($id_lang){

    $shop_ids = Shop::getContextListShopID();
    $sql = 'SELECT *
        FROM `'._DB_PREFIX_.'contact` c
        '.Shop::addSqlAssociation('contact', 'c', false).'
        LEFT JOIN `'._DB_PREFIX_.'contact_lang` cl ON (c.`id_contact` = cl.`id_contact`)
        WHERE cl.`id_lang` = '.(int)$id_lang.'
        AND contact_shop.`id_shop` IN ('.implode(', ', array_map('intval', $shop_ids)).')
        GROUP BY c.`id_contact`
        ORDER BY `name` ASC';
     return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
   }
   

}

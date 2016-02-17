<?php
class Yf_storeContactContactStoreModuleFrontController extends ModuleFrontControllerCore {
   

  	public $ssl = true;


   


	 public function initContent() {


        
    	$this->display_column_left = false;

      parent::initContent();
    	  
       if(Tools::getValue('storeid')){
       
             $store =  new Store(Tools::getValue('storeid'),(int)$this->context->language->id);

          if($store->name && $store->email){
             $store->storeid = Tools::getValue('storeid');
             $this->context->smarty->assign('store', $store);
           }

        }
      


        $stores = $this->getAllSotres();



   
      if($subjectMail = $this->getContact((int)Tools::getValue('objectid'),(int)$this->context->language->id))
                 $this->context->smarty->assign('subjectMail', $subjectMail);
               
       
                
        $subjectMails = $this->getContacts((int)$this->context->language->id);    

  

        $this->context->smarty->assign(array(

          'stores' => $stores,
          'subjectMails' => $subjectMails,
           'message' => html_entity_decode(Tools::getValue('message')),
           'name' => html_entity_decode(Tools::getValue('name')),
           'firstName' => html_entity_decode(Tools::getValue('firstName')),
           'telephone' => html_entity_decode(Tools::getValue('telephone')),
           'email' => html_entity_decode(Tools::getValue('email')),



          ));

        $this->setTemplate('contactstore.tpl');

    }

    public function postProcess()
	{
	   
       if (Tools::isSubmit('submitMessage')){

            $message = Tools::getValue('message');
            $telephone = Tools::getValue('telephone');
            if(!$message)
               $this->errors[] = Tools::displayError('The message cannot be blank.');
            elseif (!Validate::isCleanHtml($message))
               $this->errors[] = Tools::displayError('Invalid message');
            elseif (!($id_subject = (int)Tools::getValue('id_subject')) || !(is_array($subjectMails = $this->getContact($id_subject, $this->context->language->id))))
               $this->errors[] = Tools::displayError('Please select a subject from the list provided. ');
            elseif (!($id_store = (int)Tools::getValue('id_store')) || !(Validate::isLoadedObject($store = new Store($id_store, $this->context->language->id))))
               $this->errors[] = Tools::displayError('Please select a sotre from the list provided.');
            elseif(!Tools::getValue('name'))
                $this->errors[] = Tools::displayError('The name cannot be blank');
            elseif(!Tools::getValue('firstName'))
                $this->errors[] = Tools::displayError('The firstName cannot be blank');

            elseif( !($email = Tools::getValue('email')) || !Validate::isEmail($email))
                $this->errors[] = Tools::displayError('Invalid email');

            elseif (!Validate::isPhoneNumber($telephone))
                $this->errors[] = Tools::displayError('Invalid telephone');
          

          
                  
            
           

             else{


                    $StoreEmail= $store->email;
                    $name = Tools::getValue('name');
                    $firstName = Tools::getValue('firstName');
                    

                  if (!count($this->errors))
                  {
                    $var_list = array(
                        '{name}' => $name,
                        '{firstName}' => $firstName ,
                        '{telephone}' => $telephone  ,
                        '{subjectMails}' => $subjectMails['name'],
                        '{message}' => Tools::nl2br(stripslashes($message)),
                        '{email}' => $email,
                      );
                  

                  if( !Mail::Send($this->context->language->id,'contactstore', Mail::l('Your message has been correctly sent'),$var_list, $StoreEmail, null, null, null, null) ||
                    !Mail::Send($this->context->language->id,'contactstore', Mail::l('Your message has been correctly sent'),$var_list, $subjectMails['email'], null, null, null, null)) 
                        $this->errors[] = Tools::displayError('An error occurred while sending the message.');
                

                  }

                  if(Tools::getValue('receive_copy'))
                       Mail::Send($this->context->language->id,'contactstore', Mail::l('Your message has been correctly sent'),$var_list, $email, null, null, null, null);

               
            
            
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
    $this->addJS('https://www.google.com/recaptcha/api.js');

	}

   public function getAllSotres(){

      $stores = Db::getInstance()->executeS('
      SELECT s.*, cl.name country, st.iso_code state
      FROM '._DB_PREFIX_.'store s
      '.Shop::addSqlAssociation('store', 's').'
      LEFT JOIN '._DB_PREFIX_.'country_lang cl ON (cl.id_country = s.id_country)
      LEFT JOIN '._DB_PREFIX_.'state st ON (st.id_state = s.id_state)
      WHERE s.active = 1 AND s.email != "" AND cl.id_lang = '.(int)$this->context->language->id);


     return $stores;
   }

   public function getContacts($id_lang){

    $shop_ids = Shop::getContextListShopID();
    $sql = 'SELECT *
        FROM `'._DB_PREFIX_.'contactstore` c
        LEFT JOIN ps_contactstore_shop contact_shop ON (contact_shop.id_contact = c.id_contact AND contact_shop.id_shop = 1)
        LEFT JOIN `'._DB_PREFIX_.'contactstore_lang` cl ON (c.`id_contact` = cl.`id_contact`)
        WHERE cl.`id_lang` = '.(int)$id_lang.'
        AND contact_shop.`id_shop` IN ('.implode(', ', array_map('intval', $shop_ids)).')
        GROUP BY c.`id_contact`
        ORDER BY `name` ASC';

   //p($sql);
     return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
   }


   public function getContact($objectid,$id_lang){

    $shop_ids = Shop::getContextListShopID();
    $sql = 'SELECT *
        FROM `'._DB_PREFIX_.'contactstore` c
        LEFT JOIN ps_contactstore_shop contact_shop ON (contact_shop.id_contact = c.id_contact AND contact_shop.id_shop = 1)
        LEFT JOIN `'._DB_PREFIX_.'contactstore_lang` cl ON (c.`id_contact` = cl.`id_contact`)
        WHERE cl.`id_lang` = '.(int)$id_lang.' AND c.`id_contact` = '. $objectid .'
        AND contact_shop.`id_shop` IN ('.implode(', ', array_map('intval', $shop_ids)).')';

   //p($sql);
     return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
   }

}

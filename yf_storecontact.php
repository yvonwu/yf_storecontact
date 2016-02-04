<?php

if (!defined('_PS_VERSION_'))
  exit;

  class Yf_StoreContact extends Module
{
   
    public function __construct()
  {
    $this->name = 'yf_storecontact';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Yvon WU';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;
 
    parent::__construct();
 
    $this->displayName = $this->l('Contact store');
    $this->description = $this->l('send a formular to the store');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    if (!Configuration::get('YF_STORECONTACT_NAME'))      
      $this->warning = $this->l('No name provided');
  }

   public function install()
	{	
    
	  if (!parent::install())
	    return false;
	  return true;
	}

	public function uninstall()
	{
  			if (!parent::uninstall())
   			 return false;
 		return true;
	}

	
	public function getContent()
	{
	    $output = null;
	 
	    if (Tools::isSubmit('submit'.$this->name))
	    {
	        $yf_storecontact = strval(Tools::getValue('YF_STORECONTACT_NAME'));
	        if (!$yf_storecontact
	          || empty($yf_storecontact)
	          || !Validate::isGenericName($yf_storecontact))
	            $output .= $this->displayError($this->l('Invalid Configuration value'));
	        else
	        {
	            Configuration::updateValue('YF_STORECONTACT_NAME', $yf_storecontact);
	            $output .= $this->displayConfirmation($this->l('Settings updated'));
	        }
	    }
	    return $output.$this->displayForm();
	}

	public function displayForm()
{
    // Get default language
    $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
     
    // Init Fields form array
    $fields_form[0]['form'] = array(
        'legend' => array(
            'title' => $this->l('Settings'),
        ),
        'input' => array(
            array(
                'type' => 'text',
                'label' => $this->l('Configuration value'),
                'name' => 'YF_STORECONTACT_NAME',
                'size' => 20,
                'required' => true
            )
        ),
        'submit' => array(
            'title' => $this->l('Save'),
            'class' => 'button'
        )
    );
     
    $helper = new HelperForm();
     
    // Module, token and currentIndex
    $helper->module = $this;
    $helper->name_controller = $this->name;
    $helper->token = Tools::getAdminTokenLite('AdminModules');
    $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
     
    // Language
    $helper->default_form_language = $default_lang;
    $helper->allow_employee_form_lang = $default_lang;
     
    // Title and toolbar
    $helper->title = $this->displayName;
    $helper->show_toolbar = true;        // false -> remove toolbar
    $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
    $helper->submit_action = 'submit'.$this->name;
    $helper->toolbar_btn = array(
        'save' =>
        array(
            'desc' => $this->l('Save'),
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
            '&token='.Tools::getAdminTokenLite('AdminModules'),
        ),
        'back' => array(
            'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Back to list')
        )
    );
     
    // Load current value
    $helper->fields_value['YF_STORECONTACT_NAME'] = Configuration::get('YF_STORECONTACT_NAME');
     
    return $helper->generateForm($fields_form);
}


}



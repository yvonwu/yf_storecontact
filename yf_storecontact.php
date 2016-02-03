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
    $this->description = $this->l('send a formular to thestore ');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    if (!Configuration::get('YF_STORECONTACT_NAME'))      
      $this->warning = $this->l('No name provided');
  }

   public function install()
	{	

	}
	
	public function uninstall()
	{
  			if (!parent::uninstall())
   			 return false;
 		return true;
	}

}



{if isset($confirmation)}
	<p class="alert alert-success">{l s='Your message has been successfully sent to our team.'}</p>
	<ul class="footer_links clearfix">
		<li>
			<a class="btn btn-default button button-small" href="{$base_dir}">
				<span>
					<i class="icon-chevron-left"></i>{l s='Home'}


				</span>
			</a>
		</li>
	</ul>
{elseif isset($alreadySent)}
	<p class="alert alert-warning">{l s='Your message has already been sent.'}</p>
	<ul class="footer_links clearfix">
		<li>
			<a class="btn btn-default button button-small" href="{$base_dir}">
				<span>
					<i class="icon-chevron-left"></i>{l s='Home'}
				</span>
			</a>
		</li>
	</ul>
{else}
   {include file="$tpl_dir./errors.tpl"}

{capture name=path}{l s='Contact'}{/capture}
<h1 class="page-heading bottom-indent">

	{if isset($store) && $store}
	  {l s='Contact store' mod='yf_storecontact'} {$store->city|escape:'html':'UTF-8'|upper} ({$store->postcode|escape:'html':'UTF-8'|upper})
    {else}
	  {l s='Contact our stores' mod='yf_storecontact'}
	{/if}
</h1>

<form action="{$request_uri}" method="post" class="contact-form-box" enctype="multipart/form-data">
 		<fieldset>
 			
					<div class="clearfix">
							<div class="col-xs-12 col-md-3">
								
								<div class="form-group selector1">
                                   
                                        {*$store|@print_r*}

									<label for="id_store">{l s='Store name' mod='yf_storecontact'}:</label>
                                        {if isset($store) && $store}
                                        
                                         <input class="form-control" type="text" placeholder="{$store->city|escape:'html':'UTF-8'|upper}" readonly>
                                          <input type="hidden" name="id_store" value="{$store->storeid|escape:'html':'UTF-8'}">

                                        {else}
										 	<select id="id_store" class="form-control" name="id_store">

													<option value="0">{l s='-- Choose --' mod='yf_storecontact'}</option>
														{foreach from=$stores item=store}
                                                        	<option value="{$store.id_store|escape:'html':'UTF-8'}" {if isset($smarty.request.id_store) && $smarty.request.id_store == $store.id_store} selected="selected"{/if}>{$store.city|escape:'html':'UTF-8'|upper}</option>
														{/foreach}

 
							
									        </select>
									       <small  class="text-muted"> <a href="{{$link->getPageLink('stores')|escape:'html':'UTF-8'}}" ref="{l s='Find a store' mod='yf_storecontact'}">{l s='Find a store' mod='yf_storecontact'}</a></small>

                                           <br/>
                                         {/if}

                                         {if isset($subjectMail) && $subjectMail}
                                          <label for="id_subject">{l s='Subject' mod='yf_storecontact'}:</label>
                                          <input class="form-control" type="text" placeholder="{$subjectMail.name}" readonly>
                                          <input type="hidden" name="id_subject" value="{$subjectMail.id_contact}">
                                         {else}

									       <label for="id_subject">{l s='Subject' mod='yf_storecontact'}:</label>

										 	 <select id="id_subject" class="form-control" name="id_subject">
													<option value="0">{l s='-- Choose --' mod='yf_storecontact'}</option>

													{foreach from=$subjectMails item=subjectMail}
                                                        	<option value="{$subjectMail.id_contact|escape:'html':'UTF-8'}" {if isset($smarty.request.id_subject) && $smarty.request.id_subject == $subjectMail.id_contact} selected="selected"{/if}>{$subjectMail.name|escape:'html':'UTF-8'}</option>
													{/foreach}
							
									        </select>
									     {/if}

                                 </div>
                                <div class="form-group">
									<label for="name">{l s='Name'  mod='yf_storecontact'}:*</label>
                                     <input class="form-control grey validate" type="text" id="name" name="name" data-validate="isName" value="{if isset($name)}{$name|escape:'html':'UTF-8'|stripslashes}{/if}" />
								</div>

								<div class="form-group">		

                                      <label for="firstName">{l s='First Name'  mod='yf_storecontact'}:*</label>

                                      <input class="form-control grey validate" type="text" id="firstName" name="firstName" data-validate="isName" value="{if isset($firstName)}{$firstName|escape:'html':'UTF-8'|stripslashes}{/if}" />
                                </div>

                                <div class="form-group">

                                      <label for="telephone">{l s='Telephone'  mod='yf_storecontact'}:</label>

                                      <input class="form-control grey validate" type="text" id="telephone" name="telephone" data-validate="isPhoneNumber" value="{if isset($telephone)}{$telephone|escape:'html':'UTF-8'|stripslashes}{/if}" />
                                </div>

										
										
										<p class="form-group">
											<label for="email">{l s='Email address'  mod='yf_storecontact'}:*</label>
									
												<input class="form-control grey validate" type="text" id="email" name="email" data-validate="isEmail" value="{if isset($email)}{$email|escape:'html':'UTF-8'|stripslashes}{/if}" />
										
										</p>
 
								
							</div>

							<div class="col-xs-12 col-md-9">
								<div class="form-group">
									<label for="message">{l s='Message'  mod='yf_storecontact'}:</label>
									<textarea class="form-control validate" id="message" name="message" data-validate="isMessage" >{if isset($message)}{$message|escape:'html':'UTF-8'|stripslashes}{/if}</textarea>
								</div>
							</div>

				    </div>
             <div class="checkbox">
    			<label>
    				  <input type="checkbox" name="receive_copy" checked> {l s='Receive a copy'  mod='yf_storecontact'}
    			</label>
  			</div>

  			<div>
				<div class="g-recaptcha" data-sitekey="6LfHuBcTAAAAAN7Hw9Fay5v8bBQJuiI47FPahin9"></div>
  		    </div>

             <div class="submit">
				<button type="submit" name="submitMessage" id="submitMessage" class="button btn btn-default button-medium"><span>{l s='Send' mod='yf_storecontact'}<i class="icon-chevron-right right"></i></span></button>
			</div>
            
           

           <p>*{l s='Required fields' mod='yf_storecontact'}</p>
 	    </fieldset>

</form>
{/if}



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


{capture name=path}{l s='Contact'}{/capture}
<h1 class="page-heading bottom-indent">
	{l s='Contact our stores' mod='yf_storecontact'}
</h1>

<form action="{$request_uri}" method="post" class="contact-form-box" enctype="multipart/form-data">
 		<fieldset>
 			
					<div class="clearfix">
							<div class="col-xs-12 col-md-3">
								
								<div class="form-group selector1">
                                   

									<label for="id_store">{l s='Store name' mod='yf_storecontact'}:</label>

										 	 <select id="id_store" class="form-control" name="id_store">
													<option value="0">{l s='-- Choose --' mod='yf_storecontact'}</option>
														{foreach from=$stores item=store}
                                                        	<option value="{$store.id_store|escape:'html':'UTF-8'}">{$store.name|escape:'html':'UTF-8'}</option>
														{/foreach}

 
							
									        </select>
									       <small  class="text-muted"> <a href="{{$link->getPageLink('stores')|escape:'html':'UTF-8'}}" ref="{l s='Find a store' mod='yf_storecontact'}">{l s='Find a store' mod='yf_storecontact'}</a></small>

                                           <br/>

									       <label for="id_subject">{l s='Subject' mod='yf_storecontact'}:</label>

										 	 <select id="id_subject" class="form-control" name="id_subject">
													<option value="0">{l s='-- Choose --' mod='yf_storecontact'}</option>

													{foreach from=$subjectMails item=subjectMail}
                                                        	<option value="" >{$subjectMail|escape:'html':'UTF-8'}</option>
														{/foreach}
							
									</select>

                                 </div>
                                <div class="form-group">
									<label for="id_contact">{l s='Name'  mod='yf_storecontact'}:*</label>
                                     <input class="form-control grey validate" type="text" id="name" name="name" data-validate="isName" value="" />
								</div>

								<div class="form-group">		

                                      <label for="id_contact">{l s='First Name'  mod='yf_storecontact'}:*</label>

                                      <input class="form-control grey validate" type="text" id="firstName" name="firstName" data-validate="isName" value="" />
                                </div>

                                <div class="form-group">

                                      <label for="id_contact">{l s='Telephone'  mod='yf_storecontact'}:</label>

                                      <input class="form-control grey validate" type="text" id="telephone" name="telephone" data-validate="isPhoneNumber" value="" />
                                </div>

										
										
										<p class="form-group">
											<label for="email">{l s='Email address'  mod='yf_storecontact'}:*</label>
									
												<input class="form-control grey validate" type="text" id="email" name="from" data-validate="isEmail" value="" />
										
										</p>
 
								</div>
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
    				  <input type="checkbox"> {l s='Receive a copy'  mod='yf_storecontact'}
    			</label>
  			</div>

             <div class="submit">
				<button type="submit" name="submitMessage" id="submitMessage" class="button btn btn-default button-medium"><span>{l s='Send' mod='yf_storecontact'}<i class="icon-chevron-right right"></i></span></button>
			</div>
            
           

           <p>*{l s='Required fields' mod='yf_storecontact'}</p>
 	    </fieldset>

</form>
{/if}
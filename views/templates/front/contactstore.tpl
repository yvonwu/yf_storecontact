
{$stores[]="store1,store2,store3"}

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
	{l s='Contact our stores'}
</h1>

<form action="{$request_uri}" method="post" class="contact-form-box" enctype="multipart/form-data">
 		<fieldset>
 			
					<div class="clearfix">
							<div class="col-xs-12 col-md-3">
								
								<div class="form-group selector1">
                                   

									<label for="id_contact">{l s='Store'}</label>

										 	 <select id="id_contact" class="form-control" name="id_contact">
													<option value="0">{l s='-- Choose --'}</option>
														{foreach from=$stores item=store}
                                                        	<option value="" >{$store|escape:'html':'UTF-8'}</option>
														{/foreach}

 
							
									        </select>
									       <small  class="text-muted"> <a href="">{l s='Find a store'}</a></small>



									       <label for="id_contact">{l s='Subject Heading'}</label>

										 	 <select id="id_contact" class="form-control" name="id_contact">
													<option value="0">{l s='-- Choose --'}</option>
							
									</select>



									<label for="id_contact">{l s='Name'}*</label>
                                     <input class="form-control grey validate" type="text" id="email" name="from" data-validate="isEmail" value="" />
										

                                      <label for="id_contact">{l s='First Name'}*</label>

                                      <input class="form-control grey validate" type="text" id="email" name="from" data-validate="isEmail" value="" />


                                      <label for="id_contact">{l s='Telephone'}</label>

                                      <input class="form-control grey validate" type="text" id="email" name="from" data-validate="isEmail" value="" />

										

										
										<p class="form-group">
											<label for="email">{l s='Email address'}*</label>
									
												<input class="form-control grey validate" type="text" id="email" name="from" data-validate="isEmail" value="" />
										
										</p>
 
								</div>
							</div>

							<div class="col-xs-12 col-md-9">
								<div class="form-group">
									<label for="message">{l s='Message'}</label>
									<textarea class="form-control" id="message" name="message">{if isset($message)}{$message|escape:'html':'UTF-8'|stripslashes}{/if}</textarea>
								</div>
							</div>

				    </div>
             <div class="checkbox">
    			<label>
    				  <input type="checkbox"> Check me out
    			</label>
  			</div>

             <div class="submit">
				<button type="submit" name="submitMessage" id="submitMessage" class="button btn btn-default button-medium"><span>{l s='Send'}<i class="icon-chevron-right right"></i></span></button>
			</div>
            
           

           <p>*{l s='Required fields'}</p>
 	    </fieldset>

</form>
{/if}

<div class="body_box">
    <div class="h_pad10 txtLeft">
        <div class="headline"><h4 class="fs16 bold"><?=$pageData->label->label->account_resetpwd->icon.' '.$pageData->label->label->account_resetpwd->title?></h4></div>
        <?php if($pageData->data->content->init){ ?>
        <form class="ajaxfrm" role="form" id="ini_reset_pwd-form" data-func="submit_form" data-reset="1" action="" method="post"> 
            <div class="row">
            	<div class="col-xs-12 col-md-6">
                	<div class="form-group row">                	
                        <div class="col-xs-12">
                        <label for="reset_email"><?=$pageData->label->label->email->title?></label>
                        <input type="email" name="reset_email" class="form-control" placeholder="<?=$pageData->label->label->email->title?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="captcha"><?=$pageData->label->label->verify_code->title?></label> <span class="redStar">*</span>
                        <div class="row">                        
                            <div class="col-xs-6">
                            <input type="text" name="captcha" class="form-control" placeholder="<?=$pageData->label->label->code->title?>">
                            </div>
                            <div class="col-xs-6">
                                <div class="input-append input-group captchabox">
                                    <div id="captcha_img" class="form-control"></div>
                                    <span class="input-group-addon add-on renew_captcha click tooltips" title="<?=$pageData->label->label->change_code->title?>"><i class="fa fa-refresh"></i></span>
                               </div>
                            </div>
                        </div>
                    </div>                           
                    <div class="form-group row">
                        <div class="col-xs-12 col-md-6">
                            <input type="hidden" name="cmd" value="reset_pwd">
                            <button type="submit" class="btn btn-info"><?=$pageData->label->label->send->icon.' '.$pageData->label->label->send->title?></button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12">                  	
                            <div id="ini_reset_pwd_msg" data-loadtxt='<?=$pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title?>'></div>
                        </div>
                    </div>          
                </div>
            	<div class="col-xs-12 col-md-6">
                	<div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                        <h2 class="fs18 greencolor"><?=$pageData->data->content->note->title?></h2>
                        <?=$pageData->data->content->note->description?>
                    </div>
                </div>
            </div>
        </form>
        <?php 
		
		}else{
			if($pageData->data->content->valid_code){
		?>
        <form class="ajaxfrm" role="form" id="reset_pwd-form" data-func="submit_form" data-reset="1" action="" method="post"> 
              <div class="row">
                 <div class="col-xs-12 col-md-6">
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <label for="account_newpassword"><?=$pageData->label->label->account_newpwd->title?></label>
                            <input type="password" name="account_newpassword" class="form-control" placeholder="<?=$pageData->label->label->account_newpwd->title?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <label for="account_newpassword_confirm"><?=$pageData->label->label->account_newpwd->title?> (<?=$pageData->label->label->retype->title?>)</label>
                            <input type="password" name="account_newpassword_confirm" class="form-control" placeholder="<?=$pageData->label->label->retype->title?>">
                        </div>
                    </div>                          
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <input type="hidden" name="reset_code" value="<?=$pageData->data->content->reset_code?>">
                            <input type="hidden" name="cmd" value="reset_pwd">
                            <button type="submit" class="btn btn-info"><?=$pageData->label->label->reset_pwdnow->icon.' '.$pageData->label->label->reset_pwdnow->title?></button>
                        </div>
                    </div>
                    <div class="form-group row">   
                        <div class="col-xs-12">                 	
                            <div id="reset_pwd_msg" data-loadtxt='<?=$pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title?>'></div>
                        </div>
                    </div> 
            	</div>
            	<div class="col-xs-12 col-md-6">
                	<div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                        <h2 class="fs18 greencolor"><i class="icon-custom icon-bg-u fa fa-lightbulb-o"></i> How to reset your account password</h2>
                        <p>
                        	<ol>
                            	<li>Fill you login account email and secuirty code</li>
                                <li>Check you email inbox and find the reset link (instruction provided within the email)</li>
                                <li>Click or copy and paste the link to the browser</li>
                                <li>Fill your new password</li>
                            </ol>
                            Having done all the above steps, you can use your new password for the further login.
                        </p>
                        <div class="alert alert-info v_mgn10"><i class="fa fa-question-circle"></i> If you still have troubles with your account login, please contact us via our contact information below.</div>
                    </div>
                </div>   
            </div>               
        </form>
        <?php 
			}else{	
				echo '<div class="alert alert-danger txtCenter">'.$pageData->data->content->msg.'</div>';		
			}
		}		
		?>
    </div> 	
</div>   
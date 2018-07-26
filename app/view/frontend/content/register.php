<?php $reg_note = $pageData->data->content->reg_note; ?>
<div class="log-reg-v3 bg-white">
    <form class="ajaxfrm log-reg-block" role="form" id="register-form" data-func="submit_form" data-reset="1" action="" method="post">
        <div><?=$reg_note['description']?></div>
        <div class="login-input reg-input">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->fullname->title?> (<?=$pageData->label->label->kh->title?>)</label>
                        <label class="input">
                            <input type="text" name="fullname_kh" placeholder="<?=$pageData->label->label->fullname->title?>" class="form-control">
                        </label>
                    </section>
                </div>
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->fullname->title?> (<?=$pageData->label->label->en->title?>)</label>
                        <label class="input">
                            <input type="text" name="fullname_en" placeholder="<?=$pageData->label->label->fullname->title?>" class="form-control">
                        </label>
                    </section>
                </div>
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->gender->title?></label>
                        <select name="gender" class="form-control">
                            <option value="" selected><?=$pageData->label->label->select_option->title?></option>
                            <option value="m"><?=$pageData->label->label->m->title?></option>
                            <option value="f"><?=$pageData->label->label->f->title?></option>
                        </select>
                    </section>
                </div>
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->dob->title?></label>
                        <div class="input-append input-group dtpicker_notstrick">
                            <input data-format="yyyy-MM-dd" name="dob" type="text" placeholder="YY-MM-DD" class="form-control searchinputs">
                            <span class="input-group-addon add-on"><i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar" class="fa fa-calendar"></i></span>
                        </div>
                        <div id="dob_msg"></div>
                    </section>
                </div>
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->id_card->title?></label>
                        <label class="input">
                            <input type="text" name="id_card" placeholder="<?=$pageData->label->label->id_card->title?>" class="form-control">
                        </label>
                    </section>
                </div>
            </div>  
            <div class="row">
            	<div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->passport->title?></label>
                        <label class="input">
                            <input type="text" name="passport" placeholder="<?=$pageData->label->label->passport->title?>" class="form-control">
                        </label>
                    </section>
                </div>
                <div class="col-sm-12 col-md-8">
                    <section>
                        <label><?=$pageData->label->label->address->title?></label>
                        <label class="input">
                            <input type="text" name="address" placeholder="<?=$pageData->label->label->address->title?>" class="form-control">
                        </label>
                    </section>
                </div>                
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->homeno->title?></label>
                        <label class="input">
                            <input type="text" name="homeno" placeholder="<?=$pageData->label->label->homeno->title?>" class="form-control">
                        </label>
                    </section>
                </div>
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->street->title?></label>
                        <label class="input">
                            <input type="text" name="street" placeholder="<?=$pageData->label->label->street->title?>" class="form-control">
                        </label>
                    </section>
                </div>
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->group->title?></label>
                        <label class="input">
                            <input type="text" name="group" placeholder="<?=$pageData->label->label->group->title?>" class="form-control">
                        </label>
                    </section>
                </div>
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->mobile->title?></label>
                        <label class="input">
                            <input type="tel" name="mobile" placeholder="<?=$pageData->label->label->mobile->title?>" class="form-control">
                        </label>
                    </section>
                </div>       
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->email->title?></label>
                        <label class="input">
                            <input type="email" name="email" placeholder="<?=$pageData->label->label->email->title?>" class="form-control">
                        </label>
                    </section>
                </div>   
            </div>   
            <div class="row">     
            	<div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->username->title?></label>
                        <label class="input">
                            <input type="text" name="username" placeholder="<?=$pageData->label->label->username->title?>" class="form-control">
                        </label>
                    </section>
                </div>       
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->password->title?></label>
                        <label class="input">
                            <input type="password" name="password" placeholder="<?=$pageData->label->label->password->title?>" class="form-control">
                        </label>
                    </section>
                </div> 
                <div class="col-sm-6 col-md-4">
                    <section>
                        <label><?=$pageData->label->label->password->title?> (<?=$pageData->label->label->retype->title?>)</label>
                        <label class="input">
                            <input type="password" name="confirm_password" placeholder="<?=$pageData->label->label->password->title?>" class="form-control">
                        </label>
                    </section>
                </div>              
            </div>                            
             
        </div>
        
        <label class="margin-bottom-20">
            <label class="checkbox">
            <input type="checkbox" name="agreed_terms"/>
            <i></i>
           		<?=str_replace('[url]','/'.$pageData->lang->selected.$pageData->label->label->term_verify_txt->url,$pageData->label->label->term_verify_txt->title)?> 
            </label> 
            <div id="agreed_terms_msg"></div>                   
        </label>
        <div class="login-input reg-input">
            <label for="captcha"><?=$pageData->label->label->verify_code->title?></label> <span class="redStar">*</span>
            <div class="row margin-bottom-10">                    
                <div class="col-xs-5 col-sm-4 col-md-3">
                <input type="text" name="captcha" class="form-control" placeholder="<?=$pageData->label->label->code->title?>">
                </div>
                <div class="col-xs-7 col-sm-5 col-md-4 col-lg-3">
                    <div class="input-append input-group captchabox">
                        <div id="captcha_img" class="form-control"></div>
                        <span class="input-group-addon add-on renew_captcha click tooltips" title="<?=$pageData->label->label->change_code->title?>"><i class="fa fa-refresh"></i></span>
                   </div>
                </div>
            </div>
        </div> 
        <input type="hidden" name="cmd" value="register" />
        <button class="btn-u btn-u-sea-shop margin-bottom-20" type="submit"><?=$pageData->label->label->create_account->icon?> <?=$pageData->label->label->create_account->title?></button>
        <div id="register_msg" data-loadtxt='<?=$pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title?>'></div>
    </form>
</div>
<!--=== End Registre ===-->
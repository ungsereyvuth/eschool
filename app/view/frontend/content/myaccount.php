<?php
$picPath = web_config('resized_pic_path');$no_pic = web_config('no_pic');
//profile photo
$photo=$picPath.$pageData->data->content->userinfo->photo;
if($photo<>$picPath){$photo = !file_exists($_SERVER['DOCUMENT_ROOT'].$photo)?$no_pic:$photo;}else{$photo =$no_pic;}


?>
<div class="page_content bg-white">
	<!-- Tab v1 -->
	<div class="tab-v2">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
			<li><a href="#account" data-toggle="tab">Account</a></li>
			<li><a href="#activity" data-toggle="tab">Activity</a></li>
			<li><a href="#setting" data-toggle="tab">Setting</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="profile">
				<form class="ajaxfrm" role="form" id="memberprofile_update-form" data-func="submit_form" data-reset="0" action="" method="post">
					<div class="row">
		                <div class="col-xs-12 col-sm-5 pull-right">
		                    <div class="profile-pic">
	                            <div class="uploadpic_title txtCenter">Logo ឬ រូបភាព</div>                      
	                            <a href="<?=$photo?>" rel="prettyPhoto"><img id="photo_pre" width="100%" src="<?=$photo?>"></a>
	                            <div class="uploadpic txtCenter">
	                                <input type="file" name="photo" data-pretarget="#photo_pre" class="form-control file-to-preview">
	                            </div>
	                        </div>
		                </div>
		                <div class="col-xs-12 col-sm-7">		                    
	                    	<div class="row margin-bottom-10">
	                            <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->fullname->title?> (<?=$pageData->label->label->kh->title?>)</label>
	                                    <input type="text" name="fullname_kh" placeholder="First name" class="form-control" value="<?=$pageData->data->content->userinfo->fullname_kh?>">
	                            </div>
	                            <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->fullname->title?> (<?=$pageData->label->label->en->title?>)</label>
	                                    <input type="text" name="fullname_en" placeholder="Last name" class="form-control" value="<?=$pageData->data->content->userinfo->fullname_en?>">
	                            </div>
	                        </div>
	                        <div class="row margin-bottom-10">
	                            <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->gender->title?></label>
	                                    <select class="form-control" name="gender">
	                                    	<option value="m" <?=$pageData->data->content->userinfo->gender=='m'?'selected':''?>><?=$pageData->label->label->m->title?></option>
	                                    	<option value="f" <?=$pageData->data->content->userinfo->gender=='f'?'selected':''?>><?=$pageData->label->label->f->title?></option>
	                                    </select>
	                            </div>
                                <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->nationality->title?></label>
	                                    <select class="form-control" name="nationality">
                                            <?=$pageData->data->content->userinfo->nationality_select?>                                      
                                        </select>
	                            </div>
	                        </div>
	                        <div class="row margin-bottom-10">	                            
	                            <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->dob->title?></label>
	                                    <div class="input-append input-group dtpicker_notstrick">
											<input data-format="yyyy-MM-dd" name="dob" type="text" placeholder="YY-MM-DD" class="form-control" value="<?=$pageData->data->content->userinfo->dob?>">
											<span class="input-group-addon add-on"><i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar" class="fa fa-calendar"></i></span>
										</div>
                                        <div id="dob_msg"></div>
	                            </div>	 
                                <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->id_card->title?></label>
	                                    <input type="text" name="id_card" placeholder="ID Card" class="form-control" value="<?=$pageData->data->content->userinfo->id_card?>">
	                            </div>                           
	                        </div>
	                        <div class="row margin-bottom-10">	                            
	                            <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->mobile->title?></label>
	                                    <input type="text" name="mobile" placeholder="Mobile" class="form-control" value="<?=$pageData->data->content->userinfo->mobile?>">
	                            </div>
                                <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->email->title?></label>
	                                    <input type="text" name="email" placeholder="Email" class="form-control" value="<?=$pageData->data->content->userinfo->email?>">
	                            </div>	                                                            
	                        </div>
	                        <div class="row margin-bottom-10">	  
                            	<div class="col-sm-6">
	                                	<label><?=$pageData->label->label->address->title?></label>
	                                    <input type="text" name="address" placeholder="Address" class="form-control" value="<?=$pageData->data->content->userinfo->address?>">
	                            </div>	                          
	                            <div class="col-sm-6">
	                                	<label><?=$pageData->label->label->provincecity->title?></label>
	                                	<select class="form-control" name="provincecity">
	                                    <?=$pageData->data->content->userinfo->provincecity_select?>
	                                	</select>
	                            </div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-xs-12">
	                        		<input type="hidden" name="recordid" value="<?=encodeString($pageData->data->content->userinfo->id,$encryptKey);?>" />
	                        		<input type="hidden" name="cmd" value="memberprofile_update" />
				                    <button class="btn-u btn-u-sea-shop margin-bottom-10" type="submit">Save</button>
				                    <div id="memberprofile_update_msg" data-loadtxt='<?=$pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title?>'></div>
	                        	</div>
	                        </div>	
		                </div>	                
		            </div>
	            </form>
			</div>
			<div class="tab-pane fade in" id="account">
				<form class="ajaxfrm" role="form" id="memberaccount_update-form" data-func="submit_form" data-reset="0" action="" method="post">
                	<div class="row margin-bottom-10">
                        <div class="col-sm-6">
                            	<label>Username</label>
                                <input type="text" name="username" placeholder="Username" class="form-control" value="<?=$pageData->data->content->userinfo->username?>">
                        </div>
                    </div>
                	<div class="row margin-bottom-10">
                        <div class="col-sm-6">
                            	<label>Currently Password</label>
                                <input type="password" name="cpwd" placeholder="Currently Password" class="form-control">
                        </div>
                    </div>
                    <div class="row margin-bottom-10">
                        <div class="col-sm-6">
                            	<label>New Password</label>
                               <input type="password" name="npwd" placeholder="New Password" class="form-control">
                        </div>
                    </div>
                    <div class="row margin-bottom-10">
                        <div class="col-sm-6">
                            	<label>Repeat New Password</label>
                                <input type="password" name="rpwd" placeholder="Repeat New Password" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-12">
                    		<input type="hidden" name="recordid" value="<?=encodeString($pageData->data->content->userinfo->id,$encryptKey);?>" />
                    		<input type="hidden" name="cmd" value="memberaccount_update" />
		                    <button class="btn-u btn-u-sea-shop margin-bottom-10" type="submit">Save</button>
		                    <div id="memberaccount_update_msg" data-loadtxt='<?=$pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title?>'></div>
                    	</div>
                    </div>	                        
                </form>
			</div>
			<div class="tab-pane fade in" id="activity">
				No Data
			</div>
			<div class="tab-pane fade in" id="setting">
				No Data
			</div>
		</div>
	</div>
	<!-- End Tab v1 -->
</div>
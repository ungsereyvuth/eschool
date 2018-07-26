<div class="col-sm-<?=$col_sidebar?> col-sm-pull-<?=(12-$col_sidebar)?> pad10">
	<?php if($usersession->isLogin()){
		//if(!isAdmin($usersession->info()->id)){
			/*$menu = '<ul class="list-group sidebar-nav-v1" id="sidebar-nav">';
			var_dump( $pageData->data->component->sidebar->user_menu);
			foreach($pageData->data->component->sidebar->user_menu as $key=>$value){
				$menu .= '<li class="list-group-item"><a href="/'.$pageData->lang->selected.$value['url'].'">'.$value['title'].'</a></li>';
			}
			$menu .= '</ul>';
			echo $menu;		*/
			
			$picPath = web_config('thumbnail_path');$avatar =$no_pic = web_config('no_pic');$photo=$usersession->info()->photo;
			if($photo<>''){
				$avatar =$picPath.$photo;
				$avatar = (!file_exists($_SERVER['DOCUMENT_ROOT'].$avatar))?$no_pic:$avatar;
			}
	?>
    
    <div class="nav-side-menu margin-bottom-10">
        <div class="brand">
        	<div class="inline-block v_pad5 h_mgn5" style="width:30px;">
			<img src="/assets/frontend/img/blank_img_square.png" class="img-responsive bg_pic_cover media-object rounded-x inline-block" style="background-image: url(<?=$avatar?>);">
            </div>
			<?=mb_convert_case($usersession->info()->fullname, MB_CASE_TITLE, 'UTF-8')?>
        </div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>      
            <div class="menu-list">      
                <ul id="menu-content" class="menu-content collapse out">
                	<?php		
					$active_page = $pageData->fileview;
					$active_page_id = isset($pageData->label->label->$active_page->id)?$pageData->label->label->$active_page->id:0;
					if(isset($pageData->data->component->sidebar->user_menu)){
						foreach($pageData->data->component->sidebar->user_menu as $key=>$value){
							if(isset($value['child']) and is_array($value['child'])){
								$sub_menu='';$sub_active=false;
								foreach($value['child'] as $sub_key=>$sub_value){
									if($active_page_id==$sub_value['page_id']){$active_class='active';$sub_active=true;}else{$active_class='';}
									$sub_menu.='<li class="'.$active_class.'"><a href="/'.$pageData->lang->selected.$sub_value['url'].'">'.$sub_value['icon'].' '.$sub_value['title'].'<span id="menu_'.$sub_value['code'].'"></span></a></li>';
								}
								echo '<li data-toggle="collapse" data-target="#menu_'.$value['id'].'" class="collapsed">
										 <a href="#" data-toggle="collapse">'.$value['icon'].' '.$value['title'].'<span id="menu_'.$value['code'].'"></span> <span class="arrow"></span></a>									 
									</li>
									<ul id="menu_'.$value['id'].'" class="sub-menu collapse '.($sub_active?'in':'').'">'.$sub_menu.'</ul>';
							}else{
								echo '<li class="'.($active_page_id==$value['page_id']?'active':'').'"><a href="/'.$pageData->lang->selected.$value['url'].'">'.$value['icon'].' '.$value['title'].'<span id="menu_'.$value['code'].'"></span></a></li>';
							}
						}
					}
					?>
                </ul>
         </div>
    </div>
    <?php	
		//}		
	}else{?>    
    <div class="body_box margin-bottom-10">
    	<div class="headline"><h3 class="heading-sm"><?=$pageData->label->label->login->title?></h3></div>
        <div>
        <form id="login" method="post" class="ajaxfrm form-horizontal" role="form">
            <section>
                <div id="login_msg" data-loadtxt='<?=$pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title?>'></div>
            </section>
            <section>
                <label class="input login-input">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" placeholder="<?=$pageData->label->label->username->title?>" id="email" class="form-control">
                    </div>
                </label>
            </section>
            <section>
                <label class="input login-input no-border-top">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" placeholder="<?=$pageData->label->label->password->title?>" id="password" class="form-control">
                    </div>
                </label>
            </section>
            <section>
                <label class="input login-input no-border-top">
                     <a href="/<?=$pageData->lang->selected.$pageData->label->label->account_resetpwd->url?>"><?=$pageData->label->label->forget_pwd->icon.' '.$pageData->label->label->forget_pwd->title?></a>
                </label>
            </section>
            <button class="btn btn-info btn-sm btn-block" type="submit"><?=$pageData->label->label->login->title?></button>
        </form>
        </div>
    </div>
       
    <?php }?>
    <div class="body_box margin-bottom-10 bg-red">
    	<div class="headline"><h3 class="heading-sm whitecolor"><?=$pageData->data->component->sidebar->note->title?></h3></div>
        <ul class="list-unstyled link-list">
        	<div class="whitecolor"><?=str_replace(array('<p>','</p>'),'',$pageData->data->component->sidebar->note->description)?></div>
        </ul>
    </div>
    <div class="body_box margin-bottom-10">
    	<div class="headline"><h3 class="heading-sm"><?=$pageData->label->label->license->title?></h3></div>
        <ul class="list-unstyled link-list">
		<?php
		foreach($pageData->data->component->sidebar->license_cate as $key=>$value){
			$url = $pageData->lang->selected.$pageData->label->label->license_detail->url.'/'.encodeString($value['id'].'_'.time(),$encryptKey);
			echo '<li><a href="/'.$url.'" class="graycolor fs13"><span class="fa fa-caret-right"></span> '.$value['title'].'</a><i class="fa fa-angle-right"></i></li>';
		}	
		
		?>
        </ul>
    </div>
	<div class="body_box">
    	<div class="headline"><h3 class="heading-sm"><?=$pageData->label->label->doc->title?></h3></div>
        <ul class="list-unstyled link-list">
		<?php
		foreach($pageData->data->component->sidebar->doc as $key=>$value){
			//url
			$view_url = '/'.$pageData->lang->selected.$pageData->label->label->document_view->url.'/'.encodeString($value['id'].'_'.time(),$encryptKey);
			
			echo '<li><a href="'.$view_url.'" class="graycolor">'.$value['title'].'</a><i class="fa fa-angle-right"></i></li>';
		}	
		
		?>
        </ul>
    </div>
</div>
<div class="page_content">
<div class="clearfix">	
	<div class="col-md-8 bg-blacklight">
        <div class="datalist txtLeft pad10" id="page_controller_list">
            <?=$pageData->data->content->search_inputs?>
            <?php include("app/view/frontend/layout/pagination_info.php"); ?>
            <table width="100%" class="mytable" >
                <thead>
                    <tr><th style="width:50px;" class="txtCenter">No.</th><th>Page Title</th><th style="width:70px;" class="txtCenter">Tools</th></tr>
                </thead>
                <tbody></tbody>
            </table> 
            <?php include("app/view/frontend/layout/listPagination.php");?>  
        </div> 	
	</div>
    <div class="col-md-4">
		<form class="ajaxfrm sky-form" role="form" id="newpagecontrol-form" data-func="submit_form" data-reset="1" action="" method="post">
			<div class="panel panel-grey equal-height-column" style="">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-tasks"></i> New</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-6">
                                <label class="label">Page Label</label>
                                <select class="form-control" name="label_id" id="label_id">
                                	 <?=$pageData->data->content->page_labels?>
                                </select>
                            </div>                            
                            <div class="col-md-6">
                                <label class="label">Parent</label>
                                <select class="form-control" name="parent_id">
                                	<?=$pageData->data->content->page_contorls?>
                                </select>
                            </div>
                        </div>                 	
                    </div>
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-6">
                                <label class="label">Model Name</label>
                                <input type="text" id="model_name" name="model" class="form-control" placeholder="Model Name">
                            </div>
                            <div class="col-md-6">
                                <label class="label">Interited From</label>
                                <input type="text" class="form-control" name="inherited" placeholder="Inherited from">
                            </div>
                            
                        </div>                 	
                    </div>  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="required_login"><i></i>Login</label></div>
                                <div id="required_login_msg"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="required_logout"><i></i>Logout</label></div>
                                <div id="required_logout_msg"></div>
                            </div>
                        </div>                 	
                    </div>  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="required_layout"><i></i>Layout</label></div>
                                <div id="required_layout_msg"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="is_menu"><i></i>Menu</label></div>
                                <div id="is_menu_msg"></div>
                            </div>
                        </div>                 	
                    </div> 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="is_ajax"><i></i>Ajax</label></div>
                                <div id="is_ajax_msg"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="is_webpage"><i></i>Webpage</label></div>
                                <div id="is_webpage_msg"></div>
                            </div>
                        </div>                 	
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="is_backend"><i></i>Backend</label></div>
                                <div id="is_backend_msg"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="active" checked><i></i>Active</label></div>
                                <div id="active_msg"></div>
                            </div>
                        </div>                 	
                    </div>  
                    <div class="form-group">
                        	<label class="label">Page Components</label>
                            <div class="inline-group">
                            	<?php
								foreach($pageData->data->content->page_components as $key=>$value){
									echo '<label class="checkbox"><input type="checkbox" name="components['.$value['id'].']" value="'.$value['id'].'"><i></i>'.$value['component_name'].'</label>';
								}
								?>
                            </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="label">Ordering Number</label>
                                <input type="number" class="form-control" name="ordering" placeholder="Ordering Number">
                            </div>
                        </div>                 	
                    </div>   
                    <div class="form-group">
                        	<label class="label">User Priviledge</label>
                            <div class="inline-group">
                            	<?php
								foreach($pageData->data->content->user_roles as $key=>$value){
									echo '<label class="checkbox"><input type="checkbox" name="user_roles['.$value['id'].']" value="'.$value['id'].'"><i></i>'.$value['title'].'</label>';
								}
								?>
                            </div>
                    </div>         	
                    <div class="form-group">
                        <input class="removable" type="hidden" name="recordid" value="" />
                        <input type="hidden" name="cmd" value="newpagecontrol" />
                        <button class="btn-u btn-u-sea-shop margin-bottom-10" type="submit">Save</button>
                        <button class="btn-u btn-u-default margin-bottom-10 reset_btn" type="reset">Cancel</button>
                    </div>	
                    <div class="form-group">
                    	<div id="newpagecontrol_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
                    </div>
                </div>
            </div>
	    </form>
	</div>	
</div>

</div>
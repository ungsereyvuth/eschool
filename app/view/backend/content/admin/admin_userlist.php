<?php
$listname='admin_userlist';
$formkey='newUser';
$formCmd='newUser';
?>
<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-7" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">

                <header>
                    <h2><strong>Users</strong> <i>List</i></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body">
                        <div class=" txtLeft pad10" id="<?=$listname?>">
                            <?=$pageData->data->content->search_inputs?>
                            <?php include("app/view/frontend/layout/pagination_info.php"); ?>
                            <table width="100%" class="mytable" >
                                <thead>
                                    <tr><th style="width:50px;" class="txtCenter">No.</th><th>Name</th><th style="width:70px;" class="txtCenter">Tools</th></tr>
                                </thead>
                                <tbody></tbody>
                            </table> 
                            <?php include("app/view/frontend/layout/listPagination.php");?>  
                        </div> 	
                    </div>
                </div>
            </div>

        </article>
        <!-- WIDGET END -->

        <!-- NEW WIDGET START -->
        <article class="col-md-4">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-7" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">

                <header>
                    <h2><strong>Widget</strong> <i>Colors</i></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body">

                    	<form class="ajaxfrm sky-form" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
                			<div class="panel panel-grey equal-height-column" style="">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-user-plus"></i> New User</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="row">
                                        	<div class="col-md-6">
                                                <label class="label">User Role</label>
                                                <select class="form-control" name="role_id">
                                                	<option value="">--- Select ---</option>
                                                    <?=$pageData->data->content->role_options?>
                                                </select>
                                            </div>                            
                                            <div class="col-md-6">
                                                <label class="label">Photo</label>
                                                <input type="file" name="photo" class="form-control">
                                            </div>
                                        </div>                 	
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        	<div class="col-md-6">
                                                <label class="label">Fullname (KH)</label>
                                                <input type="text" name="fullname_kh" class="form-control" placeholder="Fullname (KH)">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label">Fullname (EN)</label>
                                                <input type="text" class="form-control" name="fullname_en" placeholder="Fullname (EN)">
                                            </div>
                                            
                                        </div>                 	
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                        	<div class="col-md-6">
                                                <label class="label">Gender</label>
                                                <select class="form-control" name="gender">
                                                	<option value="">--- Select ---</option>
                                                    <option value="m">Male</option>
                                                    <option value="f">Female</option>
                                                </select>
                                            </div> 
                                            <div class="col-md-6">
                                                <label class="label">Email</label>
                                                <input type="text" class="form-control" name="email" placeholder="Email">
                                            </div>                         
                                        </div>                 	
                                    </div> 
                                    <div class="form-group">
                                        <div class="row">
                                        	<div class="col-md-6">
                                                <label class="label">Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Username">
                                            </div>                         
                                        </div>                 	
                                    </div>   
                                    <div class="form-group">
                                        <div class="row">
                                        	<div class="col-md-6">
                                                <label class="label">Password</label>
                                                <input type="password" class="form-control" name="pwd" placeholder="Password">
                                            </div> 
                                            <div class="col-md-6">
                                                <label class="label">Retype Password</label>
                                                <input type="password" class="form-control" name="rpwd" placeholder="Retype Password">
                                            </div>                         
                                        </div>                 	
                                    </div>   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="notif" checked><i></i>Notification</label></div>
                                                <div id="notif_msg"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="active" checked><i></i>Active</label></div>
                                                <div id="active_msg"></div>
                                            </div>
                                        </div>                 	
                                    </div>          	
                                    <div class="form-group">
                                        <input class="removable" type="hidden" name="recordid" value="" />
                                        <input type="hidden" name="cmd" value="<?=$formCmd?>" />
                                        <button class="btn-u btn-u-sea-shop margin-bottom-10" type="submit">Save</button>
                                        <button class="btn-u btn-u-default margin-bottom-10 reset_btn" type="reset">Cancel</button>
                                    </div>	
                                    <div class="form-group">
                                    	<div id="<?=$formkey?>_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
                                    </div>
                                </div>
                            </div>
                	    </form>
                    </div>
                </div>
            </div>
        </article>
        <!-- WIDGET END -->
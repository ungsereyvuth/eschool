<?php
$listname='admin_contentcategory';
$formkey='newContentCategory';
?>

<div class="page_content">
<div class="clearfix">	
	<div class="col-md-6 bg-blacklight">
        <div class="datalist txtLeft pad10" id="<?=$listname?>">
            <?=$pageData->data->content->search_inputs?>
            <?php include("app/view/frontend/layout/pagination_info.php"); ?>
            <table width="100%" class="mytable" >
                <thead>
                    <tr><th style="width:50px;" class="txtCenter">No.</th><th>Title</th><th style="width:70px;" class="txtCenter">Tools</th></tr>
                </thead>
                <tbody></tbody>
            </table> 
            <?php include("app/view/frontend/layout/listPagination.php");?>  
        </div> 	
	</div>
    <div class="col-md-6">
    	<form class="ajaxfrm sky-form realtime-upload" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
			<div class="panel panel-grey equal-height-column" style="">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user-plus"></i> New/Update Category</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>
                            <div class="col-md-6">
                                <label class="label">Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Code">
                            </div>
                        </div>                 	
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="active" checked><i></i>Active</label></div>
                                <div id="active_msg"></div>
                            </div>
                        </div>                 	
                    </div>        	
                    <div class="form-group">
                        <input class="removable" type="hidden" name="recordid" value="" />
                        <input type="hidden" name="cmd" value="<?=$formkey?>" />
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
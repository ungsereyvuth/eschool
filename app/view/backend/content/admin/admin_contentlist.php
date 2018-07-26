<?php
$listname='admin_contentlist';
$formkey='newContent';
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
    	<form class="ajaxfrm sky-form hidden" role="form" id="newContentTranslation-form" data-func="submit_form" data-reset="1" data-removable="1" action="" method="post">
			<div class="panel panel-grey equal-height-column" style="">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-language"></i> Translation</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-6">
                                <label class="label">Language</label>
                                <input class="removable" type="hidden" name="language_id" value="" />
                                <select class="form-control" name="language_title" disabled>
                                	<option value="">--- Language ---</option>
                                    <?=$pageData->data->content->lang_options?>
                                </select>
                                
                            </div> 
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="active" checked><i></i>Active</label></div>
                                <div id="active_msg"></div>
                            </div>
                        </div>                 	
                    </div>
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-12">
                                <label class="label">Main Title</label>
                                <input type="text" class="form-control" name="main_title" placeholder="Title" readonly>
                            </div>                            
                        </div>                 	
                    </div>  
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-12">
                                <label class="label">Translated Title</label>
                                <input type="text" name="title_t" class="form-control" placeholder="Translated Title">
                            </div>                            
                        </div>                 	
                    </div>    
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-12">
                                <label class="label">Translated Description</label>
                                <textarea class="richtext" name="description_t"></textarea>
                            </div>                            
                        </div>                 	
                    </div>    	
                    <div class="form-group">
                        <input class="removable" type="hidden" name="recordid" value="" />
                        <input type="hidden" name="cmd" value="newContentTranslation" />
                        <button class="btn-u btn-u-sea-shop margin-bottom-10" type="submit">Save</button>
                        <button class="btn-u btn-u-default margin-bottom-10 reset_btn" type="reset">Cancel</button>
                    </div>	
                    <div class="form-group">
                    	<div id="newContentTranslation_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
                    </div>
                </div>
            </div>
	    </form>
        
    	<form class="ajaxfrm sky-form realtime-upload" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
			<div class="panel panel-grey equal-height-column" style="">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user-plus"></i> New/Update Content</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="label">Title (<?=$pageData->lang->defaultName?>)</label>
                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>
                        </div>                 	
                    </div>
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-6">
                                <label class="label inline-block">Code</label> <button class="auto_code_btn btn btn-info btn-xs" data-targetid="content_code" type="button">Generate</button>
                                <input type="text" name="code" id="content_code" class="form-control" placeholder="Code">
                            </div>
                        	<div class="col-md-6">
                                <label class="label">Cateogry</label>
                                <select class="form-control" name="cate_id">
                                	<option value="">--- Select ---</option>
                                    <?=$pageData->data->content->cate_options?>
                                </select>
                            </div>   
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-12">
                                <label class="label">Description</label>
                                <textarea class="richtext" name="description"></textarea>
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
                    	<label>Attachments</label>
                        <div class="row">       
                            <div class="col-md-12">                                
                                <div class="input input-file">
                                    <div class="button">
                                        <input type="file" id="attachment" name="attachment" data-criteriaid="attachment" class="realtime-upload-btn">Add Picture
                                    </div>
                                    <input type="text" readonly placeholder="You can select only allowed file types">
                                    <input type="hidden" id="allfiles_attachment" name="filename" class="realtime-upload-allfiles">
                                    <div id="selectedFile_attachment" class="row thumbnail realtime-upload-selectedfile" style="display:none; margin-top:10px;"></div>
                                </div>
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
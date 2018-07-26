<div class="page_content">
<div class="clearfix">	
	<div class="col-md-8 bg-blacklight">
        <div class="datalist txtLeft pad10" id="labelList">
            <?=$pageData->data->content->search_inputs?>
            <?php include("app/view/frontend/layout/pagination_info.php"); ?>
            <table width="100%" class="mytable" >
                <thead>
                    <tr><th>Type</th><th>Title</th><th style="width:70px;" class="txtCenter">Tools</th></tr>
                </thead>
                <tbody></tbody>
            </table> 
            <?php include("app/view/frontend/layout/listPagination.php");?>  
        </div> 	
	</div>
    <div class="col-md-4">
    	<form class="ajaxfrm sky-form hidden" role="form" id="newPageLabelTranslation-form" data-func="submit_form" data-reset="1" data-removable="1" action="" method="post">
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
                                    <?=$pageData->data->content->language_options?>
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
                                <input type="text" name="title" class="form-control" placeholder="Translated Title">
                            </div>                            
                        </div>                 	
                    </div>       	
                    <div class="form-group">
                        <input class="removable" type="hidden" name="recordid" value="" />
                        <input type="hidden" name="cmd" value="newPageLabelTranslation" />
                        <button class="btn-u btn-u-sea-shop margin-bottom-10" type="submit">Save</button>
                        <button class="btn-u btn-u-default margin-bottom-10 reset_btn" type="reset">Cancel</button>
                    </div>	
                    <div class="form-group">
                    	<div id="newPageLabelTranslation_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
                    </div>
                </div>
            </div>
	    </form>
		<form class="ajaxfrm sky-form" role="form" id="newPageLabel-form" data-func="submit_form" data-reset="1" action="" method="post">
			<div class="panel panel-grey equal-height-column" style="">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-text-width"></i> New Label</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-6">
                                <label class="label">Label Category</label>
                                <select class="form-control" name="cate_id">
                                	<option value="">--- Select ---</option>
                                    <?=$pageData->data->content->cate_options?>
                                </select>
                            </div>                            
                            <div class="col-md-6">
                                <label class="label">Content Code</label>
                                <input type="text" name="content_code" class="form-control" placeholder="Content Code">
                            </div>
                        </div>                 	
                    </div>
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-6">
                                <label class="label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>
                            <div class="col-md-6">
                                <label class="label">Code</label>
                                <input type="text" class="form-control" name="code" placeholder="Code">
                            </div>
                            
                        </div>                 	
                    </div> 
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-6">
                                <label class="label">URL</label>
                                <input type="text" class="form-control" name="url" placeholder="URL">
                            </div> 
                            <div class="col-md-6">
                                <label class="label">Icon</label>
                                <input type="text" class="form-control" name="icon" placeholder="fontawesome/image url">
                            </div>                         
                        </div>                 	
                    </div> 
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-6">
                                <label class="label">Data</label>
                                <input type="text" class="form-control" name="data" placeholder="Data">
                            </div>  
                            <div class="col-md-6">
                                <label class="label">Priority Order</label>
                                <input type="number" class="form-control" name="priority" placeholder="Ordering">
                            </div>                        
                        </div>                 	
                    </div>   
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="for_page"><i></i>For Page</label></div>
                                <div id="for_page_msg"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="btm_border_gray"><label class="toggle label" style="width: 150px;"><input type="checkbox" name="active"><i></i>Active</label></div>
                                <div id="active_msg"></div>
                            </div>
                        </div>                 	
                    </div>          	
                    <div class="form-group">
                        <input class="removable" type="hidden" name="recordid" value="" />
                        <input type="hidden" name="cmd" value="newPageLabel" />
                        <button class="btn-u btn-u-sea-shop margin-bottom-10" type="submit">Save</button>
                        <button class="btn-u btn-u-default margin-bottom-10 reset_btn" type="reset">Cancel</button>
                    </div>	
                    <div class="form-group">
                    	<div id="newPageLabel_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
                    </div>
                </div>
            </div>
	    </form>
	</div>	
</div>

</div>
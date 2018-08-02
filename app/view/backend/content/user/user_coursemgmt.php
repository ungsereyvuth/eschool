<?php
$listname='user_coursemgmt';
$formkey='newcourse';
$formCmd='newcourse';
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">
        	<div class="jarviswidget" id="<?=$listname?>_wid" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->courses->icon.' '.$pageData->label->label->courses->title?></strong></h2>   
                    <div class="widget-toolbar" role="menu">
                        <div class="btn-group">
                            <button class="btn btn-xs btn-default switch_list_filters" data-list="<?=$listname?>">
                               <i class="fa fa-search"></i> Filter
                            </button>                            
                        </div>
                    </div> 
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<div class="datalist txtLeft" id="<?=$listname?>">
                            <div class="list_filters hidden">
							<?=$pageData->data->content->search_inputs?>
                            </div>
                            <?php include("app/view/frontend/layout/pagination_info.php"); ?>
                            <table width="100%" class="mytable" >
                                <thead>
                                    <tr class="hidden"><th style="width:30px;" class="txtCenter">No.</th><th>Course</th><th style="width:70px;" class="txtCenter">Tools</th></tr>
                                </thead>
                                <tbody></tbody>
                            </table> 
                            <?php include("app/view/frontend/layout/listPagination.php");?>  
                        </div> 
                    </div>

                </div>
            </div>

       	</article>
       	<article class="col-md-4">
        	<!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="<?=$formkey?>_wid" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-deletebutton="false">

                <header>
                    <h2><strong>New Course</strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body">

                    	<form class="ajaxfrm smart-form" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
                			<fieldset>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">Title</label>
                                        <label class="input">
                                            <input type="text" name="title" class="input-sm" placeholder="Title">
                                        </label>
                                    </section>                                    
                                </div>
                                <div class="row">
                                    <section class="col col-md-6">
                                        <label class="label">School <i class="fs11">(optional)</i></label>
                                        <label class="select">
                                             <select name="school_id" class="input-sm">
                                                <option value="">--- Select ---</option>
                                            </select>
                                        </label>
                                    </section>
                                    <section class="col col-md-6">
                                        <label class="label">Grade</label>
                                        <label class="select">
                                             <select name="grade_id" class="input-sm">
                                                <option value="">--- Select ---</option>
                                            </select>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-md-6">
                                        <label class="label">Max Student <i class="fa fa-info-circle tooltips" title="Leave blank for unlimit"></i></label>
                                        <label class="input">
                                            <input type="number" name="max_student" class="input-sm" placeholder="Number">
                                        </label>
                                    </section>
                                    <section class="col col-md-6">
                                        <label class="label">Year</label>
                                        <label class="input">
                                            <input type="number" name="year" class="input-sm" placeholder="Number">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">Description <i class="fs11">(optional)</i></label>
                                        <label class="textarea textarea-expandable"> 										
											<textarea rows="3" class="custom-scroll" name="description" placeholder="More detail about your course"></textarea> 
										</label>
                                    </section>  
                                </div>
                                <div class="row">
                                    <section class="col col-md-6">
                                        <label class="toggle">
                                            <input type="checkbox" name="active" checked="checked">
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Active
                                        </label>
                                        <div id="notif_msg"></div>
                                    </section>
                                </div>
                            </fieldset>
                            
                            <footer>
                            	<input class="removable" type="hidden" name="recordid" value="" />
                                <input type="hidden" name="cmd" value="<?=$formCmd?>" />                                
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <button type="reset" class="btn btn-default btn-sm reset_btn">Cancel</button>
                            </footer>
                            <fieldset>
                            	<div class="row">
	                                <section class="col col-md-12">
	                                    <div id="<?=$formkey?>_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
	                                </section>
	                            </div>
                            </fieldset>
                	    </form>
                    </div>
                </div>
            </div>
       	</article>
    </div>
</section>
<?php
$listname='user_coursemgmt';
$formkey='newcourse';
$formCmd='newcourse';
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8  sortable-grid ui-sortable">
        	<div class="jarviswidget well jarviswidget-sortable" id="<?=$listname?>_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
                <header>
                    <h2><strong>Course List</strong></h2>   
                    <div class="widget-toolbar">
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
                                    <tr><th style="width:50px;" class="txtCenter">No.</th><th>Course</th><th style="width:70px;" class="txtCenter">Tools</th></tr>
                                </thead>
                                <tbody></tbody>
                            </table> 
                            <?php include("app/view/frontend/layout/listPagination.php");?>  
                        </div> 
                    </div>
                    <div class="dd" id="nestable">
									<ol class="dd-list">
										
										<li class="dd-item" data-id="2"><button data-action="collapse" type="button">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>
											<div class="dd-handle">
												<h4><span class="semi-bold">Item 2 </span> - Big Header</h4>
												<span>Description with piechart</span>
												<span class="air air-top-right padding-7">
													<div class="easy-pie-chart text-danger easyPieChart" data-percent="33" data-pie-size="40" data-pie-track-color="rgba(169, 3, 41,0.07)">
														<span class="percent percent-sign txt-color-red font-xs">33</span>
													<canvas height="80" width="80" style="height: 40px; width: 40px;"></canvas></div>
												</span>
												
											</div>
											<ol class="dd-list">
												<li class="dd-item" data-id="3">
													<div class="dd-handle">
														Item 3
													</div>
												</li>
												<li class="dd-item" data-id="4">
													<div class="dd-handle">
														Item 4
														<em class="label pull-right label-primary">
															Label ID
														</em>
													</div>
												</li>
												<div class="dd-placeholder" style="height: 37px;"></div><li class="dd-item" data-id="5"><button data-action="collapse" type="button">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>
													<div class="dd-handle">
														Item 5
														
													</div>
													<ol class="dd-list">
														<li class="dd-item" data-id="6">
															<div class="dd-handle bg-color-blue txt-color-white">
																<i>Item 6 (italic)</i>
															</div>
														</li>
														<li class="dd-item" data-id="7">
															<div class="dd-handle bg-color-pink txt-color-white">
																<strong>Item 7 (bold)</strong>
															</div>
														</li>
														<li class="dd-item" data-id="8">
															<div class="dd-handle bg-color-greenLight txt-color-white">
																<strong><i>Item 8 (Bold + Italic)</i></strong>
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item" data-id="9">
													<div class="dd-handle">
														Item 9
														
														<em class="badge pull-right bg-color-purple">
															99
														</em>
													</div>
												</li>
												<li class="dd-item" data-id="10">
													<div class="dd-handle">
														Item 10
													</div>
												</li>
											</ol>
										</li>
										<li class="dd-item" data-id="11">
											<div class="dd-handle">
												
												<div class="row">
													<div class="col-xs-8">
														Item 11 
														<span class="font-xs text-muted">
															- with progress bar
														</span>
													</div>
													<div class="col-xs-4">
														<div class="progress progress-striped active no-margin">
															<div class="progress-bar progress-bar-primary" role="progressbar" style="width: 37%">37%</div>
														</div> 
													</div>
												</div>
												
											</div>
										</li>
										<li class="dd-item" data-id="12">
											<div class="dd-handle">
												
												<div class="row">
													<div class="col-xs-8 text-success">
														<strong>Item 12 </strong>
														<span class="font-xs text-muted">
															- success text
														</span>
													</div>
													<div class="col-xs-4">
														<div class="progress progress-striped active no-margin">
															<div class="progress-bar progress-bar-success" role="progressbar" style="width: 85%">85%</div>
														</div> 
													</div>
												</div>
												
											</div>
										</li>
									</ol>
								</div>
                </div>
            </div>

       	</article>
       	<article class="col-md-4">
        	<!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="<?=$formkey?>_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false">

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
                                        <label class="label">School</label>
                                        <label class="select">
                                             <select name="school_id" class="input-sm">
                                                <option value="">--- Select ---</option>
                                            </select>
                                        </label>
                                    </section>
                                    <section class="col col-md-6">
                                        <label class="label">Max Student</label>
                                        <label class="input">
                                            <input type="number" name="max_student" class="input-sm" placeholder="Number">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">Description</label>
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
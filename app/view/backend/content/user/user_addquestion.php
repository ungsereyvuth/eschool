<?php
$listname='user_questionlist';
$formkey='user_addquestion';
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-7">
        	<div class="jarviswidget" id="<?=$formkey?>_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_addquestion->icon.' '.$pageData->label->label->user_addquestion->title?> <i class="fa fa-angle-double-right"></i> <?=$pageData->label->label->lesson->title.'៖ '.$pageData->data->content->lesson_info->lesson_title?></strong></h2>    
                    <!-- <div class="widget-toolbar">
                        <div class="btn-group">
                            <button class="btn btn-xs btn-default switch_list_filters" data-list="listname">
                               <i class="fa fa-search"></i> Filter
                            </button>                            
                        </div>
                    </div>-->
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<form class="ajaxfrm smart-form realtime-upload" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
                            <fieldset>          
                                <div class="row">
                                    <section class="col col-md-6">
                                        <label class="label">Title</label>
                                        <label class="input">
                                            <input type="text" name="title" class="input-xs" placeholder="Title">
                                        </label>
                                    </section>
                                    <section class="col col-md-6">
                                        <label class="label">Type</label>
                                        <label class="select">
                                             <select name="type_id" class="input-xs chosen-select">
                                                <option value="">--- Select ---</option>
                                                <?=$pageData->data->content->qtype_opt?>
                                            </select>
                                        </label>
                                    </section>  
                                </div>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">Description</label>
                                        <textarea class="richtext" name="description"></textarea>
                                    </section>                         
                                </div>                  
                                <div class="row">                                    
                                    <section class="col col-md-6">
                                        <label class="label">Ordering</label>
                                        <label class="input">
                                            <input type="number" name="ordering" class="input-xs" placeholder="Numner" value="<?=$pageData->data->content->ordering?>">
                                        </label>
                                    </section>  
                                    <section class="col col-md-6">
                                        <label class="label">Active</label>
                                        <label class="toggle inline-block">
                                            <input type="checkbox" name="active" checked="checked">
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i> ON/OFF
                                        </label>
                                        <div id="active_msg"></div>
                                    </section>
                                </div>              
                                <div class="row <?=$addmain?'hidden':''?>">       
                                    <section class="col col-md-12">  
                                        <label>Attachments</label>                              
                                        <label class="input input-file">
                                            <div class="button">
                                                <input type="file" name="attachment" class="realtime-upload-btn">Add Picture
                                            </div>
                                            <input type="text" readonly placeholder="You can select only allowed file types">
                                            <input type="hidden" id="allfiles_attachment" name="filename" class="realtime-upload-allfiles">
                                            <div id="selectedFile_attachment" class=" thumbnail realtime-upload-selectedfile" style="display:none; margin-top:10px;"></div>
                                        </label>
                                    </section>
                                </div>    
                                      
                            </fieldset>
                            <fieldset class="add_q_choice">
                            	<div class="add_choice">
	                            	<label class="label">Possible Answer 
	                            			<button type="button" class="btn btn-xs btn-info tooltips addchoice_btn" title="Add Possible Answer">
				                               <i class="fa fa-plus"></i>
				                            </button> 
	                            	</label>  
	                            </div>
	                            <div class="add_answer">
	                            	<label class="label">Correct Answer
	                            			<button type="button" class="btn btn-xs btn-info tooltips refreshchoice_btn" title="Refresh Choices">
				                               <i class="fa fa-refresh"></i>
				                            </button> 
	                            	</label>
	                            	<div class="row">                                    
	                                    <section class="col col-md-6">                                        
	                                        <label class="select">
	                                             <select name="answer" class="input-sm chosen-select choices_list">
	                                                
	                                            </select>
	                                        </label>
	                                    </section>  
	                                </div>   
	                            </div>
                            </fieldset>
                            <fieldset>
                            	<div class="dd" id="nestable2">
									<ol class="dd-list">
										<li class="dd-item" data-id="13">
											<div class="dd-handle">
												Item 13
												
												<em class="pull-right badge bg-color-orange padding-5" rel="tooltip" title="" data-placement="left" data-original-title="Warning Icon Text"><i class="fa fa-warning fa-lg txt-color-white"></i></em>
											</div>
										</li>
										<li class="dd-item" data-id="14">
											<div class="dd-handle">
												Item 14
											</div>
										</li>
										<li class="dd-item" data-id="15">
											<div class="dd-handle">
												Item 15
											</div>
										</li>
									</ol>
								</div>

			
					 			<textarea id="nestable2-output" rows="3" class="form-control font-md"></textarea>		

                            </fieldset>
                            <footer>
                                <input class="removable" type="hidden" name="recordid" value="" />
                                <input type="hidden" name="cmd" value="<?=$formkey?>" />                                  
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <button type="reset" class="btn btn-default btn-sm" onclick="javascript: window.history.back();">Back</button>
                            </footer>
                            <fieldset>
                                <div id="<?=$formkey?>_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-5">
        	<div class="jarviswidget" id="<?=$listname?>_wid" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->$listname->icon.' '.$pageData->label->label->$listname->title?></strong></h2>   
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
                            <?php //include("app/view/frontend/layout/pagination_info.php"); ?>
                            <table width="100%" class="mytable" >
                                <thead>
                                    <tr class="hidden"><th style="width:30px;" class="txtCenter">No.</th><th>Course</th><th style="width:70px;" class="txtCenter">Tools</th></tr>
                                </thead>
                                <tbody></tbody>
                            </table> 
                            <?php include("app/view/backend/layout/listPagination.php");?>  
                        </div> 
                    </div>

                </div>
            </div>
       	</article>
    </div>
</section>

<?php
$choice_input = str_replace(PHP_EOL,'','<div class="row">                                    
						                    <section class="col col-md-6">                                        
						                        <label class="input">
						                            <input type="text" name="choices[]" class="input-xs choicetxt" placeholder="Choice">
						                        </label>
						                    </section>  
						                    <section class="col col-md-6">
						                        <button type="button" class="btn btn-xs btn-danger tooltips removeChoice_btn" title="Remove Coice">
						                           <i class="fa fa-times"></i>
						                        </button> 
						                    </section> 
						                </div> ');


$late_script = "

$('.addchoice_btn').each(function() { 
    $(this).click(function(e){
		addchoice($(this));
	});
});
function removeChoice(){
	$('.removeChoice_btn').each(function() {
	    $(this).click(function(e){
			var cnf = confirmDialog('Are you sure?',$(this));
		});
	});
}
removeChoice();

function refreshchoice(){
	$('.refreshchoice_btn').each(function() {
		var vthis = $(this);
	   vthis.click(function(){
			var choices =vthis.closest('.add_q_choice').find('.choicetxt');
			var choices_select =vthis.closest('.add_q_choice').find('.choices_list');
			choices_select.html('<option value=\"\">--- choose ---</option>');
			choices.each(function() {
				var choiceval = $(this).val();
				if(choiceval != ''){
					choices_select.append('<option value=\"'+choiceval+'\">'+choiceval+'</option>');
				}
			});
			choices_select.trigger('chosen:updated');;
		});
	});
}
refreshchoice();

function confirmDialog(message,e) {
    $('<div></div>').appendTo('body')
    .html('<div><h6>'+message+'</h6></div>')
    .dialog({
        modal: true, title: 'Confirm', zIndex: 10000, autoOpen: true,
        width: 'auto', resizable: false,
        buttons: {
            Yes: function () {
            	e.closest('.row').remove();
                $(this).dialog('close');
            },
            No: function () {    
                $(this).dialog('close');
            }
        },
        close: function (event, ui) {
            $(this).remove();
        }
    });
}
function addchoice(e){
	e.closest('.add_choice').append('$choice_input');
	$('.removeChoice_btn').unbind('click');
	removeChoice();
}





var updateOutput = function(e) {
				var list = e.length ? e : $(e.target), output = list.data('output');
				if (window.JSON) {
					output.val(window.JSON.stringify(list.nestable('serialize')));
					//, null, 2));
				} else {
					output.val('JSON browser support required for this demo.');
				}
			};
	
			// activate Nestable for list 2
			$('#nestable2').nestable({
				group : 1
			}).on('change', updateOutput);
	
			// output initial serialised data
			updateOutput($('#nestable2').data('output', $('#nestable2-output')));
	
			$('#nestable-menu').on('click', function(e) {
				var target = $(e.target), action = target.data('action');
				if (action === 'expand-all') {
					$('.dd').nestable('expandAll');
				}
				if (action === 'collapse-all') {
					$('.dd').nestable('collapseAll');
				}
			});

";

?>
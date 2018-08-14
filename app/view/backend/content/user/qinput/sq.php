<?php


$qtype=array();
$qtype['html_input']='<fieldset class="add_q_choice">
                        <div class="add_choice">
                            <label class="label">ជម្រើសលំដាប់ 
                                    <button type="button" class="btn btn-xs btn-info tooltips addchoice_btn" title="Add sequence item">
                                       <i class="fa fa-plus"></i>
                                    </button> (កុំបញ្ចូលតាមលំដាប់)
                            </label>  
                        </div>
                    </fieldset>
                    <fieldset>

                        <label class="label">លំដាប់ត្រឹមត្រូវ
                                <button type="button" class="btn btn-xs btn-info tooltips refreshsq_btn" title="Refresh sequence">
                                   <i class="fa fa-refresh"></i>
                                </button> 
                        </label> 
                        <div class="clearfix">
                            <section class="col-xs-1">
                                <div class="dd" id="sequence_no">
                                    <ol class="dd-list">
                                        
                                    </ol>
                                </div>
                            </section>
                            <section class="col-xs-11">
                                <div class="dd" id="sequence">
                                    <ol class="dd-list">
                                        
                                    </ol>
                                </div>
                            </section>
                        </div>
                        <input type="hidden" name="sq_order" id="sequence-output" />    

                    </fieldset>';
$choice_input=str_replace(PHP_EOL,'','<div class="row">                                    
                                            <section class="col col-md-9">                                        
                                                <label class="input">
                                                    <textarea class="mathinput sq_item" name="choices[{key}]" id="{key}"></textarea>
                                                </label>
                                            </section>  
                                            <section class="col col-md-3">
                                                លុបចោល <button type="button" class="btn btn-xs btn-danger tooltips removeChoice_btn" title="Remove Coice">
                                                   <i class="fa fa-times"></i>
                                                </button><br />
                                            </section> 
                                        </div> ');
$qtype['js_script']="

$('.addchoice_btn').each(function() { 
    $(this).click(function(e){
        addchoice($(this));
    });
});
function removeChoice(){
    $('.removeChoice_btn').each(function() {
        $(this).click(function(e){
            confirmDialog('អ្នកកំពុងលុបជម្រើសចោល។ តើអ្នកប្រាកដទេ?',$(this));
        });
    });
}
removeChoice();

function addchoice(e){
    var key = $('.mathinput').length+'_'+$.now(),choiceinput = '$choice_input';
    var addkey = choiceinput.replace(/{key}/g,key);
    e.closest('.add_choice').append(addkey);
    $('.removeChoice_btn').unbind('click');
    removeChoice();
    tinymce.init({
        selector: '.mathinput',
        relative_urls : false,
        remove_script_host : false,
        menubar:false,
        statusbar: false,
        min_height: 50,
        valid_elements : '*[*]',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks fullscreen',
            'insertdatetime media table contextmenu paste textcolor imagetools colorpicker emoticons'
        ],
        external_plugins: {
            tiny_mce_wiris: 'https://www.wiris.net/demo/plugins/tiny_mce/plugin.js'
          },
        toolbar: 'undo redo | tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry | link image | emoticons'
     });
}

$('.refreshsq_btn').each(function() {
    var thisbtn = $(this);
    thisbtn.click(function(e){
        tinyMCE.triggerSave();
        var item = thisbtn.closest('.row').find('.sq_item');
        $('#sequence .dd-list').empty();$('#sequence_no .dd-list').empty();
        $('#sequence-output').val('');
        item.each(function(index) {
            var sq_item = '<li class=\"dd-item\" data-id=\"'+$(this).attr('id')+'\"><div class=\"dd-handle\">'+$(this).val()+'</div></li>';
            var sq_item_no = '<li class=\"dd-item\"><div class=\"dd-handle\">'+(index+1)+'</div></li>';
            $('#sequence .dd-list').append(sq_item);
            $('#sequence_no .dd-list').append(sq_item_no);
            
        });
        updateOutput($('#sequence').data('output', $('#sequence-output')));
    });
});


var updateOutput = function(e) {
                var list = e.length ? e : $(e.target), output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));
                    //, null, 2));
                } else {
                    output.val('JSON browser support required.');
                }
            };
    
            // activate sequence
            $('#sequence').nestable({
                group : 1
            }).on('change', updateOutput);
    
            // output initial serialised data
            updateOutput($('#sequence').data('output', $('#sequence-output')));




";

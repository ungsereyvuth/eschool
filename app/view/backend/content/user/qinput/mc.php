<?php


$qtype=array();
$qtype['html_input']='<fieldset class="add_q_choice">
                                <div class="add_choice">
                                    <label class="label">ជម្រើសចម្លើយ
                                            <button type="button" class="btn btn-xs btn-info tooltips addchoice_btn" title="បន្ថែមជម្រើសចម្លើយ">
                                               <i class="fa fa-plus"></i>
                                            </button> ចម្លើយត្រូវអាចមានច្រើនជាង១
                                    </label>  
                                </div>
                            </fieldset>';
$choice_input=str_replace(PHP_EOL,'','<div class="row">                                    
                                            <section class="col col-md-8">                                        
                                                <label class="input">
                                                    <textarea class="mathinput" name="choices[{key}]"></textarea>
                                                </label>
                                            </section>  
                                            <section class="col col-md-4">
                                                លុបចោល <button type="button" class="btn btn-xs btn-danger tooltips removeChoice_btn" title="Remove Coice">
                                                   <i class="fa fa-times"></i>
                                                </button><br />
                                                <label class="toggle inline-block">
                                                    <input type="checkbox" name="correct_choices[]" value="{key}">
                                                    <i data-swchon-text="ត្រូវ" data-swchoff-text="ខុស"></i>ជាចម្លើយ
                                                </label>
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
}";

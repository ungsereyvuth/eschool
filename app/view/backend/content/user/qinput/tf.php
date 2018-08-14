<?php


$qtype=array();
$qtype['html_input']='<fieldset>
                            <div class="add_choice">
                                <label class="label">ចម្លើយ</label>  
                            </div>
                            <div class="row">
                            	<section class="col col-md-6">
                            		<label class="select">
		                                 <select name="tf_format" id="tf_format" class="input-xs">
		                                    '.$tf_format.'
		                                </select>
		                            </label>
                            	</section>
                            	<section class="col col-md-6">
                            		<label class="toggle inline-block">
		                                <input type="radio" name="correct_choices" value="1">
		                                <i data-swchon-text="ត្រូវ" data-swchoff-text="ខុស"></i>[<span id="tf_yes">ពិត</span>] ជាចម្លើយ
		                            </label><br />
		                            <label class="toggle inline-block">
		                                <input type="radio" name="correct_choices" value="0">
		                                <i data-swchon-text="ត្រូវ" data-swchoff-text="ខុស"></i>[<span id="tf_no">មិនពិត</span>] ជាចម្លើយ
		                            </label>
		                            <div id="correct_choices_msg"></div>
                            	</section>
                            </div>
                            
                            
                        </fieldset>';

$qtype['js_script']="

$('#tf_format').change(function(){
	var txt=$('#tf_format option:selected').text();
	var tf = txt.split('/');
	$('#tf_yes').html(tf[0]);
	$('#tf_no').html(tf[1]);
});

";

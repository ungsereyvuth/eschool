<?php
$pdata=$pageData->data->content;
//get attached file
$file_item='';
$filedata = $pdata->lessonData->filenames;
if($filedata<>''){
	$filenames = explode('|',$pdata->lessonData->filenames);
	$filepath = web_config('post_doc_path');
	foreach ($filenames as $key => $value) {
	    $file_detail=file_detail($value);
	    $size=filesize_formatted($filepath.$value);
	    $itemname = explode('_',$value);
	    unset($itemname[count($itemname)-1]); unset($itemname[count($itemname)-1]);

	    $doc_view_url = $pageData->label->label->user_lessonview->url.'/'.encodeString($pdata->lessonData->id.'_'.time(),$encryptKey).'&doc='.$value;
	    $file_item.='<li class="v_pad5" style="border-bottom:1px dotted #e8e7e7;">
	                    <a href="'.$doc_view_url.'" class="tooltips" title="'.$file_detail['name_kh'].'">
	                          '.$file_detail['icon'].' '.implode('',$itemname).'
	                    </a>
	                    <span class="label bg-color-teal pull-right rounded">'.$size.'</span>
	                </li>';
	}
}
$file_item=$file_item==''?'<div class="alert alert-warning v_pad3 fs12">គ្មានឯកសារ</div>':('<ol>'.$file_item.'</ol>');
?>
<!--=== Blog Posts ===-->
		<div class="bg-color-light">
			<div class="container content-xs">
				<div class="row">
					<!-- Blog Sidebar -->
					<div class="col-md-3">
						<ul class="list-group sidebar-nav-v1" id="sidebar-nav">
							<?php 
                        	$lesson_items='';$main_no=1;
                        	foreach($pdata->lessons as $key=>$value){
                        		$subrow=isset($value['sub'])?$value['sub']:array();$mainrow=$value['info'];
                        		$sub=$main='';$sub_no=1;$totalq=0;
                        		foreach($subrow as $skey=>$svalue){
                        			$lesson_view_url = $pageData->label->label->subjectlesson->url.'/'.$pdata->code.'&lid='.encode($svalue['id']);	    
                                    //url new question
                                    $totalq+=$svalue['totalq'];
                                    if($pdata->lessonid){
                                    	$isActive = ($svalue['id']==$pdata->lessonid)?true:false;
                                    }else{$isActive = ($main_no==1 and $sub_no==1)?true:false;}
                                    
                            		$sub.='
	                                        <li class="'.($isActive?'active':'').'">
												<a href="'.$lesson_view_url.'"><i class="fa fa-file-text-o"></i> មេរៀនទី'.enNum_khNum($sub_no).'៖ '.$svalue['title'].'</a>
											</li>
	                                        ';
                                    $sub_no++;
                            	}

                            	$main.="<a data-toggle=\"collapse\" data-parent=\"#sidebar-nav\" href=\"#collapse-buttons$key\">ជំពូកទី".enNum_khNum($main_no).'៖ '.$mainrow['title']."</a>
                            			<ul id=\"collapse-buttons$key\" class=\"collapse in\">$sub</ul>";
                            	$lesson_items.="<li class='list-group-item list-toggle active'>$main</li>";
                                $main_no++;
                        	}

                        	echo $lesson_items;

                        	?>
							
							
						</ul>
					</div>
					<!-- End Blog Sidebar -->

					<!-- Blog All Posts -->
					<div class="col-md-9">
						<!-- News v3 -->
						<div class="news-v3 bg-color-white margin-bottom-30">
							<div class="pad15">
								<div class="headline v_mgn5">
									<h3 class="khmerTitle"><?=$pdata->lessonData->title?></h3>
								</div>
								<ul class="list-inline posted-info p_title fs12">
									<li><?=$pdata->lessonData->subjectname?></li>
									<li><?=khmerDate($pdata->lessonData->created_date)?></li>
								</ul>
								
								<?php

		                        if(isset($_GET['doc'])){
		                            echo '<iframe src="https://docs.google.com/viewer?url=http://www.khmerdocs.com/files/docs/docs561818030060.pdf&amp;embedded=true" width="100%" height="780" style="border: none;"></iframe>';
		                        }else{

		                            echo '<div class="mathFont">'.$pdata->lessonData->description.'</div>';
		                        }
		                        ?>
		                        <hr class="v_mgn10" />
		                        <div class="row">
		                        	<div class="col-md-12">
		                        		<div class="v_pad10">ឯកសារមេរៀន</div>
				                        <div>
				                            <?=$file_item?>

				                        </div>
		                        	</div>
		                        </div>
		                        

								
							</div>
						</div>
							<a class="btn btn-info" href="#"><i class="fa fa-chevron-left"></i> មេរៀនមុន</a>	
							<a class="btn btn-info pull-right" href="#">មេរៀនបន្ទាប់ <i class="fa fa-chevron-right"></i></a>	
						<div>

						</div>
						<!-- End News v3 -->

						<div id="testimonials-1" class="blog-author carousel slide testimonials testimonials-v1 hidden">
							<div class="carousel-inner">
								<div class="item active">
									<p>ការសិក្សាជាមូលដ្ឋានគ្រឹះឆ្ពោះទៅកាន់ភាពជោគជ័យ។ លោកគ្រូ អ្នកគ្រូ កសាងមនុស្សឲ្យ មានចំណេះដឹង សីលធម៌ គុណធម៌ ខុសពីការបង្កើតទូរស័ព្ទមួយគ្រឿង។</p>
									<div class="testimonial-info">
										<img class="rounded-x" src="https://ep01.epimg.net/brasil/imagenes/2016/06/23/politica/1466654550_367696_1466879337_noticia_normal.jpg" alt="">
										<span class="testimonial-author">
											លោកគ្រូ រស់ ចិត្រា
											<em>លោកគ្រូសាស្ត្រាចារ្យប្រចាំសាលាជ័យថាវី</em>
										</span>
									</div>
								</div>
							</div>
						</div>

						
					</div>
					<!-- End Blog All Posts -->
				</div>
			</div><!--/end container-->
		</div>
		<!--=== End Blog Posts ===-->

<?php
$late_script='window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};';
$late_script_file = '<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>';
?>
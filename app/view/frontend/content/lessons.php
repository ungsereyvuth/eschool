

<!--=== Parallax Counter ===-->
<div class="parallax-counter-v2 parallaxBg1" style="background-position: 50% 31px;">
	<div class="container">
		<ul class="row list-row">
			<?php
			foreach ($pageData->data->content->items as $key => $value) {
				$param = isset($value['param'])?$value['param']:'/lessons?level='.$key;
				echo '<li class="col-md-3 col-sm-6 col-xs-12 v_mgn10">
						<a href="'.$param.'" class="txt_none_decor">
							<div class="counters rounded hover_box">
								<span class="khmerNormal">'.$value['title'].'</span>
							</div>
						</a>
					</li>';
			}

			?>

			
		</ul>
	</div>
</div>

<div class="purchase">
	<div class="container overflow-h">
		<div class="row">
			<div class="col-md-9 animated fadeInLeft">
				<p><i class="fa fa-hand-o-right"></i> សូមធ្វើការចុះឈ្មោះដើម្បីទទួលបានសេវាសិក្សាអនឡាញពេញលក្ខណៈ ដែលលោកអ្នកនឹងអាច ធ្វើការប្រលងសាកល្បងសមត្ថភាព។</p>
			</div>
			<div class="col-md-3 btn-buy animated fadeInRight">
				<a href="#" class="btn-u btn-u-lg"><?=$pageData->label->label->register->icon.' '.$pageData->label->label->register->title?></a>
			</div>
		</div>
	</div>
</div>





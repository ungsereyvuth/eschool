<!-- Navbar -->
<?php
	$menu='';
	foreach($pageData->data->component->frontend_menu as $key=>$value){
        $sub1='';$grouptitle='';
        if(count($value)==1){
            $grouptitle=$value[0]['title'];
            foreach ($value[0]['subjects'] as $key1 => $value1) {
                $subject_url=$pageData->label->label->subjectlesson->url.'/'.encode($value[0]['gradeid'].'_'.$value1['id']);
                $sub1.='<li><a href="'.$subject_url.'">'.$value1['title'].'</a></li>';
            }
        }else{
            foreach ($value as $key1 => $value1) {
                $sub2='';$grouptitle=$value1['title'];
                $grade_url=$pageData->label->label->grade->url.'/'.encode($value1['gradeid']);
                foreach ($value1['subjects'] as $key2 => $value2) {
                    $subject_url=$pageData->label->label->subjectlesson->url.'/'.encode($value1['gradeid'].'_'.$value2['id']);
                    $sub2.='<li><a href="'.$subject_url.'">'.$value2['title'].'</a></li>';
                }
                $sub2=$sub2==''?'':('<ul class="dropdown-menu">'.$sub2.'</ul>');
                $sub1.='<li class="'.($sub2==''?'':'dropdown-submenu').'">
                            <a href="'.$grade_url.'">'.$value1['gradename'].'</a>
                            '.$sub2.'
                        </li>';
            }            
        }
        $sub1=$sub1==''?'':('<ul class="dropdown-menu">'.$sub1.'</ul>');
        $menu.='<li class="'.($sub1==''?'':'dropdown').'">
                    <a '.($sub1=='href="#"'?'':'href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"').'>
                        '.$grouptitle.'
                    </a>
                    '.$sub1.'                      
                </li>';
	}				
?>

<!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
                <div class="container">
                    <ul class="nav navbar-nav">
                        <li><a href="/">ទំព័រដើម</a></li>
                        <?=$menu?>
                        <li><a href="/contactus">ទំនាក់ទំនង</a></li>
                        <li><a href="/about">អំពីយើង</a></li>
                    </ul>
                </div><!--/end container-->
            </div><!--/navbar-collapse-->
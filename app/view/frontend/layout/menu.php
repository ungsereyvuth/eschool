<!-- Navbar -->
<?php
	$menu='';
	foreach($pageData->data->component->frontend_menu as $key=>$value){
        $sub1='';$grouptitle='';
        if(count($value)==1){
            $grouptitle=$value[0]['title'];
            foreach ($value[0]['subjects'] as $key1 => $value1) {
                $subject_url='/subject/'.$value[0]['gradeid'].'_'.$value1['id'];
                $sub1.='<li><a href="'.$subject_url.'">'.$value1['title'].'</a></li>';
            }
        }else{
            foreach ($value as $key1 => $value1) {
                $sub2='';$grouptitle=$value1['title'];
                $grade_url='/grade/'.$value1['gradeid'];
                foreach ($value1['subjects'] as $key2 => $value2) {
                    $subject_url='/subject/'.$value1['gradeid'].'_'.$value2['id'];
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
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                បឋមសិក្សា
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a href="/lessons?level=primary&grade=1">ថ្កាក់ទី១</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/lesson/view/math">គណិតវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ជីវវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">រូបវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">គីមីវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ភាសាខ្មែរ</a></li>
                                        <li><a href="/lesson/view/math">ភាសាអង់គ្លេស</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="/lessons?level=primary&grade=2">ថ្កាក់ទី២</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/lesson/view/math">គណិតវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ជីវវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">រូបវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">គីមីវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ភាសាខ្មែរ</a></li>
                                        <li><a href="/lesson/view/math">ភាសាអង់គ្លេស</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="/lessons?level=primary&grade=3">ថ្កាក់ទី៣</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/lesson/view/math">គណិតវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ជីវវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">រូបវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">គីមីវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ភាសាខ្មែរ</a></li>
                                        <li><a href="/lesson/view/math">ភាសាអង់គ្លេស</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="/lessons?level=primary&grade=4">ថ្កាក់ទី៤</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/lesson/view/math">គណិតវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ជីវវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">រូបវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">គីមីវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ភាសាខ្មែរ</a></li>
                                        <li><a href="/lesson/view/math">ភាសាអង់គ្លេស</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="/lessons?level=primary&grade=5">ថ្កាក់ទី៥</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/lesson/view/math">គណិតវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ជីវវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">រូបវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">គីមីវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ភាសាខ្មែរ</a></li>
                                        <li><a href="/lesson/view/math">ភាសាអង់គ្លេស</a></li>
                                    </ul>
                                </li>                                
                                <li class="dropdown-submenu">
                                    <a href="/lessons?level=primary&grade=6">ថ្កាក់ទី៦</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/lesson/view/math">គណិតវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ជីវវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">រូបវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">គីមីវិទ្យា</a></li>
                                        <li><a href="/lesson/view/math">ភាសាខ្មែរ</a></li>
                                        <li><a href="/lesson/view/math">ភាសាអង់គ្លេស</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <?=$menu?>
                    </ul>
                </div><!--/end container-->
            </div><!--/navbar-collapse-->
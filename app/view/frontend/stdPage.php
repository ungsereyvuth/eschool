<?php include('app/view/'.$dir.'layout/base.php');?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
<?php include('app/view/'.$dir.'layout/meta.php');?>
<?php include('app/view/'.$dir.'layout/stylesheet.php');?>
</head>
<?php if($sn){?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1061675323904210';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Place this tag after the last share tag. -->
<script type="text/javascript">(function(){var po=document.createElement('script');po.type='text/javascript';po.async=true;po.src='https://apis.google.com/js/platform.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(po,s);})();</script>
<?php }?>

<body>
<div class="wrapper">
<!--=== Header v5 ===-->
<div class="header">
    <?php if(isset($pageData->data->component->topinfo)) include('app/view/'.$dir.'layout/topinfo.php');?>
    <?php if(isset($pageData->data->component->frontend_menu)) include('app/view/'.$dir.'layout/menu.php');?>
</div>
<!--=== End Header v5 ===-->	
<?php if(isset($pageData->data->component->slider)) include('app/view/'.$dir.'layout/slider.php');?>
	
<?php if(isset($pageData->data->component->breadcrumb)) include('app/view/'.$dir.'layout/breadcrumb.php');?>


<!--=== body content ===-->  
    	<?php
			$col_sidebar=0;$user_menu=$sidebar=false;
			if(isset($pageData->data->component->user_menu)){$col_sidebar=3;$user_menu=true;}
			elseif(isset($pageData->data->component->sidebar)){$col_sidebar=3;$sidebar=true;}
		?>
    
        	<div > <!--class="body_box"-->
            	<?php include ('app/view/'.$dir.'content/'.$pageData->fileview.'.php');?>
            </div>   
 
    	<?php if($user_menu) {include('app/view/'.$dir.'layout/user_menu.php');}?>
    	<?php if($sidebar) {include('app/view/'.$dir.'layout/sidebar.php');}?>        




<?php include('app/view/'.$dir.'layout/subscribe_box.php');?>
<!--=== Footer v4 ===-->
<div class="footer-v1">
    <?php include('app/view/'.$dir.'layout/footer.php');?>
    <?php include('app/view/'.$dir.'layout/copyright.php');?>
</div>
<!--=== End Footer v4 ===-->
</div>
<?php include('app/view/'.$dir.'layout/waitbox.php');?>
<?php include('app/view/'.$dir.'layout/script.php');?>
<script>
	jQuery(document).ready(function() {
		<?php if(isset($late_script)){echo $late_script;} ?>
	});
</script>
</body>
</html>

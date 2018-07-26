<?php
class login{
	public function data($input){
		$pageExist=false;
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'input'=>$input);
	}	
}
?>
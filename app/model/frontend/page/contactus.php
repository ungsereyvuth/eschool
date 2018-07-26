<?php
class contactus{
	public function data($input){
		$qry = new connectDb;global $usersession;
		$pageExist=false;
		
		$content = content('footer_contact');
		$contactInfo['info'] = $content['footer_contact']['description'];
		$contactInfo['map'] = '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7817.59965572413!2d104.910597!3d11.566203!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc464b23f83b4309a!2sMinistry+of+Tourism!5e0!3m2!1sen!2skh!4v1521779736908" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>';
		
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'contactInfo'=> (object) $contactInfo);
	}	
}
?>
<?php

class Home{

	function run(){
		F3::set('title',"Hit Booking");
		echo Template::instance()->render('welcome.html');
	}
};

?>

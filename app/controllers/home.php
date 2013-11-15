<?php

class Home{

	function run(){
		F3::set('title',"HIT 校园预约");
		F3::set('plan', Teacher::get_booking_plan(F3::get('COOKIE.se_user_id')));
		echo View::instance()->render('index.html');
	}

	function showlogin(){
		F3::set('title',"登录");
		F3::set('login_status','');
		echo Template::instance()->render('login.html');
	}

	function login(){
		F3::set('title',"登录");
		$user = User::valid(F3::get('POST.uname'), F3::get('POST.upass'));
		if($user !== false){ //login success
			User::login($user);
			F3::reroute('/');
		} else {
			F3::set('login_status','error');
			echo Template::instance()->render('login.html');
		}
	}
};

?>

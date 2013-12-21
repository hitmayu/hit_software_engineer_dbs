<?php

class Home{

	function run(){
		F3::set('title',"HIT 校园预约");
		F3::set('plan', Teacher::get_booking_plan(F3::get('COOKIE.se_user_id')));
		//F3::reroute('/fetion');
		echo View::instance()->render('index.html');
	}

	function showlogin(){
		F3::set('title',"登录");
		F3::set('login_status','');
		echo Template::instance()->render('login.html');
	}

	function login(){
		F3::set('title',"登录");
		//$name=F3::get('POST.uname');
		$check = User::valid(F3::get('POST.uname'), F3::get('POST.upass'));
		if($check !== false){ //login success
			$user_array=F3::get('DB')->exec('SELECT * FROM user WHERE name = :uname',
				array(':uname'=>F3::get('POST.uname')));
				/*if( count($user) > 0 ){
					echo Template::instance()->render('login.html');
				}else{
					F3::reroute('/');
				}*/
			$user=$user_array[0];
			setcookie('se_user_name', $user['name'], time() + 86400, '/');
			setcookie('se_user_type', $user['usertype'], time() + 86400, '/');
			setcookie('se_user_token', User::generate_login_token($user['id']), time() + 86400, '/');
			if($user['usertype']=='teacher')
			{
				$teacher=F3::get('DB')->exec('SELECT * FROM teacher WHERE tid=:utid',
					array(':utid'=>$user['id']));
				$teacher[0]['usertype']="teacher";
				//$teacher['name']=$user['name'];
				//$teacher['usertype']=$user['usertype'];
				User::login($teacher[0]);
			}
			else
			{
				$student=F3::get('DB')->exec('SELECT * FROM student WHERE sid=:usid',
					array(':usid'=>$user['id']));
				$student[0]['usertype']="sdudent";
				//$student['name']=$user['name'];
				//$student['usertype']=$user['usertype'];
				User::login($student[0]);
			}
			//User::login($user);
			F3::reroute('/');
		} else {
			F3::set('login_status','error');
			echo Template::instance()->render('login.html');
			
		}
	}
	function showSignUp(){
		F3::set('title',"注册");
		//F3::set("msg", "zhengchang");
		echo Template::instance()->render('signup.html');
	}

	function signUp(){
		F3::set('title',"注册");
		$info = array();
		$info['name'] = F3::get('POST.uname');
		$info['pass'] = F3::get('POST.upass');
		$info['pass_check'] = F3::get('POST.upass_check'); //TODO check pass
		//$info['phone'] = F3::get('POST.uphone');
		$info['type'] = F3::get('POST.ugroup');
		//Code::dump($info);

		$uid = User::signUp($info);

		//if(F3::get('GET.mobile') != false){
			// WEB客户端
		if($uid == -1){
			F3::set("has_submit", "true");
			//F3::set("success", "false");
			F3::set("msg", "密码输入不一致");
			//F3::set("p", F3::get('POST'));
			echo Template::instance()->render('signup.html');
		}else if($uid == -2){
			F3::set("has_submit", "true");
			//F3::set("success", "false");
			F3::set("msg", "该用户名已注册");
			//F3::set("p", F3::get('POST'));
			echo Template::instance()->render('signup.html');
		}else{
			F3::set("success_title", "注册成功!");

			setcookie('se_user_id', $uid, time() + 86400, '/');
			setcookie('se_user_name', $info['name'], time() + 86400, '/');
			setcookie('se_user_type', $info['type'], time() + 86400, '/');
			setcookie('se_user_token', user::generate_login_token($uid), time() + 86400, '/');
			
			if($info['type']=='teacher')//teacher
			{
				echo Template::instance()->render('tinfo.html');
			}
			else
				echo Template::instance()->render('sinfo.html');
			//F3::set("success_msg", "注意: 在注册成功之后, 排队也快乐会加您为飞信好友, 请务必同意, 否则无法享受短信通知服务.");
			//$msg = new PHPFetion(F3::get('Fetionphone'), F3::get('Fetionpasswd'));
			//$msg->addfriend("排队也快乐", $info['phone']);
			//echo Template::serve('user/successnotify.html');
		}
	}
	function showSinfo(){
		F3::set('title',"个人信息");
		echo Template::instance()->render('sinfo.html');
	}
	function showTinfo(){
		F3::set('title',"个人信息");
		echo Template::instance()->render('tinfo.html');
	}
	function sinfo()
	{
		$info=array();
		$info['sid'] = F3::get("COOKIE.se_user_id");
		$info['realname']=F3::get('POST.urealname');
		$info['phone']=F3::get('POST.uphone');
		$info['college']=F3::get('POST.ucollege');
		$info['specialty']=F3::get('POST.uspecialty');
		
		$r = F3::get('DB')->exec("INSERT INTO student VALUES (:usid,:uphone, :ucollege, :uspecialty,:urealname );",
				array(':usid'=>$info['sid'],':uphone' => $info['phone'],
					':ucollege'=> $info['college'],':uspecialty'=>$info['specialty'],
					':urealname' => $info['realname']));
		$info['usertype']="student";
		//$user=F3::get('DB')->exec('SELECT * FROM user WHERE id = :usid',
		//	array(':usid'=>$info['sid']));
		//$r['name']="mayu";
		//$r['usertype']=$user['usertype'];
		F3::set("success_msg", "温馨提示--在注册成功之后, 校园预约会加您为飞信好友, 请务必同意, 否则无法享受短信通知服务.");
		$msg = new PHPFetion(F3::get('Fetionphone'), F3::get('Fetionpasswd'));
		$msg->addfriend("校园预约", $info['phone']);
		User::login($info);
		F3::reroute('/');
		//echo Template::instance()->render('login.html');
	}
	function tinfo()
	{
		$info=array();
		$info['tid'] = F3::get("COOKIE.se_user_id");
		$info['realname']=F3::get('POST.urealname');
		$info['phone']=F3::get('POST.uphone');
		$info['college']=F3::get('POST.ucollege');
		$info['job']=F3::get('POST.ujob');
		$info['location']=F3::get('POST.ulocation');
		$r = F3::get('DB')->exec("INSERT INTO teacher VALUES (:utid,:uphone, :ucollege, :ulocation,:urealname ,:ujob);",
				array(':utid'=>$info['tid'],':uphone' => $info['phone'],
					':ucollege'=> $info['college'],':ulocation'=>$info['location'],
					':urealname' => $info['realname'],':ujob'=>$info['job']));
		//$user=F3::get('DB')->exec('SELECT * FROM user WHERE id = :utid',
		//	array('utid'=>$info['tid']));
		//$r['name']=$user['name'];
		//$r['usertype']=$user['usertype'];
		F3::set("success_msg", "温馨提示--在注册成功之后, 校园预约会加您为飞信好友, 请务必同意, 否则无法享受短信通知服务.");
		$msg = new PHPFetion(F3::get('Fetionphone'), F3::get('Fetionpasswd'));
		$msg->addfriend("校园预约", $info['phone']);
		$info['usertype']='teacher';
		User::login($info);
		F3::reroute('/');
	}
};

?>

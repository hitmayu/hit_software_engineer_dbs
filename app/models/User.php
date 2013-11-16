<?php

class User{

	static function valid($uname, $upass){
		$uname = trim($uname);
		$upass = trim($upass);

		if(empty($uname) || empty($upass)){
			return false;
		}

		$r = F3::get('DB')->exec('SELECT * FROM user WHERE name = :uname AND passwd = :upass', 
			array( ':uname' => $uname, ':upass' => $upass
		));

		if( count($r) > 0 ){
			return $r[0];
		}else{
			return false;
		}
	}
	static function exist($name, $value){
		$r = F3::get('DB')->exec('SELECT * FROM user WHERE name = :uname ',
			array( ':uname' => $value));
		if(count($r) > 0)
			return true;
		else
			return false;
	}
	static function signUp($info){
		//var_dump($info);
		if($info['pass'] !== $info['pass_check'])
			return -1;
		if(self::exist("name", $info['name']))
			return -2;
		//$uid = F3::get('DB')->lastinsertid();
		$r = F3::get('DB')->exec("INSERT INTO user VALUES ('', :uname, :upass,:uusertype);",
			array( ':uname' => $info['name'], ':upass' => $info['pass'],':uusertype'=>$info['type'])
		);
		$uid = F3::get('DB')->lastinsertid();//right?????

	//	if($info['type'] == "teacher"){//teacher
	//		$r = F3::get('DB')->exec("INSERT INTO teacher VALUES (:tid);",
	//			array( ':tid' => $uid)
	//		);
	//	}else{// student
		//	$r = F3::get('DB')->exec("INSERT INTO student VALUES (:sid);",
		//		array(':sid' => $uid)
		//	);
			//Code::dump($r);
		//}
		//self::login(array('uid' => $uid, 'name' => $info['name']));
		return $uid;
	}
	static function login($user){
		//setcookie('se_user_id', $user['id'], time() + 86400, '/');
		//setcookie('se_user_name', $user['name'], time() + 86400, '/');
		//setcookie('se_user_type', $user['usertype'], time() + 86400, '/');
		setcookie('se_user_realname', $user['realname'], time() + 86400, '/');	
		setcookie('se_user_phone', $user['phone'], time() + 86400, '/');
		setcookie('se_user_college', $user['college'], time() + 86400, '/');
		if($user['usertype']=='teacher')
		{
			setcookie('se_user_id', $user['tid'], time() + 86400, '/');
			setcookie('se_user_location', $user['location'], time() + 86400, '/');
			setcookie('se_user_job', $user['job'], time() + 86400, '/');
			setcookie('se_user_token', self::generate_login_token($user['tid']), time() + 86400, '/');

			
		}
		else
		{
			setcookie('se_user_id', $user['sid'], time() + 86400, '/');
			setcookie('se_user_specialty', $user['specialty'], time() + 86400, '/');
			setcookie('se_user_token', self::generate_login_token($user['sid']), time() + 86400, '/');

		}
		//setcookie('se_user_token', self::generate_login_token($user['id']), time() + 86400, '/');

		//Code::dump($user);
	}

	static function generate_login_token($uid){
		return md5( $uid . F3::get('TOKEN_SALT') );
	}
}

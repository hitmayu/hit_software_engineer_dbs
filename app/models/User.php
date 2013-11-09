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

	static function login($user){
		setcookie('se_user_id', $user['id'], time() + 86400, '/');
		setcookie('se_user_name', $user['name'], time() + 86400, '/');
		setcookie('se_user_token', self::generate_login_token($user['id']), time() + 86400, '/');

		//Code::dump($user);
	}

	static function generate_login_token($uid){
		return md5( $uid . F3::get('TOKEN_SALT') );
	}
}

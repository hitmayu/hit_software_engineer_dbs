<?php

class message{

	function sendMessage(){
		ignore_user_abort();
		set_time_limit(0);
		$interval=30;
		$iii=0;
		do 
		{
		$plan = F3::get('DB')->exec('SELECT * FROM booking_plan WHERE date=curdate() AND TIMEDIFF(time_to,curtime())>"00:29:29" AND TIMEDIFF(time_to,curtime())<"00:30:30"');
		$count= count($plan);
		for ($i=0; $i <$count ; $i++) {
				
				$tlocation=$plan[$i]['location']; 
				$tid=$plan[$i]['tid'];
				$p=F3::get('DB')->exec('SELECT * FROM teacher WHERE tid= :tid',
					array(':tid' => $tid));
				$phone=$p[0]['phone'];
				$tname=$p[0]['realname'];
				$tjob=$p[0]['job'];

				$msg = new PHPFetion(F3::get('Fetionphone'), F3::get('Fetionpasswd'));
				$msg->send($phone, "温馨提示--尊敬的{$tname}{$tjob}，您30分钟后在{$tlocation}有一个预约，请留心。");

				$plan_id=$plan[$i]['id'];
				$splan = F3::get('DB')->exec('SELECT * FROM booking_log WHERE plan_id=:plan_id',
					array(':plan_id'=>$plan_id));
				$scount=count($splan);
				for($j=0;$j<$scount;$j++)
				{
					$sid=$splan[$j]['sid'];
					$s=F3::get('DB')->exec('SELECT * FROM student WHERE sid= :sid',
						array(':sid'=>$sid));
					$sphone=$s[0]['phone'];
					$sname=$s[0]['realname'];
					$log_id=$splan[$j]['log_id'];
					$update=F3::get('DB')->exec('UPDATE booking_log SET status = "done" WHERE log_id =:log_id',
						array(':log_id'=>$log_id));
					//$file = fopen('/home/mayu/text.txt', 'a');
					//fwrite($file, '第'.$iii.'老师的电话：'.$phone.'同学的电话：：'.$sphone);
					//fclose($file);
					$msgs[$j] = new PHPFetion(F3::get('Fetionphone'), F3::get('Fetionpasswd'));
					$msgs[$j]->send($sphone, "温馨提示--亲爱的{$sname}同学，你30分钟后在{$tlocation}有一个预约，请留心。");
				}
			}
		sleep($interval);
		}while(true);
		
		
		
			
		/*$phone=18246049342;
		$tname="陈波宇";
		$tjob="大婶";
		$msg = new PHPFetion(F3::get('Fetionphone'), F3::get('Fetionpasswd'));
		$msg->send($phone, "温馨提示--尊敬的{$tname}{$tjob}，括号还在吗？");*/
		}
	};

?>
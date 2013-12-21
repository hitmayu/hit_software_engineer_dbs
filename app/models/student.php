<?php

class Student{

	static function get_booking_log($sid){
		$plan = F3::get('DB')->exec('SELECT * FROM booking_log WHERE sid = :sid and status != "canceled"', 
			array( ':sid' => $sid
		));
		$count= count($plan);
		for ($i=0; $i <$count ; $i++) {
			$tmp=F3::get('DB')->exec('SELECT * FROM booking_plan WHERE id = :id',
			array( ':id' => $plan[$i]['plan_id']
		));
			$teacher=F3::get('DB')->exec('SELECT * FROM teacher WHERE tid = :tid',
			array( ':tid' => $tmp[0]['tid']
		));
			$plan[$i]['date']=$tmp[0]['date'];
			$plan[$i]['teacher']=$teacher[0]['realname'];
			$plan[$i]['location']=$tmp[0]['location'];
			$plan[$i]['year']=self::c_substr($plan[$i]['date'], 0, 4);
			$plan[$i]['month']=self::c_substr($plan[$i]['date'], 5, 2);
			$plan[$i]['day']=self::c_substr($plan[$i]['date'], 8, 2);
		}
/*		for ($i=0; $i <$count; $i++) {
            if ($i>0) echo ",\n";
            $start_hour=floor($plan[$i]['time_from']/4)+6;
            $start_min=($plan[$i]['time_from']%4)*15;
            $end_hour=floor($plan[$i]['time_to']/4)+6;
            $end_min=($plan[$i]['time_to']%4)*15;
            echo '{\'id\':'.$plan[$i]['id'].', \'start\': new Date('.$plan[$i]['year'].', '.$plan[$i]['month'].', '.$plan[$i]['day'].', '.$start_hour.', '.$start_min.'), \'end\': new Date('.$plan[$i]['year'].', '.$plan[$i]['month'].', '.$plan[$i]['day'].', '.$end_hour.', '.$end_min.'),\'title\':\''.$plan[$i]['note'].'\'}';
        }*/
		return $plan;
	}

	static function c_substr($string, $from, $length = null){
    	preg_match_all('/[\x80-\xff]?./', $string, $match);
    	if(is_null($length)){
         	$result = implode('', array_slice($match[0], $from));
     	}else{ 
         	$result = implode('', array_slice($match[0], $from, $length)); 
     	} 
     	return $result;
	}
};
?>
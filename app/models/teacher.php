<?php

class Teacher{

	static function get_booking_plan($tid){
		$plan = F3::get('DB')->exec('SELECT * FROM booking_plan WHERE tid = :tid ', 
			array( ':tid' => $tid
		));
		$count= count($plan);
		for ($i=0; $i <$count ; $i++) { 
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

	static function insert_booking_event($booking_plan){
		$r = F3::get('DB')->exec("INSERT INTO booking_plan VALUES ('', :tid, :date, :max_num, :time_from, :time_to, :type, :address, :note);", 
			array( ':tid'=>$booking_plan['tid'], ':date'=>$booking_plan['date'], ':max_num'=>$booking_plan['max_num'], ':time_from'=>$booking_plan['time_from'], ':time_to'=>$booking_plan['time_to'], ':type'=>$booking_plan['type'], ':address'=>$booking_plan['address'], ':note'=>$booking_plan['note']
		));
	}

	static function update_booking_event($booking_plan){
		$r = F3::get('DB')->exec("UPDATE  booking_plan SET  date = :date, time_from = :time_from, time_to = :time_to WHERE  id =:id;", 
			array( ':id'=>$booking_plan['id'], ':date'=>$booking_plan['date'], ':time_from'=>$booking_plan['time_from'], ':time_to'=>$booking_plan['time_to']
		));
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

	static function delete_booking_event($id){
		$r=F3::get('DB')->exec("DELETE FROM booking_plan WHERE id = :id;", array(':id'=>$id));
		$r=F3::get('DB')->exec("UPDATE booking_log SET status='canceled' WHERE plan_id = :id;", array(':id'=>$id));
	}
};
?>
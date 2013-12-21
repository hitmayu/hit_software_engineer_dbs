<?php

class Teacherctl{

	function processing_booking_event(){
		$action=F3::get('POST.action');
		if($action=='add'){
			$booking_plan = array();
			$booking_plan['max_num']=F3::get('POST.people');
			if($booking_plan['max_num']==''){
				$booking_plan['max_num']=1;
			}
			$booking_plan['note']=F3::get('POST.note');
			$booking_plan['address']=F3::get('POST.address');
			$booking_plan['tid']=F3::get('COOKIE.se_user_id');
			$booking_plan['time_to']=F3::get('POST.end');
			$booking_plan['time_from']=F3::get('POST.start');
			$booking_plan['date']=F3::get('POST.date');
			if (F3::get('POST.confirm')) {
				$booking_plan['type']='asked';
			}else{
				$booking_plan['type']='free';
			}
			Teacher::insert_booking_event($booking_plan);
			//print_r($booking_plan);
			F3::reroute('/');
		}else if($action=='update'){
			$booking_plan = array();
			$booking_plan['id']=F3::get('POST.id');
			$booking_plan['time_to']=F3::get('POST.end');
			$booking_plan['time_from']=F3::get('POST.start');
			$booking_plan['date']=F3::get('POST.date');
			Teacher::update_booking_event($booking_plan);
		}else if($action=='delete'){
			$id=F3::get('POST.id');
			Teacher::delete_booking_event($id);
			F3::reroute('/');
		}else{
			F3::reroute('/');
		}	
	}
};

?>

<?php
class StudentController{
	function showsearchT()
	{
		F3::set('title',"查询教师");
		echo Template::instance()->render('searchT.html');
	}
	function searchT()
	{
		F3::set('title',"查询结果");
		$tname=F3::get('POST.utname');
		$tinfo_array=F3::get('DB')->exec('SELECT * FROM teacher WHERE realname =:urealname',
			array(':urealname'=>$tname));
		$tinfo=$tinfo_array[0];
		F3::set('urealname',$tinfo['realname']);
		F3::set('uphone',$tinfo['phone']);
		F3::set('ucollege',$tinfo['college']);
		F3::set('ujob',$tinfo['job']);
		F3::set('ulocation',$tinfo['location']);
		F3::set('utid',$tinfo['tid']);
		echo Template::instance()->render('listTinfo.html');
		
	}
	function showsBooking()
	{
		F3::set('title',"预约");
		F3::set('utid',F3::get('GET.utid'));
		//$tid=F3::get('GET.utid');
		//echo $tid;
		echo Template::instance()->render('booking.html');
	}
	function sbooking()
	{
		F3::set('title',"预约");
		$time_from=F3::get('POST.utime_from');
		$time_to=F3::get('POST.utime_to');
		echo $time_from;
		echo $time_to;	
	}
};
?>
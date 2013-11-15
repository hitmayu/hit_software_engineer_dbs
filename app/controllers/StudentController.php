<?php
class StudentController{
	function showsearchT()
	{
		F3::set('title',"查询教师");
		echo Template::instance()->render('searchT.html');
	}
	function searchT()
	{
		
		$tname=F3::get('POST.utname');
		$tinfo_array=F3::get('DB')->exec('SELECT * FROM teacher WHERE realname =:urealname',
			array(':urealname'=>$tname));
		$tinfo=$tinfo_array[0];
		F3::set('urealname',$tinfo['realname']);
		F3::set('uphone',$tinfo['phone']);
		F3::set('ucollege',$tinfo['college']);
		F3::set('ujob',$tinfo['job']);
		F3::set('ulocation',$tinfo['location']);
		echo Template::instance()->render('listTinfo.html');
		
	}
};
?>
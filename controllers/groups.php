<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kaia
 * Date: 4.06.13
 * Time: 11:01
 * To change this template use File | Settings | File Templates.
 */

class groups {
	function index(){
		global $request;
		$this->scripts[] = 'groups_index_add.js';

		$groups=get_all("SELECT * FROM `group` GROUP BY group_id");

		if(isset($_POST["group"])):$group_name=$_POST["group"];
		$group_id=get_one("INSERT INTO `group` SET group_name='$group_name'");
		endif;
		if(!empty($groups)):foreach($groups as $group):
		$numbers=get_all("SELECT COUNT(student_id) as 'number' FROM student WHERE student.group_id='$group[group_id]'");
			$numbers=$numbers[0];
			foreach($numbers as $number){
				$group["number"]=[$number];
			}

	        endforeach;endif;
		require 'views/master_view.php';
	}
	function selected(){
		global $request;
		$group_id = $request->params[0];
		$students=get_all("SELECT * FROM `student` WHERE group_id='$group_id'");

		require 'views/master_view.php';

	}

}
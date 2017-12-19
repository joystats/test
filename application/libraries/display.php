<?php
class Display{
	function thaidate($date){
		$month_array=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$d=date("j",strtotime($date));
		$m=date("m",strtotime($date));
		$y=date("Y",strtotime($date))+543;
		
		return $d." ".$month_array[($m-1)]." ".$y." ".date("H:i",strtotime($date))." น.";				
	}
	function convertDateFormat($date,$returnType='th'){
		if($returnType=="th"){
			list($year,$month,$day)=explode("-",$date);
			return $day."/".$month."/".$year;
		}
		if($returnType=="en"){
			list($day,$month,$year)=explode("/",$date);
			return $year.'-'.$month.'-'.$day;
		}
	}
}
?>
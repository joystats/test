<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thaidate extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	function short_month($timestamp){
		$month=array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
		$m=date("n",strtotime($timestamp));
		return date("j",strtotime($timestamp))." ".$month[$m-1]." ".(date("Y",strtotime($timestamp))+543)." ".date("H:i:s",strtotime($timestamp));
	}
	
	function long_month($timestamp){
		$month=array('มกราคม','กุมภาพันธ์.','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
		$m=date("n",strtotime($timestamp));
		return date("j",strtotime($timestamp))." ".$month[$m-1]." ".(date("Y",strtotime($timestamp))+543);//." ".date("H:i",strtotime($timestamp))." น.";
	}
	function timedate($timestamp){
		$month=array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
		$m=date("n",strtotime($timestamp));
		return (date("d",strtotime($timestamp))*1)." ".$month[$m-1]." ".(date("Y",strtotime($timestamp))+543);
	}
	function timedate_min($timestamp){
		$month=array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
		$m=date("n",strtotime($timestamp));
		return (date("d",strtotime($timestamp))*1)." ".$month[$m-1]." ".(date("Y",strtotime($timestamp))+543)." ".date("H:i",strtotime($timestamp));
	}
	function left_date($date){
		$month=array('มกราคม','กุมภาพันธ์.','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
		$timestamp=strtotime($date);
		$now_stamp=time();
		$diff=$now_stamp-$timestamp;
		if($diff>2592000){
			$m=date("n",strtotime($timestamp));
			return (date("d",strtotime($timestamp))*1)." ".$month[$m-1]." ".(date("Y",strtotime($timestamp))+543);
		}elseif($diff>86400){
			return floor($diff/86400)." วันที่แล้ว";
		}elseif($diff>3600){
			return floor($diff/3600)." ชั่วโมงที่แล้ว";
		}elseif($diff>60){
			echo floor($diff/60)." นาทีที่แล้ว";
		}else{
			echo $diff." วินาทีที่แล้ว";
		}
	}
	function range_date($date_start,$date_back){
		$month_array=array("ม.ค.","ก.พ.","มี.ค","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		
		if($date_start>0 && $date_back>0){
			$d_1=date("d",strtotime($date_start));
			$m_1=date("m",strtotime($date_start));
			$y_1=date("Y",strtotime($date_start))+543;
			
			$d_2=date("d",strtotime($date_back));
			$m_2=date("m",strtotime($date_back));
			$y_2=date("Y",strtotime($date_back))+543;
			
			if($m_1==$m_2){
				return ($d_1*1)."-".($d_2*1)." ".$month_array[($m_1-1)]." ".$y_1;
			}else{
				return ($d_1*1)." ".$month_array[($m_1-1)]."-".($d_2*1)." ".$month_array[($m_2-1)]." ".$y_2;
			}
		}
		
	}
	
}

<?php
	function dtPadrao($data) {
		$data = trim($data);
		if (strlen($data) < 10)
		{
			$rs = "";
		}
		else
		{
			$arr_data = explode(" ",$data);
			$data_db = $arr_data[0];
			$arr_data = explode("-",$data_db);
			$data_form = $arr_data[2]."/".$arr_data[1]."/".$arr_data[0];
			$rs = $data_form;
		}
		return $rs;
	}

?>
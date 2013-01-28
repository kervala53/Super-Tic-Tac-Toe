<?php
$patara = "000100000";
$didi = "000000000000000000000000000000000000000000000000000000000000000000000000000000000";
for($i=0;$i<3;$i++){
	for($i=0;$i<9;$i++){
		if($patara{$i}==1 || $patara{$i}==2){
			$i++;
		}
		$didi{$j*$i};
	}
}
$won = false;
$whowon =5;
for($i=0;$i<3;$i++){
	for($j=0;$j<3;$j++){
		if($j=0){			
			if($patara{$i*3+$j}==0 && $patara{$i*3+$j+1}==0 && $patara{$i*3+$j+2}==0){
				$won = true;
				$whowon =0;
			}
			if($patara{$i*3+$j}==1 && $patara{$i*3+$j+1}==1 && $patara{$i*3+$j+2}==1){
				$won = true;
				$whowon =0;
			}
		}	
	}
}
$patara


?>
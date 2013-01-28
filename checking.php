<?php
$patara = "000100000";
$didi = "000000000000000000000000000000000000000000000000000000000000000000000000000000000";
$temp;
// for($i=0;$i<3;$i++){
	// for($i=0;$i<9;$i++){
		// if($patara{$i}==1 || $patara{$i}==2){
			// $i++;
		// }
		// $didi{$j*$i};
	// }
// }for($i=0;$i<9;$i++){
	if($patara{$i}==0){
		$temp = $temp.$didi{$i*3};
		$temp = $temp.$didi{$i*3+1};
		$temp = $temp.$didi{$i*3+2};
		$temp = $temp.$didi{$i*3+9};
		$temp = $temp.$didi{$i*3+10};
		$temp = $temp.$didi{$i*3+11};
		$temp = $temp.$didi{$i*3+18};
		$temp = $temp.$didi{$i*3+19};
		$temp = $temp.$didi{$i*3+20};
		//gamodzaxeba shemocmeba mag dapis mere
	}
}

$won = false;
$whowon =5;
for($i=0;$i<3;$i++){
	for($j=0;$j<3;$j++){
		if($j==0){
			if($patara{$i*3+$j}==0){
				if($patara{$i*3+$j+1}==0 && $patara{$i*3+$j+2}==0){
					$won = true;
					$whowon =0;
				}
			}
			else{
				if($patara{$i*3+$j+1}==1 && $patara{$i*3+$j+2}==1){
					$won = true;
					$whowon =1;
				}
			}	
			if($i==0){
				if($patara{0}==0){
					if($patara{4}==0 && $patara{8}==0){
						$won = true;
						$whowon =0;
					}
				}
				else{
					if($patara{4}==1 && $patara{8}==1){
						$won = true;
						$whowon =1;
					}
				}
			}	
		}
		if($i==0){
			if($patara{$j}==0){
				if($patara{$j+3}==0 && $patara{$j+6}==0){
					$won = true;
					$whowon =0;
				}
			}
			else{
				if($patara{$j+3}==1 && $patara{$j+6}==1){
					$won = true;
					$whowon =1;
				}
			}
			if($j==2){
				if($patara{2}==0){
					if($patara{4}==0 && $patara{6}==0){
						$won = true;
						$whowon =0;
					}
					
				}
				else{
					if($patara{4}==1 && $patara{6}==1){
						$won = true;
						$whowon =1;
					}
					
				}
			}
		}	
	}
}


?>
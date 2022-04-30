<?php
//冒泡排序
$arr = array(1,2,3,4,5,6,7,8,9,10);
$len = count($arr);
for($i=0;$i<$len;$i++){
	for($j=0;$j<$len-$i-1;$j++){
		if($arr[$j]>$arr[$j+1]){
			$tmp = $arr[$j];
			$arr[$j] = $arr[$j+1];
			$arr[$j+1] = $tmp;
		}
	}
}
print_r($arr);
//插入排序
$arr = array(1,2,3,4,5,6,7,8,9,10);
$len = count($arr);
for($i=1;$i<$len;$i++){
    $tmp = $arr[$i];
    $j = $i-1;
    while($j>=0 && $arr[$j]>$tmp){
        $arr[$j+1] = $arr[$j];
        $j--;
    }
    $arr[$j+1] = $tmp;
}
print_r($arr);

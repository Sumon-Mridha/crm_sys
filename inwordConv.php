<?php 
function numberToWord($value)
{
	$digit = array('','one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen');
	$list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
   
	$nw = (string)$value;
	$len = strlen($nw);
	$word = '';
	if ($len>0 && $len<4) {
		if ($len<2){
			$word = $digit[$value];
			return $word;
		}
		for ($i=$len-1; $i >= 0; $i-=3){
			$num = (int)$value;
			if ($num<20) {
				$word = $digit[$num].$word;
			}
			elseif($num<100){
				$word = $list2[$nw[($i-1)]].$digit[$nw[$i]].$word;
			}
			else{
				$word = $digit[$nw[($i-2)]].' '.$list2[10].' '.$list2[$nw[($i-1)]].$digit[$nw[$i]].$word;
			}
		}
		return $word;
	}
	else
		return null;
}
// echo numberToWord(500);

function inword($value='')
{
	if ($value==null) {
		return 0;
	}
	 $list3 = array('','thousand', 'lac', 'crore');
	 $patt = array(3,2,2);
	 $word = '';
	 $str = (string)$value;
	 $len = strlen($str);
	 $trc = 0;
	 $act = 0;
	 $num='';
	 $p = 0;
	 for ($i = $len-1; $i >= 0; $i--) {
	 	$act++;
	 	$num = $str[$i].$num;
	 	if ($act == $patt[$trc] || $i==0){
	 		if((int)$num==0){
	 			$n=0;
	 		}
	 		else{
	 			$n=$p;
	 		}
	 		$word = numberToWord($num).' '.$list3[$n].' '.$word;
	 		$trc++;
	 		$p++;
	 		$act = 0;
	 		$num='';
	 		if ($trc==3) {
	 			$trc = 0;
	 		}
	 		if ($p == 4) {
	 			$p = 0;
	 		}
	 	}	
	 }
	return ucwords(trim($word));
}

 ?>
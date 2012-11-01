<?php
session_start();
function date_diff($start, $end="NOW")
{
		 
         $sdate = strtotime($start);
         $edate = strtotime($end);

         $time = $edate - $sdate;
        if($time>=0 && $time<=59) {
                // Seconds
                $timeshift = $time.' seconds ';

        } elseif($time>=60 && $time<=3599) {
                // Minutes + Seconds
                $pmin = ($edate - $sdate) / 60;
                $premin = explode('.', $pmin);
                
                $presec = $pmin-$premin[0];
                $sec = $presec*60;
                
                $timeshift = $premin[0].' min '.round($sec,0).' sec ago';

        } elseif($time>=3600 && $time<=86399) {
                // Hours + Minutes
                $phour = ($edate - $sdate) / 3600;
                $prehour = explode('.',$phour);
                
                $premin = $phour-$prehour[0];
                $min = explode('.',$premin*60);
                
                $presec = '0.'.$min[1];
                $sec = $presec*60;

                $timeshift = $prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ago';

        } elseif($time>=86400 && $time<=2678399 ) {
                // Days + Hours + Minutes
				
				$pday = ($edate - $sdate) / 86400;
                $preday = explode('.',$pday);

                $phour = $pday-$preday[0];
                $prehour = explode('.',$phour*24); 

                $premin = ($phour*24)-$prehour[0];
                $min = explode('.',$premin*60);
                
                $presec = '0.'.$min[1];
                $sec = $presec*60;
                
                $timeshift = $preday[0].' days ago';

        }
		elseif($time>=2678400 && $time <= 32140799) {
                // Months+ Days + Hours + Minutes
				
				$pmonth = ($edate - $sdate) / 2678400;
                $premonth = explode('.',$pmonth);
				
				$pday = $pmonth - $premonth[0];
                $preday = explode('.',$pday * 31);

                $phour = $pday-$preday[0];
                $prehour = explode('.',$phour*24); 

                $premin = ($phour*24)-$prehour[0];
                $min = explode('.',$premin*60);
                
                $presec = '0.'.$min[1];
                $sec = $presec*60;
                
                $timeshift = $premonth[0].' months ago';

        }
		elseif($time>=32140800) {
                // Months+ Days + Hours + Minutes
				
				$pyear = ($edate - $sdate) / 32140800;
                $preyear = explode('.',$pyear);
				
				
				$pmonth = $pyear - $preyear[0];
                $premonth = explode('.',$pmonth*12);
				
				$pday = $pmonth - $premonth[0];
                $preday = explode('.',$pday * 31);

                $phour = $pday-$preday[0];
                $prehour = explode('.',$phour*24); 

                $premin = ($phour*24)-$prehour[0];
                $min = explode('.',$premin*60);
                
                $presec = '0.'.$min[1];
                $sec = $presec*60;
                
                $timeshift = $preyear[0].' years ago';

        }
       return $timeshift;
}
?>
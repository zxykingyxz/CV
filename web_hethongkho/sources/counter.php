<?php
	$today            =    'Hôm nay';
    $yesterday        =    'Ngày hôm qua';
    $x_month        =    'Tháng hiện tại';
    $x_week            =    'Tuần hiện tại';
    $all            =    'Lượt truy cập';
    
    $locktime        =  15;
    $initialvalue    =    1;
    $records        =    100000;
    
    $s_today        =    1;
    $s_yesterday    =    1;
    $s_all            =    1;
    $s_week            =    1;
    $s_month        =    1;
    
    $s_digit        =    1;
    $disp_type        =     'Mechanical';
    
    $widthtable        =    '60';
    $pretext        =     '';
    $posttext        =     '';
    $locktime        =    $locktime * 60;
    // Now we are checking if the ip was logged in the database. Depending of the value in minutes in the locktime variable.
    $day             =    date('d');
    $month             =    date('n');
    $year             =    date('Y');
    $daystart         =    mktime(0,0,0,$month,$day,$year);
    $monthstart         =  mktime(0,0,0,$month,1,$year);
    // weekstart
    $weekday         =    date('w');
    $weekday--;
    if ($weekday < 0)    $weekday = 7;
    $weekday         =    $weekday * 24*60*60;
    $weekstart         =    $daystart - $weekday;

    $yesterdaystart     =    $daystart - (24*60*60);
    $now             =    time();
    $ip                 =    $_SERVER['REMOTE_ADDR'];
    
    $query             =    "SELECT MAX(id) AS total FROM counter";
    $t = $db->rawQueryOne($query);
    $all_visitors     =    $t['total'];
    
    if ($all_visitors !== NULL) {
        $all_visitors += $initialvalue;
    } else {
        $all_visitors = $initialvalue;
    }
    
    // Delete old records
    $temp = $all_visitors - $records;
    
    if ($temp>0){
        $query         =  "DELETE FROM counter WHERE id<'$temp'";
        $db->rawQuery($query);
    }
    
    $query             =    "SELECT COUNT(*) AS visitip FROM counter WHERE ip='$ip' AND (tm+'$locktime')>'$now'";
    $vip  = $db->rawQueryOne($query);
    $items             =    $vip['visitip'];
    
    if (empty($items))
    {
        $query = "INSERT INTO counter (tm, ip) VALUES ( '$now', '$ip')";
        $db->rawQuery($query);
    }
    
    $n                 =     $all_visitors;
    $div = 100000;
    while ($n > $div) {
        $div *= 10;
    }

    $query             =    "SELECT COUNT(*) AS todayrecord FROM counter WHERE tm>'$daystart'";
    $todayrec  = $db->rawQueryOne($query);
    $today_visitors     =    $todayrec['todayrecord'];
    
    $query             =    "SELECT COUNT(*) AS yesterdayrec FROM counter WHERE tm>'$yesterdaystart' and tm<'$daystart'";
    $yesrec  = $db->rawQueryOne($query);
    $yesterday_visitors     =    $yesrec['yesterdayrec'];
        
    $query             =    "SELECT COUNT(*) AS weekrec FROM counter WHERE tm>='$weekstart'";
    $weekrec = $db->rawQueryOne($query);
    $week_visitors     =    $weekrec['weekrec'];

    $query             =    "SELECT COUNT(*) AS monthrec FROM counter WHERE tm>='$monthstart'";
    $monthrec  = $db->rawQueryOne($query);
    $month_visitors     =    $monthrec['monthrec'];
    
    $counter ='';
   
       
  
    // Show today, yestoday, week, month, all statistic
    if($s_today)        $counter        .= '<li class="online"><img src="images/vtoday.gif" style="margin-right:10px"/> '.$today.': <strong>'.$today_visitors.'</strong></li>';
    if($s_yesterday)    $counter        .= '<li class="guest"><img src="images/vyesterday.gif" style="margin-right:10px"/> '.$yesterday.': <strong>'.$yesterday_visitors.'</strong></li>';
   
    if($s_week)            $counter        .= '<li class="page"><img src="images/vweek.gif" style="margin-right:10px"/> '.$x_week.': <strong>'.$week_visitors.'</strong></li>';
    if($s_month)        $counter        .=  '<li class="month"><img src="images/vmonth.gif" style="margin-right:10px"/> '. $x_month.': <strong>'.$month_visitors.'</strong></li>';
    if($s_all)            $counter        .=  '<li class="statistics"><img src="images/vall.gif" style="margin-right:10px"/> '. $all.': <strong>'.$all_visitors.'</strong></li>';

?> 
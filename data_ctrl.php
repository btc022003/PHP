<?php
/**
 * User: yuluo
 * Date: 2015-05-08
 * Time: 下午3:08
 * Desc:实现生成指定月份的日历信息 在此基础上可以无限遐想和扩展...
 */
date_default_timezone_set("Asia/Shanghai");
$time_now = time(); //strtotime("2015-02-04");


function getCurMonthFirstDay($date)
{
    return date('Y-m-01', strtotime($date));
}

function getCurMonthLastDay($date)
{
    return date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));
}


//$time_now = strtotime("2015-05-11");

$str_time_now = date("Y-m-d", $time_now); ////////字符串格式的当前时间
$current_month_first_day = getCurMonthFirstDay($str_time_now); /////////当前月的第一天

$current_month_first_w_val = intval(date("w", strtotime($current_month_first_day))); //////当前月第一天是一周的第几天 周日(0)是第一天


$current_month_last_day = getCurMonthLastDay($str_time_now); ////////当前月的最后一天


$current_week_val = date("w", $time_now);
$current_day_val = date("j", $time_now);
$last_day_val = date("j", strtotime($current_month_last_day)); ////////当前月最后一天的天索引


$strart_time = false;

$int_day_val = 1;

$ctrl_step = $last_day_val + $current_month_first_w_val; ////////控件结束的位置索引

for ($i = 0; $i < 42; $i++) {

    if ($i == $current_month_first_w_val) {

        $strart_time = true;
    }

    if ($i >= $ctrl_step) {
        $strart_time = false;
    }

    if ($strart_time) {

        ?>
        <div class="has-month-day" id="day_<?php echo($int_day_val); ?>"
            style="width:20px;border-width: 1px;border-color: #ff0011;border-style: solid;margin-left: 2px;float: left;"><?php echo($int_day_val); ?></div>
        <?php

        $int_day_val++;

    } else {
        ?>
        <div
            style="width:20px;border-width: 1px;border-color: #ff0011;border-style: solid;margin-left: 2px;float: left;"></div>
    <?php
    }


    if ((($i + 1) % 7) == 0) {
        ?>
        <div class="without-month-day" style="clear: both;"/>
        <br/>
    <?php

    }
    

}
?>

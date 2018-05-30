<?php 
abstract class Staff
{
    abstract public function staffData();
}

class CommonStaff extends Staff
{
    public function staffData()
    {
        return "小名，小红，小黑";
    }
}

class VipStaff extends Staff
{
    public function staffData()
    {
        return '小星、小龙';
    }
}


// 抽象父类
abstract class SendType
{
    abstract public function send($to, $content);
}

class QQSend extends SendType
{
    public function __construct()
    {
        // 与QQ接口连接方式
    }

    public function send($to, $content)
    {
        return $content. '（To '. $to . ' From QQ）<br>';
    }
}

class SendInfo
{


    public function sending(Staff $level,SendType $method )
    {
        $staffArr = $level->staffData();
        $result = $method->send($staffArr, $content);
        echo $result;
    }
}

$info = new SendInfo();
$info->sending(new VipStaff(), new QQSend());

$info->sending(new CommonStaff(), new QQSend());

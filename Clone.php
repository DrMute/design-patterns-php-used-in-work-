<?
class Person
{
    //下面是人的成员属性
    var $name;    //人的名子
    var $sex;    //人的性别
    var $age;    //人的年龄

    //定义一个构造方法参数为属性姓名$name、性别$sex和年龄$age进行赋值
    function __construct($name = "", $sex = "", $age = "") {
        $this->name=$name;
        $this->sex=$sex;
        $this->age=$age;
    }

    //这个人可以说话的方法, 说出自己的属性
    function say() {
        echo "我的名子叫：" . $this->name . " 性别：" . $this->sex . " 我的年龄是：" . $this->age . "<br>";
    }

    //对象克隆时自动调用的方法, 如果想在克隆后改变原对象的内容，需要在__clone()中重写原本的属性和方法
    function __clone() {

        //$this指的复本p2, 而$that是指向原本p1，这样就在本方法里，改变了复本的属性。
        $this->name = "我是假的 $that->name";
        $this->age = 30;
    }

}

$p1 = new Person("张三", "男", 20);
$p2 = clone $p1;
$p1->say();
$p2->say();
?>

上例输出：

我的名子叫：张三 性别：男 我的年龄是：20
我的名子叫：我是假的张三 性别：男 我的年龄是：30

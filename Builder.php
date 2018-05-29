<?php
/**
 * 短信
 *
 */
class Sms implements MessageInterface
{

    // 短信通道
    protected $supplier = '***';

    // 接受者手机号码
    protected $mobiles;

    protected $type;

    // 短信内容
    protected $content;


    protected  $params;
    use DispatchesJobs;
    /**
     * constructor
     */
    public function __construct($params = [])
    {
        $this->params = $params;
        $this->parseParams($params);
    }

    /**
     * 解析参数
     */
    public function parseParams($params)
    {
        foreach($params as $k => $v)
        {
            if (method_exists($this,$k))
            {
                $this->$k($v);
            }
        }
    }

    /**
     * 直接发送：
     */
    public function send($data=null)
    {

        $supplier = __NAMESPACE__.'\\Sms\\'.Str::studly($this->supplier);
        if ( ! class_exists($supplier)) {
            throw new \Exception('Sms :' .$this->via .' not defined!');
        }

        $content = $this->getContent();

        if (empty($content))
        {
            throw new \Exception('Sms : content is empty!');
        }

        $mobiles = $this->mobiles;
        if (is_array($mobiles)) $mobiles = implode(',',$mobiles);


        return (new $supplier())->send($mobiles, $content);

    }

    /**
     * 生成短信内容
     */
    public function getContent()
    {
        if (! empty ($this->content))
        {
            return $this->content;
        }

        if (! isset($this->type)) return false;

        if (preg_match('/^verify/',$this->type))
        {
            $verify_code = $this->genVerifyCode();
        } else {
      
        }

        return $content;
    }

    /**
     * 通过队列发送：
     */
    public function queue($time=null)
    {
        return $this->dispatch(new Pusher($this));
    }

    /**
     * 定义接收者
     */
    public function to($mobiles)
    {
        $this->mobiles = $mobiles;
        return $this;
    }

    /**
     * 定义短信通道
     */
    public function via($supplier)
    {
        $this->supplier = $supplier;
        return $this;
    }

    /**
     * 定义发送类型
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 短信内容
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * 随机生成4位短信验证码：
     */
    public function genVerifyCode()
    {
        return rand(1000,9999);
    }
}

interface MessageInterface
{

    /**
     * 发送接口函数
    */
    public function send($data);

    /**
     * 队列接口函数
    */
    public function queue($time);

    /**
     * 接受者定义函数
    */
    public function to($user);


}

//场景类

class Message
{


    public function __construct()
    {
    }

    protected function make($method, $params)
    {

        $channel = __NAMESPACE__.'\\Channels\\'.Str::studly($method);

        if ( ! class_exists($channel)) {
            throw new \Exception('Channel :' .$method .' not exists!');
        }

        $app = new $channel(...$params);

        if (! $app instanceof MessageInterface )
        {
            throw new \Exception('对象类型错误');
        }

        return $app;

    }

    public static function __callStatic($method, $params)
    {
        return (new self)->make($method, $params);
    }
}


?>

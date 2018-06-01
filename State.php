abstract class State  
{  
  
    //设备  
    prottected $_device;  
  
    //初始化时，将设备传入  
    public function __construct($device)  
    {  
        $this->_device = $device;  
    }  
  
    //入库  
    abstract public function storage();  
      
    //分配使用  
    abstract public function assign();  
      
    //维修  
    abstract public function repire();  
      
    //报废  
    abstract public function discard();  
}  
class NewState extends State  
{  
    public function storage()  
    {  
        echo "入库".PHP_EOL;  
  
        //入库完成后就切换成已入库状态。需要用到后面的Device类  
        $this->_device->setState(Device::STATE_STORAGED);   
    }  
  
    public function assign()  
    {  
        //不允许分配，什么都不做  
    }  
  
    public function repire()  
    {  
        //待入库状态，无需维修  
    }  
  
    public function discard()  
    {  
        //待入库状态，不能报废  
    }  
}  
class Device  
{  
    //定义状态  
    const STATE_NEW      = 'new';  
    const STATE_STORAGED = 'storaged';  
    const STATE_READY    = 'ready';  
    const STATE_USING    = 'using';  
    const STATE_REPIRE   = 'repire';  
    const STATE_DISCARD  = 'discard';  
      
    //可以有的状态  
    protected static $_allowState = array(  
        self::STATE_NEW,  
        self::STATE_STORAGED,  
        self::STATE_READY,  
        self::STATE_USING,  
        self::STATE_REPIRE,  
        self::STATE_DISCARD,  
    );  
  
    //表示当前的设备状态  
    protected $_state;  
      
    //初始化时，默认状态为待入库状态  
    public function __construct()  
    {  
        //初始化所有状态  
        foreach (self::$_allowState as $name) {  
            $name = "_{$name}State";  
            $className = ucfirst($name).'State';  
            $this->$name = new $className($this);  
        }  
        $this->_state = $this->_newState;  
    }  
  
    //设置当前的状态  
    public function setState($state)  
    {  
        $name = "_".$state."State";  
        $this->_state = $this->$name;  
    }  
  
    //入库  
    public function storage()  
    {  
        $this->_state->storage();  
    }  
  
    //分配  
    public function assign()  
    {  
        $this->_state->assign();  
    }  
  
    //维修  
    public function repire()  
    {  
        $this->_state->repire();  
    }  
  
    //报废  
    public function discard()  
    {  
        $this->_state->discard();  
    }  
}  

class user{
    // 得到用户信息
    public function getInfo($uid){
  }
}

class VProxy{
  
    // 单例,如果在复杂资源时比较有用，如SOAP/DB等
    static private $_instance = array();    
  
    /**
     * 单例模式返回实现(推荐)
     *
     * @param string $model 接口模型名
     * @return object
     */
    static public function getInstance($model)
    {
        $model = strtolower($model);
        if(!isset(self::$_instance[$model])){
            self::$_instance[$model] = new self($model);
        }
        return self::$_instance[$model];
    }
  
    /**
     * 当前调用接口的实例
     *
     * @var unknown_type
     */
    private $_model = null;
    private $_modelName = '';
  
    /**
     * 构造函数
     *
     * @param string $model 接口模型名
     */
    public function __construct($model){
        include_once($model.'.php');
        $this->_modelName = $model;
        $this->_model = new $model;
    }
  
    /**
     * proxy核心方法
     *
     * @param string $functionName :方法名
     * @param mixed $args :传给方法的参数
     * @return unknown
     */
    public function __call($functionName,$args)
    {
        // 调用接口
        $result = call_user_func_array(array($this->_model, $functionName), $args));
        // 写日志
        writeLog($this->_modelName,$functionName,$args,$result);
        // 返回结果
        return $result;
    }
}
  
// 调用实例
$face = VProxy::getInstance('user');
$info = $face->getInfo(100);

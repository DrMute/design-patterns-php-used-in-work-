<?php 
trait trait_singleton {
    private static $class = array ();
    /**
     * @return self
     */
    static function getInstance(){
        $name = get_called_class ();
        $args = func_get_args();
        $key = md5($name . $args);
        if (! isset(self::$class[$key])){
            $reflection = new ReflectionClass($name);
            self::$class[$key] = $reflection->newInstanceArgs($args);
        }
        return self::$class[$key];
    }
}



class Singleton
{
    use trait_singleton;
    protected  static $instance=null;
    protected $_handle;
    protected $id;

    public function __construct(){}

/*    public static function getInstance()
    {
        if (self::$instance == null) 
        {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }
    */
    public function update($id)
    {
        $this->id=$id;
        var_dump($this->id);
    }
    
    
}

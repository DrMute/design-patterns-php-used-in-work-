interface ChargeStrategy
{
    public function charge();
}
// 支付宝策略类
class AliCharge implements ChargeStrategy
{
    public function charge()
    {
        // 完成支付宝的相关逻辑
    }
}

// 微信策略类
class WxCharge implements ChargeStrategy
{
    public function charge()
    {
        // 完成微信的相关逻辑
    }
}

final class ChargeContext
{
    /**
     * @var ChargeStrategy $charge
     */
    private $charge;

    public function initInstance($channel)
    {
        if ($channel == 'ali') {
            $this->charge = new AliCharge;
        } elseif ($chananel == 'wx') {
            $this->charge = new WxCharge;
        } else {
            $this->charge = null;
        }
    }

    public function charge()
    {
        if (is_null($this->charge)) {
            exit('初始化错误');
        }

        $this->charge->charge();
    }
}


// 获取用户选择的支付方式
$channel = trim($_GET['channel']);

$context = new ChargeContext();

// 初始化支付实例
$context->initInstance($channel);

// 调用功能
$context->charge();

# design-patterns-php-used-in-work-
开箱即用的设计模式(php)版本
在工作的环境中，我们经常会发现设计模式于业务格格不入，感觉完全无法套入到我们常用的工作开发中，这次我们以业务中的经常会涉及到业务核心层为例子，来加深大家对设计模式的理解并了解到每种设计模式的适用性。

设计模式的核心作用总结来说：
* 解耦，将对象分层，避免修改一个业务影响到另外一个方面
* 避免重复，同一个类只做一件事，保证核心类的稳定。
* 黑盒效应，逻辑应该完全不了解核心类的实现，只需要使用核心类接口暴露的接口。

## 一、创建型模式如下：                        
1.[工厂模式的使用场景-(主要实现面对对象中的多态,避免使用switch来构建逻辑](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/factory.php)]：
* 支付场景:可能对应不同的支付网关：支付宝、财付通、网银在线等
* 数据库：系统对接多个不同类型的数据库，mysql，oracle，sqlserver。
* 用户注册：比如说普通用户，管理员用户等。


2.[建筑者模式-应用场景同工厂模式](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/Builder.php)：

* 建筑者模式VS工厂模式：
  （理论区别）建造者模式关注的是零件类型和装配工艺（顺序），这是它与工厂模式最大不同的地方，虽然同为创建类模式，但是重点不同。
建造者模式是基本方法的调用顺序安排，也就是这些基本方法已经实现了，通俗地说就是零件的装配，顺序不同产生的对象也不同；而工厂模式则重点是创建，创建零件是它的主要职责，组装顺序则不是它关心的。
   （现实区别)在现实的环境中主要简单的是使用工厂模式，如果有某个对象的构造方式需要多个步骤或者步骤的顺序不同产生的对象不同的时候就使用建造者模式。


3.[原型模式](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/Clone.php)：
 使用场景: 通过复制（克隆、拷贝）一个指定类型的对象来创建更多同类型的对象。这个指定的对象可被称为“原型”对象，也就是通过复制原型对象来得到更多同类型的对象。即原型设计模式。在php的很多模板库，都用到clone。如smarty,举个例子，比如说我刚从数据库中取出一个很大的对象，现在我需要在建立一个只更改很少的相同的对象就需要使用原型模式。
 
 
4.[单例模式](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/single.php):
 使用场景:需要共享资源，比如数据库地址池，日志系统等等：
 例子中使用trail获取getinstance来构造单例。
 
 ## 二、结构类模式如下：
 1.适配器模式adapter
 使用场景：多利用在扩展第三方组件的情况下，单第三方组件不适合你的业务，是否直接修改第三方组件的代码，NO,NO,NO。使用适配器模式。
 ps:因适配器模式较为简单，暂未添加范例。
 
 
 2.[桥接模式bridge](
 使用场景：桥接模式类似与工厂模式的注入版，适合与A与B模块的解耦，如果有2个业务模块是耦合在一起的时候可以使用桥接模式，将A注入到B中。
如例子所示,我们将向不同的职员发送不同的消息，可将不同职员类，消息类注入到发送类中。


3.装饰器模式decorator
 装饰器模式同适配器模式相同，都是扩充之前的类的不同功能上，结构较为简单，暂未添加范例。
 
 
 4.[迭代器模式](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/iterator.php)；
 迭代器模式在PHP中使用最多的应该就是文件类spl了，基本上迭代器都已经集成到语言中了，不建议自己去完成。
 例子中完成了迭代器遍历文件夹目录的操作。
 
 
 5.[门面模式Facades](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/Facades.php):
 使用场景：
 * 为一些复杂的子系统提供一组接口
 * 提高子系统的独立性
 * 在层次化结构中，可以使用门面模式定义系统的每一层的接口
 例子中我们将业务类的逻辑封装到子类中，门面只是提供一个访问子系统的一个路径而已，他不应该参与具体的业务逻辑。
 
 
 6.[代理模式porxy](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/proxy.php):
 使用场景：
 * 代理模式 VS 装饰器模式
 代理模式的对象图与装饰模式对象图在结构上类似，但表达的目的各有不同，装饰者给对象动态增加行为，而代理则增加一些善后或者辅助工作，比如写日志。此外，代理只在需要时才创建RealSubject。
 例子中我们封装业务逻辑在代理中，处理相应的前置before或者后置after任务。
 
 
 ## 二、行为型模式如下：
 1.[策略模式strategy](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/strategy.php)：
 定义一组算法，将每个算法封装起来，他们之前可以相互替换，多用于只暴露少量方法(策略)的的服务，你可以不关心具体细节。
 * strategy 抽象策略角色类，抽象算法，通常为接口。
 * concreteStrategu 具体的策略角色类，实例话抽象策略的方法。
 * context上下文类；调用时将具体的策略角色类注入到上下文类中调用方法。
 VS 代理模式:
 * 策略模式与代理模式的方法非常相似,不同的是代理模式中的代理类是和被代理类使用的同一接口。
 例子中对支付宝和微信的支付pay抽象成一个策略。
 
 2.[观察者模式observer](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/observer.php):
 观察者模式也是我们经常使用到的设计模式，也叫发布订阅模式。
 使用场景：定义对象间一对多的依赖关系，每当一个对象发生事件，在发生事件的同时也会得到相应的相依赖的事件。
* subject 被观察者接口
* concreteSubject 具体的被观察者
* observer 观察者接口
* concreteobserver 具体的观察者
缺点:因为多个观察者中的事件是同步的，如果一个事件出现异常，将导致后续的事件无法执行，在这种情况下，最好采用异步的方式。


 3.[责任链模式responsibility_chain](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/responsibility_chain):
 观察者模式也是我们经常使用到的设计模式，也叫发布订阅模式。
 使用场景：当使用场景需要照不同的等级去处理事情的时候，就可以使用到责任链模式，常见于登陆或者需要相应权限去处理的情况。
 由于权限划分相对较为复杂，建议将权限等级或属性放入类库中来调用，。
缺点:单链接的事务过多时，会造成相应的混乱。
例子中是论坛中删帖的一个流程，会逐级上报，在判断权限再去调用区中的类去处理。

 4.[命令模式command]():
 使用场景：请求以命令的形式包裹在对象中，并传给调用对象。调用对象寻找可以处理该命令的合适的对象，并把该命令传给相应的对象，该对象执行命令。
 现实情况是很少使用，一般使用策略模式或代理模式来实现相对应的需求。
 
 
  5.[状态模式state](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/State.php):
使用场景：对一些实时需要去更新状态，对象有多个状态值在不同的变化中，需要if-else各种操作的判断那会相当地复杂，这种情况下我们使用状态模式state。

* state:状态类接口
* concreteState:具体的状态类。
* context:具体的封装类，把状态类注入进封装类中根据状态来执行相应的方法。
 
 
 6.[访问者模式visitor]():
 7.[中介者模式mediator](https://github.com/DrMute/design-patterns-php-used-in-work-/blob/master/Mediator.php):
用一个中介对象封装一系列的对象交互，中介者使各对象不需要显示的相互作用，从而使其耦合松散，而且可以独立的改变他们之间的交互。
简单的来说就是将中介者注入到具体事务对象中，每个具体事务对象都知道中介者的角色，而且同其他事务对象通信的时候通过中介者协作。
* mediator 抽象中介者角色
* concrete mediator 具体中介者角色
* colleague 同事角色

 


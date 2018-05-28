# design-patterns-php-used-in-work-
开箱即用的设计模式(php)版本
在工作的环境中，我们经常会发现设计模式于业务格格不入，感觉完全无法套入到我们常用的工作开发中，这次我们以业务中的经常会涉及到业务核心层为例子，来加深大家对设计模式的理解并了解到每种设计模式的适用性。

设计模式的核心作用总结来说：
                        * 解耦，将对象分层，避免修改一个业务影响到另外一个方面。
                        * 避免重复，同一个类只做一件事，保证核心类的稳定。
                        * 黑盒效应，逻辑应该完全不了解核心类的实现，只需要使用核心类接口暴露的接口。
## 一、创建型模式如下：                        
1.工厂模式的使用场景-(主要实现面对对象中的多态,避免使用switch来构建逻辑)：
* 支付场景:可能对应不同的支付网关：支付宝、财付通、网银在线等
* 数据库：系统对接多个不同类型的数据库，mysql，oracle，sqlserver。
* 用户注册：比如说普通用户，管理员用户等。

2.建筑者模式-应用场景同工厂模式：
* 建筑者模式VS工厂模式：
  （理论区别）建造者模式关注的是零件类型和装配工艺（顺序），这是它与工厂模式最大不同的地方，虽然同为创建类模式，但是重点不同。
建造者模式是基本方法的调用顺序安排，也就是这些基本方法已经实现了，通俗地说就是零件的装配，顺序不同产生的对象也不同；而工厂模式则重点是创建，创建零件是它的主要职责，组装顺序则不是它关心的。
   （现实区别)在现实的环境中主要简单的是使用工厂模式，如果有某个对象的构造方式需要多个步骤或者步骤的顺序不同产生的对象不同的时候就使用建造者模式。

3.原型模式：
 使用场景: 通过复制（克隆、拷贝）一个指定类型的对象来创建更多同类型的对象。这个指定的对象可被称为“原型”对象，也就是通过复制原型对象来得到更多同类型的对象。即原型设计模式。在php的很多模板库，都用到clone。如smarty,举个例子，比如说我刚从数据库中取出一个很大的对象，现在我需要在建立一个只更改很少的相同的对象就需要使用原型模式。
 
4.单例模式



                        

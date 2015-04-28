# yii2-playground

Yii2各种扩展实验室 扩展来自yii官网的 [yii-extensions](http://www.yiiframework.com/extensions/)

只对那些比较重要的扩展进行示例示范，主要针对版本yii2 ，至于yii1中较优秀的扩展，本项目会尝试翻写为2系兼容。

## 项目目的

组员内的技术提高，多看看总是好的，yii官方扩展仓库中有很多扩展都很优秀，如果想自己也写类似的扩展 他们的作品也是最佳范本。
yii本身只解决通用型需求 ，对于领域内的东西 一般由第三方提供：比如我们自己写的yii扩展，或者使用第三方的php类库。现在yii2
是基于composer ，psr风格，所以对于第三方类库（如文件操作库，各种存储驱动  图形图像操作库， httpClient ..等）可以很方便的
集成到yii2项目中来。  也只是需要把你依赖的库添加到composer.json 中 然后composer update 命令下载/更新 即可。常用的库，大家
可以尝试使用zendframework，跟symfony组件库，在yii中使用他们不算新奇。

对于非composer兼容的类库，一般自建一个目录比如lib，然后使用old-school（最原始的php技术）include|require_[once]进来即可。
如：

~~~

    require_once(Yii::getAlias('@app/lib').'/SomeClass.php') ; 
    $obj = new SomeClass();

~~~
主思路就是计算所要导入的文件，类的文件路径，然后include | require 进来即可。

还有一种使用方式： 设置自己的别名，然后用自己的命名空间，这种方法对于在自己的Yii2项目中使用短空间也比较有用。
yii默认有几个系统保留的名空间比如 app  system web ...  项目中的类一般都是根据app 计算得到某个类的全称类名（full qualified name）
如类 : app\model\User   .

设置我们自己的别名，可以在配置文件中 aliases段 如下例：

~~~
      
        'aliases' => [
            '@nineinchnick/usr' => '@vendor/nineinchnick/yii2-usr',
            '@year' => '@app/year',
            '@common' => '@app/common',
        ],
~~~
这样我们的类就可以基于短别名的全额限定类名。如app\common\SomeClass  变为 common\SomeClass.

还有值得一提的是：文件结构要跟名空间一致，不一致的只可能是根名空间（root namespace） 根名空间也就是你全额限定类名的起始名称
如yii的 app 根名空间 实际对应的目录名称是application 。试想如果你用application做根名空间那么位于其下的类都要“背负”这个
 长根。


## 项目结构

项目模版使用高级模版，一步到位。

项目采用模块化结构，对于每一个yii官方网站扩展仓库中的category 建立一个module ，大概十五个模块。然后针对每一个扩展建立一个
控制器。之所以这样做，是防止类名泛滥，文件很多将来看着乱。况且每个扩展可能还涉及搭配的类，这样类数目也是相当客观的。


## 贡献者列表：

- [xxx](xxxxx.xx.com)
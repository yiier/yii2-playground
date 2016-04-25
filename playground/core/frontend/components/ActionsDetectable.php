<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2016/4/25
 * Time: 9:00
 */

namespace playground\core\frontend\components;

use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use \yii\base\Controller;

/**
 * Class ActionsDetectable
 * @package playground\core\frontend\components
 */
trait ActionsDetectable
{

    /**
     * return all available actions for current module or controller
     *
     * @return array
     * @throws InvalidConfigException
     */
    public function detectActions()
    {
        if ($this instanceof \yii\base\Controller) {
            return static::detectActions4Controller($this);
        } elseif ($this instanceof Module) {
            return  static::detectActions4Module($this);
        } else {
            throw new InvalidConfigException(__TRAIT__ . ' can only be used for Controller or Module , but your class is ' . get_class($this));
        }
    }

    public static function detectActions4Controller(Controller $controller)
    {
        //  $availableActions = $this->controller->actions();
        $availableActions = [];
        $rc = new \ReflectionClass($controller);
        foreach ($rc->getMethods() as $reflectionMethod) {
            if ($reflectionMethod->isPublic()) {
                $controllerMethodName = $reflectionMethod->name ;
                if (($controllerMethodName !== 'actions') && \yii\helpers\StringHelper::startsWith($reflectionMethod->name, 'action')) {
                    $availableActions[] = substr($controllerMethodName,strlen('action'));
                }
            }
        }
        array_walk($availableActions,function(&$item1, $key){
            $item1 = \yii\helpers\Inflector::camel2id($item1) ;
        });
        $availableActions = \yii\helpers\ArrayHelper::merge(
            $availableActions ,
            array_keys($controller->actions())
        );

        $actionMenus = [] ;
        $controllerId = $controller->getUniqueId() ;
        foreach($availableActions as $actionId){
            $actionRoute = $controllerId . '/' .$actionId  ;
            // $content[] =  \yii\helpers\Html::a($actionRoute,['/'.$actionRoute]) ;
            $actionMenus[] =  [
              'label'=>$actionRoute,
                'url'=>['/'.$actionRoute] ,
            ];
        }

        return $actionMenus;
    }

    public static function detectActions4Module(Module $module)
    {
        $moduleControllerPath = $module->getControllerPath();
        $controllerFileNames = [] ;
        // @see http://www.ruanyifeng.com/blog/2008/07/php_spl_notes.html
        // @see http://php.net/manual/en/class.directoryiterator.php
        try {
            /*** class create new DirectoryIterator Object ***/
            foreach (new \DirectoryIterator($moduleControllerPath) as $item) {
                /** @var \SplFileInfo $file */
                $file = $item ;
                // echo $item . '<br />';
                // VarDumper::dump($item) ;
                if(!$file->isDot()){
                    $controllerFileNames[] = $file->getBasename('Controller.php') ;
                    // echo $file->getBasename('Controller.php') ;
                }
            }
        } /*** if an exception is thrown, catch it here ***/
        catch (\Exception $e) {
            // echo 'No files Found!<br />';
        }

        if(!empty($controllerFileNames)){
           $actions4controllers = array_map(function($item) use($module){
              $controllerId = Inflector::camel2id($item);
               // echo $controllerId ; exit(__FILE__) ;
               $controller = $module->createControllerByID($controllerId) ;
              return static::detectActions4Controller($controller) ;
            },$controllerFileNames);

            // @see http://stackoverflow.com/questions/1319903/how-to-flatten-a-multidimensional-array
           return array_reduce($actions4controllers, 'array_merge', array());
        }

        return [];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2016/4/16
 * Time: 22:11
 */
namespace playground\core\frontend\components;

use playground\core\frontend\contracts\ModuleNav;
use Yii;
use yii\helpers\VarDumper;

class NavManager extends \yii\base\Component
{


    /**
     * @return array
     */
    public static function getModuleNavItems()
    {
        $modules = Yii::$app->getModules() ;

        $navItems = [] ;
        foreach($modules as $moduleId =>  $module)        {
            /*
           // VarDumper::dump($module) ; ;
            print_r($moduleId); echo '<br/>' ;
           if($module instanceof \playground\core\frontend\contracts\ModuleNav){
                $navItems[] = $module->getNavConfig() ;
           }
            */
            if(is_object($module)){
                if($module instanceof \playground\core\frontend\contracts\ModuleNav){
                    $navItems[] = $module->getNavConfig() ;
                }
            }else      if(isset($module['class'])){
                $moduleClass = $module['class'];
                $rc = new \ReflectionClass($moduleClass) ;
                if($rc->implementsInterface( 'playground\core\frontend\contracts\ModuleNav')){
                    $navItems[] = call_user_func_array([$moduleClass,'getNavConfig'],[]);
                }
            }
        }
        return $navItems ;
    }
}
<?php

namespace playground\ui;

use playground\core\frontend\contracts\ModuleNav;

class Module extends \yii\base\Module
implements ModuleNav
{
    public $controllerNamespace = 'playground\ui\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @return mixed|array
     */
    public static function getNavConfig()
    {
        // TODO: Implement getNavConfig() method.
        return [
            'label' => 'UI',
            'url' => ['/ui'],
        ];

    }

    /**
     * for module sidebar
     *
     * todo 后期支持返回widget 作为sidebar 要么就返回配置 如果是皮肤功能 只有使用widget 可以做到“可皮肤化”
     * @return array|mix
     */
    public static function getSidebar()
    {
        return [
            [
                'label'=>'Wizard',
                'url'=>['/ui/wizard']
            ],

        ];
    }
}

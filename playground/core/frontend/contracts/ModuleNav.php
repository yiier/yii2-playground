<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2016/4/15
 * Time: 7:48
 */

namespace playground\core\frontend\contracts;

/**
 * Interface ModuleNav
 * @package playground\core\frontend\contracts
 */
interface ModuleNav
{

    /**
     *   [
    'label' => 'Dropdown',
    'items' => [
    ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
    '<li class="divider"></li>',
    '<li class="dropdown-header">Dropdown Header</li>',
    ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
    ],
    ]    ;
     */
    /**
     * navigation for current module
     *
     * @return mixed|array
     */
    public static function getNavConfig();

}
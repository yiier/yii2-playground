<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2016/4/23
 * Time: 9:43
 */

namespace yiier\web;

use yiier\web\map\Map;

/**
 * --------------------------------------------
 * usage:
 * http://www.yiiframework.com/wiki/127/dynamic-sidebar-using-cclipwidget/#hh2
 *
 * 加入顺序 将根据id排序  越小越靠前！！！
 * --------------------------------------------
 */
class Layout
{
    /**
     *
     */
    private static $_instance;

    /**
     *
     */
    protected $regions;

    /**
     *
     */
    public function __construct()
    {
        // $this->regions = new CMap;
        $this->regions = new Map();
    }

    /**
     *
     */
    public static function getInstance()
    {
        if(self::$_instance === null)
        {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     *
     */
    protected static function compareBlocks($blockA, $blockB)
    {
        if($blockA instanceof LayoutBlock && $blockB instanceof LayoutBlock)
        {
            if($blockA->getWeight() === $blockB->getWeight())
            {
                return 0;
            }
            return ($blockA->getWeight() <= $blockB->getWeight()) ? -1 : 1;
        }else{
            throw new Exception(Yii::t('application','Both blocks must be instances of LayoutBlock or one of it\'s children.'));
        }
    }

    /**
     *
     */
    protected static function sortBlocks($blocks)
    {
        $blocks = $blocks->toArray();

        uasort($blocks, array(__CLASS__,'compareBlocks'));

        return new Map($blocks);
    }

    /**
     *
     */
    public function getBlocks($regionId, $visibleOnly = true)
    {
        $instance = self::getInstance();

        $blocks   = new Map;

        if($instance->regions->contains($regionId))
        {
            foreach($instance->regions[$regionId] as $blockId => $block)
            {
                if($visibleOnly)
                {
                    if($block->getVisible() === false)
                    {
                        continue;
                    }
                }
                $blocks->add($blockId, $block);
            }
        }

        return self::sortBlocks($blocks);
    }

    /**
     *
     */
    public static function addBlock($regionId, $blockData)
    {
        if(isset($blockData['id']))
        {
            $instance    = self::getInstance();

            $blockId     = $blockData['id'];
            $content     = $blockData['content'];

            $weight      = isset($blockData['weight'])      ? $blockData['weight']      : 0;
            $visible     = isset($blockData['visible'])     ? $blockData['visible']     : true;
            $htmlOptions = isset($blockData['htmlOptions']) ? $blockData['htmlOptions'] : array();
            $tagName     = isset($blockData['tagName'])     ? $blockData['tagName']     : LayoutBlock::DEFAULT_BLOCK_TAG;

            $block       = new LayoutBlock($blockId, $content, $weight, $visible, $htmlOptions);

            if(!$instance->regions->contains($regionId))
            {
                $instance->regions[$regionId] = new Map;
            }
            $instance->regions[$regionId]->add($blockId, $block);
        }else{
            throw new Exception(Yii::t('application','A block must have at least an id.'));
        }
    }

    /**
     *
     */
    public static function addBlocks($blocks = array())
    {
        foreach($blocks as $blockData)
        {
            if(isset($blockData['regionId']))
            {
                $regionId = $blockData['regionId'];
                unset($blockData['regionId']);
                self::addBlock($regionId, $blockData);
            }
        }
    }

    /**
     *
     */
    public static function getBlock($regionId, $blockId)
    {
        $instance = self::getInstance();
        if(($region = self::getRegion($regionId)) !== null)
        {
            if($region->contains($blockId))
            {
                return $region[$blockId];
            }
        }
        return null;
    }

    /**
     *
     */
    public static function hasBlock($regionId, $blockId)
    {
        return self::getBlock($regionId, $blockId) !== null;
    }

    /**
     *
     */
    public static function removeBlock($regionId, $blockId)
    {
        if(($region = self::getRegion($regionId)) !== null)
        {
            if($region->contains($blockId))
            {
                $region->remove($blockId);
            }
        }
    }

    /**
     *
     */
    public static function getRegion($regionId)
    {
        $instance = self::getInstance();
        return $instance->regions->contains($regionId) ? $instance->regions[$regionId] : null;
    }

    /**
     *
     */
    public static function hasRegion($regionId)
    {
        return self::getRegion($regionId) !== null;
    }

    /**
     *
     */
    public static function hasRegions()
    {
        $args = func_get_args();
        if(count($args))
        {
            foreach($args as $regionId)
            {
                if(!self::hasRegion($regionId))
                {
                    return false;
                }
            }
            return true;
        }
        throw new Exception(Yii::t('application','No region id was specified.'));
    }

    /**
     *
     */
    public static function renderRegion($regionId, $return = false)
    {
        $regionContent = '';

        if(self::hasRegion($regionId))
        {
            $blocks = self::getBlocks($regionId);

            foreach($blocks as $block)
            {
                if($block instanceof LayoutBlock)
                {
                    $regionContent .= $block->render(true);
                }
            }
        }

        if($return)
        {
            return $regionContent;
        }else{
            echo $regionContent;
        }
    }

    /**
     *
     */
    public static function removeRegion($regionId)
    {
        $instance = self::getInstance();

        if($instance->regions->contains($regionId))
        {
            $instance->regions->remove($regionId);
        }
    }
}
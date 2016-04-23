<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2016/4/23
 * Time: 9:43
 */

namespace yiier\web;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class LayoutBlock
 * @package yiier\web
 */
class LayoutBlock
{
    private $_id;

    private $_content;

    private $_weight;

    private $_visible;

    private $_htmlOptions = array();

    private $_tagName;

    private $_defaultHtmlOptions = array(
        'class' => 'block',
    );

    const DEFAULT_BLOCK_TAG = 'div';

    /**
     *
     */
    public function __construct($id, $content, $weight = 0, $visible = true, $htmlOptions = array(), $tagName = self::DEFAULT_BLOCK_TAG)
    {
        $this->setId($id);
        $this->setContent($content);
        $this->setWeight($weight);
        $this->setVisible($visible);
        $this->setHtmlOptions($htmlOptions);
        $this->setTagName($tagName);
    }

    /**
     *
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     *
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     *
     */
    public function getWeight()
    {
        return $this->_weight;
    }

    /**
     *
     */
    public function getVisible()
    {
        return $this->_visible;
    }

    /**
     *
     */
    public function getTagName()
    {
        return $this->_tagName;
    }

    /**
     *
     */
    public function setId($id)
    {
        if (!is_string($id)) {
            throw new Exception(\Yii::t('application', 'The block id must be a string.'));
        }
        $this->_id = $id;
        return $this;
    }

    /**
     *
     */
    public function setContent($content)
    {
        if (!is_string($content)) {
            throw new Exception(Yii::t('application', 'The block content must be a string.'));
        }
        $this->_content = $content;
        return $this;
    }

    /**
     *
     */
    public function setWeight($weight)
    {
        if (!is_numeric($weight)) {
            throw new Exception(Yii::t('application', 'The block weight must be a number.'));
        }
        $this->_weight = (int)$weight;
        return $this;
    }

    /**
     *
     */
    public function setHtmlOptions($htmlOptions, $mergeOld = false)
    {
        if (!is_array($htmlOptions)) {
            throw new Exception(Yii::t('application', 'The block html options must be a number.'));
        }
        if ($mergeOld) {

            $this->_htmlOptions = ArrayHelper::merge($this->_htmlOptions, $htmlOptions);
        } else {
            $this->_htmlOptions = $htmlOptions;
        }
        return $this;
    }

    /**
     *
     */
    public function setTagName($tagName)
    {
        if (!is_string($tagName)) {
            throw new Exception(Yii::t('application', 'The block tag name must be a string.'));
        }
        $this->_tagName = $tagName;
        return $this;
    }

    /**
     *
     */
    public function setVisible($visible)
    {
        if (!is_bool($visible)) {
            throw new Exception(Yii::t('application', 'The block visibility must be set to a boolean value.'));
        }
        $this->_visible = $visible;
        return $this;
    }

    /**
     *
     */
    public function render($return = false, $renderTag = true)
    {
        $block = $this->_content;
        if ($renderTag) {
            $block = Html::beginTag($this->_tagName, ArrayHelper::merge($this->_defaultHtmlOptions, $this->_htmlOptions))
                . $block
                . Html::endTag($this->_tagName);
        }
        if ($return === true) {
            return $block;
        } else {
            echo $block;
        }
    }
}
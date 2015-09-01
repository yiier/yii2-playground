<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/1
 * Time: 17:40
 */

namespace yiier\db;

/**
 * 增强版日期转换器  原始版本不支持物理字段的时间戳风格
 *
 * Usage:
 * ~~~
 *  $model = new DynamicModel([
 *      'created_at'=>time() ,
 * ]);
 *
 * $model->attachBehavior('format',[
 *      'class' =>  DateConverter::className(), //'mdm\converter\DateConverter',
 *      'logicalFormat' => 'php:d/m/Y', // your readeble datetime format, default to 'd-m-Y'
 *      'physicalFormat' => 'php:time',// 'Y-m-d', // database level format, default to 'Y-m-d'
 *       'attributes' => [
 *              'createAt' => 'created_at', // sales_date is original attribute
 *      ]
 * ]);
 * ~~~
 *
 * Class DateConverter
 * @package yiier\db
 */
class DateConverter extends \mdm\converter\DateConverter
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->logicalFormat === null) {
            $format = $this->type . 'Format';
            $pattern = Yii::$app->formatter->{$format};
        } else {
            $pattern = $this->logicalFormat;
        }

        if (substr($pattern, 0, 4) === 'php:') {
            $this->_phpLogicalFormat = substr($pattern, 4);
        } else {
            $this->_phpLogicalFormat = FormatConverter::convertDateIcuToPhp($pattern, $this->type);
        }

        if ($this->physicalFormat === null) {
            $driverName = Yii::$app->db->driverName;
            if (isset(static::$dbDatetimeFormat[$driverName])) {
                $pattern = static::$dbDatetimeFormat[$driverName][$this->type];
            } else {
                $pattern = static::$dbDatetimeFormat['default'][$this->type];
            }
        } else {
            $pattern = $this->physicalFormat;
        }

        if (substr($pattern, 0, 4) === 'php:') {
            $this->_phpPhysicalFormat = substr($pattern, 4);
        } else {
            $this->_phpPhysicalFormat = FormatConverter::convertDateIcuToPhp($pattern, $this->type);
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function convertToLogical($value, $attribute)
    {
        if ($this->isEmpty($value)) {
            return null;
        }
        if (trim($this->_phpPhysicalFormat) == 'time') {

            $date = date($this->_phpLogicalFormat, $value);
            return $date === false ? null : $date;
        } else {
            $date = @date_create_from_format($this->_phpPhysicalFormat, $value);
            return $date === false ? null : $date->format($this->_phpLogicalFormat);
        }
    }

    /**
     * @inheritdoc
     */
    protected function convertToPhysical($value, $attribute)
    {

        if ($this->isEmpty($value)) {
            return null;
        }
        if (trim($this->_phpPhysicalFormat) == 'time') {
            $date = \DateTime::createFromFormat($this->_phpLogicalFormat, $value);

            return (Yii::$app->formatter->asTimestamp($date));
        } else {
            $date = @date_create_from_format($this->_phpLogicalFormat, $value);

            return $date === false ? null : $date->format($this->_phpPhysicalFormat);
        }

    }
}
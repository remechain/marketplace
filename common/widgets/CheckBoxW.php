<?php
/**
 * Created by PhpStorm.
 * User: Программист
 * Date: 03.03.2017
 * Time: 14:00
 */

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class CheckBoxW extends Widget
{
    /**
     * @var $content array [id,название,состояние(bool)]
     */
    public $content;
    public $name;

    public function run()
    {
        $render = '';
        foreach ($this->content as $item){
            $label =  Html::tag('label',$item[1],[
                'class' => 'text text_medium',
                'for' => $this->name.'-'.$item[0],
            ]);
            $label =  Html::tag('div' ,$label ,['class' => 'form__label']);

            $checkbox = $label.Html::checkbox($this->name.'-'.$item[0],(bool)$item[2], [
                'class' => 'form__input form__input_checkbox form__input_checkbox-aquamarine',
            ]);

            $render .= Html::tag('div',$checkbox,['class' => 'form__block wrap']);
        }
        return $render;
    }
}
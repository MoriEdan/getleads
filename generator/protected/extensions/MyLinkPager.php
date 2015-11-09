<?php

class MyLinkPager extends CLinkPager {

    protected function createPageButton($label, $page, $class, $hidden, $selected) {
        if ($hidden || $selected)
            $class.=' ' . ($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
        $actionParams=$this->getController()->actionParams;
        unset($actionParams['page']);
        $sort = isset($actionParams['sort']) ? $actionParams['sort'] : '';
        unset($actionParams['sort']);
        return '<li class="' . $class . '">' . CHtml::link($label, Yii::app()->createUrl($this->getController()->route . '/' . implode('/', $actionParams) . '?page=' . ($page+1) . ($sort ? "&sort=$sort" : ''))) . '</li>';
    }

}

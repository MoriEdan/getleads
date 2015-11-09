<?php
$this->pageTitle = Yii::app()->name . ' - ' . CHtml::encode($page->title);
?>
<div class="well" style="min-height: 300px">
    <?php echo $page->content ?>
</div>
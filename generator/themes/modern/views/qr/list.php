<table class="table table-bordered table-condensed">
    <tr>
        <th class="align-middle"><?php echo Yii::t('dict', 'Title'); ?></th>
        <th class="align-center align-middle"><?php echo Yii::t('dict', 'Type'); ?></th>
        <th class="align-center align-middle"><?php echo Yii::t('dict', 'Tag URL'); ?></th>
        <th class="align-center align-middle"><?php echo Yii::t('dict', 'Image'); ?></th>
        <th class="align-center align-middle"><?php echo Yii::t('dict', 'Hits'); ?></th>
        <th class="align-center align-middle"><?php echo Yii::t('dict', 'Created At'); ?></th>
        <th class="align-center align-middle"><?php echo Yii::t('dict', 'Updated At'); ?></th>
        <th></th>
    </tr>
    <?php if ($qrs): ?>
        <?php foreach ($qrs as $qr): ?>
            <tr>
                <td class="align-middle"><?php echo $qr->title; ?></td>
                <td class="align-center align-middle"><?php echo $qr->type_name; ?></td>
                <td class="align-center align-middle"><a href="<?php echo $qr->tag_url; ?>" target="_blank"><?php echo $qr->tag_url; ?></a></td>
                <td class="align-center align-middle">
                    <a class="modal-btn" href="<?php echo $qr->image_url ?>"><img width="100" src="<?php echo $qr->image_url ?>?<?php echo rand() ?>" /></a>
                </td>
                <td class="align-center align-middle"><?php echo $qr->hits ?></td>
                <td class="align-center align-middle"><?php echo $qr->created_at ?></td>
                <td class="align-center align-middle"><?php echo $qr->updated_at ?></td>
                <td class="align-center align-middle" style="width:105px;">
                    <a rel="tooltip" data-original-title="<?php echo Yii::t('dict', 'customize'); ?>" href="<?php echo $this->createUrl('qr/customize', array('id' => $qr->id)) ?>"><i class="glyphicon glyphicon-cog"></i></a>
                    <a rel="tooltip" data-original-title="<?php echo Yii::t('dict', 'edit'); ?>" href="<?php echo $this->createUrl('qr/edit', array('id' => $qr->id)) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a rel="tooltip" data-original-title="<?php echo Yii::t('dict', ($qr->show_in_gallery ? 'hide' : 'show') . ' in gallery'); ?>" href="<?php echo $this->createUrl('qr/gallery_toggle', array('id' => $qr->id)) ?>"><i class="glyphicon glyphicon-picture <?php echo $qr->show_in_gallery ? '' : 'glyphicon glyphicon-cross' ?>"></i></a>
                    <a rel="tooltip" data-original-title="<?php echo Yii::t('dict', 'stats'); ?>" href="<?php echo $this->createUrl('qr/stats', array('id' => $qr->id)) ?>"><i class="glyphicon glyphicon-signal"></i></a>
                    <a rel="tooltip" data-original-title="<?php echo Yii::t('dict', 'delete'); ?>" href="<?php echo $this->createUrl('qr/delete', array('id' => $qr->id)) ?>"><i class="glyphicon glyphicon-remove"></i></a>
                    <div class="btn-group">
                        <button class="btn btn-mini">Download</button>
                        <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Yii::app()->createUrl('qr/download', array('id' => $qr->id, 'size' => 'small')) ?>">small</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('qr/download', array('id' => $qr->id, 'size' => 'medium')) ?>">medium</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('qr/download', array('id' => $qr->id, 'size' => 'large')) ?>">large</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('qr/download', array('id' => $qr->id, 'size' => 'xlarge')) ?>">extra large</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
</table>

<!-- Modal -->
<div class="modal hide" id="qr-preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">QR Preview</h3>
    </div>
    <div class="modal-body align-center">
        <p></p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<div style="text-align: center;margin-bottom: 30px;">
<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
    'header' => '',
))
?>
</div>

<script>
    $('.modal-btn').click(function(){
        var url = $(this).find('img').attr('src');
        $('#qr-preview .modal-body').html('<img src="' + url + '" />');
        $('#qr-preview').modal('show');
        return false;
    });
    
    //    $('#qr-preview').modal();
</script>

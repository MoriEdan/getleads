<table class="table table-bordered table-condensed">
    <tr>
        <?php
        $table_head = array(
            'qr.title' => 'Title',
            'qr.type' => 'Type',
            'Tag URL',
            'Image',
            'user.username' => 'Username',
            'hitCount' => 'Hits',
            'qr.created_at' => 'Created At',
            'qr.updated_at' => 'Updated At',
        );


        echo Utility::tableHead('admin/qr/list', $table_head);
        ?>
    </tr>
    <?php if ($qrs): ?>
        <?php foreach ($qrs as $qr): ?>
            <tr>
                <td class="align-middle"><?php echo $qr->title; ?></td>
                <td class="align-center align-middle"><?php echo $qr->type_name; ?></td>
                <td class="align-center align-middle"><a href="<?php echo $qr->tag_url; ?>" target="_blank"><?php echo $qr->tag_url; ?></a></td>
                <td class="align-center align-middle">
                    <a class="modal-btn" href="<?php echo $qr->image_url ?>"><img width="100" src="<?php echo $qr->image_url ?>" /></a>
                </td>
                <td class="align-center align-middle"><?php echo $qr->user ? $qr->user->username : '' ?></td>
                <td class="align-center align-middle"><?php echo $qr->hits ?></td>
                <td class="align-center align-middle"><?php echo $qr->created_at ?></td>
                <td class="align-center align-middle"><?php echo $qr->updated_at ?></td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
</table>

<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
))
?>


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

<script>
    $('.modal-btn').click(function(){
        var url = $(this).find('img').attr('src');
        $('#qr-preview .modal-body').html('<img src="' + url + '" />');
        $('#qr-preview').modal('show');
        return false;
    });
    
//    $('#qr-preview').modal();
</script>
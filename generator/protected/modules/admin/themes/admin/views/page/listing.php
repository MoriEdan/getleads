
<div class="page-header">
    <h1 class="pull-left">Pages <small>(<?php echo count($pages) ?> found)</small></h1>
    <a href="<?php echo $this->createUrl('page/add') ?>" class="pull-right btn btn-primary pull-right"><i class="icon-white icon-plus"></i> Add New</a>
    <div class="clearfix"></div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="span12">
            <table class="table table-striped table-bordered table-condensed">
                <tr>
                    <th>Title</th>
                    <th class="center">Created On</th>
                    <th class="center">Updated On</th>
                    <th></th>
                </tr>
                <?php foreach($pages as $page): ?>
                <tr>
                    <td><?php echo CHtml::encode($page->title) ?></td>
                    <td class="center"><?php echo $page->created_at ?></td>
                    <td class="center"><?php echo $page->updated_at ?></td>
                    <td>
                        <a rel="tooltip" data-original-title="edit" href="<?php echo $this->createUrl('page/edit', array('id' => $page->id)) ?>"><i class="icon-pencil"></i></a>
                        <a rel="tooltip" data-original-title="click to <?php echo $page->is_active ? 'deactivate' : 'activate' ?>" href="<?php echo $this->createUrl('page/toggle_visible', array('id' => $page->id)) ?>"><i class="<?php echo $page->is_active ? 'icon-eye-open' : 'icon-eye-close' ?>"></i></a>
                        <a rel="tooltip" data-original-title="delete" href="<?php echo $this->createUrl('page/delete', array('id' => $page->id)) ?>"><i class="icon-remove"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>


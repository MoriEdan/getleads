<?php
$this->breadcrumbs = array(
    'User' => array('/admin/user'),
);
?>

<div class="page-header">
    <h1 class="pull-left">Users List <small>(<?php echo $pages->getItemCount() ?> found)</small></h1>
    <a href="<?php echo $this->createUrl('user/export') ?>" class="btn btn-primary pull-right"><i class="icon-download icon-white"></i> Export</a>
    <div class="clearfix"></div>
</div>

<table class="table table-striped table-bordered table-condensed">
    <tr>
        <?php
        $table_head = array(
            'user.username' => 'Username',
            'user.first_name' => 'First Name',
            'user.last_name' => 'Last Name',
            'user.email' => 'E-mail',
            'qcount' => '# Qrs',
            'status' => 'Status',
            'user.created_at' => 'Registered At',
            'Actions',
        );


        echo Utility::tableHead('admin/user/list', $table_head);
        ?>

    </tr>
    <?php if ($users): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo CHtml::encode($user->username) ?></td>
                <td><?php echo CHtml::encode($user->first_name) ?></td>
                <td><?php echo CHtml::encode($user->last_name) ?></td>
                <td><?php echo CHtml::encode($user->email) ?></td>
                <td><?php echo $user->qcount ?></td>
                <td><?php echo $user->is_active ? 'active' : 'inactive' ?></td>
                <td><?php echo $user->created_at ?></td>
                <td>
                    <a href="<?php echo $this->createUrl('/admin/user/toggleactive', array('id' => $user->id)) ?>"><?php echo $user->is_active ? 'inactivate' : 'activate' ?></a> | 
                    <a href="<?php echo $this->createUrl('/admin/user/delete', array('id' => $user->id)) ?>">delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">No users found!</td>
        </tr>
    <?php endif; ?>
</table>

<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
))
?>

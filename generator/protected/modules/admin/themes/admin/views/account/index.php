<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<div class="page-header">
    <h1>Recent 5 Users:</h1>
</div>
<table class="table table-striped">
    <tr>
        <th>Username</th>
        <th>First name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Registered on</th>
    </tr>
    <?php if ($recent_5_users): ?>
        <?php foreach ($recent_5_users as $user): ?>
            <tr>
                <td><?php echo CHtml::encode($user->username) ?></td>
                <td><?php echo CHtml::encode($user->first_name) ?></td>
                <td><?php echo CHtml::encode($user->last_name) ?></td>
                <td><?php echo CHtml::encode($user->email) ?></td>
                <td><?php echo CHtml::encode($user->created_at) ?></td>
            </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No registered user</td>
        </tr>
    <?php endif ?>
</table>

<?php
$this->pageTitle = $user->username . ' Profile';
$this->breadcrumbs = array(
    'Profile',
);
?>

<div class="page-header">
    <h1>User Profile:</h1>
</div>

<div class="well">
    <table class="table table-striped">
        <tr>
            <th>First Name</th>
            <td><?php echo CHtml::encode($user->first_name) ?></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><?php echo CHtml::encode($user->last_name) ?></td>
        </tr>
        <tr>
            <th>Member Since</th>
            <td><?php echo $user->created_at ?></td>
        </tr>
    </table>
</div>
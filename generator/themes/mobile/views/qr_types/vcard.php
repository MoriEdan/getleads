<ul data-inset="true" data-role="listview" class="format-label">
    <li>
        <label>First Name:</label>
        <?php echo $qr->qrData->fname; ?>
    </li>
    <li>
        <label>Last Name:</label>
        <?php echo $qr->qrData->lname; ?>
    </li>
    <li>
        <label>Job Title:</label>
        <?php echo $qr->qrData->job_title; ?>
    </li>
    <li>
        <label>Telephone:</label>
        <?php echo $qr->qrData->telephone; ?>
    </li>
    <li>
        <label>Cell:</label>
        <?php echo $qr->qrData->cell; ?>
    </li>
    <?php if ($qr->qrData->fax): ?>
        <li>
            <label>Fax:</label>
            <?php echo $qr->qrData->fax; ?>
        </li>
    <?php endif ?>

    <?php if ($qr->qrData->email): ?>
        <li>
            <label>Email:</label>
            <?php echo $qr->qrData->email; ?>
        </li>
    <?php endif ?>

    <?php if ($qr->qrData->website): ?>
        <li>
            <label>Website:</label>
            <?php echo $qr->qrData->website; ?>
        </li>
    <?php endif ?>

    <?php if ($qr->qrData->org): ?>
        <li>
            <label>Organization:</label>
            <?php echo $qr->qrData->org; ?>
        </li>
    <?php endif ?>
</ul>

<a rel="external" href="<?php echo Yii::app()->createUrl('qr/downloadVcard', array('id' => $qr->id)) ?>" data-role="button">Download vCard</a> 
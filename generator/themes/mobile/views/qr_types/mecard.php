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
        <label>Telephone:</label>
        <?php echo $qr->qrData->telephone; ?>
    </li>

    <?php if ($qr->qrData->email): ?>
        <li>
            <label>E-mail:</label>
            <?php echo $qr->qrData->email; ?>
        </li>
    <?php endif ?>

    <?php if ($qr->qrData->website): ?>
        <li>
            <label>Website:</label>
            <?php echo $qr->qrData->website; ?>
        </li>
    <?php endif ?>
</ul>

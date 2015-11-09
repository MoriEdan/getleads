<form>
    <ul data-role="listview">
        <li data-role="fieldcontain">
            <label><?php echo $qr->qrData->number; ?></label>
            <input type="text" />
        </li>
        <li data-role="fieldcontain">
            <label><?php echo $qr->qrData->message; ?></label>
            <input type="text" />
        </li>
    </ul>
</form>
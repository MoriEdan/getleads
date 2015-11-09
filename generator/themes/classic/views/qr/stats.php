<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/flotr2/flotr2.min.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/js/bootstrap-datepicker/css/datepicker.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js');
?>

<div class="well">
<form class="form-inline" method="get" style="text-align: center;">
    <?php echo '<label>' . Yii::t('dict', 'From Date') . ': </label> ' . '<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>' . CHtml::textField('d1', $d1, array('id' => 'fromDate', 'class' => 'date fromDate', 'data-date-format' => 'yyyy-mm-dd', 'data-date' => $d1)) . '</div>'; ?>
    <?php echo '<label>' . Yii::t('dict', 'To Date') . ': </label> ' . '<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>' . CHtml::textField('d2', $d2, array('id' => 'toDate', 'class' => 'date toDate', 'data-date-format' => 'yyyy-mm-dd', 'data-date' => $d2)) . '</div>'; ?>
    <?php echo CHtml::submitButton(Yii::t('dict', 'Submit'), array('class' => 'btn')); ?>
</form>

<div id="qr-graph" style="width:850px;height:300px;margin:0 auto;"></div>

<div class="page-header">
    <div class="row-fluid">
        <div class="span10">
            <h1><?php echo Yii::t('dict', 'QR Logs'); ?> <small>(<?php echo count($logs) ?> <?php echo Yii::t('dict', 'records'); ?>)</small></h1>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped">
    <?php if ($logs): ?>
        <thead>
            <tr>
                <th><?php echo Yii::t('dict', 'Date'); ?></th>
                <th><?php echo Yii::t('dict', 'Time'); ?></th>
                <th><?php echo Yii::t('dict', 'Brand'); ?></th>
                <th><?php echo Yii::t('dict', 'Model'); ?></th>
                <th><?php echo Yii::t('dict', 'OS'); ?></th>
                <th><?php echo Yii::t('dict', 'OS Version'); ?></th>
                <th><?php echo Yii::t('dict', 'Browser'); ?></th>
                <th><?php echo Yii::t('dict', 'Browser Version'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <?php $date = explode('--', date('d M Y--h:i a', strtotime($log->created_at))) ?>
                    <td style="white-space: nowrap;"><?php echo $date[0] ?></td>
                    <td style="white-space: nowrap;"><?php echo $date[1] ?></td>
                    <td><?php echo $log->brand_name ?></td>
                    <td><?php echo $log->model_name ?></td>
                    <td><?php echo $log->device_os ?></td>
                    <td><?php echo $log->device_os_version ?></td>
                    <td><?php echo $log->browser ?></td>
                    <td><?php echo $log->browser_version ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    <?php endif ?>
</table>
</div>
<script>
    (function(container) {
<?php
$xy = array();
$x = 1;
foreach ($data as $date => $y) {
    $xy[] = "[$x, $y]";
    $x++;
}

$noTicks = count($data) % 7;
$noTicks = ($noTicks > 0 && $noTicks < 7) ? $noTicks - 1 : $noTicks;
?>
        var mouseLabels = [<?php echo "'" . implode("','", array_keys($data)) . "'" ?>];
        var d1 = [<?php echo implode(',', $xy) ?>],
        //        ticks = [
        //            [0, "Lower"], 10, 20, 30, [40, "Upper"]
        //        ],
        graph;

        function ticksFn(n) {
            return mouseLabels[n-1];
        }

        graph = Flotr.draw(container, [{
                data: d1//,
                //        label: "y = 4 + x^(1.5)"
            }], {
            xaxis: {
                noTicks: <?php echo $noTicks ?>,
                tickFormatter: ticksFn,
                min: 1,
                max: <?php echo count($data) ?>
            },
            yaxis: {
                //            ticks: ticks,
                min: <?php echo max(@min($data) - 1, 0) ?>,
                max: <?php echo @max($data) + 1 ?>
            },
            legend: {
                position: "nw"
            },
            lines: {
                show: true
            },
            points: {
                show: true
            },
            mouse: {
                track: true,
                relative: true,
                trackFormatter: function(e) {
                    return mouseLabels[e.index] + '<br /> <?php echo Yii::t('dict', 'Count') ?>: ' + Math.round(e.y) + '';
                }
            },
            title: "<?php echo Yii::t('dict', 'QR Analytics') ?>",
            subtitle: "....."
        });
    })(document.getElementById("qr-graph"));
    
    $('.fromDate').datepicker({
//        format:'Y-m-d'
    });

    $('.toDate').datepicker({
//        format:'Y-m-d'
    });
</script>

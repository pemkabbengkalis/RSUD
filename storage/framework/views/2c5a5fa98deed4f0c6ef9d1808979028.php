<canvas id="myChart2" style="width:100%;height:300px "></canvas>
<script src="<?php echo e(asset('backend/js/Chart.min.js')); ?>"></script>
<script>
var chartData = {
    labels: [
<?php $__currentLoopData = $weekago; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo e(date('d',strtotime($r))); ?>,
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ],
    datasets: [
        {
            fillColor: "#79D1CF",
            strokeColor: "#79D1CF",
            data: [
                <?php
                $visitor = App\Models\Visitor::whereIn('date',$weekago)->select('date')->get();
                ?>
              <?php $__currentLoopData = $weekago; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e(count(collect($visitor)->where('date',$r))); ?>,
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          ]
        }
    ]
};



var ctx = document.getElementById("myChart2").getContext("2d");
var myBar = new Chart(ctx).Bar(chartData, {
    showTooltips: false,
    onAnimationComplete: function () {

        var ctx = this.chart.ctx;
        ctx.font = this.scale.font;
        ctx.fillStyle = this.scale.textColor
        ctx.textAlign = "center";
        ctx.textBaseline = "bottom";

        this.datasets.forEach(function (dataset) {
            dataset.bars.forEach(function (bar) {
                ctx.fillText(bar.value, bar.x, bar.y - 0);
            });
        })
    }
});
</script>
<?php /**PATH C:\laragon\www\cmsv2\app\View/admin/visitor-chart.blade.php ENDPATH**/ ?>
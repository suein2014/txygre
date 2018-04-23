<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = $phrase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <p>
    <i style="color:green;font-size:16px;font-weight:bold"><?php echo e($ph->en); ?></i>
    <br>
    <?php echo e($ph->zh); ?>

  </p>
  <p></p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<hr>
<?php $__currentLoopData = $example; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <p>
    <?php echo e($ex->en); ?><br>
    <i style="color:cadetblue"><?php echo e($ex->zh); ?></i>
  </p>
  <p></p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
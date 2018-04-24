<?php $__env->startSection('content'); ?>

<div>
  <span style="color: blue;"><?php echo e($contents->phonitic); ?></span>
  <?php if(count($contents->explain) > 1 ): ?>
    <ol>
      <?php $__currentLoopData = $contents->explain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($ph); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
  <?php else: ?>
    <?php $__currentLoopData = $contents->explain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div> <?php echo e($ph); ?> </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
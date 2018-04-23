<?php $__env->startSection('content'); ?>
<div id="content" style="padding: 50px;">

    <h4>
        <a href="<?php echo e(url('wordlist/list/'.$wordlist->list_number).'?page='.$currentPage.'&type='.$type.'#'.$wordlist->id); ?>"><< 返回列表</a>
    </h4>
    <div style="float:right">
      Hard:
      <button style="background-color:darkgrey" disabled="disabled">1</button>
      <button style="background-color:burlywood" disabled="disabled">2</button>
      <button style="background-color:darkseagreen" disabled="disabled">3</button>
      <button style="background-color:cadetblue" disabled="disabled">4</button>
      <button style="background-color:darkturquoise" disabled="disabled">5</button>
      <button style="background-color:coral" disabled="disabled">6</button>
      <button style="background-color:darkgoldenrod" disabled="disabled">7</button>
      <button style="background-color:deeppink" disabled="disabled">8</button>
      <button style="background-color:darkorchid" disabled="disabled">9</button>
      <button style="background-color:red" disabled="disabled">10</button>
    </div>

    <h1 style="text-align: center; margin-top: 50px;color:<?php echo e($colors[$wordlist->familiar]); ?> "><?php echo e($wordlist->word); ?></h1>
    <hr>
    <div id="date" style="text-align: right;">
        <?php echo e($wordlist->updated_at); ?>

    </div>
    <div id="content" style="margin: 20px;">
        <p>
            page: <?php echo e($wordlist->page_number); ?>

        </p>
    </div>
    <!-- <?php echo $wordlist->contents; ?> -->
    <?php echo e($wordlist->contents); ?>

    <hr>
    <?php $__currentLoopData = $wordlist->phrase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <p>
        <i style="color:green;font-size:16px;font-weight:bold"><?php echo e($ph->en); ?></i>
        <br>
        <?php echo e($ph->zh); ?>

      </p>
      <p></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div></div>
    <hr>
    <?php $__currentLoopData = $wordlist->example; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <p>
        <?php echo e($ex->en); ?><br>
        <i style="color:cadetblue"><?php echo e($ex->zh); ?></i>
      </p>
      <p></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
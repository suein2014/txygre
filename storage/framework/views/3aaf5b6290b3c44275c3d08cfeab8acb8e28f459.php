<?php $__env->startSection('content'); ?>

<a href="<?php echo e(url('wordlist/card')); ?>" class="btn btn-lg btn-warning">刷新</a>
<table class="table table-sm" >

  <!-- <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
    Popover on top
  </button> -->

<tr>
 <?php $__currentLoopData = $wordlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loopId=>$wordlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  <?php if( ($loopId+1) == ($showColumn+1) ||  $loopId>$showColumn && $loopId%$showColumn == 0): ?>
</tr><tr>
  <?php endif; ?>

<td id="cw<?php echo e($wordlist->id); ?>">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo e($wordlist->word); ?>">
    <span style="font-size:1.5em;"> <?php echo e($wordlist->word); ?> </span>
  </button>
  <button type="button" class="btn btn-light" onclick="hideWord(<?php echo e($wordlist->id); ?>)" >隐藏</button>
</div>

  <!-- Modal -->
  <div class="modal fade" id="<?php echo e($wordlist->word); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo e($wordlist->word); ?>label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="<?php echo e($wordlist->word); ?>label" style="color:deeppink;"><?php echo e($wordlist->word); ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="color:green">
          <?php echo $wordlist->contents; ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>




</td>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tr>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<table class="table  table-sm">
  <thead>
    <tr>
      <th>Type</th>
      <th>Card</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div class="card">
          <ul class="list-group">
            <?php $__currentLoopData = $cardTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cardType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if( $type == $cardType): ?>
                <li class="list-group-item active" >
              <?php else: ?>
                <li class="list-group-item" >
              <?php endif; ?>

              <div class="list">
                  <a href="<?php echo e(url('wordlist/card?type='.$cardType)); ?>"
                  style="text-decoration:none;color:black;font-weight:bold;" >
                      <h4><?php echo e(ucfirst($cardType)); ?></h4>
                  </a>
              </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </td>
      <td>
        <div class="card">
          <div class="card-header">
            <?php if($type=='alphabet'): ?>
              <?php $__currentLoopData = $alphabet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="btn btn-<?php echo e($initial==$ab?'primary':'success'); ?>" role="button" href="<?php echo e(url('wordlist/card?type=alphabet&initial='.$ab)); ?>">
                <?php echo e($ab); ?>

                </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if($type=='hard'): ?>
              <?php for($i=10;$i>0;$i--): ?>
                <a class="btn btn-<?php echo e($hard==$i?'primary':'success'); ?>" role="button" href="<?php echo e(url('wordlist/card?type=hard&hard='.$i)); ?>">
                H<?php echo e($i); ?>

                </a>
              <?php endfor; ?>
            <?php endif; ?>

            <?php if($type=='list'): ?>
              <?php for($i=1;$i<51;$i++): ?>
                <a class="btn btn-<?php echo e($list_number==$i?'primary':'light'); ?>" role="button" href="<?php echo e(url('wordlist/card?type=list&list_number='.$i)); ?>">
                L<?php echo e($i); ?>

                </a>
              <?php endfor; ?>
            <?php endif; ?>

          </div>


          <div class="card-body">
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

            <a href="<?php echo e(url('wordlist/card?subtype=1&type='.$type.'&initial='.$initial.'&hard='.$hard.'&list_number='.$list_number)); ?>" class="btn btn-lg btn-<?php echo e($subType==0||$subType==1 ? 'warning':'light'); ?>">刷新</a>
            <?php if($type!='random'): ?>
            <a href="<?php echo e(url('wordlist/card?subtype=2&type='.$type.'&initial='.$initial.'&hard='.$hard.'&list_number='.$list_number)); ?>" class="btn btn-lg btn-<?php echo e($subType==2 ? 'warning':'light'); ?>">随机刷新</a>
            <?php endif; ?>
            <?php if($type=='list'): ?>
            <a href="<?php echo e(url('wordlist/card?subtype=3&type='.$type.'&hard='.$hard.'&list_number='.$list_number)); ?>" class="btn btn-lg btn-<?php echo e($subType==3 ? 'warning':'light'); ?>">生词刷新</a>
            <?php endif; ?>
            &nbsp;<span style="color:Grey">计数:<?php echo e($count); ?></span>
            <table class="table table-sm" >
              <tr>
               <?php $__currentLoopData = $wordlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loopId=>$wordlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if( ($loopId+1) == ($showColumn+1) ||  $loopId>$showColumn && $loopId%$showColumn == 0): ?>
                </tr><tr>
                <?php endif; ?>

                <td id="cw<?php echo e($wordlist->id); ?>">
                    <!-- Button trigger modal -->
                    <button type="button" style="background-color:<?php echo e($wordlist->familiar>7?'floralwhite':($wordlist->familiar>4? 'lightblue':'honeydew')); ?>;color:<?php echo e($wordlist->familiar>7? 'red':($wordlist->familiar>4 ? 'black':'grey')); ?>" class="btn btn-outline-secondary" data-toggle="modal" data-target="#<?php echo e($wordlist->word); ?>">
                      <span style="font-size:1.5em;"> <?php echo e($wordlist->word); ?> </span>
                    </button>
                    <button type="button" class="btn btn-light" onclick="hideWord(<?php echo e($wordlist->id); ?>)" >隐藏</button>

                    <!-- Modal Begin -->
                    <?php if ($__env->exists('wordlist.subview.word_modal')) echo $__env->make('wordlist.subview.word_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- Modal End -->
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
          </table>
        </div>
      </div>
    </div>
    </td>
  </tr>
  </tbody>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
              <a class="btn btn-primary" role="button" href="<?php echo e(url('wordlist/card?type=alphabet&initial='.$ab)); ?>">
                <?php echo e($ab); ?>

              </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if($type=='hard'): ?>
              <?php for($i=10;$i>0;$i--): ?>
              <a class="btn btn-success" role="button" href="<?php echo e(url('wordlist/card?type=hard&hard='.$i)); ?>">
                H<?php echo e($i); ?>

              </a>
              <?php endfor; ?>
            <?php endif; ?>

            <?php if($type=='list'): ?>
              <?php for($i=1;$i<51;$i++): ?>
              <a class="btn btn-light" role="button" href="<?php echo e(url('wordlist/card?type=list&list_number='.$i)); ?>">
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

            <a href="<?php echo e(url('wordlist/card?type='.$type.'&initial='.$initial.'&hard='.$familiar.'&list_number='.$list_number)); ?>" class="btn btn-lg btn-warning">刷新</a>
            <table class="table table-sm" >
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
                            <?php if( empty($e = json_decode($wordlist->contents)) ): ?>
                              <?php echo $wordlist->contents; ?>

                            <?php else: ?>

                            <div>
                              <span style="color: blue;"><?php echo e($e->phonitic); ?></span>
                              <?php if(count($e->explain) > 1 ): ?>
                                <ol>
                                  <?php $__currentLoopData = $e->explain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($exp); ?></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                              <?php else: ?>
                                <?php $__currentLoopData = $e->explain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <div> <?php echo e($exp); ?> </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                            </div>

                            <?php endif; ?>
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
        </div>
      </div>
      </td>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
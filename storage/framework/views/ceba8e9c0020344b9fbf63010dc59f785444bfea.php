<?php $__env->startSection('content'); ?>
  <!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> -->
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th width="12%">Wordlist</th>
                  <th width="88%">Words-<?php echo e($type); ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                  <div class="card">
                    <ul class="list-group">
                        <?php for($i=1; $i<51;$i++): ?>
                          <?php if($list_number==$i): ?>
                            <li class="list-group-item active" >
                          <?php else: ?>
                            <li class="list-group-item">
                          <?php endif; ?>
                            <div class="list">
                                <a href="<?php echo e(url('wordlist/list/'.$i)); ?>"
                                style="text-decoration:none;color:black;font-weight:bold;" >
                                    <h4>Wordist  <?php echo e($i); ?></h4>
                                </a>
                            </div>
                          </li>
                        <?php endfor; ?>
                    </ul>
                  </div>
                </td>
                <td>
                  <div class="card">
                    <div class="card-header">
                        排序:
                        <a class="btn btn-primary" role="button" href="<?php echo e(url('wordlist/list/'.$list_number)); ?>">
                          List <?php echo e($list_number); ?>

                        </a>
                        <a class="btn btn-primary" role="button" href="<?php echo e(url('wordlist/list/'.$list_number.'?type=list_desc')); ?>">
                          List <?php echo e($list_number); ?> Desc
                        </a>
                        <a class="btn btn-danger" role="button" href="<?php echo e(url('wordlist/list/'.$list_number.'?type=hard')); ?>">
                          Hard
                        </a>
                        <a class="btn btn-info" role="button" href="<?php echo e(url('wordlist/list/'.$list_number.'?type=hard_desc')); ?>">
                          Hard Desc
                        </a>
                        <a class="btn btn-success" role="button" href="<?php echo e(url('wordlist/list/'.$list_number.'?type=alphabet')); ?>">
                          Alphabet
                        </a>
                        <a class="btn btn-warning" role="button" href="<?php echo e(url('wordlist/list/'.$list_number.'?type=alphabet_desc')); ?>">
                          Alphabet Desc
                        </a>
                        <div style="float:right"><?php echo e($wordlists->appends(['type'=>$type])->links()); ?></div>
                        <br/>

                        <?php if ($__env->exists('wordlist.subview.hard_color')) echo $__env->make('wordlist.subview.hard_color', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </div>


                    <div class="card-body">
                          <?php if ($__env->exists('wordlist.subview.table_word')) echo $__env->make('wordlist.subview.table_word', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                  </div>

                </td>
              </tr>
            </tbody>
          </table>
        <!-- </div>
    </div>
</div> -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
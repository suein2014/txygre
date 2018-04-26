<?php $__env->startSection('content'); ?>
<table class="table table-striped table-sm">

  <tbody>
  <tr>

  <td>
    <div class="card">
        <div class="card-header">Wordlist-有序</div>
        <div class="card-body">
          <div id="content2">
            <ul>
              <?php $__currentLoopData = $alphabet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="margin: 50px 0;">
                    <div class="list">
                        <a href="<?php echo e(url('wordlist/olist/'.$ab)); ?>">
                            <h4><?php echo e($ab); ?></h4>
                        </a>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
    </div>
  </td>
  <td>
  <div class="card">
      <div class="card-header">Wordlist-乱序(50单元)</div>
      <div class="card-body">
          <?php if(session('status')): ?>
              <div class="alert alert-success">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>

          <div id="content">
            <ul>
                <?php for($i=1; $i<51;$i++): ?>
                <li style="margin: 50px 0;">
                    <div class="list">
                        <a class="wl" href="<?php echo e(url('wordlist/list/'.$i)); ?>">
                            <h4>Wordist  <?php echo e($i); ?></h4>
                        </a>
                    </div>
                </li>
                <?php endfor; ?>
            </ul>
          </div>
      </div>
  </div>
</td>

<td>
<div class="card">
    <div class="card-header">Wordlist-难度</div>
    <div class="card-body">
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <div id="content">
          <ul>
              <?php for($i=10; $i>0;$i--): ?>
              <li style="margin: 50px 0;">
                  <div class="list">
                      <a href="<?php echo e(url('wordlist/familiar/'.$i)); ?>">
                          <h4>Hard  <?php echo e($i); ?></h4>
                      </a>
                  </div>
              </li>
              <?php endfor; ?>
          </ul>
        </div>
    </div>
</div>
</td>
</tr>
</tbody>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
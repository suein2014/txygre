<?php $__env->startSection('content'); ?>
<table class="table table-striped table-sm table-hover">
  <thead>
    <tr>
      <th>Wordlist</th>
      <th>Words-<?php echo e($hardLevel); ?>-<?php echo e($type); ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
      <div class="card">
        <ul class="list-group">
          <?php for($i=10; $i>0;$i--): ?>
            <?php if($hardLevel==$i): ?>
              <li class="list-group-item active" >
            <?php else: ?>
              <li class="list-group-item">
            <?php endif; ?>
              <div class="list">
                  <a href="<?php echo e(url('wordlist/familiar/'.$i)); ?>"
                  style="text-decoration:none;color:black;font-weight:bold;" >
                      <h4>Hard  <?php echo e($i); ?></h4>
                  </a>
              </div>
            </li>
          <?php endfor; ?>
      </ul>
        </ul>
      </div>
    </td>
    <td>
      <div class="card">
        <div class="card-header">
            排序:
            <a class="btn btn-danger" role="button" href="<?php echo e(url('wordlist/familiar/'.$hardLevel.'?type=alphabet')); ?>">
              Alphabet
            </a>
            <a class="btn btn-info" role="button" href="<?php echo e(url('wordlist/familiar/'.$hardLevel.'?type=alphabet_desc')); ?>">
              Alphabet Desc
            </a>
            <a class="btn btn-success" role="button" href="<?php echo e(url('wordlist/familiar/'.$hardLevel.'?type=list')); ?>">
              List
            </a>
            <a class="btn btn-info" role="button" href="<?php echo e(url('wordlist/familiar/'.$hardLevel.'?type=list_desc')); ?>">
              List Desc
            </a>
            <div style="float:right"><?php echo e($wordlists->appends(['type'=>$type])->links()); ?></div>
            <br/>
            <div style="float:left">
              Hard:
              <button class="btn-sm" style="background-color:darkgrey" disabled="disabled">1</button>
              <button class="btn-sm" style="background-color:burlywood" disabled="disabled">2</button>
              <button class="btn-sm" style="background-color:darkseagreen" disabled="disabled">3</button>
              <button class="btn-sm" style="background-color:cadetblue" disabled="disabled">4</button>
              <button class="btn-sm" style="background-color:darkturquoise" disabled="disabled">5</button>
              <button class="btn-sm" style="background-color:coral" disabled="disabled">6</button>
              <button class="btn-sm" style="background-color:darkgoldenrod" disabled="disabled">7</button>
              <button class="btn-sm" style="background-color:deeppink" disabled="disabled">8</button>
              <button class="btn-sm" style="background-color:darkorchid" disabled="disabled">9</button>
              <button class="btn-sm" style="background-color:red" disabled="disabled">10</button>
          </div>
        </div>


        <div class="card-body">
              <?php if(session('status')): ?>
                  <div class="alert alert-success">
                      <?php echo e(session('status')); ?>

                  </div>
              <?php endif; ?>


              <div id="content">
                <div class="table-responsive">
                  <table class="table table-striped table-sm" style="line-height:15px">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>word</th>
                        <th>List</th>
                        <th>Page</th>
                        <!-- <th>contents</th> -->
                        <th>db_id</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $wordlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loopId=>$wordlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($loopId+1); ?></td>
                        <td>
                          <?php if($wordlist->familiar>5): ?>
                            <a class="btn btn-outline-secondary btn-sm"
                             style="color:<?php echo e($colors[$wordlist->familiar]); ?>"
                             href="<?php echo e(url('wordlist/'.$wordlist->id)); ?>">
                          <?php else: ?>
                            <a style="color:<?php echo e($colors[$wordlist->familiar]); ?>" href="<?php echo e(url('wordlist/'.$wordlist->id)); ?>">
                          <?php endif; ?>
                          <?php echo e($wordlist->word); ?>


                          </a>

                        </td>
                        <td><?php echo e($wordlist->list_number); ?></td>
                        <td><?php echo e($wordlist->page_number); ?></td>
                        <!-- <td><?php echo $wordlist->contents; ?></td> -->

                        <td><?php echo e($wordlist->id); ?></td>
                    </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              <div style="float:right"><?php echo e($wordlists->appends(['type'=>$type])->links()); ?></div>
              </div>
            </div>

          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
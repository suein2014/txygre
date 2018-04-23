<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                  单词管理
                </div>

                <div class="panel-body">
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <?php echo implode('<br>', $errors->all()); ?>

                        </div>
                    <?php endif; ?>

                    <a href="<?php echo e(url('admin/wordlists/create')); ?>" class="btn btn-lg btn-primary">新增</a>
                    <div style="float:right">
                      <?php echo e($wordlists->links()); ?>

                     </div>

                    <div class="table-responsive">
                      <table class="table table-striped table-sm" >
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Initial</th>
                            <th>word</th>
                            <th>操作</th>
                            <th>familiar</th>
                            <th>list</th>
                            <th>page</th>
                            <th>contents</th>
                            <th>phrase</th>
                            <th >example</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $wordlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wordlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                  <td><?php echo e($wordlist->id); ?></td>
                                  <td><?php echo e($wordlist->initial); ?></td>
                                  <td><?php echo e($wordlist->word); ?></td>
                                  <td>
                                    <a href="<?php echo e(url('admin/wordlists/'.$wordlist->id.'/edit?page='.$currentPage.'#'.$wordlist->id )); ?>" class="btn btn-success btn-sm">编辑</a>
                                  </td>
                                  <td><?php echo e($wordlist->familiar); ?></td>
                                  <td><?php echo e($wordlist->list_number); ?></td>
                                  <td><?php echo e($wordlist->page_number); ?></td>
                                  <td><?php echo $wordlist->contents; ?></td>
                                  <td><?php echo e($wordlist->phrase); ?></td>
                                  <td>
                                      <?php echo e($wordlist->example); ?>

                                  </td>

                              <!--<form action="<?php echo e(url('admin/wordlists/'.$wordlist->id)); ?>" method="POST" style="display: inline;">
                                  <?php echo e(method_field('DELETE')); ?>

                                  <?php echo e(csrf_field()); ?>

                                  <button type="submit" class="btn btn-danger">删除</button>
                              </form> -->
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
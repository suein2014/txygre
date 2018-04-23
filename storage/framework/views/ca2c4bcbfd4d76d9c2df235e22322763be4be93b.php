<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">修改单词内容</div>
                <div class="panel-body">

                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <strong>修改失败</strong> 修改不符合要求<br><br>
                            <?php echo implode('<br>', $errors->all()); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(url('admin/wordlists/'.$wordlist->id).'?page='.$currentPage.'#'.$wordlist->id); ?>" method="POST">
                      <input name="_method" type="hidden" value="PUT">
                      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <br>
                        <div>单词:</div>
                        <input type="text" name="word" class="form-control"
                            required="required" value="<?php echo e($wordlist->word); ?>">
                        <div>内容:</div>
                        <textarea name="contents" rows="5" class="form-control">
                          <?php echo e($wordlist->contents); ?>

                        </textarea>
                        <div>词组:</div>
                        <textarea name="phrase" rows="5" class="form-control">
                          <?php echo e($wordlist->phrase); ?>

                        </textarea>
                        <div>例句:</div>
                        <textarea name="example" rows="5" class="form-control">
                          <?php echo e($wordlist->example); ?>

                        </textarea>
                        <br>
                        <div>熟悉程度(10为最不熟悉):</div>
                        <select name="familiar" class="form-control">
                          <?php for($i = 10; $i>0; $i--): ?>
                              <?php if( $wordlist->familiar == $i ): ?>
                                <option  selected="selected" value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                              <?php else: ?>
                                <option  value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                              <?php endif; ?>

                          <?php endfor; ?>
                        </select>
                        <div>单元:</div>
                        <input type="text" name="list_number" class="form-control"
                            required="required" value="<?php echo e($wordlist->list_number); ?>">
                        <div>页码:</div>
                        <input type="text" name="page_number" class="form-control"
                            required="required" value="<?php echo e($wordlist->page_number); ?>">
                        <br>
                        <button class="btn btn-lg btn-info">修改</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
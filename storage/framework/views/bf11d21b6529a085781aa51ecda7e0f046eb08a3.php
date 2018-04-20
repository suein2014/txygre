<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">新增一个单词</div>
                <br>
                <div class="panel-body">

                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            <?php echo implode('<br>', $errors->all()); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(url('admin/wordlists')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <!-- 简易版输入 begin -->
                        请输入"单词,熟悉度,单元,页码":
                        <input type="text" name="wordinfo" class="form-control"
                            required="required" autofocus="autofocus" placeholder="请输入单词,熟悉度,单元,页码">
                        <br>
                        <!-- 简易版输入 end -->

                        <!-- 详细版 begin -->
                        <!-- <input type="text" name="word" class="form-control"
                            required="required" placeholder="请输入单词">
                        <br>
                        <textarea name="contents" rows="10" class="form-control"
                             placeholder="请输入解释"></textarea>
                        <br>
                        <div>选择熟悉程度(10为最不熟悉):</div>
                        <select name="familiar" class="form-control">
                          <?php for($i = 10; $i>0; $i--): ?>
                              <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                          <?php endfor; ?>
                        </select>
                        <br>
                        <br>
                        <input type="text" name="list_number" class="form-control"
                            required="required" placeholder="请输入单元 1-50">
                        <br>
                        <input type="text" name="page_number" class="form-control"
                            required="required" placeholder="请输入页码 1-500">
                        <br> -->

                        <!-- 详细版 end -->

                        <button class="btn btn-lg btn-info">新增单词</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
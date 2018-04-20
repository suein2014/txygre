<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">GRE Learning 后台</div>

                <div class="panel-body">

                    <a href="<?php echo e(url('admin/wordlists')); ?>" class="btn btn-lg btn-success col-xs-12">管理单词</a>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
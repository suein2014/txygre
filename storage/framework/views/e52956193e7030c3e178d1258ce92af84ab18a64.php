<?php $__env->startSection('content'); ?>

<ul>
			  <li>
			    <a href="">
			      <h2>Title #1</h2>
			      <p>Text Content #1</p>
			    </a>
			  </li>
			  [...]
			  <li>
			    <a href="">
			      <h2>Title #8</h2>
			      <p>Text Content #8</p>
			    </a>
			  </li>
	</ul>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('konten'); ?>
<div>
    
</div>
    <div class="flex justify-center mt-4">
        <h5 class="text-4xl font-bold"><?php echo e($buku->judul); ?></h5>
    </div>
    <div class="flex justify-center mb-4">
        <h2 class="text-blue-500"><?php echo e($buku->penulis); ?></h2>
    </div>
    <div class=" flex justify-center mx-4 border-2 text-white rounded-b-2xl p-4 bg-blue-950 border-blue-900">
        <p class="indent-8"><?php echo e($buku->deskripsi); ?></p>
    </div>
    <div class="ms-4 mt-4">
        <a href="<?php echo e(route('user')); ?>"     class="text-white rounded-full bg-blue-900 px-4 py-2" ><- back to home</a>
        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\UKP\smt5\SQA\SQA Library\resources\views/detailBuku.blade.php ENDPATH**/ ?>
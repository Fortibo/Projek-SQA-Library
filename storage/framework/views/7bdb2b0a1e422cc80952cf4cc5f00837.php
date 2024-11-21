<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title> wewewe</title>
</head>
<body>
    <div>
        <?php echo $__env->make('nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div>
        <?php echo $__env->yieldContent('konten'); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html><?php /**PATH D:\UKP\smt5\SQA\SQA Library\resources\views/base.blade.php ENDPATH**/ ?>
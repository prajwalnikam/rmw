<?php if($isHired == 1): ?>
    <span class="shortlisted-item hired"><?php echo e(__('Hired')); ?></span>
<?php elseif($isShortListed == 1): ?>
    <span class="shortlisted-item"><?php echo e(__('Shortlisted')); ?></span>
<?php endif; ?>
<?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/components/job/hire-short-list-check.blade.php ENDPATH**/ ?>
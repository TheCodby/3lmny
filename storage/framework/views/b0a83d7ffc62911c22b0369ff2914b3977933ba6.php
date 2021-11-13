<div class="modal fade" id="showTypes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Types of materials</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="card-header">Add Type</div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.types.add')); ?>" method='POST'>
                            <?php echo csrf_field(); ?>
                            <div class='form-group row align-items-center' >
                                <div class="col-8"><input type="text" name='name' placeholder='Type name' id='subject' class="form-control"></div>
                                <div class="col-4"><button type='submit' class="btn btn-primary float-end">Add</button></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($type->id); ?></th>
                                    <td><?php echo e($type->name); ?></td>
                                    <td><?php echo e($type->created_at); ?></td>
                                    <td><?php echo e($type->updated_at); ?></td>
                                    <td><a href='<?php echo e(route("admin.types.delete", $type->id)); ?>' class='btn btn-outline-danger'>Delete</a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>					
</div>
<script>
	$(document).ready( function() {
		$('#keywords2').tagsInput();
	});
</script>
<?php /**PATH C:\3lmny\resources\views/admin/materials/types.blade.php ENDPATH**/ ?>
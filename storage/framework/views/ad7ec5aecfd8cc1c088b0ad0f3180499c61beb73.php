<div class="table-responsive">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Peminjaman</h1>
        <p class="mb-4">Berikut merupakan Data Peminjaman perpustakaan Lumban Dolok</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman 2.0</h6>
            </div>
            <div class="card-body">  
                <div class="text-center px-4 mb-3">
                    <form class="form-group" id="form_input">
                        <?php echo csrf_field(); ?>
                        <?php if($borrow->id): ?>
                        <div class="form-group" id="select_books">
                            <button class="btn btn-primary mb-3" type="button" style="float: right;" id="tombol-tambah" name="tombol-tambah">Tambah Buku</button>
                            <?php $__currentLoopData = $borrow->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="name" class="labeled-form">Judul Buku</label>
                                <select class="form-control form-control-user insert-books" name="books[0]" id="books" >
                                <option value="">Pilih</option>
                                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($book->id); ?>" <?php echo e($book->id == $detail->id_buku ? 'selected' : ''); ?>><?php echo e($book->judul); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php else: ?>
                        <div class="form-group" id="select_books">
                            <button class="btn btn-primary mb-3" type="button" style="float: right;" id="tombol-tambah" name="tombol-tambah" >Tambah Buku</button>
                            <label for="name" class="labeled-form">Judul Buku</label>
                            <select class="form-control form-control-user insert-books" name="books[0]" id="books" >
                               <option value="">Pilih</option>
                               <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($book->id); ?>" ><?php echo e($book->judul); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="name" class="labeled-form">Peminjam</label>
                            <select class="form-control form-control-user" name="users" id="users">
                               <option value="">Pilih</option>
                               <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"<?php echo e($user->id == $borrow->id_user ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="load_list(1)">Batal</button>
                            <?php if($borrow->id): ?>
                            <button type="button" id="tombol_simpan" onclick="handle_save('#tombol_simpan','#form_input','<?php echo e(route('office.borrow.update',$borrow->id)); ?>','PATCH')" class="btn btn-primary">Simpan Perubahan</button>
                            <?php else: ?>
                            <button type="button" id="tombol_simpan" onclick="handle_save('#tombol_simpan','#form_input','<?php echo e(route('office.borrow.store')); ?>','POST')" class="btn btn-primary">Simpan</button>
                            <?php endif; ?> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".insert-books").select2();
         $("#users").select2();
        var i = 0;
        $("#tombol-tambah").click(function () {
            ++i;
            if(i < 3){
                $("#select_books").after('<div class="form-group"><label for="name" class="labeled-form input-books">Judul Buku</label><select  class="form-control form-control-user insert-books" id="select-books" name="books['+ i +']"><option value="">Pilih</option><?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($book->id); ?>"><?php echo e($book->judul); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>');
            }else if(i > 3){
                error_message('Hanya dapat meminjam maksimal 3 buku');
            }else{
                error_message('Hanya dapat meminjam maksimal 3 buku');
            }
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    });
</script><?php /**PATH C:\laragon\www\perpustakaan-l8-h\resources\views/pages/office/borrow/input.blade.php ENDPATH**/ ?>
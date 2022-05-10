<?php if (isset($component)) { $__componentOriginal4b9fd5df344ded1279b89d3c3f61127b178f3274 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\OfficeLayout::class, ['title' => 'Data Peminjaman']); ?>
<?php $component->withName('OfficeLayout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>


<div id="content_list">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Peminjaman</h1>
        <p class="mb-4">Berikut merupakan data peminjaman buku perpustakaan Lumban Dolok</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manajemen Peminjaman 1.0.1</h6>
                <a class="btn <?php echo e(request()->is('office/borrow/index') ? 'btn-primary' : 'btn-secondary'); ?> mb-3 btn-icon-split btn-md text-white" href="<?php echo e(route('office.borrow.index')); ?>">
                    <span class="icon">
                        <?php if(request()->is('office/borrow/index')): ?>
                        <i class="fas fa-check"></i>
                        <?php endif; ?>
                    </span>
                    <span class="text">Admin</span>
                </a>
                <a class="btn <?php echo e(request()->is('office/user-borrow/index') ? 'btn-primary' : 'btn-secondary'); ?> mb-3 btn-icon-split btn-md text-white" href="<?php echo e(route('office.user-borrow.index')); ?>">
                   <span class="icon text-white-50">
                       <?php if(request()->is('office/user-borrow/index')): ?>
                        <i class="fas fa-check"></i>
                        <?php endif; ?>
                    </span>
                     <span class="text">Peminjam</span>
                </a>
            </div>
            <div class="card-body">
                <a href="javascript:void(0);" onclick="load_input('<?php echo e(route('office.borrow.create')); ?>')" class="btn btn-primary mb-3 btn-icon-split btn-sm" >
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Tambah Data Peminjaman</span>
                </a>
                <div id="list_result"></div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<div id="content_input"></div>
<?php $__env->startSection('custom_js'); ?>
    <script type="text/javascript">
        load_list(1);
        $(document).ready(function(){
            $(document).on('click', '.page-link', function(event){
                event.preventDefault(); 
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page)
            {
                $.ajax({
                url:"?page="+page,
                success:function(data){
                    $('#list_result').html(data);
                }
                });
            }
        });
        $(".insert-books").select2();
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
<style>
    .labeled-form{
        float: left;
        display: inline;
        color:black;
        border: 5px black
    }
</style>    
<?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginal4b9fd5df344ded1279b89d3c3f61127b178f3274)): ?>
<?php $component = $__componentOriginal4b9fd5df344ded1279b89d3c3f61127b178f3274; ?>
<?php unset($__componentOriginal4b9fd5df344ded1279b89d3c3f61127b178f3274); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\perpustakaan-l8-h\resources\views/pages/office/borrow/main.blade.php ENDPATH**/ ?>
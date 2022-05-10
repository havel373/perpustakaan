<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('office.home')); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Lumban Dolok <sup>1.0</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php echo e(request()->is('office/dashboard') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(route('office.dashboard')); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
        Data
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php echo e((request()->is('office/member') || request()->is('office/employee') || request()->is('office/admin')) ? 'active' :''); ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Pengguna</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Fitur Data Pengguna:</h6>
            <a class="collapse-item <?php echo e(request()->is('office/member') ? 'active' : ''); ?>" href="<?php echo e(route('office.member.index')); ?>">Data Anggota</a>
            <a class="collapse-item <?php echo e(request()->is('office/employee') ? 'active' : ''); ?>" href="<?php echo e(route('office.employee.index')); ?>">Data Pustakawan</a>
            <?php if(Auth::user()->role == 'superadmin'): ?>
                <a class="collapse-item <?php echo e(request()->is('office/admin') ? 'active' : ''); ?>" href="<?php echo e(route('office.admin.index')); ?>">Data Admin</a>
            <?php endif; ?>
            </div>
        </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item <?php echo e((request()->is('office/book-category') || request()->is('office/all-cat')) || request()->is('office/books/index/*') ? 'active' : ''); ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Data Buku</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Fitur Data Buku:</h6>
            <a class="collapse-item <?php echo e(request()->is('office/book-category') ? 'active' : ''); ?>" href="<?php echo e(route('office.book-category.index')); ?>">Kategori Buku</a>
            <a class="collapse-item <?php echo e(request()->is('office/all-cat') ? 'active' : ''); ?>" href="<?php echo e(route('office.book-category.all')); ?>">Kumpulan Buku</a>
            </div>
        </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
        Manajemen Buku
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item <?php echo e((request()->is('office/borrow/index') || request()->is('office/user-borrow/index')) ? ' active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(route('office.borrow.index')); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Peminjaman</span></a>
        </li>

        <div class="sidebar-heading">
            Galeri
            </div>
        <li class="nav-item <?php echo e(request()->is('office/galeri') ? ' active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('office.galeri.index')); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Galeri</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        
    <li class="nav-item <?php echo e(request()->is('office/info') ? 'active' : ''); ?>">
        <a class="nav-link " href="<?php echo e(route('office.info')); ?>">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Info Website</span></a>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" id="content_filter">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" id="keywords" name="keywords" placeholder="Cari disini" aria-label="Search" aria-describedby="basic-addon2">
                    </div>
                    </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Cari disini" id="keywords" name="keywords" aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 text-gray-600 small text-uppercase "> <?php echo e(Auth::user()->name); ?> </span>
                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item <?php echo e(request()->is('office/profile') ? 'active' : ''); ?>" href="<?php echo e(route('office.profile.index')); ?>">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Pengaturan Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo e(route('office.logout')); ?>">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Keluar
                        </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar --><?php /**PATH C:\laragon\www\perpustakaan-l8-h\resources\views/theme/office/aside.blade.php ENDPATH**/ ?>
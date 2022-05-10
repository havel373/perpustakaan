<?php if (isset($component)) { $__componentOriginal4b9fd5df344ded1279b89d3c3f61127b178f3274 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\OfficeLayout::class, ['title' => 'Dashboard']); ?>
<?php $component->withName('OfficeLayout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
        <?php $__env->startSection('custom_css'); ?>
        <style>
          #chartdiv {
            width: 100%;
            height: 500px;
          }
          </style>
        <?php $__env->stopSection(); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>
            <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                      <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e(number_format($user)); ?> 
                                Orang</div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-user fa-3x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
        
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                      <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Peminjam</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">
                                  <?php echo e(number_format($borrowers)); ?> 
                                  Orang</div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-dollar-sign fa-3x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                      <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Judul Buku</div>
                              <div class="row no-gutters align-items-center">
                                      <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e(number_format($book)); ?> judul</div>
                                      </div>
                                      <div class="col">
                                        <div class="progress progress-sm mr-2">
                                          <div class="progress-bar bg-info" role="progressbar" 
                                          style="width: <?php echo e($book); ?>%"
                                          aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </div>
                                    </div>
                                      <?php echo e(number_format($newBook)); ?> Buku Baru
                                      <?php echo e(number_format($oldBook)); ?> Buku Bekas
                                  </div>
                            <div class="col-auto">
                              <i class="fas fa-book fa-3x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
        
                    <div class="col-xl-3 col-md-6 mb-4">
                      <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Kategori Buku</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($category)); ?> buah</div>
                            </div>
                            <div class="col-auto">
                              <i class="fa fa-list-alt fa-3x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                      <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Seluruh Buku</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($totalbook)); ?> buah</div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-book-open fa-solid fa-3x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Welcome Message !!</h6>
                </div>
                <div class="card-body">
                      <p>Selamat Datang Admin <b class="text-uppercase "><?php echo e(Auth::user()->name); ?>, </b></p>
                      <p class="mb-0">Sistem Informasi Manajemen Perpustakaan "Lumban Dolok" <br> Jangan Berikan Email dan Password Anda pada Siapapun</p>
                </div>
            </div>
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary text-center">Grafik Peminjam Buku</h6>
              </div>
              <div class="card-body">
                <div id="chartdiv"></div>
              </div>
          </div>
        </div>
        <?php $__env->startSection('custom_js'); ?>
        <script src="<?php echo e(asset('offices/amcharts4/core.js')); ?>"></script>
        <script src="<?php echo e(asset('offices/amcharts4/charts.js')); ?>"></script>
        <script src="<?php echo e(asset('offices/amcharts4/themes/animated.js')); ?>"></script>
          <script>
            am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            // Add data
            chart.data = <?php echo $grafik; ?>;

            // Create axes

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "monthname";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;

            categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
              if (target.dataItem && target.dataItem.index & 2 == 2) {
                return dy + 25;
              }
              return dy;
            });

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = "total";
            series.dataFields.categoryX = "monthname";
            series.name = "Count";
            series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;

            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
            columnTemplate.strokeOpacity = 1;

            }); // end am4core.ready()
          </script>
        <?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginal4b9fd5df344ded1279b89d3c3f61127b178f3274)): ?>
<?php $component = $__componentOriginal4b9fd5df344ded1279b89d3c3f61127b178f3274; ?>
<?php unset($__componentOriginal4b9fd5df344ded1279b89d3c3f61127b178f3274); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\perpustakaan-l8-h\resources\views/pages/office/dashboard.blade.php ENDPATH**/ ?>
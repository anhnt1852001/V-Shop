<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/?module=backend">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Sản Phẩm</span>
            <span class="info-box-number">
              <?php echo $count_product
              ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Lượt xem</span>
            <span class="info-box-number"> <?php echo $count_luot_xem ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Sales</span>
            <span class="info-box-number"><?php echo $count_giam_gia ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Members</span>
            <span class="info-box-number"> <?php echo $count_user ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Thống Kê Hóa Đơn</h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
                  <a class="dropdown-divider"></a>
                  <a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong>Biểu Đồ Thống Kê Tổng Tiền </strong>
                </p>
                <div class="card card-primary">

                  <!-- <h3 class="card-title"></h3> -->
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <p class="text-center">
                  <strong>Đơn Hàng</strong>
                </p>
                <div class="progress-group">
                  Sản Phẩm Đã Lên Hóa Đơn
                  <span class="float-right"><b><?php echo $sum_sp_order_detail ?></b>/<?php echo $count_product ?></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width:<?= $sum_sp_order_detail/$count_product*100 ?>%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                  Hoàn Tất Mua Hàng
                  <span class="float-right"><b><?php echo $count_order_complete ?></b>/<?php echo $count_order ?></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: <?= $count_order_complete/$count_order*100?>%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Hóa Đơn Chưa Giao</span>
                  <span class="float-right"><b><?php echo $count_order_not_delivery ?></b>/<?php echo $count_order ?></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: <?=$count_order_not_delivery/$count_order*100?>%"></div>
                  </div>
                </div>
                <div class="progress-group">
                  <span class="progress-text">Hóa Đơn Đang Giao</span>
                  <span class="float-right"><b><?php echo $count_order_delivered ?></b>/<?php echo $count_order ?></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: <?=$count_order_delivered/$count_order*100?>%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- /.card -->
        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Latest Orders</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Receiver</th>
                    <th>Status</th>
                    <th>Ngày Tạo Đơn</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($detail_order as $order) : ?>
                    <tr>
                      <td><a href="?module=backend&controller=order&action=detail&id=<?=$order['ma_hd']?>"><?= $order['ma_hd'] ?></a></td>
                      <td><?= $order['nguoi_nhan'] ?></td>
                      <td> <?php if ($order['trang_thai'] == 0) {
                              echo '<span class="badge badge-warning">Đang Chờ Xác Nhận</span>';
                            } else if ($order['trang_thai'] == 1) {
                              echo '<span class="badge badge-info">Đang Giao Hàng</span>';
                            } else if ($order['trang_thai'] == 2) {
                              echo '<span class="badge badge-success">Đã Thanh Toán</span>';
                            }
                            ?></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $order['ngay_lap_don'] ?></div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a href="<?= BASE_URL ?>/?module=backend&controller=order&action=list" class="btn btn-sm btn-secondary float-right">View All Orders</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <div class="row">
          <!-- /.col -->

          <div class="col-md-6">
            <!-- USERS LIST -->
            <!--/.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-4">
        <!-- Info Boxes Style 2 -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Thống Kê Sản Phẩm </h3>
          </div>
          <!-- /.card-header -->
          <!-- DONUT CHART -->
          <div class="card-danger">
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            <div class="card-body">
              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card-body -->
        <!-- PRODUCT LIST -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  <!--/. container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>

<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
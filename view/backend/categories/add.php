<div class="card-header">
    <h3 class="card-title">
    <i class="fas fa-plus-circle"></i>
        Thêm Loại Hàng
    </h3>
</div>
<!-- /.card-header -->
<h4 class="text-center card-header text-success"><?php echo @$msg; ?></h4>
<form action="" method="post" enctype="multipart/form-data">
  <!-- content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">General</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
          <div class="form-group">
              <label for="inputName">Mã Mặt Hàng</label>
              <input name="ma_mh" class="form-control" readonly value="auto number">
            </div>
            <div class="form-group">
              <label for="inputName">Tên Mặt Hàng</label>
              <input type="text" name="ten_mh" class="form-control">
              <?= (isset($err['ten_mh']) ? $err['ten_mh'] : '') ?> 
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
      <input type="submit" name="btnSave" value="Create New" class="btn btn-success ml-2 float-right">
        <button class="btn btn-secondary float-right ml-2 " type="reset">Reset</button>
        <a href="?module=backend&controller=categories&action=list" type="input" class="btn btn-primary float-right"><i class="fas fa-list-ul"> List</i></a>
      </div>
    </div>
  </section>
  <!-- /.content -->
</form>
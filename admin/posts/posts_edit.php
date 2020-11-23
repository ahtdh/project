<?php
require_once '../includes/functions.php';

if(count($_POST) && isset($_POST['id']) && isset($_POST['title']) && isset($_POST['short_description'])  && isset($_POST['description']) ) {
  updatePost($_POST['id'], $_POST['title'], $_POST['short_description'], $_POST['description'],$_POST['id_category']);
}

if(count($_GET) && isset($_GET['id']) && is_numeric($_GET['id'])) {
  $result = getPosts($_GET['id']);
  $post = mysqli_fetch_assoc($result);
}

$cal = getCategories();

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>پنل مدیریت | شروع سریع</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="../dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="../dist/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php
require_once '../layouts/nav.php';
require_once '../layouts/right_aside.php';
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">صفحه سریع</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">صفحه سریع</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
    <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">مثال ساده</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="">
                <input type="hidden" name="id" value="<?= $post['id'] ?>" />
                <div class="card-body">
                <select name="id_category" class="form-control">
                    <option>انتخاب کنید</option>
                      <?php
                      while ($calcul = mysqli_fetch_assoc($cal)) {
                      ?>
                        <option value="<?= $calcul['id'] ?>"<?= $post['id_category'] == $calcul['id'] ? 'selected' : '' ?>><?= $calcul['title'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  <div class="form-group">
                    <label for="exampleInputEmail1">عنوان پست</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="عنوان پست را وارد کنید" value="<?= $post['title'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">توضیحات کوتاه</label>
                    <input type="text" name="short_description" class="form-control" id="exampleInputPassword1" placeholder="توضیحات کوتاه را وارد کنید" value="<?= $post['short_description'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">توضیحات </label>
                    <textarea name="description" class="form-control" id="exampleInputPassword1" placeholder="توضیحات را وارد کنید"><?= $post['description'] ?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">ارسال</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
       
          <!--/.col (right) -->
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
require_once '../layouts/footer.php';
?>


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>

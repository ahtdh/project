<?php

require_once '../includes/functions.php';

if(count($_GET) && isset($_GET['del']) && is_numeric($_GET['del'])) {
  $result=deletecommentd($_GET['del']);
  header('Location: comments_index.php');
  exit();
}

$comments = getComments();


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

  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">

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
              <h1 class="m-0 text-dark">لیست نطرات</h1>
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


          <div class="card col-12">
            <div class="card-header">
              <h3 class="card-title">Data Table With Full Features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="posts_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>موبایل</th>
                    <th>نظر</th>
                    <th>تاریخ</th>
                    <th>عنوان پست</th>
                    <th>عملیات</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  while ($comment = mysqli_fetch_assoc($comments)) {
                  ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= $comment['name'] ?></td>
                      <td><?= $comment['mobile'] ?></td>
                      <td><?= mb_substr($comment['description_comment'], 0, 20) . ' ...' ?></td>
                      <td><?= $comment['created_at'] ?></td>
                      <td><a href="/project/single.php?id=<?= $comment['post_id']?>"><?= $comment['title_post'] ?></a></td>
                      <td>
                        <a href="comments_edit.php?id=<?= $comment['id'] ?>" class="fa fa-edit"></a>
                        <a href="comments_index.php?del=<?= $comment['id'] ?>" onclick="return confirm('Do you sure?');" class="fa fa-times" style="color: red;"></a>
                      </td>
                    <?php
                  }
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
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
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>

  <!-- page script -->
  <script>
    $(function() {

      $('#posts_table').DataTable();
    });
  </script>
</body>

</html>
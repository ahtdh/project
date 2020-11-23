<?php
require_once '../admin/includes/functions.php';
require_once '../project/functions_f/functions_f.php';
if (count($_GET) && !is_null($_GET['id']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
  $posts = getPosts($_GET['id']);
  $post = mysqli_fetch_assoc($posts);
  if (is_null($post)) {
    header("Location: /project");
  }
} else
  header("Location: /project");
if (!isset($_COOKIE['amir' . $post['id']])) {
  setcookie('amir' . $post['id'], '1', ['expires' => time() + 84500],);
  calculateCountViews($post['id']);
}

if (count($_POST))
  storeComments($_POST);

if (count($_GET) && isset($_GET['id']) && is_numeric($_GET['id'])) {
  $Result = getComments($comment_id = null, $post_id = $_GET['id']);
} else
  header("Location: /project");



  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>مقاله انرژی های تجدید پذیر</title>
  <link rel="stylesheet" href="./node_modules/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="./style.css" />
</head>

<body>
  <?php
  require_once  'layouts/header.php';
  ?>
  <main class="rtl mt-3">
    <div class="container">
      <div class="row">
        <!-- <div class="col-12 col-md-8 col-lg-5 d-flex d-md-block justify-content-center">
          <div class="d-flex justify-content-center single-img mb-4">
            <img src="./images/p1.jpg" alt="file">
          </div>
        </div> -->
        <div class="col-12 col-md-4 col-lg-7">
          <h1 class="o-font-md font-weight-bold"><?= $post['title'] ?></h1>
          کد مقاله:<span class="text-muted d-block mb-2"> SF-564</span>
          <strong>قیمت محصول: </strong><span class="d-block text-success">25,000 تومان</span>
        </div>
      </div>
      <hr>
      <article class="o-font-sm text-dark text-justify">
        <p><?= $post['description'] ?> </p>
        <hr>
        <h5 class="mb-3">نظر</h5>
        <form method="POST" action="">
          <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
          <input type="hidden" name="parent_id" value="0">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputName4">نام</label>
              <input type="text" name="name" class="form-control" id="inputName4">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPhone4">شماره همراه</label>
              <input type="text" name="mobile" class="form-control" id="inputPhone4">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">ایمیل</label>
              <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="inputName4">توضیحات</label>
            <textarea class="form-control" name="description_comment" id="inputName4"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">ثبت نظر</button>
        </form>
        <br>
      </article>
      <?php
      while ($comment = mysqli_fetch_assoc($Result)) {
      ?>
        <div class="alert alert-success" role="alert">
          <P>نام:<?= $comment['name'] ?><br>
            نظر:<?= nl2br($comment['description_comment']) ?>
          </P>
          <button data-comment_id="<?= $comment['id'] ?>" class="btn btn-primary btn_reply_cm" id="btn_reply_cm_<?= $comment['id'] ?>">پاسخ</button>
          <form method="POST" action="" class="reply_form" id="reply_form_<?= $comment['id'] ?>">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <input type="hidden" name="parent_id" value="<?= $comment['id'] ?>">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputName4">نام</label>
                <input type="text" name="name" class="form-control" id="inputName4">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputPhone4">شماره همراه</label>
                <input type="text" name="mobile" class="form-control" id="inputPhone4">
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">ایمیل</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputPhone4">توضیحات</label>
                <textarea name="description_comment" class="form-control"></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">ارسال نظر</button>
          </form>
          <?php
          $childern=getComments($comment['id'], $post['id']);
          while ($child = mysqli_fetch_assoc($childern)) {
           ?>
           <div class="alert alert-info" role="alert">
            <P>نام:<?= $child['name'] ?><br>
            نظر:<?= nl2br($child['description_comment']) ?>
            </P>
          </div>
            <?php
          }
       ?>
        
        </div>
      <?php
      }
      ?>
      </div>
  </main>
  <?php
  require_once  'layouts/footer.php';
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('form.reply_form').hide();

      $('button.btn_reply_cm').on('click', function() {
        var comment_id = $(this).attr('data-comment_id');
        // console.log(comment_id);
        $('form#reply_form_' + comment_id).toggle();
      });

    });
  </script>
  <script src="./node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./popper.min.js"></script>
  <script src="./node_modules/bootstrap-v4-rtl/dist/js/bootstrap.min.js"></script>
</body>

</html>
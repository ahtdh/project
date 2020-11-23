<?php
require_once '../admin/includes/functions.php';
require_once '../project/functions_f/functions_f.php';
// $posts = getPosts();
$post2=getPostsForIndex($limit = 2, $orderBy = null, $orderType = 'ASC');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فروشگاه</title>
    <link rel="stylesheet" href="./node_modules/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
    <?php
    require_once  'layouts/header.php';
    ?>
    <main class="rtl mt-3">
        <div class="d-flex justify-content-center flex-wrap">
            <?php
            while ($post = mysqli_fetch_assoc($post2)) {
            ?>
                <div class="card m-2" style="width: 18rem;">
                    <img src="./images/p1.jpg" class="card-img-top" alt="store">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="single.html" class="nav-link p-0 text-dark"><?= $post['title'] ?></a>
                        </h5>
                        <p class="card-text text-muted o-font-sm"><?= $post['short_description'] ?></p>
                    </div>
                    <div class="card-footer">
                        <p class="text-success text-center">25,000 تومان</p>

                        <a href="single.php?id=<?= $post['id'] ?>" class="btn btn-outline-secondary btn-block">ادامه مطلب</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </main>
    <?php
    require_once  'layouts/footer.php';
    ?>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./popper.min.js"></script>
    <script src="./node_modules/bootstrap-v4-rtl/dist/js/bootstrap.min.js"></script>
</body>
</html>
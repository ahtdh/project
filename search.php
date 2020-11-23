<?php
require_once '../admin/includes/functions.php';
require_once '../project/functions_f/functions_f.php';

if (isset($_GET) && ($_GET['search']!= '')&&!is_null($_GET['search']))
    $search = searchs($_GET['search']);


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
        <div class="d-flex justify-content-center flex-wrap">
            <?php
            while ($sear = mysqli_fetch_assoc($search)) {
                if(!empty($sear)){
            ?>
                <div class="card m-12">
                    <p><?= $sear['description'] ?>
                        <?= $_GET['search'] ?> </p>
                </div>
            <?php
            
        }
        else
        var_dump($_GET['search'].'موجود نمی باشد') ;
    
            }
            ?>
        </div>
    </main>
    <?php
    require_once  'layouts/footer.php';
    ?>
    </script>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./popper.min.js"></script>
    <script src="./node_modules/bootstrap-v4-rtl/dist/js/bootstrap.min.js"></script>
</body>

</html>
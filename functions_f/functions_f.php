<?php
require_once   '../admin/includes/db.php';

function calculateCountViews($post_id)
{ {
    global $link;
    $query = "UPDATE `posts` SET
        `count_views` = `count_views` + 1
         WHERE `id` = '{$post_id}'";

    $result = mysqli_query($link, $query);
  }
}

function storeComments($_post)
{
  global $link;

  $query =  "INSERT INTO `comments` VALUES
 (NULL,'{$_post['post_id']}','{$_post['parent_id']}','{$_post['name']}','{$_post['email']}','{$_post['mobile']}','{$_post['description_comment']}', '" . date('Y-m-d H:i:s') . "', '0',' j')";

  $result = mysqli_query($link, $query);
}
function getComments($parent_id = null, $post_id)
{
  global $link;
  $query = "SELECT * FROM `comments` WHERE `Confirmation` = '1' AND `post_id` = '{$post_id}'";
  if (is_null($parent_id)) {
    $query .= " AND `parent_id` = '0'";
  } else {
    $query .= " AND `parent_id` = '{$parent_id}' ";
  }

  $result = mysqli_query($link, $query);
  return $result;
}
function storeadmins($name, $username, $password)
{
  global $link;
  $query = "INSERT INTO `admins`(`id`, `name`, `username`, `password`) 
  VALUES (NULL,'{$name}','{$username}','{$password}')";
  $result = mysqli_query($link, $query);
}

function getalladmin()
{
  global $link;
  $query = "SELECT * FROM `admins`WHERE 1";
  $result = mysqli_query($link, $query);

  return $result;
}

function getadmin($username, $password)
{
  global $link;
  $query = "SELECT * FROM `admins`WHERE `username`='$username' AND `password`='$password'";
  $result = mysqli_query($link, $query);

  return $result;
}
function getPostsForIndex($limit = null, $orderBy = null, $orderType = 'ASC')
{
  global $link;
  $query = "SELECT P.* FROM `posts` P 
              JOIN `categories` C 
              ON P.id_category =C.id
              WHERE
                  C.show_at_index = '1'
                ";
  $result = mysqli_query($link, $query);
  return $result;
}
function getCommentsForPage($post_id)
{
  global $link;
  $query = "SELECT C.* FROM  `comments` C
              JOIN `posts` P
              ON P.$post_id =C.post_id
              WHERE
                  C.Confirmation = '1'
                ";
  $result = mysqli_query($link, $query);
  return $result;
}




function searchs($_get)
{
  global $link;
  $query = "SELECT `description` FROM `posts` WHERE title LIKE '%$_get%'
  OR description LIKE '%$_get%'";
  $result = mysqli_query($link, $query);
  return $result;
}

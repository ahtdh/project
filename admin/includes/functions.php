<?php
require_once 'db.php';


function storePost($title, $short_description, $description, $id_category)
{
    global $link;
    $query = "INSERT INTO `posts`(`id`,`id_category` ,`title`, `short_description`, `description`, `count_views`, `pic_url`, `created_at`) VALUES
     (NULL,'{$id_category}',  '{$title}', '{$short_description}', '{$description}', '0', '', '" . date('Y-m-d H:i:s') . "')";
    $result = mysqli_query($link, $query);
}
function updatePost($id, $title, $short_description, $description,$id_category)
{
    global $link;
    $query = "UPDATE `posts` SET 
        `title` = '{$title}', 
        `short_description` = '{$short_description}',
        `description` = '{$description}',
        `id_category` ='{$id_category}'
         WHERE `id` = '{$id}'";
    $result = mysqli_query($link, $query);
}
// function getPosts($post_id = null)
// {
//     global $link;

//     $query = "SELECT * FROM `posts`";
//     if (!is_null($post_id)) {
//         $query .= " WHERE `id`='{$post_id}'";
//     }
//     $result = mysqli_query($link, $query);
//     return $result;
// }
function getPosts($post_id = null,$id_category=null ,$limit = null, $orderBy = null, $orderType = 'ASC')
{
    global $link;
    $query = "SELECT * FROM `posts`";
    if (!is_null($post_id)) {
        $query .= " WHERE `id`='{$post_id}'";
    }
    if (!is_null($orderBy)) {
        $query .= " ORDER BY `" . $orderBy . "` " . $orderType;
    }
    if (!is_null($limit)) {
        $query .= " LIMIT " . $limit;
        
    }
    if (!is_null($id_category)) {
        $query .= " WHERE `id_category`='{$id_category}'";
    }
    //    echo $query; exit;
    $result = mysqli_query($link, $query);
    return $result;
}
function deletePost($post_id)
{
    global $link;
    $query = "DELETE FROM `posts` WHERE `id`='{$post_id}'";
    $result = mysqli_query($link, $query);
    return $result;
}
function storeCategory($title, $show_at_index)
{
    global $link;
    $query = "INSERT INTO `categories` VALUES
     (NULL,  '{$title}', '{$show_at_index}', '" . date('Y-m-d H:i:s') . "')";

    $result = mysqli_query($link, $query);
}

function getCategories($category_id = null)
{
    global $link;
    $query = "SELECT * FROM `categories`";
    if (!is_null($category_id)) {
        $query .= " WHERE `id`='{$category_id}'";
    }
    $result = mysqli_query($link, $query);
    return $result;
}


function deleteCategory($category_id)
{
    global $link;

    $query = "DELETE FROM `categories` WHERE `id`='{$category_id}'";
    $result = mysqli_query($link, $query);
    return $result;
}


function updateCategory($id, $title, $show_at_index)
{
    global $link;
    $query = "UPDATE `categories` SET 
        `title` = '{$title}', 
        `show_at_index` = '{$show_at_index}'
         WHERE `id` = '{$id}'";

    $result = mysqli_query($link, $query);
}

function getPostsForIndex($limit = null, $orderBy = null, $orderType = 'ASC')
{
    global $link;
    $query = "SELECT P.* FROM `posts` P 
                JOIN `categories` C 
                ON P.category_id=C.id
                WHERE
                    C.show_at_index = '1'";
    if (!is_null($orderBy)) {
        $query .= " ORDER BY `" . $orderBy . "` " . $orderType;
    }
    if (!is_null($limit)) {
        $query .= " LIMIT " . $limit;
    }
    //    echo $query; exit;
    $result = mysqli_query($link, $query);
    return $result;
}
function storeComments($name, $post_id, $email, $mobile, $description_comment)
{
    global $link;
    $query = "INSERT INTO `comments`(`id`, `post_id`, `name`, `email`, `mobile`, `description_comment`, `created_at`, `Confirmation`) 
  VALUES (NULL,'{$post_id}','{$name}','{$email}','{$mobile}','{$description_comment}', '" . date('Y-m-d H:i:s') . "', '0'";

    $result = mysqli_query($link, $query);
}
function getComments($comment_id = null)
{
    global $link;
    $query = "SELECT * FROM `comments` ";

    if (!is_null($comment_id)) {
        $query .= " WHERE `id`='{$comment_id}'";
    }
    $result = mysqli_query($link, $query);
    return $result;
}


function calculateCountViews($post_id)
{

    global $link;
    $query = "UPDATE `posts` SET
        `count_views` = `count_views` + 1
         WHERE `id` = '{$post_id}'";
    $result = mysqli_query($link, $query);
}

function updateComments($Confirmation,$comment_id){
    global $link;

    $query = "UPDATE `comments` SET
        `Confirmation` = $Confirmation
         WHERE `id` = '{$comment_id}'";

    $result = mysqli_query($link, $query);
}
function deletecommentd($commet_id)
{
    global $link;
    $query = "DELETE FROM `comments` WHERE `id`='{$commet_id}'";
    $result = mysqli_query($link, $query);
    return $result;
}
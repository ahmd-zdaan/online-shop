<?php
$category_id = $_GET['category_id'];

$query = "DELETE FROM category WHERE category_id=".$category_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=category_list'</script>";
}
?>
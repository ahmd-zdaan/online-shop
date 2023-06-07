<?php
$sale_id = $_GET['sale_id'];

$query = "DELETE FROM sale WHERE id=".$sale_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=sale_list'</script>";
}
?>
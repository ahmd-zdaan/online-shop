<?php
$subcategory_id = $_GET['subcategory_id'];

$query = "DELETE FROM subcategory WHERE subcategory_id=".$subcategory_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=subcategory_list'</script>";
}
?>
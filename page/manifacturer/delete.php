<?php
$manifacturer_id = $_GET['manifacturer_id'];

$query = "DELETE FROM manifacturer WHERE manifacturer_id=".$manifacturer_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=manifacturer_list'</script>";
}
?>
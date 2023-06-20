<?php
$review_report_id = $_GET['review_report_id'];

$query = "DELETE FROM review_report WHERE review_report_id=".$review_report_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=report_review_list'</script>";
}
?>
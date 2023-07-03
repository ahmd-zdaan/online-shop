<?php
$subcategory_id = $_GET['subcategory_id'];

$get_subcategory = get('subcategory', 'WHERE subcategory_id='.$subcategory_id);
$data_subcategory = mysqli_fetch_assoc($get_subcategory);

$category_id = $data_subcategory['category_id'];

$query = "DELETE FROM subcategory WHERE subcategory_id=".$subcategory_id;

if (mysqli_query($connect, $query)) {
    echo '<script>window.location.href = "index.php?page=category_edit&category_id='.$category_id.'"</script>';
}

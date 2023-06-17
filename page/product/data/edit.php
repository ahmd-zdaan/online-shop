<?php
include_once '../../../config/connect.php';

$category_id = $_GET['category_id'];

$result = get('subcategory', 'WHERE category_id=' . $category_id);
foreach ($result as $data) :
    $subcategory_id = $data['subcategory_id'];
    $subcategory_name = $data['subcategory_name'];
?>
    <option value="<?= $subcategory_id ?>"><?= $subcategory_name ?></option>
<?php
endforeach
?>
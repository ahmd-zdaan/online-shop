<?php
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$category = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$size = $_POST['size'];
	$color = $_POST['color'];
	$weight = $_POST['weight'];
	$stock = $_POST['stock'];

	$manifacturer = $_POST['manifacturer'];
	$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $manifacturer)));
	$select = get('manifacturer', 'WHERE slug="' . $slug . '"');
	if (mysqli_num_rows($select) > 0) {
		$data = mysqli_fetch_assoc($select);
		$id = $data['manifacturer_id'];
	} else {
		insert('manifacturer', [
			'manifacturer_name' => $manifacturer,
			'slug' => $slug
		]);
		$id = mysqli_insert_id($connect);
	}

	$result = insert('product', [
		'product_name' => $name,
		'category_id' => $category,
		'subcategory_id' => $subcategory,
		'price' => $price,
		'stock' => $stock,
		'description' => $description,
		'manifacturer_id' => $id,
		'size' => $size,
		'color' => $color,
		'weight' => $weight
	]);

	$id = $connect->insert_id;

	if (!empty($_FILES['image']['name'])) {
		$name = $_FILES['image']['name'];
		list($file_name, $extension) = explode(".", $name);
		$image_name = time() . "." . $extension;

		$tmp = $_FILES['image']['tmp_name'];
		if (move_uploaded_file($tmp, "uploads/" . $image_name)) {
			$query = "INSERT INTO product_image (image_name, product_id) VALUES ('" . $image_name . "', '" . $id . "')";
			var_dump($query);
			$result = mysqli_query($connect, $query);

			if (!$result) {
				unlink("uploads/" . $image_name);
			}
		}
	}

	if ($result) {
		echo '<script>window.location.href = "index.php?page=product_list"</script>';
	}
}
?>

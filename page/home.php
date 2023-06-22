<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

<!-- BASE CSS -->
<link href="css/bootstrap.custom.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- SPECIFIC CSS -->
<link href="css/home_1.css" rel="stylesheet">

<main>
	<div id="carousel-home">
		<div class="owl-carousel owl-theme">
			<?php
			$result1 = get('product');

			foreach ($result1 as $data1) :
				$product_id = $data1['product_id'];
				$product_name = $data1['product_name'];
				$price = $data1['price'];

				$result_image = get('product_image', 'WHERE product_id=' . $product_id);
				$data_image = mysqli_fetch_assoc($result_image);

				$image_name = $data_image['image_name'];
			?>
				<!-- <div class="owl-slide cover" style="background-image: url(img/slides/slide_home_2.jpg);"> -->
				<div class="owl-slide cover" style="background-image: url(uploads/product/<?= $image_name ?>);background-size:contain;background-repeat: no-repeat">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<div class="container">
							<div class="row justify-content-center justify-content-md-end">
								<div class="col-lg-6 static">
									<div class="slide-text text-right white">
										<h2 class="owl-slide-title">
											<?= $product_name ?>
										</h2>
										<?php
										$get_sale = get('sale', 'WHERE product_id=' . $product_id);
										if (mysqli_num_rows($get_sale) > 0) :
											$data_sale = mysqli_fetch_assoc($get_sale);
											$sale = $data_sale['sale'];
											$price_sale = $price - $price * (int) $sale / 100;
										?>
											<span style="font-size:medium;" class="ribbon off ml-3 mt-3 px-3 py-2">- <?= $sale ?>%</span>
											<p class="owl-slide-subtitle mb-0" style="font-size:larger; font-weight:bold">
												<?= rupiah($price) ?>
											</p>
											<p style="color:#9d9d9d" class="old_price">
												<?= rupiah($price) ?>
											</p>
										<?php else : ?>
											<p class="owl-slide-subtitle">
												<?= rupiah($price) ?>
											</p>
										<?php endif ?>
										<div class="owl-slide-cta">
											<a class="btn_1" href="index.php?page=product_view&product_id=<?= $product_id ?>" role="button">View Product</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		<ul id="banners_grid" class="clearfix">
			<li>
				<a href="index.php?page=list&view=list" class="img_container">
					<img src="img/fashion.jpg" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>FASHION</h3>
						<div>
							<span class="btn_1">Browse Category</span>
						</div>
					</div>
				</a>
			</li>
			<li>
				<a href="index.php?page=list&view=list" class="img_container">
					<img src="img/electronics.jpg" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>ELECTRONICS</h3>
						<div>
							<span class="btn_1">Browse Category</span>
						</div>
					</div>
				</a>
			</li>
			<li>
				<a href="index.php?page=list&view=list" class="img_container">
					<img src="img/kitchen.jpg" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>KITCHEN</h3>
						<div>
							<span class="btn_1">Browse Category</span>
						</div>
					</div>
				</a>
			</li>
		</ul>
		<div class="container margin_60_35 pt-5">
			<div class="main_title">
				<h2>Products on Sale</h2>
				<p>Discover products that are on sale</p>
			</div>
			<div class="row small-gutters">
				<?php
				$result = get('sale', 'ORDER BY sale DESC');

				foreach ($result as $data) :
					$product_id = $data['product_id'];

					$get_product = get('product', 'WHERE product_id=' . $product_id);
					$data = mysqli_fetch_assoc($get_product);

					$product_id = $data['product_id'];
					$product_name = $data['product_name'];
					$category_id = $data['category_id'];
					$subcategory_id = $data['subcategory_id'];
					$price = $data['price'];
					$sold = $data['sold'];
					$description = $data['description'];
				?>
					<div class="col-6 col-md-4 col-xl-3">
						<div class="grid_item">
							<?php
							$get_sale = get('sale', 'WHERE product_id=' . $product_id);
							if (mysqli_num_rows($get_sale) > 0) :
								$data_sale = mysqli_fetch_assoc($get_sale);
								$sale = $data_sale['sale'];
								$price_sale = $price - $price * (int) $sale / 100;
							?>
								<span class="ribbon off">- <?= $sale ?>%</span>
							<?php endif ?>
							<figure>
								<!-- <span class="ribbon new">New</span>
								<span class="ribbon hot">Hot</span>
								<span class="ribbon off">-30%</span> -->
								<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
									<?php
									$result = get('product_image', 'WHERE product_id=' . $product_id);
									if (mysqli_num_rows($result) > 0) :
										$data = mysqli_fetch_assoc($result);
										$image_name = $data['image_name'];
									?>
										<img src="uploads/product/<?= $image_name ?>" class="lazy" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
									<?php
									else :
									?>
										<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
									<?php endif ?>
								</a>
								<!-- <div data-countdown="2019/05/15" class="countdown"></div> -->
							</figure>
							<div class="rating">
								<?php
								$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
								$data_review = mysqli_fetch_assoc($get_review);
								$total_rating = (int)$data_review['sum(rating)'];

								$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
								$data_review = mysqli_fetch_assoc($get_review);
								$count_rating = (int)$data_review['count(rating)'];

								if ($count_rating > 0) {
									$average_rating = round($total_rating / $count_rating);

									for ($i = $average_rating; $i > 0; $i--) {
										echo '<i class="icon-star voted"></i>';
									}
								}

								if ($count_rating == 0) {
									echo '<p class="mb-0">No review</p>';
								} else {
									$n = 5 - $average_rating;
									for ($i = $n; $i > 0; $i--) {
										echo '<i class="icon-star"></i>';
									}
									echo '<em class="ml-2" style="color:#9d9d9d">(' . $count_rating . ')</em>';
								}
								?>
							</div>
							<a href="product-detail-1.html">
								<h3>
									<?= $product_name ?>
								</h3>
							</a>
							<div class="price_box mb-0">
								<?php
								$get_sale = get('sale', 'WHERE product_id=' . $product_id);
								if (mysqli_num_rows($get_sale) > 0) :
									$data_sale = mysqli_fetch_assoc($get_sale);
									$sale = $data_sale['sale'];
									$price_sale = $price - $price * (int) $sale / 100;
								?>
									<span class="new_price">
										<?= rupiah($price_sale) ?>
									</span>
									<span class="old_price" style="font-size:small">
										<?= rupiah($price) ?>
									</span>
								<?php else : ?>
									<span class="new_price">
										<?= rupiah($price) ?>
									</span>
								<?php endif ?>
							</div>
							<div>
								<p style="color: #9d9d9d;" class="mb-3">
									<?= $sold ?> sold • 0 discussions
								</p>
							</div>
							<ul>
								<li>
									<?php
									if (isset($_SESSION['email'])) :
										$email = $_SESSION['email'];

										$get_user = get('user', 'WHERE email="' . $email . '"');
										$data_user = mysqli_fetch_assoc($get_user);
										$user_id = $data_user['user_id'];

										$get_wishlist = get('wishlist', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
										if (mysqli_num_rows($get_wishlist) > 0) :
									?>
											<a href="index.php?page=wishlist_remove&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Remove from wishlist">
												<i class="ti-heart"></i>
											</a>
										<?php else : ?>
											<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
												<i class="ti-heart"></i>
											</a>
										<?php endif ?>
									<?php endif ?>
								</li>
								<li>
									<?php
									if (isset($user_id)) :
										$get_cart = get('cart', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
										if (mysqli_num_rows($get_cart) > 0) :
									?>
											<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Remove from cart" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')">
												<i class="ti-shopping-cart"></i>
											</a>
										<?php else : ?>
											<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart">
												<i class="ti-shopping-cart"></i>
											</a>
										<?php endif ?>
									<?php endif ?>
								</li>
								<!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
							</ul>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<?php
		$get_sale = get('sale');
		$data_sale = mysqli_fetch_assoc($get_sale);
		$product_id_sale = $data_sale['product_id'];
		$sale = $data_sale['sale'];

		$get_product = get('product', 'WHERE product_id=' . $product_id_sale);
		$data_product = mysqli_fetch_assoc($get_product);
		$product_name_sale = $data_product['product_name'];
		$price_original_sale = $data_product['price'];
		$description_sale = $data_product['description'];

		$sale_amount = str_replace('%', '', $sale);
		$price_sale = $price_original_sale - $price_original_sale * (int) $sale_amount / 100;

		$get_product_image = get('product_image', 'WHERE product_id=' . $product_id_sale);
		$data_product_image = mysqli_fetch_assoc($get_product_image);
		$product_image_sale = $data_product_image['image_name']
		?>
		<!-- <div class="featured lazy" data-bg="url(uploads/product/<?= $product_image_sale ?>)"> -->
		<div class="featured lazy container-fluid" style='background-image: url("uploads/product/<?= $product_image_sale ?>");'>
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
				<div class="container margin_60">
					<div class="row justify-content-center justify-content-md-start">
						<div class="col-lg-6 wow" data-wow-offset="150">
							<h3>
								<?= $product_name_sale ?>
							</h3>
							<p>
								<?= $description_sale ?>
							</p>
							<div class="feat_text_block">
								<div class="price_box">
									<span class="new_price mr-1" style="font-size:larger; font-weight:bold">
										<?= rupiah($price_sale) ?>
									</span>
									<span class="old_price">
										<?= rupiah($price_original_sale) ?>
									</span>
								</div>
								<a class="btn_1" href="index.php?page=product_view&product_id=<?= $product_id_sale ?>" role="button">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container margin_60_35 pb-4">
			<div class="main_title mb-5">
				<h2>Top Selling</h2>
				<p>Discover the best selling products</p>
			</div>
			<div class="row small-gutters">
				<?php
				$result = get('product', 'WHERE sold > 0');
				foreach ($result as $data) :
					$product_id = $data['product_id'];
					$product_name = $data['product_name'];
					$category_id = $data['category_id'];
					$subcategory_id = $data['subcategory_id'];
					$price = $data['price'];
					$sold = $data['sold'];
					$description = $data['description'];
				?>
					<div class="col-6 col-md-4 col-xl-3">
						<div class="grid_item">
							<?php
							$get_sale = get('sale', 'WHERE product_id=' . $product_id);
							if (mysqli_num_rows($get_sale) > 0) :
								$data_sale = mysqli_fetch_assoc($get_sale);
								$sale = $data_sale['sale'];
								$price_sale = $price - $price * (int) $sale / 100;
							?>
								<span class="ribbon off">- <?= $sale ?>%</span>
							<?php endif ?>
							<figure>
								<!-- <span class="ribbon new">New</span>
								<span class="ribbon hot">Hot</span>
								<span class="ribbon off">-30%</span> -->
								<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
									<?php
									$result = get('product_image', 'WHERE product_id=' . $product_id);
									if (mysqli_num_rows($result) > 0) :
										$data = mysqli_fetch_assoc($result);
										$image_name = $data['image_name'];
									?>
										<img src="uploads/product/<?= $image_name ?>" class="lazy" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
									<?php
									else :
									?>
										<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
									<?php endif ?>
								</a>
								<!-- <div data-countdown="2019/05/15" class="countdown"></div> -->
							</figure>
							<div class="rating">
								<?php
								$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
								$data_review = mysqli_fetch_assoc($get_review);
								$total_rating = (int)$data_review['sum(rating)'];

								$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
								$data_review = mysqli_fetch_assoc($get_review);
								$count_rating = (int)$data_review['count(rating)'];

								if ($count_rating > 0) {
									$average_rating = round($total_rating / $count_rating);

									for ($i = $average_rating; $i > 0; $i--) {
										echo '<i class="icon-star voted"></i>';
									}
								}

								if ($count_rating == 0) {
									echo '<p class="mb-0">No review</p>';
								} else {
									$n = 5 - $average_rating;
									for ($i = $n; $i > 0; $i--) {
										echo '<i class="icon-star"></i>';
									}
									echo '<em class="ml-2" style="color:#9d9d9d">(' . $count_rating . ')</em>';
								}
								?>
							</div>
							<a href="product-detail-1.html">
								<h3>
									<?= $product_name ?>
								</h3>
							</a>
							<div class="price_box mb-0">
								<?php
								$get_sale = get('sale', 'WHERE product_id=' . $product_id);
								if (mysqli_num_rows($get_sale) > 0) :
									$data_sale = mysqli_fetch_assoc($get_sale);
									$sale = $data_sale['sale'];
									$price_sale = $price - $price * (int) $sale / 100;
								?>
									<span class="new_price">
										<?= rupiah($price_sale) ?>
									</span>
									<span class="old_price" style="font-size:small">
										<?= rupiah($price) ?>
									</span>
								<?php else : ?>
									<span class="new_price">
										<?= rupiah($price) ?>
									</span>
								<?php endif ?>
							</div>
							<div>
								<p style="color: #9d9d9d;" class="mb-3">
									<?= $sold ?> sold • 0 discussions
								</p>
							</div>
							<ul>
								<li>
									<?php
									if (isset($_SESSION['email'])) :
										$email = $_SESSION['email'];

										$get_user = get('user', 'WHERE email="' . $email . '"');
										$data_user = mysqli_fetch_assoc($get_user);
										$user_id = $data_user['user_id'];

										$get_wishlist = get('wishlist', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
										if (mysqli_num_rows($get_wishlist) > 0) :
									?>
											<a href="index.php?page=wishlist_remove&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Remove from wishlist">
												<i class="ti-heart"></i>
											</a>
										<?php else : ?>
											<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
												<i class="ti-heart"></i>
											</a>
										<?php endif ?>
									<?php endif ?>
								</li>
								<li>
									<?php
									if (isset($user_id)) :
										$get_cart = get('cart', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
										if (mysqli_num_rows($get_cart) > 0) :
									?>
											<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Remove from cart" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')">
												<i class="ti-shopping-cart"></i>
											</a>
										<?php else : ?>
											<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart">
												<i class="ti-shopping-cart"></i>
											</a>
										<?php endif ?>
									<?php endif ?>
								</li>
								<!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
							</ul>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<div class="container margin_60_35 pt-0">
			<div class="main_title mb-5">
				<h2>Featured</h2>
				<p>Discover the best selling products by average reviews</p>
			</div>
			<div class="owl-carousel owl-theme products_carousel">
				<?php
				$get_product = get('review', 'WHERE rating >= 3 GROUP BY product_id');

				foreach ($get_product as $data) :
					$product_id = $data['product_id'];

					$get_product = get('product', 'WHERE product_id=' . $product_id);
					$data = mysqli_fetch_assoc($get_product);

					$product_name = $data['product_name'];
					$category_id = $data['category_id'];
					$subcategory_id = $data['subcategory_id'];
					$price = $data['price'];
					$sold = $data['sold'];
					$description = $data['description'];
				?>
					<div class="item">
						<div class="grid_item">
							<!-- <span class="ribbon hot">Hot</span>
							<span class="ribbon off">-30%</span>
							<span class="ribbon new">New</span> -->
							<?php
							$get_sale = get('sale', 'WHERE product_id=' . $product_id);
							if (mysqli_num_rows($get_sale) > 0) :
								$data_sale = mysqli_fetch_assoc($get_sale);
								$sale = $data_sale['sale'];
								$price_sale = $price - $price * (int) $sale / 100;
							?>
								<span class="ribbon off">- <?= $sale ?>%</span>
							<?php endif ?>
							<figure>
								<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
									<?php
									$result = get('product_image', 'WHERE product_id=' . $product_id);
									if (mysqli_num_rows($result) > 0) :
										$data = mysqli_fetch_assoc($result);
										$image_name = $data['image_name'];
									?>
										<img src="uploads/product/<?= $image_name ?>" class="lazy" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
									<?php
									else :
									?>
										<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
									<?php endif ?>
								</a>
							</figure>
							<div class="rating">
								<?php
								$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
								$data_review = mysqli_fetch_assoc($get_review);
								$total_rating = (int)$data_review['sum(rating)'];

								$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
								$data_review = mysqli_fetch_assoc($get_review);
								$count_rating = (int)$data_review['count(rating)'];

								if ($count_rating > 0) {
									$average_rating = round($total_rating / $count_rating);

									for ($i = $average_rating; $i > 0; $i--) {
										echo '<i class="icon-star voted"></i>';
									}
								}

								if ($count_rating == 0) {
									echo '<p class="mb-0">No review</p>';
								} else {
									$n = 5 - $average_rating;
									for ($i = $n; $i > 0; $i--) {
										echo '<i class="icon-star"></i>';
									}
									echo '<em class="ml-2" style="color:#9d9d9d">(' . $count_rating . ')</em>';
								}
								?>
							</div>
							<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
								<h3>
									<?= $product_name ?>
								</h3>
							</a>
							<div class="price_box mb-0">
								<?php
								$get_sale = get('sale', 'WHERE product_id=' . $product_id);
								if (mysqli_num_rows($get_sale) > 0) :
									$data_sale = mysqli_fetch_assoc($get_sale);
									$sale = $data_sale['sale'];
									$price_sale = $price - $price * (int) $sale / 100;
								?>
									<span class="new_price">
										<?= rupiah($price_sale) ?>
									</span>
									<span class="old_price" style="font-size:small">
										<?= rupiah($price) ?>
									</span>
								<?php else : ?>
									<span class="new_price">
										<?= rupiah($price) ?>
									</span>
								<?php endif ?>
							</div>
							<div>
								<p style="color: #9d9d9d;" class="mb-3">
									<?= $sold ?> sold • 0 discussions
								</p>
							</div>
							<ul>
								<li>
									<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
										<i class="ti-heart"></i>
										<span>Add to favorites</span>
									</a>
								</li>
								<li>
									<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart">
										<i class="ti-shopping-cart">
										</i><span>Add to cart</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<div class="bg_gray">
			<div class="container margin_30">
				<div id="brands" class="owl-carousel owl-theme">
					<div class="item">
						<a href="#0">
							<img data-src="img/brands/ikea.png" class="owl-lazy">
						</a>
					</div>
					<div class="item">
						<a href="#0">
							<img data-src="img/brands/microsoft.png" class="owl-lazy">
						</a>
					</div>
					<div class="item">
						<a href="#0">
							<img data-src="img/brands/canon.png" class="owl-lazy">
						</a>
					</div>
					<div class="item">
						<a href="#0">
							<img data-src="img/brands/sony.png" class="owl-lazy">
						</a>
					</div>
					<div class="item">
						<a href="#0">
							<img data-src="img/brands/nike.png" class="owl-lazy">
						</a>
					</div>
					<div class="item">
						<a href="#0">
							<img data-src="img/brands/adidas.png" class="owl-lazy">
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="container margin_60_35">
			<div class="main_title">
				<h2>Latest News</h2>
				<span>Blog</span>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<a class="box_news" href="blog.html">
						<figure>
							<img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-1.jpg" alt="" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>by Mark Twain</li>
							<li>20.11.2017</li>
						</ul>
						<h4>Pri oportere scribentur eu</h4>
						<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
					</a>
				</div>
				<div class="col-lg-6">
					<a class="box_news" href="blog.html">
						<figure>
							<img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-2.jpg" alt="" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>By Jhon Doe</li>
							<li>20.11.2017</li>
						</ul>
						<h4>Duo eius postea suscipit ad</h4>
						<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
					</a>
				</div>
				<div class="col-lg-6">
					<a class="box_news" href="blog.html">
						<figure>
							<img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-3.jpg" alt="" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>By Luca Robinson</li>
							<li>20.11.2017</li>
						</ul>
						<h4>Elitr mandamus cu has</h4>
						<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
					</a>
				</div>
				<div class="col-lg-6">
					<a class="box_news" href="blog.html">
						<figure>
							<img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-4.jpg" alt="" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>By Paula Rodrigez</li>
							<li>20.11.2017</li>
						</ul>
						<h4>Id est adhuc ignota delenit</h4>
						<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
					</a>
				</div>
			</div>
		</div> -->
</main>
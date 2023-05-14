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
				<div class="owl-slide cover" style="background-image: url(uploads/<?= $image_name ?>);background-size:contain;background-repeat: no-repeat">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<div class="container">
							<div class="row justify-content-center justify-content-md-end">
								<div class="col-lg-6 static">
									<div class="slide-text text-right white">
										<h2 class="owl-slide-animated owl-slide-title"><?= $product_name ?></h2>
										<p class="owl-slide-animated owl-slide-subtitle"><?= rupiah($price) ?></p>
										<div class="owl-slide-animated owl-slide-cta">
											<a class="btn_1" href="index.php?page=product_view&product_id=<?= $product_id ?>" role="button">View Product</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<div id="icon_drag_mobile"></div>
	</div>
	<!--/carousel-->

	<ul id="banners_grid" class="clearfix">
		<li>
			<a href="index.php?page=list" class="img_container">
				<img src="img/banners_cat_placeholder.jpg" data-src="img/banner_1.jpg" alt="" class="lazy">
				<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
					<h3>FASHION</h3>
					<div><span class="btn_1">Browse Category</span></div>
				</div>
			</a>
		</li>
		<li>
			<a href="index.php?page=list" class="img_container">
				<img src="img/banners_cat_placeholder.jpg" data-src="img/banner_2.jpg" alt="" class="lazy">
				<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
					<h3>ELECTRONICS</h3>
					<div><span class="btn_1">Browse Category</span></div>
				</div>
			</a>
		</li>
		<li>
			<a href="index.php?page=list" class="img_container">
				<img src="img/banners_cat_placeholder.jpg" data-src="img/banner_3.jpg" alt="" class="lazy">
				<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
					<h3>KITCHEN</h3>
					<div><span class="btn_1">Browse Category</span></div>
				</div>
			</a>
		</li>
	</ul>
	<div class="container margin_60_35">
		<div class="main_title">
			<h2>Top Selling</h2>
			<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
		</div>
		<div class="row small-gutters">
			<?php
			$result = get('product');
			foreach ($result as $data) :
				$product_id = $data['product_id'];
				$product_name = $data['product_name'];
				$category_id = $data['category_id'];
				$subcategory_id = $data['subcategory_id'];
				$price = $data['price'];
				$description = $data['description'];
			?>
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<figure>
							<!-- <span class="ribbon new">New</span>
							<span class="ribbon hot">Hot</span>
							<span class="ribbon off">-30%</span> -->
							<a href="product-detail-1.html">
								<?php
								$result = get('product_image', 'WHERE product_id=' . $product_id);
								if (mysqli_num_rows($result) > 0) :
									$data = mysqli_fetch_assoc($result);
									$image_name = $data['image_name'];
								?>
									<img src="uploads/<?= $image_name ?>" class="lazy" alt="Image" width="100%">
								<?php
								else :
								?>
									<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" alt="Image" width="100%">
								<?php endif ?>
							</a>
							<!-- <div data-countdown="2019/05/15" class="countdown"></div> -->
						</figure>
						<div class="rating">
							<i class="icon-star voted"></i>
							<i class="icon-star voted"></i>
							<i class="icon-star voted"></i>
							<i class="icon-star voted"></i>
							<i class="icon-star"></i>
						</div>
						<a href="product-detail-1.html">
							<h3><?= $product_name ?></h3>
						</a>
						<div class="price_box">
							<span class="new_price"><?= rupiah($price) ?></span>
							<!-- <span class="old_price">$60.00</span> -->
						</div>
						<ul>
							<li>
								<a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
									<i class="ti-heart"></i>
									<span>Add to favorites</span>
								</a>
							</li>
							<li>
								<a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart">
									<i class="ti-shopping-cart"></i>
									<span>Add to cart</span>
								</a>
							</li>
							<!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
						</ul>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="featured lazy" data-bg="url(img/featured_home.jpg)">
		<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
			<div class="container margin_60">
				<div class="row justify-content-center justify-content-md-start">
					<div class="col-lg-6 wow" data-wow-offset="150">
						<h3>Armor<br>Air Color 720</h3>
						<p>Lightweight cushioning and durable support with a Phylon midsole</p>
						<div class="feat_text_block">
							<div class="price_box">
								<span class="new_price">$90.00</span>
								<span class="old_price">$170.00</span>
							</div>
							<a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container margin_60_35">
		<div class="main_title">
			<h2>Featured</h2>
			<span>Products</span>
			<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
		</div>
		<div class="owl-carousel owl-theme products_carousel">
			<?php
			$result = get('product');
			foreach ($result as $data) :
				$product_id = $data['product_id'];
				$product_name = $data['product_name'];
				$category_id = $data['category_id'];
				$subcategory_id = $data['subcategory_id'];
				$price = $data['price'];
				$description = $data['description'];
			?>
				<div class="item">
					<div class="grid_item">
						<!-- <span class="ribbon hot">Hot</span>
					<span class="ribbon off">-30%</span>
					<span class="ribbon new">New</span> -->
						<figure>
							<a href="product-detail-1.html">
								<?php
								$result = get('product_image', 'WHERE product_id=' . $product_id);
								if (mysqli_num_rows($result) > 0) :
									$data = mysqli_fetch_assoc($result);
									$image_name = $data['image_name'];
								?>
									<img src="uploads/<?= $image_name ?>" class="lazy" alt="Image" width="100%">
								<?php
								else :
								?>
									<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" alt="Image" width="100%">
								<?php endif ?>
							</a>
						</figure>
						<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
						<a href="product-detail-1.html">
							<h3><?= $product_name ?></h3>
						</a>
						<div class="price_box">
							<span class="new_price"><?= rupiah($price) ?></span>
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
							<!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
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
					<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_1.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_2.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_3.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_4.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_5.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_6.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
			</div><!-- /carousel -->
		</div><!-- /container -->
	</div>
	<!-- /bg_gray -->

	<div class="container margin_60_35">
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
			<!-- /box_news -->
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
			<!-- /box_news -->
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
			<!-- /box_news -->
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
			<!-- /box_news -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</main>
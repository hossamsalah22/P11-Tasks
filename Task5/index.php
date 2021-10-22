<?php

$title = "Home";
include_once "views/layouts/header.php";
include_once "views/layouts/nav.php";
include_once "app/database/models/Product.php";
include_once "app/database/models/Offer.php";

$ProductsObject = new Product;
$getNewProducts = $ProductsObject->getNewProducts();
$newProducts = $getNewProducts->fetch_all(MYSQLI_ASSOC);
$getMostReviewedProducts = $ProductsObject->getMostReviewedProducts();
$mostReviewedProducts = $getMostReviewedProducts->fetch_all(MYSQLI_ASSOC);
$getMostOrderedProducts = $ProductsObject->getMostOrderedProducts();
$mostOrderedProducts = $getMostOrderedProducts->fetch_all(MYSQLI_ASSOC);
$getMostViewedProducts = $ProductsObject->getMostViewedProducts();
$mostViewedProducts = $getMostViewedProducts->fetch_all(MYSQLI_ASSOC);
$offersObject = new Offer;
$getOffers = $offersObject->read();


?>

<!-- Slider Start -->
<div class="slider-area">
	<div class="slider-active owl-dot-style owl-carousel">
		<?php
		$offers = $getOffers->fetch_all(MYSQLI_ASSOC);
		if ($offers) {
			foreach ($offers as $index => $offer) { ?>

				<div class="single-slider ptb-240 bg-img" style="background-image:url(assets/img/offers/<?= $offer['image'] ?>);">
					<div class="container">
						<div class="slider-content slider-animated-1">
							<h1 class="animated"><?= $offer['title_en'] . " (" . $offer['discValue'] . ")" ?></h1>
							<p><span>Starts: <?= $offer['start_date'] ?></span><br><span>Ends: <?= $offer['end_date'] ?></span></p>
							<p><?= substr($offer['desc_en'], 0, 500) ?>...<a href="shop.php?offer=<?= $offer['id'] ?>">Click here</a></p>
						</div>
					</div>
				</div>
		<?php	}
		}
		?>
	</div>
</div>
<!-- Slider End -->
<!-- Newest Products Start -->
<div class="product-area gray-bg pt-90 pb-65">
	<div class="container">
		<div class="product-top-bar section-border mb-55">
			<div class="section-title-wrap text-center">
				<h3 class="section-title">Newest Products</h3>
			</div>
		</div>
		<div class="tab-content jump">
			<div class="tab-pane active">
				<div class="row">
					<?php
					if ($newProducts) {
						foreach ($newProducts as $index => $product) { ?>

							<div class="col-3 mb-30">
								<div class="product-wrapper">
									<div class="product-img">
										<a href="product-details.php?product=<?= $product['id'] ?>">
											<img alt="" src="assets/img/product/<?= $product['image'] ?>">
										</a>
										<div class="product-action">
											<a class="action-wishlist" href="product-details.php?product=<?= $product['id'] ?>" title="Wishlist">
												<i class="ion-android-favorite-outline"></i>
											</a>
											<a class="action-cart" href="product-details.php?product=<?= $product['id'] ?>" title="Add To Cart">
												<i class="ion-ios-shuffle-strong"></i>
											</a>
											<a class="action-compare" href="product-details.php?product=<?= $product['id'] ?>" data-target="product-details.php?product=<?= $product['id'] ?>exampleModal" data-toggle="modal" title="Quick View">
												<i class="ion-ios-search-strong"></i>
											</a>
										</div>
									</div>
									<div class="product-content text-left">
										<div class="product-hover-style">
											<div class="product-title">
												<h4>
													<a href="product-details.php"><?= $product['name_en'] ?></a>
												</h4>
											</div>
											<div class="cart-hover">
												<h4><a href="product-details.php?product=<?= $product['id'] ?>">+ Add to cart</a></h4>
											</div>
										</div>
										<div class="product-price-wrapper">
											<span><?= $product['price'] ?> EGP </span>
										</div>
									</div>
								</div>
							</div>
					<?php	}
					} ?>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- New Products End -->

<!-- Most Reviewed Products Start -->
<div class="product-area gray-bg pt-90 pb-65">
	<div class="container">
		<div class="product-top-bar section-border mb-55">
			<div class="section-title-wrap text-center">
				<h3 class="section-title">Most Reviewed Products</h3>
			</div>
		</div>
		<div class="tab-content jump">
			<div class="tab-pane active">
				<div class="row">
					<?php
					if ($mostReviewedProducts) {
						foreach ($mostReviewedProducts as $index => $product) { ?>

							<div class="col-3 mb-30">
								<div class="product-wrapper">
									<div class="product-img">
										<a href="product-details.php?product=<?= $product['id'] ?>">
											<img alt="" src="assets/img/product/<?= $product['image'] ?>">
										</a>
										<div class="product-action">
											<a class="action-wishlist" href="product-details.php?product=<?= $product['id'] ?>" title="Wishlist">
												<i class="ion-android-favorite-outline"></i>
											</a>
											<a class="action-cart" href="product-details.php?product=<?= $product['id'] ?>" title="Add To Cart">
												<i class="ion-ios-shuffle-strong"></i>
											</a>
											<a class="action-compare" href="product-details.php?product=<?= $product['id'] ?>" data-target="product-details.php?product=<?= $product['id'] ?>exampleModal" data-toggle="modal" title="Quick View">
												<i class="ion-ios-search-strong"></i>
											</a>
										</div>
									</div>
									<div class="product-content text-left">
										<div class="product-hover-style">
											<div class="product-title">
												<h4>
													<a href="product-details.php"><?= $product['name_en'] ?></a>
												</h4>
											</div>
											<div class="cart-hover">
												<h4><a href="product-details.php?product=<?= $product['id'] ?>">
														<?php
														for ($i = 0; $i < $product['reviews_avarage']; $i++) { ?>
															<i class="ion-star theme-color"></i>
														<?php }
														for ($i = $product['reviews_avarage']; $i < 5; $i++) { ?>
															<i class="ion-android-star-outline"></i>
														<?php } ?>
													</a></h4>
											</div>
										</div>
										<div class="product-price-wrapper">
											<span><?= $product['price'] ?> EGP </span>
										</div>
									</div>
								</div>
							</div>
					<?php	}
					} ?>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Most Reviewed Products End -->
<!-- Most Ordered Products Start -->
<div class="product-area gray-bg pt-90 pb-65">
	<div class="container">
		<div class="product-top-bar section-border mb-55">
			<div class="section-title-wrap text-center">
				<h3 class="section-title">Most Ordered Products</h3>
			</div>
		</div>
		<div class="tab-content jump">
			<div class="tab-pane active">
				<div class="row">
					<?php
					if ($mostOrderedProducts) {
						foreach ($mostOrderedProducts as $index => $product) { ?>

							<div class="col-3 mb-30">
								<div class="product-wrapper">
									<div class="product-img">
										<a href="product-details.php?product=<?= $product['id'] ?>">
											<img alt="" src="assets/img/product/<?= $product['image'] ?>">
										</a>
										<div class="product-action">
											<a class="action-wishlist" href="product-details.php?product=<?= $product['id'] ?>" title="Wishlist">
												<i class="ion-android-favorite-outline"></i>
											</a>
											<a class="action-cart" href="product-details.php?product=<?= $product['id'] ?>" title="Add To Cart">
												<i class="ion-ios-shuffle-strong"></i>
											</a>
											<a class="action-compare" href="product-details.php?product=<?= $product['id'] ?>" data-target="product-details.php?product=<?= $product['id'] ?>exampleModal" data-toggle="modal" title="Quick View">
												<i class="ion-ios-search-strong"></i>
											</a>
										</div>
									</div>
									<div class="product-content text-left">
										<div class="product-hover-style">
											<div class="product-title">
												<h4>
													<a href="product-details.php"><?= $product['name_en'] ?></a>
												</h4>
											</div>
											<div class="cart-hover">
												<h4><a href="product-details.php?product=<?= $product['id'] ?>">
														<span> Ordered: (<?= $product['count_of_orders_per_product'] ?>)times</span>
													</a>
												</h4>
											</div>
										</div>
										<div class="product-price-wrapper">
											<span><?= $product['price'] ?> EGP </span>
										</div>
									</div>
								</div>
							</div>
					<?php	}
					} ?>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Most Ordered Products End -->
<!-- Most Visited Products Start -->
<div class="product-area gray-bg pt-90 pb-65">
	<div class="container">
		<div class="product-top-bar section-border mb-55">
			<div class="section-title-wrap text-center">
				<h3 class="section-title">Most Viewed Products</h3>
			</div>
		</div>
		<div class="tab-content jump">
			<div class="tab-pane active">
				<div class="row">
					<?php
					if ($mostViewedProducts) {
						foreach ($mostViewedProducts as $index => $product) { ?>

							<div class="col-3 mb-30">
								<div class="product-wrapper">
									<div class="product-img">
										<a href="product-details.php?product=<?= $product['id'] ?>">
											<img alt="" src="assets/img/product/<?= $product['image'] ?>">
										</a>
										<div class="product-action">
											<a class="action-wishlist" href="product-details.php?product=<?= $product['id'] ?>" title="Wishlist">
												<i class="ion-android-favorite-outline"></i>
											</a>
											<a class="action-cart" href="product-details.php?product=<?= $product['id'] ?>" title="Add To Cart">
												<i class="ion-ios-shuffle-strong"></i>
											</a>
											<a class="action-compare" href="product-details.php?product=<?= $product['id'] ?>" data-target="product-details.php?product=<?= $product['id'] ?>exampleModal" data-toggle="modal" title="Quick View">
												<i class="ion-ios-search-strong"></i>
											</a>
										</div>
									</div>
									<div class="product-content text-left">
										<div class="product-hover-style">
											<div class="product-title">
												<h4>
													<a href="product-details.php"><?= $product['name_en'] ?></a>
												</h4>
											</div>
											<div class="cart-hover">
												<h4><a href="product-details.php?product=<?= $product['id'] ?>">
														<?php
														if ($product['views'] != 1) { ?>
															<span> <?= $product['views'] ?> Views</span>

														<?php } else { ?>
															<span> <?= $product['views'] ?> View</span>
														<?php }
														?>
													</a>
												</h4>
											</div>
										</div>
										<div class="product-price-wrapper">
											<span><?= $product['price'] ?> EGP </span>
										</div>
									</div>
								</div>
							</div>
					<?php	}
					} ?>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Most Visited Products End -->
<!-- Testimonial Area Start -->
<div class="testimonials-area bg-img pt-100 pb-100">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12">
				<div class="testimonial-active owl-carousel">
					<div class="single-testimonial text-center">
						<div class="testimonial-img">
							<img alt="" src="assets/img/icon-img/testi.png">
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore</p>
						<h4>Gregory Perkins</h4>
						<h5>Customer</h5>
					</div>
					<div class="single-testimonial text-center">
						<div class="testimonial-img">
							<img alt="" src="assets/img/icon-img/testi.png">
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore</p>
						<h4>Khabuli Teop</h4>
						<h5>Marketing</h5>
					</div>
					<div class="single-testimonial text-center">
						<div class="testimonial-img">
							<img alt="" src="assets/img/icon-img/testi.png">
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut labore </p>
						<h4>Lotan Jopon</h4>
						<h5>Admin</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Testimonial Area End -->


<?php include_once "views/layouts/footer.php"; ?>
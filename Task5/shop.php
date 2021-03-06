<?php
$title = "Shop";
include_once "views/layouts/header.php";
include_once "views/layouts/nav.php";
include_once "views/layouts/breadcrumb.php";
include_once "app/database/models/Product.php";
include_once "app/database/models/Category.php";
include_once "app/database/models/Subcategory.php";
include_once "app/database/models/Brand.php";
include_once "app/database/models/Offer_Product.php";

$productsObject = new Product;

$categoriesObject = new Category;
$getCategories = $categoriesObject->read();

$subcategoriesObject = new Subcategory;

$brandsObject = new Brand;
$getBrands = $brandsObject->read();

$offersObject = new Offer_Product;

if ($_GET) {
    if (isset($_GET['sub'])) {
        if (is_numeric($_GET['sub'])) {
            $subcategoriesObject->setId($_GET['sub']);
            $result = $subcategoriesObject->find();
            if ($result) {
                $productsObject->setSubcategory_id($_GET['sub']);
                $getProducts = $productsObject->readBySub();
            } else {
                header("Location:views/errors/404.php");
                die;
            }
        } else {
            header("Location:views/errors/404.php");
            die;
        }
    } elseif (isset($_GET['brand'])) {
        if (is_numeric($_GET['brand'])) {
            $brandsObject->setId($_GET['brand']);
            $result = $brandsObject->getBrand();
            if ($result) {
                $productsObject->setBrand_id($_GET['brand']);
                $getProducts = $productsObject->readByBrand();
            } else {
                header("Location:views/errors/404.php");
                die;
            }
        } else {
            header("Location:views/errors/404.php");
            die;
        }
    } elseif (isset($_GET['offer'])) {
        if (is_numeric($_GET['offer'])) {
            $offersObject->setOffer_id($_GET['offer']);
            $result = $offersObject->read();
            if ($result) {
                $getProducts = $offersObject->getProducts();
            } else {
                header("Location:views/errors/404.php");
                die;
            }
        } else {
            header("Location:views/errors/404.php");
            die;
        }
    } else {
        header("Location:views/errors/404.php");
        die;
    }
} else {
    $getProducts = $productsObject->read();
}

?>

<!-- Shop Page Area Start -->
<div class="shop-page-area ptb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-topbar-wrapper">
                    <div class="shop-topbar-left">
                        <ul class="view-mode">
                            <li class="active"><a href="#product-grid" data-view="product-grid"><i class="fa fa-th"></i></a></li>
                            <li><a href="#product-list" data-view="product-list"><i class="fa fa-list-ul"></i></a></li>
                        </ul>
                        <p>Showing 1 - 20 of 30 results </p>
                    </div>
                    <div class="product-sorting-wrapper">
                        <div class="product-shorting shorting-style">
                            <label>View:</label>
                            <select>
                                <option value=""> 20</option>
                                <option value=""> 23</option>
                                <option value=""> 30</option>
                            </select>
                        </div>
                        <div class="product-show shorting-style">
                            <label>Sort by:</label>
                            <select>
                                <option value="">Default</option>
                                <option value=""> Name</option>
                                <option value=""> price</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <?PHP

                            if ($getProducts) {
                                $products = $getProducts->fetch_all(MYSQLI_ASSOC);
                                foreach ($products as $index => $product) { ?>

                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="product-details.php?product=<?= $product['id'] ?>">
                                                    <img alt="<?= $product['name_en'] ?>" src="assets/img/product/<?= $product['image'] ?>">
                                                </a>
                                                <!-- <span>-30%</span> -->
                                                <div class="product-action">
                                                    <a class="action-wishlist" href="#" title="Wishlist">
                                                        <i class="ion-android-favorite-outline"></i>
                                                    </a>
                                                    <a class="action-cart" href="#" title="Add To Cart">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                    <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Grid View -->
                                            <div class="product-content text-left">
                                                <div class="product-hover-style">
                                                    <div class="product-title">
                                                        <h4>
                                                            <a href="product-details.php?product=<?= $product['id'] ?>"><?= $product['name_en'] ?></a>
                                                        </h4>
                                                        <div class="cart-hover">
                                                            <h4><a href="product-details.php?product=<?= $product['id'] ?>">+ Add to cart</a></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-price-wrapper">
                                                    <?php
                                                    if (isset($product['price_after_disc'])) { ?>
                                                        <span><?= $product['price_after_disc'] . " EGP" ?></span>
                                                        <span class="product-price-old"><?= $product['original_price'] . " EGP" ?> </span>
                                                    <?php } else { ?>
                                                        <span><?= $product['price'] . " EGP" ?></span>
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                            <!-- List View -->
                                            <div class="product-list-details">
                                                <h4>
                                                    <a href="product-details.php?product=<?= $product['id'] ?>"><?= $product['name_en'] ?></a>
                                                </h4>
                                                <div class="product-price-wrapper">
                                                    <?php
                                                    if (isset($product['price_after_disc'])) { ?>
                                                        <span><?= $product['price_after_disc'] . " EGP" ?></span>
                                                        <span class="product-price-old"><?= $product['original_price'] . " EGP" ?> </span>
                                                    <?php } else { ?>
                                                        <span><?= $product['price'] . " EGP" ?></span>
                                                    <?php }
                                                    ?>
                                                </div>
                                                <p><?= $product['desc_en'] ?></p>
                                                <div class="shop-list-cart-wishlist">
                                                    <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                    <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                                    <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>

                                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                    <div class="product-wrapper">
                                        <!-- Grid View -->
                                        <div class="product-content text-left">
                                            <div class="alert alert-danger">
                                                Products Comming Soon!
                                            </div>
                                        </div>
                                        <!-- List View -->
                                        <div class="product-list-details">
                                            <div class="alert alert-danger">
                                                Products Comming Soon!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php   }
                            ?>
                        </div>
                    </div>
                    <div class="pagination-total-pages">
                        <div class="pagination-style">
                            <ul>
                                <li><a class="prev-next prev" href="#"><i class="ion-ios-arrow-left"></i> Prev</a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li><a class="prev-next next" href="#">Next<i class="ion-ios-arrow-right"></i> </a></li>
                            </ul>
                        </div>
                        <div class="total-pages">
                            <p>Showing 1 - 20 of 30 results </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Shop By Categories</h4>
                        <div class="shop-catigory">
                            <ul id="faq">
                                <?php
                                $categories = $getCategories->fetch_all(MYSQLI_ASSOC);
                                if ($categories) {
                                    foreach ($categories as $catIndex => $category) { ?>
                                        <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-<?= $category['id'] ?>"><?= $category['name_en'] ?> <i class="ion-ios-arrow-down"></i></a>
                                            <ul id="shop-catigory-<?= $category['id'] ?>" class="panel-collapse collapse">
                                                <?php
                                                $subcategoriesObject->setCategory_id($category['id']);
                                                $getSubcategories = $subcategoriesObject->getSubCatByCat();
                                                if ($getSubcategories) {
                                                    $subcategories = $getSubcategories->fetch_all(MYSQLI_ASSOC);
                                                    foreach ($subcategories as $subIndex => $subcategory) { ?>
                                                        <li><a href="shop.php?sub=<?= $subcategory['id'] ?>"><?= $subcategory['name_en'] ?></a></li>
                                                    <?php  }
                                                } else { ?>
                                                    <li>
                                                        <p class="text-danger">Comming Soon</p>
                                                    </li>
                                                <?php  } ?>
                                            </ul>
                                    <?php }
                                }
                                    ?>
                                        </li>
                            </ul>
                        </div>
                    </div>
                    <div class="shop-widget mt-40 shop-sidebar-border pt-35">
                        <h4 class="shop-sidebar-title">Shop By Categories</h4>
                        <div class="sidebar-list-style mt-20">
                            <ul>
                                <?php
                                $brands = $getBrands->fetch_all(MYSQLI_ASSOC);
                                if ($brands) {
                                    foreach ($brands as $index => $brand) { ?>
                                        <li><a href="shop.php?brand=<?= $brand['id'] ?>"><?= $brand['name_en'] ?> </a></li>
                                    <?php   }
                                } else { ?>
                                    <div class="alert alert-danger">Sorry No Brands Found</div>
                                <?php }
                                ?>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shop Page Area End -->

<?php include_once "views/layouts/footer.php"; ?>
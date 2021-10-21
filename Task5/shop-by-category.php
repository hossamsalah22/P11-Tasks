<?php


$title = "shop";
include_once "views/layouts/header.php";
include_once "views/layouts/nav.php";
include_once "views/layouts/breadcrumb.php";
include_once "app/database/models/Category.php";
include_once "app/database/models/Subcategory.php";

$categoriesObject = new Category;

$subcategoriesObject = new Subcategory;

if ($_GET) {
    if (isset($_GET['cat'])) {
        if (is_numeric($_GET['cat'])) {
            $categoriesObject->setId($_GET['cat']);
            $result = $categoriesObject->find();
            if ($result) {
                $subcategoriesObject->setCategory_id($_GET['cat']);
                $getSubcategories = $subcategoriesObject->getSubCatByCat();
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
    header("Location:views/errors/404.php");
    die;
}

?>

<!-- Shop Page Area Start -->
<div class="shop-page-area ptb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <?PHP

                            if ($getSubcategories) {
                                $subcategories = $getSubcategories->fetch_all(MYSQLI_ASSOC);
                                foreach ($subcategories as $index => $subcategory) { ?>

                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product">
                                            <div class="product-img">
                                                <a href="shop.php?sub=<?= $subcategory['id'] ?>">
                                                    <img alt="<?= $subcategory['name_en'] ?>" src="assets/img/subcategories/<?= $subcategory['image'] ?>">
                                                </a>
                                            </div>
                                            <!-- Grid View -->
                                            <div class="product-content text-left">
                                                <div class="product-hover-style">
                                                    <div class="product-title">
                                                        <h4>
                                                            <a href="shop.php?sub=<?= $subcategory['id'] ?>"><?= $subcategory['name_en'] ?></a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>

                                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                    <div class="product">
                                        <!-- Grid View -->
                                        <div class="product-content text-left">
                                            <div class="alert alert-danger">
                                                Subcategories Coming Soon
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php   }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shop Page Area End -->

<?php include_once "views/layouts/footer.php"; ?>
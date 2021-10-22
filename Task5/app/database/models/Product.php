<?php


require_once __DIR__ . "\..\config\connection.php";
require_once __DIR__ . "\..\config\crud.php";

class Product extends connection implements crud
{

    private $id;
    private $name_ar;
    private $name_en;
    private $price;
    private $image;
    private $desc_ar;
    private $desc_en;
    private $quantity;
    private $status;
    private $views;
    private $subcategory_id;
    private $brand_id;
    private $created_at;
    private $updated_at;
    private const available = 1;
    private const unavailable = 0;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name_ar
     */
    public function getName_ar()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     *
     * @return  self
     */
    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;

        return $this;
    }

    /**
     * Get the value of name_en
     */
    public function getName_en()
    {
        return $this->name_en;
    }

    /**
     * Set the value of name_en
     *
     * @return  self
     */
    public function setName_en($name_en)
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of desc_ar
     */
    public function getDesc_ar()
    {
        return $this->desc_ar;
    }

    /**
     * Set the value of desc_ar
     *
     * @return  self
     */
    public function setDesc_ar($desc_ar)
    {
        $this->desc_ar = $desc_ar;

        return $this;
    }

    /**
     * Get the value of desc_en
     */
    public function getDesc_en()
    {
        return $this->desc_en;
    }

    /**
     * Set the value of desc_en
     *
     * @return  self
     */
    public function setDesc_en($desc_en)
    {
        $this->desc_en = $desc_en;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of views
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set the value of views
     *
     * @return  self
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get the value of subcategory_id
     */
    public function getSubcategory_id()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of subcategory_id
     *
     * @return  self
     */
    public function setSubcategory_id($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;

        return $this;
    }

    /**
     * Get the value of brand_id
     */
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @return  self
     */
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }



    public function create()
    {
    }
    public function update()
    {
    }
    public function read()
    {
        $query = "SELECT id,name_en,image,price,desc_en FROM products WHERE status = '" . self::available . "' ORDER BY name_en ASC";
        return $this->runDQL($query);
    }
    public function delete()
    {
    }


    public function readBySub()
    {
        $query = "SELECT id , name_en , image , price ,desc_en FROM products 
            WHERE status = '" . self::available . "' AND subcategory_id = $this->subcategory_id ORDER BY name_en ASC";
        return $this->runDQL($query);
    }

    public function readByBrand()
    {
        $query = "SELECT id , name_en , image , price , desc_en FROM products 
            WHERE status = '" . self::available . "' AND brand_id = $this->brand_id ORDER BY name_en ASC";
        return $this->runDQL($query);
    }

    public function find()
    {
        $query = "SELECT
        `products`.* ,
        `categories`.`name_en` AS `cat_name_en`,
        `categories`.`id` AS `cat_id`,
        `subcategories`.`name_en` AS `sub_name_en`,
        `brands`.`name_en` AS `brand_name_en`,
        count(`reviews`.`product_id`) AS `product_reviews`,
        IF(ROUND(AVG(`reviews`.`value`)) IS NULL , 0 , ROUND(AVG(`reviews`.`value`))) AS `reviews_avarage`
    FROM
        `products`
    LEFT JOIN `subcategories` ON `products`.`subcategory_id` = `subcategories`.`id`
    LEFT JOIN `categories` ON `subcategories`.`category_id` = `categories`.`id`
    LEFT JOIN `brands` ON `products`.`brand_id` = `brands`.`id`
    LEFT JOIN `reviews` ON `reviews`.`product_id` = `products`.`id`
    WHERE
    `products`.`id` = $this->id AND `products`.`status` = '" . self::available . "'
    GROUP BY `products`.`id`";
        $incViews = "UPDATE `products` SET `products`.`views` = (`products`.`views` + 1) WHERE
    `products`.`id` = $this->id";
        $this->runDML($incViews);
        return $this->runDQL($query);
    }

    public function getSpecs()
    {
        $query = "SELECT `products_specs`.`spec_value`, `specs`.`name_en`, `products_specs`.`product_id` 
        FROM `specs` JOIN `products_specs` ON `products_specs`.`spec_id` = `specs`.`id` WHERE `product_id` = $this->id";
        return $this->runDQL($query);
    }

    public function productReviews()
    {
        $query = "SELECT
        `reviews`.`value`,
        `reviews`.`comment`,
        `reviews`.`created_at`,
        `reviews`.`updated_at`,
       CONCAT( `users`.`first_name`, ' ', `users`.`last_name`) AS `user_name`
    FROM
        `reviews`
    JOIN `users` ON `reviews`.`user_id` = `users`.`id`
    WHERE
        `reviews`.`product_id` = $this->id";
        return $this->runDQL($query);
    }

    public function getNewProducts()
    {
        $query = "SELECT
        `id`,
        `name_en`,
        `price`,
        `image`,
        `desc_en`
    FROM `products`
    WHERE `status` = '" . self::available . "'
    ORDER BY
        `created_at` DESC , `name_en` DESC
    LIMIT 4";
        return $this->runDQL($query);
    }

    public function getMostReviewedProducts()
    {
        $query = "SELECT
        `products`.`id`,
        `products`.`name_en`,
        `products`.`price`,
        `products`.`image`,
        COUNT(`reviews`.`product_id`) AS `product_reviews`,
        IF(
            ROUND(AVG(`reviews`.`value`)) IS NULL,
            0,
            ROUND(AVG(`reviews`.`value`))
        ) AS `reviews_avarage`
    FROM
        `products`
    JOIN `reviews` ON `reviews`.`product_id` = `products`.`id`
    WHERE
        `products`.`status` = '" . self::available . "'
    GROUP BY
        `products`.`id`
        ORDER BY
        `product_reviews`
    DESC,
     `reviews_avarage`
    DESC
    LIMIT 4";
        return $this->runDQL($query);
    }

    public function getMostOrderedProducts()
    {
        $query = "SELECT
        `products`.`id`,
        `products`.`name_en`,
        `products`.`price`,
        `products`.`image`,
        COUNT(`orders_products`.`product_id`) AS `count_of_orders_per_product`,
        ROUND(AVG(`orders_products`.`quantity`)) AS `average_quantity_per_order`
    FROM
        `products`
    JOIN `orders_products` ON `orders_products`.`product_id` = `products`.`id`
    WHERE
        `products`.`status` = '" . self::available . "'
    GROUP BY
        `products`.`id`
        ORDER BY
        `count_of_orders_per_product`
    DESC,
     `average_quantity_per_order`
    DESC
    LIMIT 4";
        return $this->runDQL($query);
    }

    public function getMostViewedProducts()
    {
        $query = "SELECT
        `id`,
        `name_en`,
        `price`,
        `image`,
        `views`
    FROM
        `products`
    WHERE
        `status` = '" . self::available . "'
    ORDER BY
     `views` DESC , `created_at` ASC
    LIMIT 4";
        return $this->runDQL($query);
    }

    public function getRelatedProducts()
    {
        $query = "SELECT `products`.`id`,
         `products`.`name_en`,
          `products`.`price`,
           `products`.`image`,
            `products`.`desc_en`
             FROM `products`
             JOIN `subcategories` ON `products`.`subcategory_id` = `subcategories`.`id` 
             JOIN `brands` ON `products`.`brand_id` = `brands`.`id` 
             WHERE $this->id NOT IN (`products`.`id`) AND `products`.`subcategory_id` = $this->subcategory_id AND 
              `products`.`status` = '" . self::available . "'
              ORDER BY `products`.`views` DESC";
        return $this->runDQL($query);
    }
}

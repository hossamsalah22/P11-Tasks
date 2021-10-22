<?php


require_once __DIR__ . "\..\config\connection.php";
require_once __DIR__ . "\..\config\crud.php";

class Offer_Product extends connection implements crud
{
    private $product_id;
    private $offer_id;
    private $price;
    private const available = 1;
    private const unavailable = 0;

    /**
     * Get the value of product_id
     */
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of offer_id
     */
    public function getOffer_id()
    {
        return $this->offer_id;
    }

    /**
     * Set the value of offer_id
     *
     * @return  self
     */
    public function setOffer_id($offer_id)
    {
        $this->offer_id = $offer_id;

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

    public function create()
    {
        # code...
    }
    public function read()
    {
        $query = "SELECT `offer_id` FROM `offers_products` WHERE `offer_id` = $this->offer_id";
        return $this->runDQL($query);
    }
    public function update()
    {
        # code...
    }
    public function delete()
    {
        # code...
    }

    public function readOffers()
    {
        $query = "SELECT `product_id` FROM `offers_products` WHERE `product_id` = $this->product_id";
        return $this->runDQL($query);
    }


    public function getProducts()
    {
        $query = "SELECT
        `products`.`id`,
        `products`.`name_en`,
        `products`.`image`,
        `products`.`price` AS `original_price`,
        `offers_products`.`price` AS `price_after_disc`
    FROM
        `offers_products`
    JOIN `products` ON `offers_products`.`product_id` = `products`.`id`
    JOIN `offers` ON `offers_products`.`offer_id` = `offers`.`id`
    WHERE
        `products`.`status` = '" . self::available . "' AND
        `offers_products`.`offer_id` = $this->offer_id AND 
        `offers`.`end_date` >= CURRENT_TIMESTAMP AND 
        `offers`.`start_date` <= CURRENT_TIMESTAMP
    GROUP BY
        `products`.`id`";
        return $this->runDQL($query);
    }

    public function getPriceAfterDiscount()
    {
        $query = "SELECT
        `products`.`id`,
        `products`.`price` AS `original_price`,
        `offers_products`.`price` AS `price_after_disc`
    FROM
        `offers_products`
    JOIN `products` ON `offers_products`.`product_id` = `products`.`id`
    JOIN `offers` ON `offers_products`.`offer_id` = `offers`.`id`
    WHERE
    `products`.`status` = '" . self::available . "' AND
        `offers_products`.`product_id` = $this->product_id AND 
        `offers`.`end_date` >= CURRENT_TIMESTAMP AND 
        `offers`.`start_date` <= CURRENT_TIMESTAMP
    GROUP BY
        `products`.`id`";
        return $this->runDQL($query);
    }
}

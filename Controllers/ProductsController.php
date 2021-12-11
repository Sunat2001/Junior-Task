<?php

//namespace Controller;

class ProductsController{

    public function store(array $products, string $product){
//        if (preg_match('\'/^[а-яё0-9-]+$/iu\'',$product))
//        {
//            return "Product is write incorrect";
//        }
        array_push($products,$product);
        return $products;
    }

    public function update(array $products, int $id, string $product){
        $id--;
        if(!array_key_exists($id,$products))
        {
               return "Products is not found";
        }
//        if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z].*[-].*[А-Яа-я]/',$product))
//        {
//            return "Product is write incorrect";
//        }
        $products[$id] = $product;
        return $products;
    }

    public function destroy(array $products,int $id){
        $id--;
        if(!array_key_exists($id,$products))
        {
            return "Products is not found";
        }
        unset($products[$id]);
        return $products;
    }

    public function sum(array $products){
        $sum = 0;
        foreach ($products as $product){
           $sum += preg_replace('/[^0-9]/', '', $product);
        }
        return $sum;
    }

    public function checkForExist(array $products, int $id){
        $id--;
        return array_key_exists($id,$products);
    }
}
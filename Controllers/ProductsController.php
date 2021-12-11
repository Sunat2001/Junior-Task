<?php

//namespace Controller;

class ProductsController{

    public function index(array $products){
        echo "№ Наименование Цена\n";
        for ($i = 0; $i < count($products); $i++){
            echo $i+1 . " " . $products[$i] . "\n";
        }
    }

    public function store(array $products, string $product){
        array_push($products,$product);
        return $products;
    }

    public function update(array $products, int $id, string $product){
        $id--;
        $products[$id] = $product;
        return $products;
    }

    public function destroy(array $products,int $id){
        $id--;
        unset($products[$id]);
        $products = array_values($products);
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
    public function checkForValidity(string $product){
        return preg_match('/^[а-я0-9А-Я .\-]+$/i',$product);
    }
}
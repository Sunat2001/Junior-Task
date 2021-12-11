<?php

require_once "Controllers/ProductsController.php";
require_once "Controllers/FilesController.php";

$file = new FilesController();
$products = $file->open();
$actions = new ProductsController();

while(true){
    /**
     * Вывод всех продуктов
     */
    $actions->index($products);

    $typeOfOperation = readline("Выберите тип(число) действия(1.Добавления записи,2.Изменения записи,3.Удаления записи,4.Вычесть общую сумму)");

    switch ($typeOfOperation){

        case 1:
            $product = readline("Введите продукт(Пример: Огурцы — 50) ");
            if(!$actions->checkForValidity($product)){
                echo ("Продукт записан неправильно \n");
            } else {
                $products = $actions->store($products, $product);
                echo "Успешно добавлен \n";
                $actions->index($products);
            }
            break;

        case 2:
            $id = (int)readline("№ продукта (Пример: 1) ");
            if($actions->checkForExist($products,$id)){
                $product = readline("Введите продукт(Пример: Огурцы — 50) ");
                if(!$actions->checkForValidity($product)){
                    echo ("Продукт записан неправильно \n");
                }else {
                    $products = $actions->update($products, $id, $product);
                    echo "Успешно обновлен! \n";
                    $actions->index($products);
                }
            }else echo "Продукт не найден!! \n";
            break;

        case 3:
            $id = (int)readline("№ продукта (Пример: 1) ");
            if($actions->checkForExist($products,$id)){
                $products = $actions->destroy($products,$id);
                echo "Успешно удален! \n";
                $actions->index($products);
            }
            else echo "Продукт не найден!! \n";
            break;

        case 4:
            echo $actions->sum($products) . "\n";
            break;
    }

    programEnd:
    $end =  readline("Хотите закончить дейсвие программы? [y(yes),n(no)]");
    if($end === "y")continue;
    if($end === "n")break;
    else echo "Неизвестная команда, попробуйте снова \n";
    goto programEnd;
}


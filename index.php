<?php

//use Controller\ProductsController;

require_once "Controllers/ProductsController.php";

//$fname = readline("Введите имя файла: ");
//if (!file_exists("$fname.txt")) die("Файл не найден");
//$fh = fopen("$fname.txt", 'r') or
//die("Не удалось открыть файл, возможно вы не обладаете правами на его открытие");
$fh = fopen("Files/import.txt", 'r');
$text = file_get_contents("Files/import.txt");
fclose($fh);

$products = explode("\n",$text);

while(true){
    echo "# Name   Price\n";
    for ($i = 0; $i < count($products); $i++){
        echo $i+1 . " " . $products[$i] . "\n";
    }

    $typeOfOperation = readline("Выберите тип(число) действия(1.Добавления записи,2.Изменения записи,3.Удаления записи,4.Вычесть общую сумму)");
    $actions = new ProductsController();
    switch ($typeOfOperation){
        case 1:
            $product = readline("Type product (example: Огурцы — 50) ");
            $products = $actions->store($products,$product);
            echo "Successful added \n";
            break;
        case 2:
            $id = (int)readline("# of product (example: 1) ");
            if($actions->checkForExist($products,$id)){
                $product = readline("Type product (example: Огурцы — 50) ");
                $products = $actions->update($products,$id,$product);
                echo "Successful updated! \n";
            }
            else echo "Product is not found!! \n";
            break;
        case 3:
            $id = (int)readline("# of product (example: 1) ");
            if($actions->checkForExist($products,$id)){
                $products = $actions->destroy($products,$id);
                echo "Successful deleted! \n";
            }
            else echo "Product is not found!! \n";
            break;
        case 4:
            echo $actions->sum($products) . "\n";
            break;
    }

    programEnd:
    $end =  readline("Do you want to end program? [y(yes),n(no)]");
    if($end === "y")continue;
    if($end === "n")break;
    else echo "Unknown command, try again \n";
    goto programEnd;
}


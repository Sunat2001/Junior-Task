<?php

class FilesController{
    public function open(){
        $fName = readline("Введите имя файла: ");
        if (!file_exists("Files/$fName.txt")) die("Файл не найден");
        $fh = fopen("Files/$fName.txt", 'r') or
        die("Не удалось открыть файл, возможно вы не обладаете правами на его открытие");
        $text = file_get_contents("Files/$fName.txt");
        fclose($fh);
        $products = explode("\n",$text);
        return $products;
    }

}
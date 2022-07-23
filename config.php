<?php


date_default_timezone_set("Asia/Jakarta");
error_reporting(0);

    //sesuai dengan server anda
    $host = 'localhost'; //host server
    $user = 'root'; // username server
    $pass = ''; //pasword server,kalau pakai xamppp kosongi saja
    $dbname = 'db_toko'; // nama database

    try{
        $config = new PDO("mysql:host=$host;dbname=$dbname;", $user,$pass);
        //echo 'sukses';
    }catch(PDOException $e){
        echo 'KONEKSI GAGAL' .$e-> getMessage();
    }

    $view = 'fungsi/view/view.php'; // direktori fungsi select data

?>
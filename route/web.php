<?php
// day se la noi tiep nhan cac request tu phia client
// sau do se dieu phoi den cac controller can xu ly cho cac request do
// http://127.0.0.1/mvc/index?c=home&m=index&id=12
// c : trieu goi vao controller : HomeController
// m: trieu goi vao phuong thuc nam trong controller do (phuong thuc index)

$c = $_GET['c'] ?? 'login';
// mac dinh la luon luon chay vao LoginController
$m = $_GET['m'] ?? 'index';
// mac dinh luon luon chay vao phuong thuc index

$controller = ucfirst($c).'Controller';
$namesapce = "app\\controller\\".$controller;
// lay ra dc ten cua controller(class)
$obj = new $namesapce();
// tu dong chay cac phuong thuc
$obj->$m();





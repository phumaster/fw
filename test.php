<?php

/*
 | Project: fw
 | Description: my framework
 | Author: Pham Ngoc Phu
 | Alias: Phu Master
 | Email: phumaster.dev@gmail.com 
 */
$limit = " limit 1 lasld";
$where = "null";
$str = "SELECT * FROM `table`".$where.$limit;
var_dump($str);
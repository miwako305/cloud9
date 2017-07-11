<?php 

// 設定ファイル読み込み
require_once './conf/const.php';
// 関数ファイル読み込み
require_once './model/function.php';

$data    = [];
$err_msg = [];

$link = get_db_connect();

$data = get_drink_list($link);

$data = entity_assoc_array($data);

// テンプレートファイル読み込み
include_once './view/index.php';

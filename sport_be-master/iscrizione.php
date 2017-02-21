<?php
require_once "index.php";

use Models\Sport\Iscrizione as Iscrizione;

$id = ( isset($_GET['id']) ) ? $_GET['id'] : 0;
$message = "";

$item = $id ? new Iscrizione($id) : new Iscrizione();

if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
    $item->delete();
}

if (!empty($_POST["item"])) {

    foreach ($_POST["item"] as $k => $v) {
        $item->$k = $v;
    }

    if ($item->validate()) {
        $item->save();
    } else {
        $message = $item->getErrors();
    }
}

$list = Iscrizione::getAll();
echo json_encode(["items" => $list, "message" => $message]);

<?php
require_once "index.php";

use Models\Sport\Atleta as Atleta;

$id = ( isset($_GET['id']) ) ? $_GET['id'] : 0;
$message = "";

$item = $id ? new Atleta($id) : new Atleta();

if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
    $item->delete();
}

$data=json_decode(file_get_contents("php://input"));
if (!empty($data->item)) {
    foreach ($data->item as $k => $v) {
        $item->$k = $v;
    }

    if ($item->validate()) {
        $item->save();
    } else {
        $message = $item->getErrors();
    }
}else{
}

$list = Atleta::getAll();
echo json_encode(["items" => $list, "message" => $message]);

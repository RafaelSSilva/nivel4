<?php
require_once 'db/pessoa_db.php';

if (!empty($_GET['action']) AND $_GET['action'] == 'delete') {
    $id     = (int) $_GET['id'];
    exclui_pessoa($id);
}

$pessoas = lista_pessoas();
$items   = '';
foreach($pessoas as $pessoa){
    $item   = file_get_contents('html/item.html');
    $items .= str_replace(['{id}', '{nome}', '{endereco}', '{bairro}', '{telefone}'], $pessoa, $item);
}

$list = file_get_contents('html/list.html');
$list = str_replace('{items}', $items, $list);
print $list;


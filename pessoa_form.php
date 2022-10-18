<?php
require_once 'db/pessoa_db.php';

if (!empty($_REQUEST['action'])) {
    $host     = '127.0.0.1';
    $user     = 'root';
    $password = '';
    $database = 'livro';
    $conn     = mysqli_connect($host, $user, $password, $database);

    if ($_REQUEST['action'] == 'edit') {
        $id     = (int) $_GET['id'];
        $pessoa = get_pessoa($id);       
    } else if ($_REQUEST['action'] == 'save') {
        $pessoa = $_POST;
        
        if (empty($pessoa['id'])) {
            $pessoa['next'] = get_next_pessoa();
            $result         = insert_pessoa($pessoa);                  
        } else {
            $result = update_pessoa($pessoa);
        }
        
        print ($result) ? 'Registro salvo com sucesso.' : $result;
    }

    mysqli_close($conn);
} else {
    $pessoa = [];
    $pessoa['id'] = $pessoa['nome'] = $pessoa['endereco'] = $pessoa['bairro'] = $pessoa['telefone'] = $pessoa['email'] = $pessoa['id_cidade'] = ''; 
}

require_once 'lista_combo_cidades.php';
$form = file_get_contents('html/form.html');
$form = str_replace(['{id}', '{nome}', '{endereco}', '{bairro}', '{telefone}', '{email}'], $pessoa, $form);
$form = str_replace('{cidades}', lista_combo_cidades($pessoa['id_cidade']), $form);
print $form;


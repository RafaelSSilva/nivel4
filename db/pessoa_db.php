<?php

function lista_pessoas () {
    $host     = '127.0.0.1';
    $user     = 'root';
    $password = '';
    $database = 'livro';
    
    $conn   = mysqli_connect($host, $user, $password, $database);
    $result = mysqli_query($conn, "SELECT id, nome, endereco, bairro, telefone FROM pessoa ORDER BY id");
    $list   = mysqli_fetch_all($result);
    mysqli_close($conn);
    return $list;
}

function exclui_pessoa ($id) {
    $host     = '127.0.0.1';
    $user     = 'root';
    $password = '';
    $database = 'livro';

    $conn   = mysqli_connect($host, $user, $password, $database);
    $result = mysqli_query($conn, "DELETE FROM pessoa WHERE id = '{$id}'");
    mysqli_close($conn);
    return $result;
}

function get_pessoa ($id) {
    $host     = '127.0.0.1';
    $user     = 'root';
    $password = '';
    $database = 'livro';

    $conn   = mysqli_connect($host, $user, $password, $database);
    $result = mysqli_query($conn, "SELECT id, nome, endereco, bairro, telefone, email, id_cidade FROM pessoa WHERE id = '{$id}'");
    $pessoa = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $pessoa;
}

function get_next_pessoa () {
    $host     = '127.0.0.1';
    $user     = 'root';
    $password = '';
    $database = 'livro';

    $conn   = mysqli_connect($host, $user, $password, $database);
    $result = mysqli_query($conn, 'SELECT MAX(id) as next FROM pessoa');
    $next   = (int) mysqli_fetch_assoc($result)['next'] + 1;
    mysqli_close($conn);
    return $next;
}

function insert_pessoa ($pessoa) {
    $host     = '127.0.0.1';
    $user     = 'root';
    $password = '';
    $database = 'livro';
    
    $conn     = mysqli_connect($host, $user, $password, $database);
    $result   = mysqli_query($conn, "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade) VALUE ('{$pessoa['next']}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['id_cidade']}')");                  
    mysqli_close($conn);
    return $result;
}

function update_pessoa ($pessoa) {
    $host     = '127.0.0.1';
    $user     = 'root';
    $password = '';
    $database = 'livro';
    $conn     = mysqli_connect($host, $user, $password, $database);
    $result   = mysqli_query($conn, "UPDATE pessoa SET nome = '{$pessoa['nome']}', endereco = '{$pessoa['endereco']}', bairro = '{$pessoa['bairro']}', telefone = '{$pessoa['telefone']}', email = '{$pessoa['email']}', id_cidade = '{$pessoa['id_cidade']}' WHERE id = '{$pessoa['id']}'");
    mysqli_close($conn);
    return $result;
}
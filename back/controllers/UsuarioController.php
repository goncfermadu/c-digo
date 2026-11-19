<?php
require_once __DIR__ . "/../Models/UsuariosModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-end respondendo com sucesso!"
    ]);
    exit;
}

// receber e validar os dados
function receberDadosUsuarios(){
    $dados = json_decode(
        file_get_contents("php://input"), true);
    if(!is_array($dados)){
        http_response_code(400);
        echo json_encode([
            "erro"=>"Envie um objeto JSON com dados!"
        ]);
        return null;
    }
}
//nome, username, email senha -> se ja existe
foreach(["nome","username","email","senha"] as $campo){
    if( !isset($dados[$camlpo]) ||
        !is_string($dados[$campo]) ||
        trim($dados[$campo])===""){
            http_response_code(400);
            echo json_encode([
                "erro" =>
                "O campo $campo é obrigatorio
                e deve ser um texto"
            ]);
            return null;
        }
        return $dados;
}
function receberIdUsuario(){
    $id = filter_var($_GET["id"] ?? null,
        FILTER_VALIDATE_INT,
        ["options" => ["min_range"=>1]]);
    if($id === false){
        http_response_code(400);
        echo json_encode([
            "erro" => "Informe um id de usuário válido!"
        ]);
        return null;
    }
return $id;
}
function createUsuario($con){
    $dados = receberDadosUsuarios();
    if($dados === null){
        return;
    }
    $id = inserir($con,$dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Usuário criado com sucesso!",
        "id" => $id
    ]);
}
function readUsuario($con){
    $id = receberDadosUsuarios();
    if($id === null){
        return;
    }
    $dados = receberDadosUsuarios();
    if($dados === null){
        return;
    }
}
function updateUsuario($con){
    $id = receberIdUsuarios();
    if($id === null){
        return;
    }
    $dados = receberDadosUsuarios();
    if($dados === null){
        return;
    }
    atualizar($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Senha alterada com sucesso!"
    ]);
}
function deleteUsuario($con){
    $id = receberIdUsuario();
    if($id === null){
        return;
    }
    remover($con, $id);
    echo json_encode([
        "mensagem" => "Usuário removido com sucesso!"
    ]);
};

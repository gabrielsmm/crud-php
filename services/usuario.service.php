<?php

require_once("../models/usuario.php");

class UsuarioService {
    private $conexao;
    private $usuario;

    public function __construct(Conexao $conexao, Usuario $usuario = null){
        $this->conexao = $conexao->conectar();
        $this->usuario = $usuario;
    }

    public function cadastrar() {
        $query = 'insert into usuarios (`login`, `senha`, `nome_completo`) values (?, ?, ?)';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->usuario->getLogin());
        $stmt->bindValue(2, $this->usuario->getSenha());
        $stmt->bindValue(3, $this->usuario->getNome());

        return $stmt->execute();
    }

    public function validar_login() {
        $query = 'select usuario_id, login, senha, ativo, nome_completo from usuarios where login = ? and senha = ?';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->usuario->getLogin());
        $stmt->bindValue(2, $this->usuario->getSenha());
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function recuperar($pesquisa) {
        $query = "select usuario_id, nome_completo, login, ativo from usuarios where nome_completo like '%$pesquisa%' or login like '%$pesquisa%' ";

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperar_por_id() {
        $query = "select usuario_id, nome_completo, login, senha from usuarios where usuario_id = ? ";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->usuario->getId());
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperar_todos(){
        $query = 'select usuario_id, nome_completo, login, ativo from usuarios';

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function remover() {
        $query = 'delete from usuarios where usuario_id = ?';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->usuario->getId());

        return $stmt->execute();
    }

    public function atualizar() {
        $query = 'update usuarios set nome_completo = ?, login = ?, senha = ? where usuario_id = ?';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->usuario->getNome());
        $stmt->bindValue(2, $this->usuario->getLogin());
        $stmt->bindValue(3, $this->usuario->getSenha());
        $stmt->bindValue(4, $this->usuario->getId());

        return $stmt->execute();
    }
}

?>
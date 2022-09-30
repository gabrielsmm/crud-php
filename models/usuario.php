<?php

class Usuario {
    private $id;
    private $login;
    private $senha;
    private $nome;
    private $ativo;

    //Métodos Set
    public function setId($id) {
        $this->id = $id;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    //Métodos Get
    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getAtivo() {
        return $this->ativo;
    }
}

?>
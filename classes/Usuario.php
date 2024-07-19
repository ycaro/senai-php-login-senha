<?php
/**
* Classe responsavel por gerir os dados de Usuario
*/
include_once 'Tabela.php';
class Usuario{

  /**
  * Classe responsavel por buscar os dados de Usuario no banco de dados
  * @param string $condicao Condição da Sql
  * @return [type] [description]
  */
  public function getUsuario($condicao = null){
    $obTabelaUsuario = new Tabela('usuario');
    $retorno = $obTabelaUsuario->select($condicao)->fetchObject();
    return $retorno;
  }


  /**
  * Método responsável por inserir os dados no banco de dados
  * @param array $dados  Dados do Usuário
  */
  public function setUsuario($dados = []){
    $obTabelaUsuario = new Tabela('usuario');
    $obTabelaUsuario->insert($dados);
  }


}

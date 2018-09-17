<?php

namespace App\models;


class MapsModel extends DatabaseModel
{

//Para isto, utilize um banco de dados MySQL para armazenar as cidades e bairros pesquisados na requisição desenvolvida na Parte 1.
//Utilize apenas uma tabela, com a seguinte estrutura:
//nome da tabela: consulta
//campos: id (int, pk, not null, autoincrement), dt_hr_consulta (timestamp not null), cidade (string), bairro (string).

    public function insert(String $district, String $city) {
        $query = "INSERT INTO consulta (cidade, bairro) VALUES (:cidade, :bairro)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':cidade', $city);
        $stmt->bindValue(':bairro', $district);
        $stmt->execute();
    }

    public function list():array
    {
        $query = "SELECT * FROM consulta ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}
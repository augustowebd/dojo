<?php

namespace App\Getters;

use PDO;

class Endereco extends Getter
{
    const DQL_ENDERECO = 'SELECT ende.id AS endereco,
                                  ende.id_dono,
                                  ende.tx_endereco
                             FROM dojo.endereco AS ende';

    /**
     * retorna os dados da entidade identificada por 'id',
     */
    public function get(int $id): array
    {
        $dql = self::DQL_ENDERECO . ' WHERE ende.id = :id';

        $statement = $this->pdo->prepare($dql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * recupera todos os endereços do usuário identificado por '$id'
     * @param integer $id
     * @return array
     */
    public function usuario(int $id): array
    {
        $dql = self::DQL_ENDERECO . ' WHERE ende.id_dono = :dono';

        $statement = $this->pdo->prepare($dql);
        $statement->bindParam(':dono', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

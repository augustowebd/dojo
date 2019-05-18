<?php

namespace App\Getters;

use PDO;
use App\Getters\Notificacao;

class Infracao extends Getter
{
    const DQL_INFRACA= 'SELECT infr.id AS infracao,
                                 infr.tx_infracao,
                                 infr.vl_infracao,
                                 TO_CHAR(infr.dt_infracao, \'dd/mm/yyyy\') AS dt_infracao,
                                 infr.id_infrator
                            FROM dojo.infracao AS infr';

    /**
     * retorna os dados da entidade identificada por 'id',
     */
    public function get(int $id): array
    {
        $dql = self::DQL_INFRACA . ' WHERE id = :id';

        $statement = $this->pdo->prepare($dql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $infracao = $statement->fetch(PDO::FETCH_ASSOC);

        if ($infracao) {
            $infracao['notificacao'] = $this->notificacao($id);
        }

        return [];
    }

    /**
     * recupera todos as infraçoes do usuário identificado por '$id'
     * @param integer $id
     * @return array
     */
    public function usuario(int $infrator): array
    {
        $dql = self::DQL_INFRACA . ' WHERE id_infrator = :infrator';

        $statement = $this->pdo->prepare($dql);
        $statement->bindParam(':infrator', $infrator, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            foreach($result as $key => $infracao) {
                $result[$key]['notificacao'] = $this->notificacao($infracao['infracao']);
            }
        }

        return $result;
    }

    public function notificacao(int $infracao): array
    {
        return (new Notificacao($this->pdo))->infracao($infracao);
    }
}

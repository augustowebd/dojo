<?php

namespace App\Getters;

use PDO;
use App\Getters\Endereco;

class Notificacao extends Getter
{
    const DQL_NOTIFICACAO = 'SELECT noti.id AS notificacao,
                                    noti.id_endereco,
                                    noti.id_infracao,
                                    TO_CHAR(noti.dt_notificacao, \'dd/mm/yyyy\') AS dt_notificacao,
                                    noti.is_notificou
                               FROM dojo.notificacao AS noti';

    /**
     * retorna os dados da entidade identificada por 'id',
     */
    public function get(int $id): array
    {
        $dql = self::DQL_NOTIFICACAO . ' WHERE noti.id = :id';

        $statement = $this->pdo->prepare($dql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $result['endereco'] = $this->endereco($result['id_endereco']);
        }

        return $result;
    }

    public function infracao(int $infracao): array
    {
        $dql = self::DQL_NOTIFICACAO . ' WHERE noti.id_infracao = :infracao';

        $statement = $this->pdo->prepare($dql);
        $statement->bindParam(':infracao', $infracao, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $key => $row) {
            unset($result[$key]['id_endereco']);
            $result[$key]['endereco'] = (new Endereco($this->pdo))->get($row['id_endereco']);
        }

        return $result;
    }

    public function endereco(int $endereco): array
    {
        return (new Endereco($this->pdo))->get($endereco);
    }
}

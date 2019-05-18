<?php

namespace App\Getters;

use PDO;
use App\Getters\Endereco;
use App\Getters\Infracao;

class Usuario extends Getter
{
    const DQL_USUARIO = 'SELECT usu.id AS usuario,
                                usu.tx_nome,
                                usu.tx_email
                           FROM dojo.usuario AS usu
                          WHERE usu.id = :id';

    /**
     * retorna os dados da entidade identificada por 'id',
     */
    public function get(int $id): array
    {
        $statement = $this->pdo->prepare(self::DQL_USUARIO);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $result['endereco'] = $this->endereco($id);
            $result['infracao'] = $this->infracao($id);
        }

        return $result;
    }

    /*
     * recupera todas as infracoes do usuário informado
     * */
    public function infracao(int $id): array
    {
        return (new Infracao($this->pdo))->usuario($id);
    }

    /*
     * recupera todas os enderecos do usuário informado
     * */
    public function endereco(int $id): array
    {
        return (new Endereco($this->pdo))->usuario($id);
    }
}

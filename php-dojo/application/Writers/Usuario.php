<?php

namespace App\Writers;

class Usuario extends Writer
{
    /**
     * @param array $data
     * @return void
     */
    public function writer(array $data)
    {
        $response = $this->es->index([
            'index' => 'usuarios',
            'type'  => 'usuario',
            'id'    => $data['usuario'],
            'body'  => $data
        ]);

        # @TODO: implementat controle de execução
        ;

        if(! count($response)) {
            echo '[WRITER][ERROR]: Erro ao tentar gravar dados no ES do usuário: [', $data['usuario'], ']';
        }
    }
}

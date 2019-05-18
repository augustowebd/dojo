<?php

namespace App\Services;

class Usuario extends Service
{
    public function run()
    {
        # recupera os dados do usuário no banco de dados
        $data = $this->getter->get($this->id);

        # converte os dados no formado requerido para envio para es
        $dataToES = $this->parser->parse($data);

        # envia os dados ao es
        $this->writer->writer($dataToES);

        echo PHP_EOL, '[', date('Y-m-d h:i:s',  time()), '] Fila de usuário processada.', PHP_EOL;
    }
}

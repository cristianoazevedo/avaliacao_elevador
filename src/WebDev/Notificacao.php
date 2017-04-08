<?php
/**
 * Created by PhpStorm.
 * User: UniCesumar
 * Date: 08/04/2017
 * Time: 15:42
 */

namespace WebDev;


trait Notificacao
{
    /**
     * @var integer
     */
    private $posicaoElevador;

    /**
     * @return int
     */
    public function getPosicaoElevador()
    {
        return $this->posicaoElevador;
    }

    /**
     * @param int $posicaoElevador
     */
    public function setPosicaoElevador($posicaoElevador)
    {
        $this->posicaoElevador = $posicaoElevador;
    }
}
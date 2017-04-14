<?php
/**
 * @author Cristiano Azevedo <cristianodasilva.azevedo@gmail.com>
 */

namespace WebDev;

/**
 * Class Notificacao
 *
 * @package WebDev
 */
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
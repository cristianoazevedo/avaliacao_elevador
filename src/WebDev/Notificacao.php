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
     * @var string
     */
    private $estado;

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

    public function setEstadoDoElevador($estado)
    {
        print $estado . PHP_EOL;
        $this->estado = $estado;
    }

    public function getEstadoDoElevador()
    {
        return $this->estado;
    }
}
<?php

namespace WebDev;

use SplSubject;

class Andar implements \SplObserver
{
    /**
     * @var integer
     */
    private $posicao;
    /**
     * @var integer
     */
    private $posicaoElevador;

    public function __construct($posicao)
    {
        $this->posicao = $posicao;
    }

    public function update(\SplSubject $subject)
    {
        $this->setPosicaoElevador($subject->getPosicaoElevador());
    }

    /**
     * @return int
     */
    public function getPosicao()
    {
        return $this->posicao;
    }

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

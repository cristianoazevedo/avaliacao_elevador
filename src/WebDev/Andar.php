<?php

namespace WebDev;

use SplSubject;

class Andar implements \SplObserver
{
    /**
     * @var integer
     */
    private $posicao;
    use Notificacao;

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
}

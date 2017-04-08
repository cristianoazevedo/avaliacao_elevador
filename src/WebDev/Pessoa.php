<?php

namespace WebDev;


class Pessoa implements \SplObserver
{
    private $nome;
    use Notificacao;

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    public function update(\SplSubject $subject)
    {
        $this->setPosicaoElevador($subject->getPosicaoElevador());
    }
}

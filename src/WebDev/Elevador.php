<?php

namespace WebDev;

use SplObserver;

class Elevador implements \SplSubject
{
    const LIMITE_MAXIMO_PESSOA = 1;
    /**
     * @var array
     */
    private $observers = [];
    /**
     * @var int
     */
    private $posicao = 0;
    /**
     * @var array
     */
    private $pessoas = [];
    use Notificacao;

    public function attach(\SplObserver $observer)
    {
        if ($observer instanceof \WebDev\Pessoa) {
            $this->pessoas[] = $observer;
        }

        if ($observer instanceof \WebDev\Pessoa && count($this->pessoas) > self::LIMITE_MAXIMO_PESSOA) {
            throw new \Exception('O elevador suporta apenas 1 pessoa');
        }

        $this->observers[] = $observer;

        if ($observer instanceof \WebDev\Andar) {
            $this->setPosicaoElevador($observer->getPosicao());
        }

        $this->notify();
    }

    public function detach(\SplObserver $observer)
    {
        $key = array_search($observer, $this->observers, true);
        if ($key) {
            unset($this->observers[$key]);

            if (count($this->observers)) {
                $observer = end($this->observers);
                $this->setPosicaoElevador($observer->getPosicao());
            }
        }

        $this->notify();
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

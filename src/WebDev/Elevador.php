<?php

namespace WebDev;

use SplObserver;

class Elevador implements \SplSubject
{
    private $observers = [];
    private $posicao = 0;

    public function attach(\SplObserver $observer)
    {
        $this->observers[] = $observer;
        $this->setPosicaoElevador($observer->getPosicao());
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
            /* @var $observer \WebDev\Andar */
            $observer->update($this);
        }
    }

    public function setPosicaoElevador($posicao)
    {
        $this->posicao = $posicao;
    }

    public function getPosicaoElevador()
    {
        return $this->posicao;
    }
}

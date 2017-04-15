<?php
/**
 * @author Cristiano Azevedo <cristianodasilva.azevedo@gmail.com>
 */

namespace WebDev;

/**
 * Class Elevador
 *
 * @package WebDev
 */
class Elevador implements \SplSubject
{
    /**
     * @var integer
     */
    const LIMITE_MAXIMO_PESSOA = 1;
    /**
     * @var array
     */
    private $observers = [];
    /**
     * @var array
     */
    private $pessoas = [];
    /**
     * @var array
     */
    private $andares = [];

    /**
     * @var array
     */
    private $estados = [];

    use Notificacao;

    /**
     * @param \SplObserver $observer
     * @throws \Exception
     */
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
            $this->andares[] = $observer;
            $this->setPosicaoElevador($observer->getPosicao());
        }

        $this->notify();
    }

    /**
     * @param \SplObserver $observer
     */
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

    /**
     * @return void
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function getMudancasDeEstados()
    {
        print "===================== INÍCIO ======================== \n";
        $pessoa = current($this->pessoas);
        /* @var $pessoa \WebDev\Pessoa */

        $andar = current($this->andares);
        /* @var $andar \WebDev\Andar */


        $this->setEstadoDoElevador(sprintf('Pessoa está no %so andar. Elevador está no %so andar.',
            $pessoa->getAndar()->getPosicao(), $this->getPosicaoElevador()));
        $this->estados[] = $this->getEstadoDoElevador();

        $this->setEstadoDoElevador(sprintf('Pessoa chama elevador. Elevador está no %so andar.',
            $this->getPosicaoElevador()));
        $this->estados[] = $this->getEstadoDoElevador();

        if ($andar->getPosicao() > $pessoa->getAndar()->getPosicao()) {
            for ($i = $andar->getPosicao(); $i >= $pessoa->getAndar()->getPosicao(); $i--) {
                $novoAndar = new \WebDev\Andar($i);
                $this->attach($novoAndar);
                $this->setEstadoDoElevador(sprintf('Pessoa está no %so andar. Elevador está no %so andar.',
                    $pessoa->getAndar()->getPosicao(), $this->getPosicaoElevador()));
                $this->estados[] = $this->getEstadoDoElevador();

                if ($i == $pessoa->getAndar()->getPosicao()) {
                    $this->setEstadoDoElevador(sprintf('Pessoa entra no elevador. Elevador está no %so andar.',
                        $this->getPosicaoElevador()));
                    $this->estados[] = $this->getEstadoDoElevador();

                    $this->setEstadoDoElevador(sprintf('Pessoa aperta %so andar. Elevador está no %so andar.',
                        $pessoa->getAndarDesejado()->getPosicao(), $this->getPosicaoElevador()));
                    $this->estados[] = $this->getEstadoDoElevador();

                    if ($pessoa->getAndarDesejado()->getPosicao() < $i) {
                        $this->desce($i - 1, $pessoa->getAndarDesejado()->getPosicao());
                    }

                    if ($pessoa->getAndarDesejado()->getPosicao() > $i) {
                        $this->sobe($i + 1, $pessoa->getAndarDesejado()->getPosicao());
                    }
                }
            }
        }

        if ($andar->getPosicao() < $pessoa->getAndar()->getPosicao()) {
            for ($i = $andar->getPosicao(); $i <= $pessoa->getAndar()->getPosicao(); $i++) {
                $novoAndar = new \WebDev\Andar($i);
                $this->attach($novoAndar);
                $this->setEstadoDoElevador(sprintf('Pessoa está no %so andar. Elevador está no %so andar.',
                    $pessoa->getAndar()->getPosicao(), $this->getPosicaoElevador()));
                $this->estados[] = $this->getEstadoDoElevador();

                if ($i == $pessoa->getAndar()->getPosicao()) {
                    $this->setEstadoDoElevador(sprintf('Pessoa entra no elevador. Elevador está no %so andar.',
                        $this->getPosicaoElevador()));
                    $this->estados[] = $this->getEstadoDoElevador();

                    $this->setEstadoDoElevador(sprintf('Pessoa aperta %so andar. Elevador está no %so andar.',
                        $pessoa->getAndarDesejado()->getPosicao(), $this->getPosicaoElevador()));
                    $this->estados[] = $this->getEstadoDoElevador();

                    if ($pessoa->getAndarDesejado()->getPosicao() < $i) {
                        $this->desce($i - 1, $pessoa->getAndarDesejado()->getPosicao());
                    }

                    if ($pessoa->getAndarDesejado()->getPosicao() > $i) {
                        $this->sobe($i + 1, $pessoa->getAndarDesejado()->getPosicao());
                    }
                }
            }
        }

        if ($andar->getPosicao() == $pessoa->getAndar()->getPosicao()) {
            $this->setEstadoDoElevador(sprintf('Pessoa entra no elevador. Elevador está no %so andar.',
                $this->getPosicaoElevador()));
            $this->estados[] = $this->getEstadoDoElevador();

            $this->setEstadoDoElevador(sprintf('Pessoa aperta %so andar. Elevador está no %so andar.',
                $pessoa->getAndarDesejado()->getPosicao(), $this->getPosicaoElevador()));
            $this->estados[] = $this->getEstadoDoElevador();

            if ($pessoa->getAndarDesejado()->getPosicao() < $andar->getPosicao()) {
                $this->desce($andar->getPosicao() - 1, $pessoa->getAndarDesejado()->getPosicao());
            }

            if ($pessoa->getAndarDesejado()->getPosicao() > $andar->getPosicao()) {
                $this->sobe($andar->getPosicao() + 1, $pessoa->getAndarDesejado()->getPosicao());
            }
        }

        print "===================== FIM =========================== \n\n";
        return $this;
    }

    /**
     * @param $inicio
     * @param $fim
     * @throws \Exception
     */
    private function sobe($inicio, $fim)
    {
        for ($i = $inicio; $i <= $fim; $i++) {
            $novoAndar = new \WebDev\Andar($i);
            $this->attach($novoAndar);
            $this->setEstadoDoElevador(sprintf('Pessoa está no elevador. Elevador está no %so andar.',
                $this->getPosicaoElevador()));
            $this->estados[] = $this->getEstadoDoElevador();

            if ($fim == $i) {
                $this->setEstadoDoElevador(sprintf('Pessoa sai do elevador. Elevador está no %so andar.',
                    $this->getPosicaoElevador()));
                $this->estados[] = $this->getEstadoDoElevador();

                $this->setEstadoDoElevador(sprintf('Pessoa está no %so andar. Elevador está no %so andar.', $i,
                    $this->getPosicaoElevador()));
                $this->estados[] = $this->getEstadoDoElevador();
            }
        }
    }

    /**
     * @param $inicio
     * @param $fim
     * @throws \Exception
     */
    private function desce($inicio, $fim)
    {
        for ($i = $inicio; $i >= $fim; $i--) {
            $novoAndar = new \WebDev\Andar($i);
            $this->attach($novoAndar);
            $this->setEstadoDoElevador(sprintf('Pessoa está no elevador. Elevador está no %so andar.',
                $this->getPosicaoElevador()));
            $this->estados[] = $this->getEstadoDoElevador();

            if ($fim == $i) {
                $this->setEstadoDoElevador(sprintf('Pessoa sai do elevador. Elevador está no %so andar.',
                    $this->getPosicaoElevador()));
                $this->estados[] = $this->getEstadoDoElevador();

                $this->setEstadoDoElevador(sprintf('Pessoa está no %so andar. Elevador está no %so andar.', $i,
                    $this->getPosicaoElevador()));
                $this->estados[] = $this->getEstadoDoElevador();
            }
        }
    }

    /**
     * @return array
     */
    public function getEstados()
    {
        return $this->estados;
    }
}

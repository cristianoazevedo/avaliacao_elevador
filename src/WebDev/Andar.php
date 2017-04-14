<?php
/**
 * @author Cristiano Azevedo <cristianodasilva.azevedo@gmail.com>
 */

namespace WebDev;

/**
 * Class Andar
 *
 * @package WebDev
 */
class Andar implements \SplObserver
{
    /**
     * @var integer
     */
    private $posicao;
    use Notificacao;

    /**
     * Andar constructor.
     *
     * @param $posicao
     */
    public function __construct($posicao)
    {
        $this->posicao = $posicao;
    }

    /**
     * @param \SplSubject $subject
     */
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

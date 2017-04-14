<?php
/**
 * @author Cristiano Azevedo <cristianodasilva.azevedo@gmail.com>
 */

namespace WebDev;

/**
 * Class Pessoa
 *
 * @package WebDev
 */
class Pessoa implements \SplObserver
{
    /**
     * @var string
     */
    private $nome;
    /**
     * @var \WebDev\Andar
     */
    private $andar;
    /**
     * @var \WebDev\Andar
     */
    private $andarDesejado;

    use Notificacao;

    /**
     * Pessoa constructor.
     *
     * @param $nome
     */
    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param \SplSubject $subject
     */
    public function update(\SplSubject $subject)
    {
        $this->setPosicaoElevador($subject->getPosicaoElevador());
    }

    /**
     * @return \WebDev\Andar
     */
    public function getAndar()
    {
        return $this->andar;
    }

    /**
     * @param \WebDev\Andar $andar
     */
    public function setAndar(\WebDev\Andar $andar)
    {
        $this->andar = $andar;
    }

    public function vaiPara(\WebDev\Andar $andar)
    {
        if ($andar->getPosicao() == $this->getAndar()->getPosicao()) {
            throw new \Exception('O andar não pode ser o mesmo');
        }

        $this->andarDesejado = $andar;
    }

    /**
     * @return \WebDev\Andar
     */
    public function getAndarDesejado()
    {
        return $this->andarDesejado;
    }


}

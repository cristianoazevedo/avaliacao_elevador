<?php
/**
 * @author Cristiano Azevedo <cristianodasilva.azevedo@gmail.com>
 */

namespace WebDevTest;

require __DIR__ . '/../../vendor/autoload.php';

class ElevadorTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificarPosicaoAtualElevador()
    {
        $elevador = new \WebDev\Elevador();

        $marcio = new \WebDev\Pessoa('Márcio');

        $andar1 = new \WebDev\Andar(1);
        $andar2 = new \WebDev\Andar(2);
        $andar3 = new \WebDev\Andar(3);
        $andar4 = new \WebDev\Andar(4);

        $elevador->attach($marcio);
        $elevador->attach($andar1);
        $elevador->attach($andar2);
        $elevador->attach($andar3);
        $elevador->attach($andar4);

        $this->assertEquals(4, $andar1->getPosicaoElevador());
        $this->assertEquals(4, $marcio->getPosicaoElevador());
        $this->assertEquals(4, $elevador->getPosicaoElevador());
    }

    /**
     * @expectedException \Exception
     */
    public function testQuantidadeDePessoas()
    {
        $elevador = new \WebDev\Elevador();

        $marcio = new \WebDev\Pessoa('Márcio');
        $cristiano = new \WebDev\Pessoa('Cristiano');

        $elevador->attach($marcio);
        $elevador->attach($cristiano);

    }

    public function testRemoverUmAndar()
    {
        $elevador = new \WebDev\Elevador();

        $marcio = new \WebDev\Pessoa('Márcio');

        $andar1 = new \WebDev\Andar(1);
        $andar2 = new \WebDev\Andar(2);
        $andar3 = new \WebDev\Andar(3);
        $andar4 = new \WebDev\Andar(4);

        $elevador->attach($marcio);
        $elevador->attach($andar1);
        $elevador->attach($andar2);
        $elevador->attach($andar3);
        $elevador->attach($andar4);

        $elevador->detach($andar4);

        $this->assertEquals(3, $andar1->getPosicaoElevador());
        $this->assertEquals(3, $marcio->getPosicaoElevador());
        $this->assertEquals(3, $elevador->getPosicaoElevador());
    }

    public function testMudancasDeEstados()
    {
        $estados = [
            'Pessoa está no 3o andar. Elevador está no 5o andar.',
            'Pessoa chama elevador. Elevador está no 5o andar.',
            'Pessoa está no 3o andar. Elevador está no 5o andar.',
            'Pessoa está no 3o andar. Elevador está no 4o andar.',
            'Pessoa está no 3o andar. Elevador está no 3o andar.',
            'Pessoa entra no elevador. Elevador está no 3o andar.',
            'Pessoa aperta 8o andar. Elevador está no 3o andar.',
            'Pessoa está no elevador. Elevador está no 4o andar.',
            'Pessoa está no elevador. Elevador está no 5o andar.',
            'Pessoa está no elevador. Elevador está no 6o andar.',
            'Pessoa está no elevador. Elevador está no 7o andar.',
            'Pessoa está no elevador. Elevador está no 8o andar.',
            'Pessoa sai do elevador. Elevador está no 8o andar.',
            'Pessoa está no 8o andar. Elevador está no 8o andar.'
        ];

        $elevador = new \WebDev\Elevador();

        $cristiano = new \WebDev\Pessoa('Cristiano');
        $cristiano->setAndar(new \WebDev\Andar(3));
        $cristiano->vaiPara(new \WebDev\Andar(8));

        $andar = new \WebDev\Andar(5);

        $elevador->attach($cristiano);
        $elevador->attach($andar);

        $estdosDoElevador = $elevador->getMudancasDeEstados()->getEstados();

        $this->assertEquals(count($estados), count($estdosDoElevador));

        foreach ($estados as $posicao => $estado) {
            $this->assertEquals($estado, $estdosDoElevador[$posicao]);
        }
    }

    public function testMudancasDeEstadosMesmoAndarElevador()
    {
        $estados = [
            'Pessoa está no 5o andar. Elevador está no 5o andar.',
            'Pessoa chama elevador. Elevador está no 5o andar.',
            'Pessoa entra no elevador. Elevador está no 5o andar.',
            'Pessoa aperta 8o andar. Elevador está no 5o andar.',
            'Pessoa está no elevador. Elevador está no 6o andar.',
            'Pessoa está no elevador. Elevador está no 7o andar.',
            'Pessoa está no elevador. Elevador está no 8o andar.',
            'Pessoa sai do elevador. Elevador está no 8o andar.',
            'Pessoa está no 8o andar. Elevador está no 8o andar.'
        ];

        $elevador = new \WebDev\Elevador();

        $cristiano = new \WebDev\Pessoa('Cristiano');
        $cristiano->setAndar(new \WebDev\Andar(5));
        $cristiano->vaiPara(new \WebDev\Andar(8));

        $andar = new \WebDev\Andar(5);

        $elevador->attach($cristiano);
        $elevador->attach($andar);

        $estdosDoElevador = $elevador->getMudancasDeEstados()->getEstados();

        $this->assertEquals(count($estados), count($estdosDoElevador));

        foreach ($estados as $posicao => $estado) {
            $this->assertEquals($estado, $estdosDoElevador[$posicao]);
        }
    }

    /**
     * @expectedException \Exception
     */
    public function testMudancasDeEstadosMesmoAndar()
    {
        $cristiano = new \WebDev\Pessoa('Cristiano');
        $cristiano->setAndar(new \WebDev\Andar(5));
        $cristiano->vaiPara(new \WebDev\Andar(5));
    }
}

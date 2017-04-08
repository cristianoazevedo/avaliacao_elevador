<?php

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
}

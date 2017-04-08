<?php

namespace WebDevTest;

require __DIR__ . '/../../vendor/autoload.php';

class ElevadorTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificarPosicaoAtualElevador()
    {
        $elevador = new \WebDev\Elevador();

        $andar1 = new \WebDev\Andar(1);
        $andar2 = new \WebDev\Andar(2);
        $andar3 = new \WebDev\Andar(3);
        $andar4 = new \WebDev\Andar(4);

        $elevador->attach($andar1);
        $elevador->attach($andar2);
        $elevador->attach($andar3);
        $elevador->attach($andar4);

        $elevador->detach($andar4);

        $this->assertEquals(3, $andar1->getPosicaoElevador());
    }
}

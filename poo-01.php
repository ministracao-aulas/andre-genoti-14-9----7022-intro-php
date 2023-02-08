<?php

class Pessoa
{
    protected bool $amigo = false;
    protected float $dinheiroNaCarteira = 80;
    protected float $dividaComOBanco = 0;
    protected float $valorEmprestado = 0;

    public static function queHorasSao(): void
    {
        echo sprintf('São %s horas e %s minutos.', date('H'), date('i')) . PHP_EOL;
    }

    public function amizade(): void
    {
        $this->amigo = true;
    }

    public function romperAmizade(): void
    {
        $this->amigo = false;
    }

    public function dividaComOBanco(): void
    {
        if (!$this->dividaComOBanco) {
            echo "Estou em dia com o banco." . PHP_EOL;
            return;
        }

        echo "Estou devendo R$ {$this->dividaComOBanco} para o banco." . PHP_EOL;
    }

    public function suaDividaComigo(): void
    {
        if (!$this->valorEmprestado) {
            echo "Você está em dia comigo." . PHP_EOL;
            return;
        }

        echo "Você está me devendo R$ {$this->valorEmprestado}." . PHP_EOL;
    }

    public function pegarEmprestimoNoBanco(float $valor): void
    {
        $this->dividaComOBanco += $valor;
        $this->dinheiroNaCarteira += $valor;
    }

    public function meEmpresta(float $valor, bool $emprestarDoBanco = false): string
    {
        if (!$this->amigo) {
            return "Você está doido? Nem somos amigos." . PHP_EOL;
        }

        if ($this->dinheiroNaCarteira <= 0 && $emprestarDoBanco) {
            $this->pegarEmprestimoNoBanco($valor);
        }

        if ($this->dinheiroNaCarteira <= 0) {
            return "Cara, até gostaria, mas meu saldo é de R$ {$this->dinheiroNaCarteira}." . PHP_EOL;
        }

        if ($this->dinheiroNaCarteira >= $valor) {
            $this->dinheiroNaCarteira -= $valor;
            $this->valorEmprestado += $valor;
            return "Claro. Te empresto R$ {$valor}." . PHP_EOL;
        }

        $mensagem = "Claro. Mas posso te emprestar R$ {$this->dinheiroNaCarteira}." . PHP_EOL;
        $this->valorEmprestado += $this->dinheiroNaCarteira;
        $this->dinheiroNaCarteira = 0;

        return $mensagem;
    }
}

$amigo = new Pessoa();
echo $amigo->meEmpresta(100);
$amigo->amizade();
$amigo->suaDividaComigo();
echo $amigo->meEmpresta(100);
echo $amigo->meEmpresta(100);
echo $amigo->meEmpresta(100, true);
$amigo->dividaComOBanco();
echo $amigo->meEmpresta(100, true);
$amigo->romperAmizade();
echo $amigo->meEmpresta(100, true);
$amigo->dividaComOBanco();
$amigo->suaDividaComigo();
echo $amigo->meEmpresta(100, true);
$amigo->queHorasSao();
Pessoa::queHorasSao();
echo $amigo->meEmpresta(100, true);

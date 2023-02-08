<?php

class CarrinhoDeCompras
{
    protected int $maxWidth = 39;
    protected array $itens = [];
    protected float $valorNoCarrinho = 0;
    protected array $itensCarrinhoString = [];
    protected array $valoresDescritivosNoCarrinho = [
        'a_pagar' => 0, //float
        'cupom' => null, // string
        'desconto_do_cupom' => 0, // float
        'total_de_itens' => 0, //int
    ];

    public static function dd(...$params): void
    {
        foreach ($params as $key => $param) {
            var_dump($param);
            echo  PHP_EOL;
        }
        die();
    }

    public function somarValor(float $valor): void
    {
        $this->valorNoCarrinho += $valor;
        $this->valoresDescritivosNoCarrinho['a_pagar'] = $this->valorNoCarrinho;
    }

    public function adicionarCupom(float $valorDoDesconto, string $codigoDoCupom): void
    {
        if ($this->valoresDescritivosNoCarrinho['cupom'] ?? null) {
            return;
        }

        $atualAPagar = $this->valoresDescritivosNoCarrinho['a_pagar'] ?? 0;

        $this->valoresDescritivosNoCarrinho['a_pagar'] = $valorDoDesconto <= $atualAPagar
            ? $atualAPagar - $valorDoDesconto : $atualAPagar;

        $this->valoresDescritivosNoCarrinho['desconto_do_cupom'] = $valorDoDesconto;
        $this->valoresDescritivosNoCarrinho['cupom'] = $codigoDoCupom;
    }

    public function mapearItens(): void
    {
        $this->valorNoCarrinho = 0;
        $this->valoresDescritivosNoCarrinho['a_pagar'] = 0;
        $this->itensCarrinhoString = [];

        foreach ($this->itens as $key => $item) {
            if (!is_float($item['valor'] ?? null) || !is_string($item['descricao'] ?? null)) {
                unset($this->itens[$key]);
                continue;
            }

            $itemPos ??= 1;
            $tracejado = str_repeat(
                '-',
                ($this->maxWidth - (strlen($item['descricao']) +
                    strlen((string) $item['valor']))) -
                    strlen("{$itemPos} -------")
            );

            $this->itensCarrinhoString[] = "{$itemPos} - {$item['descricao']} {$tracejado} R$ {$item['valor']}";

            $this->somarValor($item['valor'] ?? 0);
            $itemPos++;
        }

        $this->valoresDescritivosNoCarrinho['total_de_itens'] = count($this->itens);
    }

    public function adicionarItem(string $descricao, float $valor): void
    {
        $this->itens[] = [
            'valor' => $valor,
            'descricao' => $descricao,
        ];

        $this->mapearItens();
    }

    public function mostrarCarrinhoCli(): void
    {
        $aPagar = $this->valoresDescritivosNoCarrinho['a_pagar'] ?? null;
        $cupom = $this->valoresDescritivosNoCarrinho['cupom'] ?? null;
        $descontoDoCupom = $this->valoresDescritivosNoCarrinho['desconto_do_cupom'] ?? null;
        $totalDeItens = $this->valoresDescritivosNoCarrinho['total_de_itens'] ?? null;

        $linhaFull = str_repeat('-', $this->maxWidth);
        echo $linhaFull . PHP_EOL;
        echo "# - DESCRICAO ------------------- VALOR" . PHP_EOL;
        echo implode(PHP_EOL, $this->itensCarrinhoString);
        echo PHP_EOL . $linhaFull . PHP_EOL;

        $temCupom = $cupom && $descontoDoCupom;

        $linhaCupom = $temCupom ? "Desconto ({$cupom}): ----- (- R$ {$descontoDoCupom})" : $linhaFull;

        echo $linhaFull . PHP_EOL;
        echo "Total de itens: -------------------- {$totalDeItens}" . PHP_EOL;
        echo "Valor total: --------------------------- R$ {$this->valorNoCarrinho}" . PHP_EOL;
        echo "{$linhaCupom}" . PHP_EOL;
        echo "A pagar: --------------------------- R$ {$aPagar}" . PHP_EOL;
        echo $linhaFull . PHP_EOL;
    }

    public function carrinhoAsJson(): string
    {
        $aPagar = $this->valoresDescritivosNoCarrinho['a_pagar'] ?? null;
        $cupom = $this->valoresDescritivosNoCarrinho['cupom'] ?? null;
        $descontoDoCupom = $this->valoresDescritivosNoCarrinho['desconto_do_cupom'] ?? null;
        $totalDeItens = $this->valoresDescritivosNoCarrinho['total_de_itens'] ?? null;

        return json_encode([
            'total_de_itens' => $totalDeItens,
            'valor_total' => $this->valorNoCarrinho,
            'tem_cupom' => $cupom && $descontoDoCupom,
            'desconto_do_cupom' => $descontoDoCupom,
            'cupom' => $cupom,
            'a_pagar' => $aPagar,
            'valores_descritivos_no_carrinho' => $this->valoresDescritivosNoCarrinho,
        ]);
    }
}


$item = 1;
$items = [
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
    [
        'name' => 'Xpto ' . ($item++),
        'value' => rand(10, 50) . '.'. rand(10, 99),
    ],
];

$carrinho = new CarrinhoDeCompras();

foreach($items as $item) {
    $carrinho->adicionarItem($item['name'], $item['value']);
}
$carrinho->adicionarCupom(3, 'DESCONTO-02');
echo $carrinho->carrinhoAsJson();
// $carrinho->mostrarCarrinhoCli();

// TODO: largura das linhas no rodapé e lógica de cálculo

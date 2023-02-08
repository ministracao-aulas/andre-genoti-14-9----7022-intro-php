<?php

function soma(float $par1, float $par2): float
{
    return $par1 + $par2;
}

function ola(string $nome): string
{
    return "Olá {$nome}!";
}

function ola2(string $nome): void
{
    echo "Olá {$nome}!";
}

function ola3(
    null|int|string $nome = null,
    null|int|string $cidade = '',
    null|int|string $estado = ''
) {
}

function ola4(
    string $nome,
    null|int $idade = null,
    null|string $cidade = null,
    null|string $estado = null
) {
    $saudacao = "Olá {$nome}.";
    $saudacao .= $idade ? " Você tem {$idade} anos." : '';
    $saudacao .= $cidade ? " Mora na cidade de {$cidade}." : '';
    $saudacao .= $estado ? " Seu estado é {$estado}." : '';

    echo $saudacao . PHP_EOL;
}

// ola4(estado: 'SP', cidade: 'Marilia', idade: 22, nome: 'Andre');

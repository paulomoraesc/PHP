<?php

$result = '';
$showForm = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $function = $_POST['function'];

    if ($function == 1) {
        
        $nota1 = $_POST['nota1'];
        $nota2 = $_POST['nota2'];
        $nota3 = $_POST['nota3'];
        $nota4 = $_POST['nota4'];

        $media = ($nota1 + $nota2 + $nota3 + $nota4) / 4;

        if ($media >= 7) {
            $result = "Aluno aprovado com média: $media";
        } else {
            $nota_exame = $_POST['nota_exame'] ?? 0;
            $nova_media = ($media + $nota_exame) / 2;

            if ($nova_media >= 5) {
                $result = "Aluno aprovado em exame com nova média: $nova_media";
            } else {
                $result = "Aluno reprovado com média: $nova_media";
            }
        }
    } elseif ($function == 2) {
        
        $nome = $_POST['nome'];
        $salario_fixo = $_POST['salario_fixo'];
        $vendas = $_POST['vendas'];

        $comissao = $vendas * 0.15;
        $salario_final = $salario_fixo + $comissao;

        $result = "Nome: $nome<br>Salário Fixo: R$ $salario_fixo<br>Salário Final: R$ $salario_final";
    } elseif ($function == 3) {
        
        $a = $_POST['a'];
        $b = $_POST['b'];

        $trocado = $a;
        $a = $b;
        $b = $trocado;

        $result = "Valor de A após troca: $a<br>Valor de B após troca: $b";
    } elseif ($function == 4) {
        
        $numero = $_POST['numero'];

        if (filter_var($numero, FILTER_VALIDATE_INT) !== false) {
            if ($numero % 2 == 0) {
                $result = "Número $numero é par.";
            } else {
                $result = "Número $numero é ímpar.";
            }
        } else {
            $result = "Erro: Insira um número inteiro válido.";
        }
    } elseif ($function == 5) {
        
        $idade = $_POST['idade'];

        if (filter_var($idade, FILTER_VALIDATE_INT) !== false && $idade >= 0) {
            if ($idade >= 18) {
                $result = "Você é maior de idade.";
            } else {
                $result = "Você é menor de idade.";
            }
        } else {
            $result = "Insira uma idade válida.";
        }
    } elseif ($function == 6) {
        
        $peso = $_POST['peso'];
        $altura = $_POST['altura'];

        $imc = $peso / ($altura * $altura);

        if ($imc < 18.5) {
            $resultado = "Abaixo do peso";
        } elseif ($imc < 24.9) {
            $resultado = "Peso normal";
        } elseif ($imc < 29.9) {
            $resultado = "Sobrepeso";
        } elseif ($imc < 34.9) {
            $resultado = "Obesidade grau 1";
        } elseif ($imc < 39.9) {
            $resultado = "Obesidade grau 2";
        } else {
            $resultado = "Obesidade grau 3";
        }

        $result = "IMC: $imc<br>Classificação: $resultado";
    } elseif ($function == 7) {
        
        $custo = $_POST['custo'];
        $percentual = $_POST['percentual'];

        $valor_venda = $custo * (1 + $percentual / 100);

        $result = "Valor de Venda: R$ $valor_venda";
    } elseif ($function == 8) {
        
        $custo_fabrica = $_POST['custo_fabrica'];

        $impostos = $custo_fabrica * 0.45;
        $valorComImposto = $custo_fabrica + $impostos;
        $percentual_distribuidor = $valorComImposto * 0.28;
        $custo_consumidor = $valorComImposto + $percentual_distribuidor;

        $result = "Custo ao Consumidor: R$ $custo_consumidor";
    }

    $showForm = false;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulários de Cálculo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: 000;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 100%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 15px;
        }
        .result {
            font-size: 1.2em;
            margin-top: 20px;
        }
        .error {
            color: red;
        }
        form {
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #FFFFFF;
        }
        input[type="submit"]{
            background-color: #BA593A;
            border-radius: 15px;
        }


    </style>
</head>
<body>
    <div class="container">
        <h1>Trabalho de PHP</h1>
        
        <?php if ($showForm): ?>

            
            <form method="post" style="<?= $function == 1 ? '' : 'display:none;' ?>">
                <input type="hidden" name="function" value="1">
                <h2>Função 1: Notas Escolares</h2>
                <input type="number" name="nota1" placeholder="Nota 1" step="0.01" required>
                <input type="number" name="nota2" placeholder="Nota 2" step="0.01" required>
                <input type="number" name="nota3" placeholder="Nota 3" step="0.01" required>
                <input type="number" name="nota4" placeholder="Nota 4" step="0.01" required>
                <input type="number" name="nota_exame" placeholder="Nota de Exame" step="0.01">
                <input type="submit" value="Calcular Média">
            </form>

           
            <form method="post" style="<?= $function == 2 ? '' : 'display:none;' ?>">
                <input type="hidden" name="function" value="2">
                <h2>Função 2: Salário do Vendedor</h2>
                <input type="text" name="nome" placeholder="Nome do Vendedor" required>
                <input type="number" name="salario_fixo" placeholder="Salário Fixo" step="0.01" required>
                <input type="number" name="vendas" placeholder="Total de Vendas" step="0.01" required>
                <input type="submit" value="Calcular Salário">
            </form>

            
            <form method="post" style="<?= $function == 3 ? '' : 'display:none;' ?>">
                <input type="hidden" name="function" value="3">
                <h2>Função 3: Troca de Valores</h2>
                <input type="number" name="a" placeholder="Valor A" step="0.01" required>
                <input type="number" name="b" placeholder="Valor B" step="0.01" required>
                <input type="submit" value="Trocar Valores">
            </form>

            
            <form method="post" style="<?= $function == 4 ? '' : 'display:none;' ?>">
                <input type="hidden" name="function" value="4">
                <h2>Função 4: Verificar Par ou Ímpar</h2>
                <input type="text" name="numero" placeholder="Número Inteiro" required>
                <input type="submit" value="Verificar Número">
            </form>

            
            <form method="post" style="<?= $function == 5 ? '' : 'display:none;' ?>">
                <input type="hidden" name="function" value="5">
                <h2>Função 5: Verificar Idade</h2>
                <input type="text" name="idade" placeholder="Sua Idade" required>
                <input type="submit" value="Verificar Idade">
            </form>

            
            <form method="post" style="<?= $function == 6 ? '' : 'display:none;' ?>">
                <input type="hidden" name="function" value="6">
                <h2>Função 6: Calcular IMC</h2>
                <input type="number" name="peso" placeholder="Peso (kg)" step="0.01" required>
                <input type="number" name="altura" placeholder="Altura (m)" step="0.01" required>
                <input type="submit" value="Calcular IMC">
            </form>

            
            <form method="post" style="<?= $function == 7 ? '' : 'display:none;' ?>">
                <input type="hidden" name="function" value="7">
                <h2>Função 7: Calcular Valor de Venda</h2>
                <input type="number" name="custo" placeholder="Preço de Custo" step="0.01" required>
                <input type="number" name="percentual" placeholder="Percentual de Acréscimo" step="0.01" required>
                <input type="submit" value="Calcular Valor de Venda">
            </form>

            
            <form method="post" style="<?= $function == 8 ? '' : 'display:none;' ?>">
                <input type="hidden" name="function" value="8">
                <h2>Função 8: Custo ao Consumidor de Carro</h2>
                <input type="number" name="custo_fabrica" placeholder="Custo de Fábrica" step="0.01" required>
                <input type="submit" value="Calcular Custo ao Consumidor">
            </form>
        <?php endif; ?>

        <?php if (!$showForm): ?>
            <div class="result">
                <?= $result ?>
            </div>
            <form method="post">
                <input type="submit" value="Voltar">
                <input type="hidden" name="function" value="<?= $function ?>">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

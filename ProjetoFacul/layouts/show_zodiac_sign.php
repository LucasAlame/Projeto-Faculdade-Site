<?php include("header.php"); ?>

<?php
// Captura a data de nascimento do formulário
$dataRecebida = $_POST['data_nascimento'] ?? '';
$dataFormatada = DateTime::createFromFormat('Y-m-d', $dataRecebida);
$dataConvertida = $dataFormatada ? $dataFormatada->format('d/m') : '';

// Carrega o arquivo XML com os signos
$arquivoSignos = simplexml_load_file("signos.xml");

// Função para determinar o signo com base na data
function obterSigno($dataInformada, $listaSignos) {
    foreach ($listaSignos->signo as $itemSigno) {
        $inicioPeriodo = DateTime::createFromFormat('d/m', (string)$itemSigno->dataInicio);
        $fimPeriodo = DateTime::createFromFormat('d/m', (string)$itemSigno->dataFim);
        $dataUsuario = DateTime::createFromFormat('d/m', $dataInformada);

        // Lida com os signos que atravessam o ano
        if ($inicioPeriodo > $fimPeriodo) {
            if ($dataUsuario >= $inicioPeriodo || $dataUsuario <= $fimPeriodo) {
                return $itemSigno;
            }
        } else {
            if ($dataUsuario >= $inicioPeriodo && $dataUsuario <= $fimPeriodo) {
                return $itemSigno;
            }
        }
    }
    return null;
}

// Chama a função para descobrir o signo correspondente
$meuSigno = obterSigno($dataConvertida, $arquivoSignos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Signo</title>
    <style>
        /* Estilos internos para o show_zodiac_sign.php */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .resultado-container {
            background: linear-gradient(to right, #1c1c1e, #2c2c2e);
            padding: 50px 30px;
            border-radius: 20px;
            max-width: 700px;
            margin: 100px auto;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.15);
            text-align: center;
            color: #f1f1f1;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
        }

        .resultado-container h2 {
            font-size: 2.5rem;
            color: #ffcc00;
            margin-bottom: 25px;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
        }

        .resultado-container p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #e6e6e6;
            font-weight: 300;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 0 20px;
        }

        .btn-voltar {
            margin-top: 30px;
            background-color: #28a745;
            border: none;
            padding: 12px 28px;
            color: white;
            font-size: 1rem;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s;
            display: inline-block;
            font-weight: bold;
        }

        .btn-voltar:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .alerta {
            text-align: center;
            background-color: rgba(255, 193, 7, 0.9);
            color: #212529;
            padding: 25px;
            border-radius: 12px;
            max-width: 600px;
            margin: 100px auto;
            font-weight: bold;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <?php if ($meuSigno): ?>
        <div class="resultado-container">
            <h2>Seu signo é: <?= htmlspecialchars($meuSigno->signoNome) ?></h2>
            <p><?= nl2br(htmlspecialchars($meuSigno->descricao)) ?></p>
            <a href="index.php" class="btn-voltar">Voltar</a>
        </div>
    <?php else: ?>
        <div class="alerta">
            Data inválida ou signo não encontrado.<br><br>
            <a href="index.php" class="btn-voltar">Tentar novamente</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

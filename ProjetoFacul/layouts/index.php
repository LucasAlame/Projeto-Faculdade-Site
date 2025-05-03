<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Descubra seu Signo Zodiacal</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <!-- Vídeo de fundo -->
    <video autoplay muted loop id="bg-video" playsinline>
        <source src="/ProjetoFacul/sky-stars.mp4" type="video/mp4">
        Seu navegador não suporta a reprodução de vídeo.
    </video>

    <!-- Conteúdo principal -->
    <div class="container mt-5 content">
        <h1 class="text-center mb-4">Qual é o seu signo do zodíaco?</h1>
        <p class="text-center">Preencha com sua data de nascimento e descubra as características do seu signo.</p>
        
        <form action="show_zodiac_sign.php" method="POST" class="card shadow p-4 mx-auto" style="max-width: 450px;">
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Selecione sua data de nascimento:</label>
                <input 
                    type="date" 
                    class="form-control" 
                    id="data_nascimento" 
                    name="data_nascimento" 
                    required
                >
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Ver meu signo</button>
            </div>
        </form>
    </div>

</body>
</html>

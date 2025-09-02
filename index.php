<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signos do Zodíaco</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'layouts/header.php'; ?>

    <div class="container my-5">
        <h2 class="text-center mb-4">Descubra seu Signo</h2>

        <!-- Formulário para inserir a data de nascimento -->
        <?php if (!isset($_POST['birthdate'])): ?>
    <form action="" method="post" class="text-center mb-5">
        <label for="birthdate" class="form-label">Digite sua data de nascimento:</label><br>
        <input type="date" name="birthdate" id="birthdate" class="form-control w-50 mx-auto" required><br><br>
        <button type="submit" class="btn btn-primary">Descobrir Signo</button>
    </form>
<?php endif; ?>

<?php
$descriptions = [
    "aries" => "Áries (21 de março a 20 de abril): signo de fogo, governado por Marte. É conhecido por sua energia, coragem e impulsividade.",
    "touro" => "Touro (21 de abril a 20 de maio): signo de terra, regido por Vênus. Os taurinos são práticos, confiáveis e gostam de estabilidade.",
    "gemeos" => "Gêmeos (21 de maio a 20 de junho): signo de ar, governado por Mercúrio. São pessoas comunicativas, versáteis e curiosas.",
    "cancer" => "Câncer (21 de junho a 22 de julho): signo de água, regido pela Lua. São sensíveis, protetores e muito ligados à família.",
    "leao" => "Leão (23 de julho a 22 de agosto): signo de fogo, regido pelo Sol. Leões são confiantes, generosos e gostam de ser o centro das atenções.",
    "virgem" => "Virgem (23 de agosto a 22 de setembro): signo de terra, governado por Mercúrio. São detalhistas, organizados e críticos.",
    "libra" => "Libra (23 de setembro a 22 de outubro): signo de ar, regido por Vênus. Libras buscam harmonia, justiça e equilíbrio nas relações.",
    "escorpiao" => "Escorpião (23 de outubro a 21 de novembro): signo de água, regido por Plutão. São intensos, passionais e muito leais.",
    "sagitario" => "Sagitário (22 de novembro a 21 de dezembro): signo de fogo, regido por Júpiter. São aventureiros, otimistas e amantes da liberdade.",
    "capricornio" => "Capricórnio (22 de dezembro a 20 de janeiro): signo de terra, governado por Saturno. São disciplinados, responsáveis e focados em objetivos.",
    "aquario" => "Aquário (21 de janeiro a 18 de fevereiro): signo de ar, regido por Urano. São inovadores, independentes e pensam no bem coletivo.",
    "peixes" => "Peixes (19 de fevereiro a 20 de março): signo de água, regido por Netuno. São sensíveis, empáticos e têm uma imaginação fértil."
];

// Verifica se o usuário enviou a data
if (isset($_POST['birthdate'])) {
    $birthdate = $_POST['birthdate'];
    $day = (int)date('d', strtotime($birthdate));
    $month = (int)date('m', strtotime($birthdate));

    function getSign($day, $month) {
        if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 20)) return "aries";
        if (($month == 4 && $day >= 21) || ($month == 5 && $day <= 20)) return "touro";
        if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) return "gemeos";
        if (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) return "cancer";
        if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) return "leao";
        if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) return "virgem";
        if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) return "libra";
        if (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) return "escorpiao";
        if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) return "sagitario";
        if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 20)) return "capricornio";
        if (($month == 1 && $day >= 21) || ($month == 2 && $day <= 18)) return "aquario";
        if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) return "peixes";
        return "desconhecido";
    }

    $sign = getSign($day, $month);

    echo "<h3 class='text-center'>Seu signo é: " . ucfirst($sign) . "</h3>";
    echo "<p class='text-center my-4'>{$descriptions[$sign]}</p>";
}

?>

<hr class="my-5">

<h2 class="text-center mb-4">Signos do Zodíaco</h2>

<div class="row text-center">
    <?php
    foreach ($descriptions as $signo => $descricao) {
        // Remove as datas da descrição para mostrar apenas o texto
        $descricao_sem_data = preg_replace('/\([^)]+\):\s*/', '', $descricao);
        echo "<div class='col-md-6 mb-4'>";
        echo "<strong>" . ucfirst($signo) . "</strong><br>";
        echo "<p>$descricao_sem_data</p>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>
<?php
include 'layouts/header.php';

if (isset($_GET['data_nascimento'])) {
    $data_nascimento = $_GET['data_nascimento'];

    // Função para converter a data em formato numérico (mês e dia)
    function getMesEDia($data) {
        $data = strtotime($data);
        return [
            'mes' => (int)date('m', $data),
            'dia' => (int)date('d', $data)
        ];
    }

    // Carrega o arquivo XML
    $xml = simplexml_load_file("signos.xml") or die("Erro ao carregar XML");
    $usuario_data = getMesEDia($data_nascimento);

    $signo_encontrado = null;

    // Lógica para comparar data e encontrar o signo correspondente
    foreach ($xml->signo as $signo) {
        $data_signo = explode(" - ", $signo->data);
        $inicio = explode(" de ", $data_signo[0]);
        $fim = explode(" de ", $data_signo[1]);

        $mes_inicio = $inicio[0] == 'março' ? 3 : ($inicio[0] == 'abril' ? 4 : 0);  // Completar os meses conforme o XML
        $mes_fim = $fim[0] == 'março' ? 3 : ($fim[0] == 'abril' ? 4 : 0);  // Implementar de forma completa...

        if ($usuario_data['mes'] >= $mes_inicio && $usuario_data['mes'] <= $mes_fim ) {
            $signo_encontrado = $signo;
            break;
        }
    }

    if ($signo_encontrado) {
        echo "<h2>Seu signo é: " . $signo_encontrado->nome . "</h2>";
        echo "<p><strong>Período:</strong> " . $signo_encontrado->data . "</p>";
        echo "<p><strong>Descrição:</strong> " . $signo_encontrado->descricao . "</p>";
        
        // Aqui vamos incluir a foto do signo
        $signo_nome = strtolower($signo_encontrado->nome);
        echo "<img src='imgs/{$signo_nome}.png' alt='Imagem do signo {$signo_encontrado->nome}' />";
    } else {
        echo "<p>Desculpe, não conseguimos determinar seu signo.</p>";
    }
} else {
    echo "<p>Por favor, informe sua data de nascimento para descobrir seu signo.</p>";
}

echo "<p><a href='index.php'>Voltar para a página inicial</a></p>";

include 'layouts/footer.php';
?>
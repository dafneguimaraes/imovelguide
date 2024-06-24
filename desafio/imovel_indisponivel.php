<?php
    include 'conexao_db.php';
    $conexao = Conectar();

    //mesma localização
    function buscarImoveisSimilares($mysqli, $tipoImovel, $localizacao) {
        $sql = "SELECT * FROM imoveis WHERE tipo_imovel LIKE ? AND localizacao = ? LIMIT 3";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $tipoImovel = '%' . $tipoImovel . '%';
            $stmt->bind_param('ss', $tipoImovel, $localizacao);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            die('Erro de preparação: ' . $mysqli->error);
        }
    }
    
    //mesmo tipo de imóvel em outros lugares
    function buscarImoveisOutrasLocalizacoes($mysqli, $tipoImovel, $localizacaoAtual) {
        $sql = "SELECT * FROM imoveis WHERE tipo_imovel = ? AND localizacao != ? LIMIT 3";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ss', $tipoImovel, $localizacaoAtual);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            die('Erro de preparação: ' . $mysqli->error);
        }
    }
    
    function extrairInformacoes($url) {
        // Remover a parte do domínio
        $url = parse_url($url, PHP_URL_PATH);
    
        // Remover a parte após a última barra
        $url = preg_replace('/\/[^\/]*$/', '', $url);
    
        // Encontrar a posição de "com" e "em"
        $comPos = strpos($url, 'com-');
        $emPos = strpos($url, '-em-');
    
        // Extrair tipo de imóvel entre "com" e "em"
        $tipoImovel = substr($url, $comPos + 4, $emPos - $comPos - 4);
        $tipoImovel = str_replace('-', ' ', $tipoImovel);
    
        // Extrair localização após "em"
        $localizacao = substr($url, $emPos + 4);
        $localizacao = str_replace('-', ' ', $localizacao);
    
        // Formatar o resultado
        return [
            'tipo_imovel' => $tipoImovel,
            'localizacao' => $localizacao,
        ];
    }
    
    // Teste com o link fornecido
    $link = "https://imovelguide.com.br/imovel/apartamento-com-3-quartos-a-venda-110-m2-em-vila-andrade-sao-paulo/1317073";
    $info = extrairInformacoes($link);
    
    if ($info) {
        echo "O imóvel com " . $info['tipo_imovel'] . " em " . $info['localizacao'] . " está indisponível. Veja outras opções:<br><br>";
    
        $mysqli = Conectar();
        if ($mysqli) {
            // Buscar imóveis similares na mesma localização
            $imoveisSimilares = buscarImoveisSimilares($mysqli, $info['tipo_imovel'], $info['localizacao']);
            
            if (!empty($imoveisSimilares)) {
                echo "Imóveis na mesma localização que também podem ser interessantes:<br>";
                foreach ($imoveisSimilares as $imovel) {
                    echo $imovel['tipo_imovel'] . " em " . $imovel['localizacao'] . ";<br>";
                }
            } else {
                echo "Nenhum imóvel similar encontrado na mesma localização.<br>";
            }
    
            // Buscar imóveis do mesmo tipo em outras localizações
            $imoveisOutrasLocalizacoes = buscarImoveisOutrasLocalizacoes($mysqli, $info['tipo_imovel'], $info['localizacao']);
            
            if (!empty($imoveisOutrasLocalizacoes)) {
                echo "Imóveis similares encontrados em outras localizações:<br>";
                foreach ($imoveisOutrasLocalizacoes as $imovel) {
                    echo $imovel['tipo_imovel'] . " em " . $imovel['localizacao'] . ";<br>";
                }
            } else {
                echo "Nenhum imóvel similar encontrado em outras localizações.<br>";
            }
    
            $mysqli->close();
        }
    }
?>
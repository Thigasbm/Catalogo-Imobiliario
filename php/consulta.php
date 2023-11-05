<?php
// Conexão com o banco de dados (substitua pelas suas credenciais)
@$conexao = pg_connect("host=localhost port=5432 dbname=CatImo user=postgres password=Thigasbm");
pg_set_client_encoding($conexao, 'UNICODE');

//cidade
if (!$conexao) {
    echo "Não foi possível conectar ao banco de dados.";
} else {
    if (isset($_GET['uf_estado'])) {
        $uf_estado = $_GET['uf_estado'];

        $select = "SELECT id_cidade, nome FROM cidades WHERE uf_estado = '$uf_estado' ORDER BY nome";
        $resultado = pg_query($conexao, $select);

        if ($resultado) {
            $cidades = array();

            while ($linha = pg_fetch_array($resultado)) {
                $idcidade = $linha[0];
                $nomecidade = $linha[1];
                $cidades[] = array('id' => $idcidade, 'nome' => $nomecidade);
                
            }

            echo json_encode($cidades);
        } else {
            echo "Erro na consulta ao banco de dados.";
        }
    } else {
        echo "Parâmetro 'uf_estado' não foi fornecido.";
        $erro = "Ocorreu um erro";
        echo "<script>console.log('$erro');</script>";
    }
}

?>
<?php
include_once '../controllers/banco.php';

// Sua consulta SQL
$resolvido = "SELECT sistema_entrega, COUNT(*) AS total_sistema FROM produtos GROUP BY sistema_entrega";

// Função para gerar uma cor aleatória em formato hexadecimal
function gerarCorAleatoria() {
  return 'color: #' . sprintf('%06X', mt_rand(0, 0xFFFFFF));
}

// Executar a consulta SQL
try {
    $stmt = $conn->query($resolvido);

    // Array para armazenar os resultados formatados
    $data = array();

    // Iterar sobre os resultados e formatar os dados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $sistema_entrega = $row['sistema_entrega'];
        $total_sistema = intval($row['total_sistema']); // Converter para inteiro
        $cor = gerarCorAleatoria(); // Gerar uma cor aleatória

        // Adicionar os dados formatados ao array
        $data[] = array($sistema_entrega, $total_sistema, $cor);
    }

    // Converter o array em formato JSON
    $json_data = json_encode($data);
} catch (PDOException $error) {
    echo "Erro ao executar a consulta: " . $error->getMessage();
}
?>

<!-- HTML e JavaScript para renderizar o gráfico de barras do Google Charts -->
<html>
  <head>
    <!-- Carregar a biblioteca do Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      // Carregar a biblioteca de visualização e definir o callback
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      // Função para desenhar o gráfico
      function drawChart() {
        // Converter os dados JSON de volta para um array
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Sistematica');
        data.addColumn('number', 'Sistema de Entregas');
        data.addColumn({type: 'string', role: 'style'}); // Adicionar a cor como uma coluna adicional
        data.addRows(<?php echo $json_data; ?>);
        

        // Opções do gráfico
        var options = {
          width: 450,
          height: 450,
          pieHole: 0.4,
          legend: 'none',
          pieSliceText: 'label',
          backgroundColor: 'transparent'
        };

        // Criar o gráfico de barras e renderizá-lo na div com o ID 'chart_div'
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material_cd'));
        chart.draw(data, options); 
      }
    </script>
  </head>
  <body>
    <!-- Div para renderizar o gráfico -->
    <div id="columnchart_material_cd" style="margin-top: -60px; margin-left: -15px;"></div>
  </body>
</html>
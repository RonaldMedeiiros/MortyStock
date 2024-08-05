<?php
include_once '../controllers/banco.php';

// Sua consulta SQL
$resolvido = "SELECT setor, COUNT(*) AS total_setor FROM produtos GROUP BY setor ORDER BY total_setor DESC limit 5";

function gerarCorAleatoriaSetor() {
  return 'color: #' . sprintf('%06X', mt_rand(0, 0xFFFFFF));
}

// Executar a consulta SQL
try {
    $stmt = $conn->query($resolvido);

    // Array para armazenar os resultados formatados
    $data = array();

    // Iterar sobre os resultados e formatar os dados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $setor = $row['setor'];
        $total_setor = intval($row['total_setor']); // Converter para inteiro
        $cor = gerarCorAleatoriaSetor(); // Gerar uma cor aleatória

        // Adicionar os dados formatados ao array
        $data[] = array($setor, $total_setor, $cor);
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
        data.addColumn('string', 'Setor');
        data.addColumn('number', 'Total por Setor');
        data.addColumn({type: 'string', role: 'style'}); // Adicionar a cor como uma coluna adicional
        data.addRows(<?php echo $json_data; ?>);

        // Opções do gráfico
        var options = {
          width: 450,
          height: 500,          
          legend: 'none',          
          backgroundColor: 'transparent',
          colors: ['#4285F4', '#EA4335', '#FBBC05', '#34A853', '#FF6D01']
        };

        // Criar o gráfico de barras e renderizá-lo na div com o ID 'chart_div'
        var chart = new google.visualization.BarChart(document.getElementById('columnchart_material_setor'));
        chart.draw(data, options); 
      }
    </script>
  </head>
  <body>
    <!-- Div para renderizar o gráfico -->
    <div id="columnchart_material_setor" style="margin-top: -70px;"></div>
  </body>
</html>
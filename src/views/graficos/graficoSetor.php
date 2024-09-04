<?php
include_once '../controllers/banco.php';

// Sua consulta SQL
$resolvido = "SELECT setor, COUNT(*) AS total_setor FROM produtos GROUP BY setor ORDER BY total_setor DESC limit 5";

// Paleta de cores fornecida
$cores = ['#11091a', '#1d192d', '#2a263f', '#2f2f4d', '#4a4f5a', '#767a81', '#bab195'];

// Executar a consulta SQL
try {
    $stmt = $conn->query($resolvido);

    // Array para armazenar os resultados formatados
    $data = array();
    $index = 0;

    // Iterar sobre os resultados e formatar os dados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $setor = $row['setor'];
        $total_setor = intval($row['total_setor']); // Converter para inteiro
        $cor = $cores[$index % count($cores)]; // Usar a cor da paleta

        // Adicionar os dados formatados ao array
        $data[] = array($setor, $total_setor, 'color: ' . $cor);
        $index++;
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
          height: 400,
          legend: { position: 'none' },
          backgroundColor: 'transparent',
          hAxis: {
            textStyle: {
              color: '#bab195', // Cor mais forte para as legendas
              bold: true
            },
            gridlines: { color: 'transparent' } // Remove as grades do fundo
          },
          vAxis: {
            textStyle: {
              color: '#bab195', // Cor mais forte para as legendas
              bold: true
            },
            gridlines: { color: 'transparent' } // Remove as grades do fundo
          },
          chartArea: {
            width: '80%',
            height: '70%'
          }
        };

        // Criar o gráfico de barras e renderizá-lo na div com o ID 'columnchart_material_setor'
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
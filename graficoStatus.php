<?php
include_once 'banco.php';
//Tickets por Status
$resolvido = "SELECT COUNT(*) FROM tickets WHERE statusticket = 'Resolvido'";
$qtdResolvido = $conn->query($resolvido)->fetchColumn();
$fechado = "SELECT COUNT(*) FROM tickets WHERE statusticket = 'Fechado'";
$qtdFechado = $conn->query($fechado)->fetchColumn();
$pendente = "SELECT COUNT(*) FROM tickets WHERE statusticket = 'Pendente'";
$qtdPendente = $conn->query($pendente)->fetchColumn();
$aberto = "SELECT COUNT(*) FROM tickets WHERE statusticket = 'Aberto'";
$qtdAberto = $conn->query($aberto)->fetchColumn();

// Agora o PHP terminou de buscar os dados e começamos a renderização HTML
?>
<html>
  <head>
    <meta charset="utf-8">
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Status', 'Quantidade'],
          ['Aberto',  <?php echo $qtdAberto ?>],
          ['Pendente',  <?php echo $qtdPendente ?>],
          ['Resolvido',  <?php echo $qtdResolvido ?>]
        ]);

        var options = {
          backgroundColor: 'transparent', // Tornar o fundo transparente
          width: 600, // Largura do gráfico em pixels
          height: 400, // Altura do gráfico em pixels
          chartArea: {
            width: '70%', // Largura da área do gráfico em relação à largura total do gráfico
            height: '70%', // Altura da área do gráfico em relação à altura total do gráfico
            left: '5%', // Espaço à esquerda em relação à largura total do gráfico
            top: '10%' // Espaço superior em relação à altura total do gráfico
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      
    </script>
  </head>
  <body>
    <div id="piechart" style="height: 400px; width: 400px; margin: 0 auto;"></div>
  </body>
</html>

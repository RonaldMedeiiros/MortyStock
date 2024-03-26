<?php
include_once 'banco.php';
//Tickets por nível
$sqlN1 = "SELECT COUNT(*) FROM tickets WHERE nivel_atribuido = 'Nível 1'";
$qtdTicketsN1 = $conn->query($sqlN1)->fetchColumn();
$sqlN2 = "SELECT COUNT(*) FROM tickets WHERE nivel_atribuido = 'Nível 2'";
$qtdTicketsN2 = $conn->query($sqlN2)->fetchColumn();
$sqlN3 = "SELECT COUNT(*) FROM tickets WHERE nivel_atribuido = 'Nível 3'";
$qtdTicketsN3 = $conn->query($sqlN3)->fetchColumn();
$melhoria = "SELECT COUNT(*) FROM tickets WHERE nivel_atribuido = 'Melhoria/Nova Funcionalidade'";
$qtdMelhoria = $conn->query($melhoria)->fetchColumn();
?>

<html>
  <head>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.arrayToDataTable([
          ['Nível', 'Quantidade', { role: "style" }],
          ['Melhoria',  <?php echo $qtdMelhoria ?>, "color: #e5e4e2"],
          ['Nível 3',  <?php echo $qtdTicketsN3 ?>, "gold"],
          ['Nível 2',  <?php echo $qtdTicketsN2 ?>, "silver"],
          ['Nível 1',  <?php echo $qtdTicketsN1 ?>, "#b87333"],
          
        ]);
        
        var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        width: 500,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        backgroundColor: 'transparent', // Tornar o fundo transparente
          chartArea: {
            width: '70%', // Largura da área do gráfico em relação à largura total do gráfico
            height: '70%', // Altura da área do gráfico em relação à altura total do gráfico
            left: '8%', // Espaço à esquerda em relação à largura total do gráfico
            top: '10%' // Espaço superior em relação à altura total do gráfico
          }
      };

        var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
        // Convert the Classic options to Material options.
        chart.draw(view, options);
      };
    </script>
  </head>
  <body>
    <div id="barchart_values" style=" height: 400px; width: 400px; margin: 0 auto;"></div>
  </body>
</html>

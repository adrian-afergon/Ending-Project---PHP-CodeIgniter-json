<div id="contenido">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        	['Fecha', 'Cantidad'],
			<?php 
			/*para poder generar la estadistica crearemos el javascript mediante php*/
				for ($j=1;$j<=count($rango);$j++)
				{
					for ($i=0; $i<count($citas);$i++)
					{
						if ($rango[$j] == $citas[$i]['fecha_cita'])
						{
							echo "['".$citas[$i]['fecha_cita']."',". $citas[$i]['cantidad']."],";
							$i = count($citas);
						}
						else if ($i == (count($citas)-1))
						echo "['".$rango[$j]."',0],";
					}
				}
			?>
        	]
        	);
        var options = {
          title: 'Citas'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

    <div id="chart_div" style="width: 900px; height: 500px;"></div>
</div>
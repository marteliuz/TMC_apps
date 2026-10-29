<?php
@session_start();
include ("libreria.php");

$con = mysql_connect("localhost","root","Touchmedia");
mysql_set_charset('utf8');
mysql_select_db("dbmaster",$con);

$id        	= $_GET['productos'];
$div        = $_GET['div'];
$cantidad	= "1";
$margen		= "0%";

$data[0][0] = "ID";
$data[0][1] = "PRICE";
$data[0][2] = "QTY";
$data[0][3] = "DETAIL";

$sql = mysql_query("SELECT * FROM tbproductos WHERE idtbproductos='$id'");
while($Reg=mysql_fetch_array($sql))
{
	$precio = $Reg['precio'];
}

// echo "count de session: ";
// echo count($_SESSION['data']);
// echo "<br>";

// echo "count de local: ";
// echo count($data);
// echo "<br>";

$count = count($data);

$i = count($_SESSION['data'])+1;

$data[$i][0]= $id;
$data[$i][1] = $precio;
$data[$i][2] = $cantidad;
$data[$i][3] = 1;

$_SESSION['data'] = $data;

// foreach($data as $datas){
    // echo $datas."<br>";
// }



for ( $y = 1 ; $y <= $i ; $y ++)
{
	$e= $data[$y][0];
	$r=	$data[$y-1][0];

	// echo $r;
	// echo "id: ".$data[$y][0];
	// echo " precio: ".$data[$y][1];
	// echo " cantidad: ".$data[$y][2];
	// echo " detalle: ".$data[$y][3];
	// echo "<br>";
	// echo $r." ".$e;
	// echo "r: ";
	// echo $r;
	// echo "<br>";
	
	// echo "<br>";
	
	// echo $data[$y][0];
	
	if($r!=$e){$cantidad= 1;
	// echo "SI";
	$sql = mysql_query("SELECT * FROM tbproductos WHERE idtbproductos='$e'");

	while($Reg=mysql_fetch_array($sql)){ 


		$head = "
	<table id='tb' name='tb' class='tabla_actores'>
			<thead><tr>
			<th></th>
			<th>Nombre</th>
			<th>Imagen</th>
			<th>Descripción</th>
			<th>Cantidad</th>
			<th>Valor Unitario</th>
			<th>Margen de Ganancia</th>
			<th>Valor Neto</th>
			<th></th>
			</tr></thead>";
		
		$rows = "<tr id=".$Reg['idtbproductos'].">
			    <td align= center> <a href=# onclick='javascript:borrar(".$Reg['idtbproductos'].");return false;'><img name='quitar' title='quitar producto de la cotización' style='cursor:pointer' id='Delete Row' src='menos1.png' width='47' height='52' border='0'></a></td>
				<td align= center width=180>".$Reg['nombre']."</td>
				<td align= center> <img src='visor.php?id=".$Reg['idtbproductos']."' alt='Imagen desde Blob' ></td>
				<td class= align.align { text-align: justify; padding:3px }>".nl2br($Reg['descripcion'])."</td>
				<td align= center><input type='text' size='4' id='cantidad' name='cantidad' onkeypress='return soloLetras(event)' maxlength='10' value='".$cantidad."'></td>
				<td align= center width=100><input type='text' size='12' id='precio' name='precio' maxlength='26' value='".Moneda_Selected($Reg['moneda'])." ".$formato_precio."'></td>
				<td align= center width=100><input type='text' size='4' id='margen' name='margen'onkeypress='return soloLetras1(event)' maxlength='6' value='".$margen."'></td>
				<td align= center width=110>".Moneda_Selected($Reg['moneda'])." ".$formato_precio2."</td>
				<td align= center> <input type='image' onclick='javascript:guardar(".$Reg['idtbproductos'].")' name='guardar' title='guardar cambios' alt='guardar cambios' style='cursor:pointer' id='Save Row' src='guardar.png' width='35' height='40' border='0'></td>
				</tr>";

			$_SESSION['$rows'] = $rows;
			
			echo $head.$_SESSION['$rows'];
			
		
			}}
	else{$cantidad= $cantidad+1;
	// echo "NO";
	$sql = mysql_query("SELECT * FROM tbproductos WHERE idtbproductos='$e'");

	while($Reg=mysql_fetch_array($sql)){ 


		$head = "
	<table id='tb' name='tb' class='tabla_actores'>
			<thead><tr>
			<th></th>
			<th>Nombre</th>
			<th>Imagen</th>
			<th>Descripción</th>
			<th>Cantidad</th>
			<th>Valor Unitario</th>
			<th>Margen de Ganancia</th>
			<th>Valor Neto</th>
			<th></th>
			</tr></thead>";
		
		$rows = "<tr id=".$Reg['idtbproductos'].">
			    <td align= center> <a href=# onclick='javascript:borrar(".$Reg['idtbproductos'].");return false;'><img name='quitar' title='quitar producto de la cotización' style='cursor:pointer' id='Delete Row' src='menos1.png' width='47' height='52' border='0'></a></td>
				<td align= center width=180>".$Reg['nombre']."</td>
				<td align= center> <img src='visor.php?id=".$Reg['idtbproductos']."' alt='Imagen desde Blob' ></td>
				<td class= align.align { text-align: justify; padding:3px }>".nl2br($Reg['descripcion'])."</td>
				<td align= center><input type='text' size='4' id='cantidad' name='cantidad' onkeypress='return soloLetras(event)' maxlength='10' value='".$cantidad."'></td>
				<td align= center width=100><input type='text' size='12' id='precio' name='precio' maxlength='26' value='".Moneda_Selected($Reg['moneda'])." ".$formato_precio."'></td>
				<td align= center width=100><input type='text' size='4' id='margen' name='margen'onkeypress='return soloLetras1(event)' maxlength='6' value='".$margen."'></td>
				<td align= center width=110>".Moneda_Selected($Reg['moneda'])." ".$formato_precio2."</td>
				<td align= center> <input type='image' onclick='javascript:guardar(".$Reg['idtbproductos'].")' name='guardar' title='guardar cambios' alt='guardar cambios' style='cursor:pointer' id='Save Row' src='guardar.png' width='35' height='40' border='0'></td>
				</tr>";

			echo $rows;
			
			
			}
		}

}
?>
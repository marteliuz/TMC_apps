<? 
header("Content-Type: image/jpeg");
header("Content-Type: image/jpg");
header("Content-Type: image/gif");
header("Content-Type: image/bmp");

$id = $_GET['id']; 
  $con = mysql_connect("localhost","root","Touchmedia");
	mysql_set_charset('utf8');
	mysql_select_db("dbmaster",$con);
	
    $q = "SELECT * FROM tbproductos WHERE idtbproductos = '$id'"; 
    $result = mysql_query($q) or die ("Error al consultar"); 
    
	
    while ($row = mysql_fetch_assoc($result)) { 
	
    echo $row["imagen"]; 
    } 
     
    mysql_free_result($result); 
 
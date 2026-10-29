<?php
include("config.php");

if (isset($_POST['User']))
{
	$myusername = $_POST['User']; 
	$mypassword = $_POST['Pass'];
	$myusername = trim($myusername);
	$mypassword = trim($mypassword);
	
	if ($myusername==NULL||$mypassword==NULL)
	{
		header("location:../errores/CamposVacios.php");
	}else{
		$myusername = stripslashes($myusername);
		$mypassword = stripslashes($mypassword);
		$myusername = mysql_real_escape_string($myusername);
		$mypassword = mysql_real_escape_string($mypassword);
		$myusername = strtolower($myusername);
		
		$qry        = "SELECT * FROM dbtmedia.tbusuarios WHERE username='$myusername' and password='$mypassword' and estatus ='1'";
		$result 	= mysql_query($qry);
		$Reg   	 	= mysql_fetch_array($result);
		$count  	= mysql_num_rows($result);
		if($count==1)
		{
			session_start();
			$_SESSION['Usuario'] = $myusername;
			switch ($Reg['tipo']) 
			{
				case 1:
					//Usuario tipo Admin
					$_SESSION['UserType'] = "Admin";
					header("location:MainMenuAdmin.php");
					break;
				case 2:
					//Usuario tipo Cliente
					$_SESSION['UserType'] = "Cliente";
					header("location:MainMenu.php");
					break;
			}
		}else{
			header("location:../errores/NoExisteUsuario.php");
		}
	}
}
?>
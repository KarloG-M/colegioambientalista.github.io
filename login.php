<style type="text/css">
			.main-wrapper{
				width:60%;
				background:#E0E4E5;
				border:1px solid #292929;
				padding:25px;
				margin:auto;
			}
			
			
	</style>
	
		<div id="layoutCenterBody"><div class="inner_copy"></div>
			
			
			<div class="main-wrapper">
				<form  method="POST" name="formulario" action="">
				  
					<table>
						<tr>
							<td> Usuario: </td>
							<td><input type="text" name="usuario" required="required"/></td>
						</tr>
						
						<tr>
							<td>Contraseña:</td>
							<td><input type="password" name="contra" required="required"/></td>
						
						</tr>
						
							
						
						<tr>
							<td><input type="submit" name="aceptar" value="Aceptar" /> </td> 
						
							<td><input type="reset" name="cancelar" value="Cancelar" /></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		
		<div class="clearer"></div>
		<?php include "include/footer.php"?>

		</div>
	</body>
</html>


<?php
	if(!empty($_REQUEST['aceptar'])){
		
		
		
		$link = mysqli_connect("localhost", "root", "")
			or die("Problemas en la conexion");
		
		mysqli_select_db($link,"phputc")
			or die("Problemas con la seleccion de la base de datos");
		
		$query = "SELECT * FROM `usuarios` where usuario = '".$_POST['usuario']."' and contrasena = '".$_POST['contra']."'";
		
		if($result = mysqli_query($link, $query)){		
			mysqli_data_seek ($result, 0);
			$extraido= mysqli_fetch_array($result);
			
			if($extraido['usuario'] && $extraido['contrasena']){
				session_start();
				$_SESSION['usuario']= $extraido['nombre'];
				mysqli_free_result($result);  //libera el $result	
				mysqli_close($link);
				header ('Location: principal.php');	
			}
			else{
				mysqli_free_result($result);  //libera el $result
				mysqli_close($link);
				echo '<script language="javascript">';
				echo 'alert("Datos incorrectos");';
				echo 'window.location.href=("login.php")';
				echo '</script>';
			}
					
		}
	}			
		
 ?>
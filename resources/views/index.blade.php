<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<textarea style="width: 100%; height:1024px" id="txt" onchange="prueba(this)">
		
	</textarea>
	<script type="text/javascript">
		//Esta funcion sirve pero no copia el link 
		function prueba(e){
			filas=e.value.split('\n');
			
			filas.forEach(function(e){
				console.log(e.split('\t'));
			});
			
		}
		function prueba2(e){
			console.log(e.value);
		}
	</script>
</body>
</html>
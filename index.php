<?php

	function __autoload($class_name){
		require_once $class_name . '.php';
	} 

?>
<!DOCTYPE HTML>

<html land="pt-BR">

<head>
	<meta charset="UTF-8">

	<title>Cadastro de usuarios</title>
	<style>


@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}




	

</style>
</head>

<body>
<div id="box-c">
<div id="box-b">
<div class="login-page">
<div class="form">
<center>	<h1>Cadastro de usuarios</h1> </center>

	<hr/>

<div align="center">
	<?php

		$usuario = new Usuarios();

		if(isset($_POST['cadastrar'])):

			$nome = $_POST['nome'];
			$email = $_POST['email'];

			$usuario->setNome($nome);			
			$usuario->setEmail($email);			

			if($usuario->insert()){
				echo "Inserido com sucesso!";
			}

		endif;

	?>

	<?php

	if(isset($_POST['atualizar'])):

		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		
		$usuario->setNome($nome);				
		$usuario->setEmail($email);		

		if($usuario->update($id)){

			echo "Atualizado com sucesso!";	
		}

	endif;

	?>

	<?php

	if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):

		$id = (int)$_GET['id'];
		if($usuario->delete($id)){
			echo "Deletado com sucesso!";
		}

	endif;

	?>

	<?php

	if(isset($_GET['acao']) && $_GET['acao'] == 'editar'):

		$id = (int)$_GET['id'];
		$resultado = $usuario->find($id);

	?>

	<h1>Atualizar dados abaixo!</h1>

	<form method="POST" class="login-form"  action="">
		<input type="text" name="nome" value="<?php echo $resultado->nome ?>" placeholder="nome:" />
		<br>
		<input type="text" name="email" value="<?php echo $resultado->email ?>" placeholder="E-mail:" />
		<br>
		<input type="hidden" name="id" value="<?php echo $resultado->id ?>">
		<br>
		<input type="submit" name="atualizar" value="Atualizar dados">
	</form>

	<?php endif; ?>

	<br><hr/><br>


	<form method="POST" class="login-form" action="">		
		<input type="text" name="nome" placeholder="nome:" />
		<br>
		<input type="text" name="email" placeholder="E-mail:" />
		<br>
		<input type="submit" name="cadastrar" value="Cadastrar dados">
		 
		
	</form>

	<br><br>

	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Nome:</th>
				<th>E-mail:</th>
				<th>Ações:</th>
			</tr>
		</thead>

		<?php foreach ($usuario->findAll() as $key => $value): ?>

		<tbody>
			<tr>
				<td><?php echo $value->id; ?></td>
				<td><?php echo $value->nome; ?></td>
				<td><?php echo $value->email; ?></td>
				<td>
					<?php echo "<a href='index.php?acao=editar&id=" . $value->id . "'>Editar</a>"; ?>
					<?php echo "<a href='index.php?acao=deletar&id=" .$value->id . "'>Deletar</a>"; ?>
				</td>
			</tr>
		</tbody>

	<?php endforeach; ?>
</div>
</div>
</div>
</div>
</div>
	</table>

</body>

</html>	
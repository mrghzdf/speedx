<?php 
/******************************************************* 
	Djalma Aguiar Rodrigues
	E-mail/MSN djalma.df1@gmail.com
	Todos os direitos reservados - � Copyright 2014
*******************************************************/
// Inicia sess�es
session_start();
include("../../xtra-old/includes/actions/conexao.phpd/xtra-old/conexao.php");
abre();

$strLogin = $_POST["nome"];
$strSenha = $_POST["senha"];

$query = mysql_query("SELECT a.id_cadastro idCad, a.nm_usuario nmUser, a.nm_senha senha, a.id_perfil idPerfil, a.id_status ativo
			FROM tab_usuario a, tab_cadastro b
			WHERE a.id_cadastro = b.id_cadastro
			AND a.id_status = 1
			AND b.id_status = 1
			AND a.nm_usuario = '".$strLogin."'
			AND a.nm_senha = '".$strSenha."'");

$numrows = mysql_num_rows($query);
$row = mysql_fetch_array($query);


if($numrows){

	// Verifica a senha
	if(!strcmp($strSenha, $row["senha"])){
		if($row["ativo"] == 1){
			 
			// Tudo Ok! Agora, passa os dados para a sess�o e redireciona o usu�rio
			$_SESSION["idCad"]     = $row["idCad"];
			$_SESSION["usuario"]   = $row["nmUser"];
			$_SESSION["idPerfil"]  = $row["idPerfil"];
				
			
			if($_SESSION["idPerfil"] == 1){
				echo "<script>document.location.href='../../admin/index.php';</script>";
			}else{
				echo "<script>document.location.href='../../mnt/index.php';</script>";
			}
			
		}else{
			echo "<script>alert('Usu�rio sem permiss�o para acessar o sistema.');</script>";
			echo "<script>history.go(-1);</script>";
		}
	// Senha inv�lida
	}else{
		echo "<script>alert('Senha inv�lida.');</script>";
		echo "<script>history.go(-1);</script>"; 
  }
  // Login inv�lido
} else {
	echo "<script>alert('Nome de usu�rio inexistente.');</script>";
	echo "<script>history.go(-1);</script>"; 
}
fecha();
?>
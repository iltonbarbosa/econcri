<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Econcri - Sistema de gestão para a economia criativa">
  <meta name="author" content="Ilton Barbosa">

  <title>Econcri - <?=$title?></title>

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="/css/formulario.css" rel="stylesheet">

<?php if (isset($listaCadastro)):?>
	<!-- para a barra de busca no topo das tabelas-->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
	
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.24/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
			$.extend($.fn.dataTable.defaults, {
				language: { url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json" }
			});

			$('#dataTable').DataTable( {
				"ajax": "/Ajax/Cadastros/lista/"
			} );
		} );
	</script>
 <?php endif ?>
  <?=isset($headerMapa)?$headerMapa:''?>
</head>

<body id="page-top">
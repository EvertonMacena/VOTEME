<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Vote.ME</title>
    <meta charset="utf-8">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/br/br-all.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <link rel="stylesheet" href="style.css"  media="screen">
  </head>
  <body>
    <!--<div class="collapse" id="est" tabindex="-1" role="dialog" aria-hidden="true"> -->
          <nav class="navbar navbar-expand-lg navbar-light bg-primary">
          <a class="navbar-brand text-light" href="#" data-toggle="collapse" id="btn-02" data-target="#est" onclick="document.body.style.backgroundColor = '#0096fa';" >Vote.ME</a>
              
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

           <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Meus Votos</a>
              </li>
              <div class="dropdown-divider"></div>

          <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Candidatos
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="#" data-toggle="collapse" data-target="#presidentes">Presidentes</a>
           <a class="dropdown-item" href="#" data-toggle="collapse" data-target="#governadores">Governadores</a>
           </div>
         </li>

           <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Opções
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="#" data-toggle="collapse" data-target="#heatmap">Mapa de calor</a>
           <a class="dropdown-item" href="#">Graficos</a>
           <a class="dropdown-item" href="#">Votar</a>
           </div>
           </li>
           </ul>
           <form class="form-inline my-2 my-lg-0">
           <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
           </form>
          </div>
          </nav>
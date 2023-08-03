<?php
require_once APPPATH.'../vendor/autoload.php';
ob_start();
$html = '
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Factura</title>
			<link rel="shortcut icon" href="favicon.gif" type="image/x-icon"/>
			<style type="text/css">
				/* MegaClass */
				.tipoLetra{
					font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
				}
				.tamaño10{
					font-size: 10px;
				}
				.tamaño9{
					font-size: 9px;
				}
				.tamaño12{
					font-size: 12px;
				}
				.tamaño15{
					font-size: 15px;
				}
				/* MegaClass */
				div{
					display: inline-block;
				}
				.titulo{
					padding: 0px;
					margin-top: 5PX;
				}
				.derecha{
					text-align: right;
				}
				.centrar{
					text-align: center;
				}
				.border{
					border: 1px solid #000;
				}
				.border-left{
					border: 1px solid #000;
				}
				.border-right{
					border: 1px solid #000;
				}
				.border-top{
					border: 1px solid #000;
				}
				.border-bottom{
					border: 1px solid #000;
				}
				.pdleft{
					padding-left: 3px;
				}
				.pdright{
					padding-right: 3px;
				}
				.table{
					border-collapse: collapse;
				}
				.contenedor{
					padding: 0px 25px 0px 25px;
				}
				.tr{
					background-color: #DDDBDB;
				}
				.ancho{
					width: 5%;
					border: hidden;
				}
				.alto{
					width: 5%;
					background-color: #000;
				}
				.altoTD{
					height: 20px;
				}
				.hdDet{
					background-color: #B0C8E0;
				}
				.h4{
					text-align: center;
					font-weight: normal;
				}
				.negrita{
					font-weight: bold;
				}
				.fontSize{
					font-size: 9px !important;
				}
			</style>
		</head>
		<body>
		<div style="width: 100%;">
			<table class="tipoLetra">
				<thead>
				<tr>
					<td class="">
						<img alt="" width="60px" height="80px">
					</td>
					<td class="">
						<h3 class="titulo">	
						</h3>
						<br>
						<h5>						
						</h5>
						<h5 class="h4">						
						</h5>
					</td>
					<td style="width:230px;"></td>
				</tr>
				</thead>
			</table>
			<table class="table tipoLetra tamaño9"  width="100%" border="1">
				<tr>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
					<td class="ancho"></td>
				</tr>
				<tr class="tipoLetra tamaño12" style="border: hidden;">
					<td colspan="20" class="centrar pdleft">
						<b>&nbsp;</b>
					</td>
				</tr>
				<tr>
					<td colspan="10" class="border pdleft" style=" border: hidden;" >
						&nbsp;
					</td>
					<td colspan="3" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="7" class="border pdright derecha" style=" border: hidden;">
						<b>'.$Fecha.'</b>
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
					&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="10" class="border pdleft" style=" border: hidden;" >
						&nbsp;
					</td>
					<td colspan="3" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="7" class="border pdleft" style=" border: hidden;">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;'.$Nombre.' '.$Apellido.'</b>
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="10" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="9" class="border pdleft" style=" border: hidden;">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$Direccion.'</b>
					</td>	
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="10" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="4" class="border pdleft" style=" border: hidden;">
					</td>
					<td colspan="3" class="border pdleft" style=" border: hidden;">
						<b>'.$DUI.' - '.$NIT.'</b>
					</td>
					<td colspan="2" class="border pdleft" style=" border: hidden;">
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
						<b>'.$Telefono.'</b>
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="11" rowspan="5" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="5" class="border pdleft" style=" border: hidden;">
						<b>'.$Descripcion.'</b>
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						<b>'.$PrecioUni.'</b>
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						<b>'.$PrecioUni.'</b>
					</td>
				</tr>
				<tr>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="5" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="5" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="5" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="5" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="5" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdleft" style=" border: hidden;">
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
					&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
					&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
					&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style=" border: hidden;">
					&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
					</td>
				</tr>
				<tr>
					<td colspan="20" class="border pdleft" style="border: hidden;">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="10" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="9" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						<b>'.$PrecioUni.'</b>
					</td>
					
				</tr>
				<tr>
					<td colspan="10" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="9" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						<b>'.$ISR.'</b>
					</td>
				</tr>
				<tr>
					<td colspan="10" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="9" class="border pdleft" style=" border: hidden;">
						&nbsp;
					</td>
					<td colspan="1" class="border pdright derecha" style=" border: hidden;">
						<b>'.$Total.'</b>
					</td>
				</tr>
			</table>
		</div>  <!-- Fin de Contenedor -->
		</body>
		</html>';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'orientation' => 'L','format' => 'A4-L','margin_bottom' => '0',]);
$mpdf->WriteHTML($html);
$mpdf->Output();
?>

<?php
require_once APPPATH.'../vendor/autoload.php';
ob_start();
$html = '
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Recibo de Caja</title>
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
			<!-- Header de Reporte -->
			<table class="tipoLetra" style="width: 100%;">  <!-- Tabla de Encabezado -->
				<thead>
				<tr>
					<td class="">
						<img src="'.APPPATH.'../resources/img/FinalLogo_ASEI.jpg" alt="" width="60px" height="80px">
					</td>
					<td class="centrar">
						<h3 class="titulo">
							ASOCIACIÓN SALVADOREÑA DE EXTENSIONISTAS DEL INCAE (ASEI)
						</h3>
						<h3 class="titulo">
							PRESUPUESTO ANUAL: '.$anio.'
						</h3>
						<h5 class="h4">
						</h5>
					</td>
				</tr>
				</thead><!-- Tabla de Encabezado -->
			</table>
			<!-- Fin de Header -->

			<!-- Tipo de Reserva -->
			<table class="table tipoLetra "  width="100%" border="1">
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
				<tr>
					<td class="hdDet centrar" colspan="3" style="border-right: hidden">
						Cuenta Contable
					</td>
					<td class="hdDet centrar" colspan="4" style="border-left: hidden; border-right: hidden">
						Nombre Cuenta Contable
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Codigo Oficina
					</td>
					<td class="hdDet centrar" colspan="3" style="border-left: hidden; border-right: hidden">
						Nombre Oficina
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Enero
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Febrero
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Marzo
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Abril
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Mayo
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Junio
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Julio
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Agosto
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Septiembre
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Octubre
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden; border-right: hidden">
						Noviembre
					</td>
					<td class="hdDet centrar" colspan="2" style="border-left: hidden;">
						Diciembre
					</td>
				</tr class="tamaño9">';
if (!empty($dataPresupuesto)) {
	foreach ($dataPresupuesto as $dp) {
		$html .= "<tr>";
		$html .= "<td style=\"border-right: hidden; border-bottom: hidden; border-top: hidden\" colspan='3' class='centrar'>" . $dp->ccodcta . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='4' class='centrar'>" . $dp->nombCcodcta . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='centrar'>" . $dp->ccodofi . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='3' class='centrar'>" . $dp->nombCcodofi . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->enero, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->febrero, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->marzo, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->abril, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->mayo, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->junio, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->julio, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->agosto, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->septiembre, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->octubre, 2) . "</td>";
		$html .= "<td style=\"border: hidden;\" colspan='2' class='derecha'>$ " . number_format($dp->noviembre, 2) . "</td>";
		$html .= "<td style=\"border-left: hidden; border-bottom: hidden; border-top: hidden\" colspan='2' class='derecha'>$ " . number_format($dp->diciembre, 2) . "</td>";
		$html .= "</tr>";
	}
}
$html .= '
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
			</table>
		</div>  <!-- Fin de Contenedor -->
		</body>
		</html>';
$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
/*/Marcas de agua en MPDF
$mpdf->SetWatermarkText('PRUEBA WATERMARK');
$mpdf->showWatermarkText = true;
*/
$mpdf->WriteHTML($html);
$mpdf->Output();

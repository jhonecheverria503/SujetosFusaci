<?php
require_once APPPATH.'../vendor/autoload.php';
ob_start();
//var_dump($dataFactura);
//die();
$html = '
	<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Factura de Sujeto Excluido</title>
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
						background-color: white;
						border: hidden;
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
				<div style="width: 100%; height: 4%;">
					<table class="table tipoLetra tamaño12"  width="100%">
						<thead>
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
						<tr>
							<td colspan="20">
							</td>
						</tr>
						<tr>
							<td colspan="2" rowspan="2" >
								<img src="'.base_url("/resources/img/FinalLogo_ASEI.jpg").'" alt="" width="70px" height="80px">
							</td>
							<td colspan="12" rowspan="2" >
								<h3 class="titulo">
									Fundación para la Salud Comunitaria Integral
								</h3>
								<br>
								<br>
								<h5>
									
								</h5>
							</td>
							<td colspan="6" rowspan="2">
								<table class="table tipoLetra tamaño12" width="100%" border="1">
									<tr>
										<td>
											Comprobante Provisional
											<br>
											<br>
											<b>N° '.$corTemp.'</b>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						</thead>
					</table>
				</div>
				<div style="width: 100%; height: 4%;">
					<table class="table tipoLetra tamaño12"  width="100%">
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
						<tr>
							<td colspan="14">
							</td>
							<td colspan="6">
								Fecha: <b>'.$Fecha.'</b>
							</td>
						</tr>
						<tr>
							<td colspan="20">
								Nombre del Sujeto Excluido: <b>'.$nombre.' '.$apellido.'</b>
							</td>
						</tr>
						<tr>
							<td colspan="20">
								Dirección: <b>'.$direccion.'</b>
							</td>
						</tr>
						<tr>
							<td colspan="14">
								NIT o DUI del Sujeto Excluido: <b>'.$nit.' - '.$dui.'</b>
							</td>
							<td colspan="6">
								Telefono: <b>'.$telefono.'</b>
							</td>
						</tr>
					</table>
				</div>
				<div style="width: 100%; height: 80%;">
					<table class="table tipoLetra tamaño12"  width="100%" heigth="100%" border="1">
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
						<tr>
							<td colspan="20" style="border-left: hidden;border-right: hidden">
								<br>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								Cantidad
							</td>
							<td colspan="12">
								Descripción
							</td>
							<td colspan="3">
								Precio Unitario
							</td>
							<td colspan="3">
								Total Compras
							</td>
						</tr>
						<tr style="height: 92%;">
							<td colspan="2">
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
							</td>
							<td colspan="12">
								<br>
								'.$concepto.' 
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
							</td>
							<td colspan="3">
								<br>
								$ '.$gasto.'
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
							</td>
							<td colspan="3">
								<br>
								$ '.$gasto.'
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td colspan="14" style="border-bottom: hidden">
								Recibi la cantidad de:
							</td>
							<td colspan="3" style="border-bottom: hidden">
							</td>
							<td colspan="3" style="border-bottom: hidden">
							</td>
						</tr>
						<tr>
							<td colspan="14" style="border-top: hidden;border-bottom: hidden">
							</td>
							<td colspan="3" style="border-top: hidden;border-bottom: hidden">
								SUMAS
							</td>
							<td colspan="3" style="border-top: hidden;border-bottom: hidden">
								$ '.$gasto.'
							</td>
						</tr>
						<tr>
							<td colspan="14" style="border-top: hidden;border-bottom: hidden">
							</td>
							<td colspan="3" style="border-top: hidden;border-bottom: hidden">
							(-) Renta Retenida
							</td>
							<td colspan="3" style="border-top: hidden;border-bottom: hidden">
								$ '.$isr.'
							</td>
						</tr>
						<tr>
							<td colspan="14" style="border-top: hidden;border-bottom: hidden">
							________________________________________________________________________________
							</td>
							<td colspan="3" style="border-top: hidden;border-bottom: hidden">
							</td>
							<td colspan="3" style="border-top: hidden;border-bottom: hidden">
							</td>
						</tr>
						<tr>
							<td colspan="14" style="border-top: hidden">
							<centrar><a class="centrar">Firma de Sujeto Excluido</a></centrar>
							</td>
							<td colspan="3" style="border-top: hidden">
							<b>Total</b>
							</td>
							<td colspan="3" style="border-top: hidden">
								$ '.$monto.'
							</td>
						</tr>
						<tr>
							<td colspan="20">
								Nota: En caso que no supiere firmar, debe estampar la huella de uno de sus dedos
							</td>
						</tr>
					</table>
				</div>
			</body>
		</html>';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
//$mpdf->Output('nuevaFactura.pdf','D');
$mpdf->Output();
//echo $html;
?>

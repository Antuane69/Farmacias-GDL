<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css" media="all">
        body {
            width: 100%;
            height: 100%;
            border: 50mm;
            font-family: Arial, Helvetica, sans-serif;
            font: 12pt 'sans-serif';
            max-width: 100%;
        }
        * {
            font-family: 'sans-serif';
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        @media print {
            html,
            body {
                width: 200mm;
                height: 250mm;
            }
        }

        .table {
            margin-left: auto;
            margin-right: auto;
            margin-top: auto;
            margin-bottom: auto;
        }
        
        .pdf-image {
            width: 200px; /* Ancho deseado en píxeles o porcentaje */
            height: auto; /* Altura automática para mantener la proporción original */
        }

        .pdf-image2 {
            width: 100px; /* Ancho deseado en píxeles o porcentaje */
            height: auto; /* Altura automática para mantener la proporción original */            
        }
    </style>
</head>
<body>
<table style="height:200px; border:1px solid black; margin-left:auto; margin-right:auto;margin-top:auto;margin-bottom:auto;padding:3px;border-spacing:20px;">
    <tr>
        <table style="margin-left:auto; margin-right:auto; width:750px">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td style="text-align:left;font-size:11;margin-left:10%;font-weight: bold;" colspan="3">
                    Recibo de Nómina</td>
                <td colspan="6"></td>
                <td style="text-align:right;">
                    <img style="margin-left: 100px" src="{{ public_path('assets/tokyoLogo.png') }}" width="80" height="80"> 
                </td>
            </tr>
            <tr>
                <td style="text-align:left;font-size:11;margin-left:10%;text-decoration: underline;" colspan="2">
                    Fecha: del {{$fecha_actual}} al {{$fecha_final}}</td>
                <td style="text-align:center;" colspan="2"></td>
                <td style="text-align:center;font-weight:bold;font-size:13px" colspan="2">
                    Nombre del Empleado: {{$nomina->nombre_real}}
                </td>
            </tr>
        </table>
        <p></p>
        <table style="margin-left:auto;margin-top:10px; margin-right:auto;width:920px;border-collapse:collapse;">
            <tr style="border: 1px solid #262626;border-bottom: 1px solid #262626;background-color: #A2E4FF;">
                <th style="width: 15%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">HORAS COMPLETAS TRABAJADAS</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">MINUTOS RESTANTES TRABAJADOS</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">DIAS LABORADOS</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">SUELDO POR HORA</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">SALARIO DIARIO</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">BONOS</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">PRIMA DOMINICAL</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">PRIMA VACACIONAL</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">DIAS EXTRA</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">IMSS</th>
                <th style="width: 6%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">ISR</th>
                <th style="width: 20%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626;border: 1px solid #262626">TOTAL</th>
            </tr>
            <tr style="text-align:center;font-size:13px;border: 1px solid #262626;">   
                <td style="font: bold;text-align:center;border: 1px solid #262626;">{{$nomina->horas}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">{{$nomina->minutos}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">15</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$salario_h}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$salario_d}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$nomina->bonos}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$nomina->prima_d}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$nomina->prima_v}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$nomina->host}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$nomina->imss}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">$75.46</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$nomina->total}}</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border-top: 1px solid #262626;"></td>
                <td style="border-top: 1px solid #262626;"></td>
                <td style="border-top: 1px solid #262626;"></td>
                <td style="border-top: 1px solid #262626;"></td>
                <td style="border-top: 1px solid #262626;"></td>
                <td style="border-top: 1px solid #262626;"></td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;font-weight: bold;text-align: center;" colspan="3">PERCEPCIONES</td>
                <td style="border: 1px solid #262626;font-weight: bold;text-align: center;" colspan="3">DEDUCCIONES</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">AGUINALDO</td>
                <td style="border: 1px solid #262626;text-align: center;">--</td>
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">UNIFORMES</td>
                <td style="border: 1px solid #262626;text-align: center;font-weight: bold;">
                   @if (count($nomina->pivote) > 0)
                   ${{$nomina->pivote[0]->uniforme}}
                   @else
                   $
                   @endif</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">DIAS FESTIVOS</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->festivos}}</td>
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">MERMAS</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->descuentos}}</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">GASOLINA</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->gasolina}}</td>
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">COMIDA PERSONAL</td>
                <td style="border: 1px solid #262626;text-align: center;font-weight: bold;">${{$nomina->comida}}</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;font-weight: bold;text-align: center;" colspan="3">TOTAL A PAGAR:</td>
                <td style="border: 1px solid #262626;font-weight: bold;text-align: center;" colspan="3">${{$nomina->total}}</td>
                <p></p>
            </tr>
        </table>
    </tr>
    <p></p>
    <tr>
        <td style="font:bold;font-size:10;text-align:justify" colspan="3">
            Recibí de Luis Sanchez de la Vega, la cantidad neta indicada en este recibo la cuál cubre a la fecha, el importe de mi salario, tiempo extra y todas las percepciones a que tengo derecho por ley, sin que se me adeude cantidad alguna por otro concepto. 	
        </td>
    </tr>
    <p></p>
    <tr>
        <td style="font-size:12px;font-weight:bold">
            <div style="visibility: hidden; display:inline">.....................</div>RECIBIÓ: <div style="text-decoration: underline; display: inline;">{{$nomina->nombre_real}}</div>              
            <div style="visibility: hidden; display:inline">................................................................</div>SELLO Y FIRMA DE RECURSOS HUMANOS
            <p></p>
            <div style="visibility: hidden; display:inline">........................................</div>FIRMA
            <div style="visibility: hidden; display:inline">...............................................................................................................................</div>FIRMA
        </td>
    </tr>
    <tr></tr>
</table>
</body>

</html>
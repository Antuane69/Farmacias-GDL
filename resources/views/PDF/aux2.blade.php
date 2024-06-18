<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css" media="all">
        body {
            width: 100%;
            height: 100%;
            border: 80mm;
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

        table {
            margin-left: auto;
            margin-right: auto;
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
<table style="height:900px; border:1px solid black; margin-left:auto; margin-right:auto;margin-top:6mm;margin-bottom:auto;padding:3px;border-spacing:20px;">
    <tr>
        <table style="margin-left:auto; margin-right:auto; width:660px">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td style="text-align:left;font-size:11;margin-left:10%;font-weight: bold;" colspan="3">
                    <div style="visibility: hidden; display:inline">......</div>
                    Recibo de Nómina</td>
                <td colspan="2"></td>
                <td style="text-align:right;">
                    <img style="margin-left: 100px" src="{{ public_path('assets/tokyoLogo.png') }}" width="80" height="80"> 
                </td>
            </tr>
            <tr>
                <td style="text-align:left;font-size:11;margin-left:10%;text-decoration: underline;" colspan="2">
                    <div style="visibility: hidden; display:inline">......</div>
                    Fecha: del {{$fecha_actual}} al {{$fecha_final}}</td>
                <td style="text-align:center;" colspan="2"></td>
                <td style="text-align:center;"></td>
            </tr>
            <p></p>
            <p></p>
            <tr style="text-align:center;font-size:14px;font-weight: bold;">
                <td style="text-align:center;" colspan="5">
                    Nombre del Empleado: {{$nomina->nombre_real}}
                </td>
            </tr>
        </table>
        <p></p>
        <table style="margin-left:auto;margin-top:10px; margin-right:auto;width:680px;border-collapse:collapse;">
            <tr style="border: 1px solid #262626;border-bottom: 1px solid #262626;background-color: #A2E4FF;">
                <th style="width: 30%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">HORAS COMPLETAS TRABAJADAS</th>
                <th style="width: 18%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">MINUTOS RESTANTES TRABAJADOS</th>
                <th style="width: 17%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">DIAS LABORADOS</th>
                <th style="width: 18%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">SUELDO POR HORA</th>
                <th style="width: 17%; font-size:10;border: 1px solid #262626;border-bottom: 1px solid #262626">SALARIO DIARIO</th>
            </tr>
            <tr style="text-align:center;font-size:13px;border: 1px solid #262626;">   
                <td style="font: bold;text-align:center;border: 1px solid #262626;">{{$nomina->horas}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">{{$nomina->minutos}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">15</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$salario_h}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$salario_d}}</td>
                {{-- <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$nomina->salario_h}}</td>
                <td style="font: bold;text-align:center;border: 1px solid #262626;">${{$nomina->salario_d}}</td> --}}
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;font-weight: bold;text-align: center;" colspan="3">PERCEPCIONES</td>
                <td style="border: 1px solid #262626;font-weight: bold;text-align: center;" colspan="2">DEDUCCIONES</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">AGUINALDO</td>
                <td style="border: 1px solid #262626;text-align: center;">--</td>
                <td style="border: 1px solid #262626;text-align: center;">IMSS</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->imss}}</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">PRIMA VACACIONAL</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->prima_v}}</td>
                <td style="border: 1px solid #262626;text-align: center;">ISR</td>
                <td style="border: 1px solid #262626;text-align: center;">$75.46</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">DIAS FESTIVOS</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->festivos}}</td>
                <td style="border: 1px solid #262626;text-align: center;">MERMAS</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->descuentos}}</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">BONO</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->bonos}}</td>
                <td style="border: 1px solid #262626;text-align: center;">COMIDA PERSONAL</td>
                <td style="border: 1px solid #262626;text-align: center;font-weight: bold;">${{$nomina->comida}}</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">PRIMA DOMINICAL</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->prima_d}}</td>
                <td style="border: 1px solid #262626;text-align: center;">UNIFORMES</td>
                <td style="border: 1px solid #262626;text-align: center;font-weight: bold;">
                   @if (count($nomina->pivote) > 0)
                   ${{$nomina->pivote[0]->uniforme}}
                   @else
                   $
                   @endif</td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">GASOLINA</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->gasolina}}</td>
                <td style="border: 1px solid #262626;text-align: center;"></td>
                <td style="border: 1px solid #262626;text-align: center;"></td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;text-align: center;" colspan="2">DIAS EXTRA</td>
                <td style="border: 1px solid #262626;text-align: center;">${{$nomina->host}}</td>
                <td style="border: 1px solid #262626;text-align: center;"></td>
                <td style="border: 1px solid #262626;text-align: center;"></td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <td style="border: 1px solid #262626;"></td>
                <p></p>
            </tr>
            <tr style="font-size:10">
                <td style="border: 1px solid #262626;font-weight: bold;text-align: center;" colspan="3">TOTAL A PAGAR:</td>
                <td style="border: 1px solid #262626;font-weight: bold;text-align: center;" colspan="2">${{$nomina->total}}</td>
                <p></p>
            </tr>
        </table>
    </tr>
    <p></p>
    <tr>
        <td style="font:bold;font-size:10;text-align:justify" colspan="3">
            Recibí de Luis Sanchez de la Vega, la cantidad neta indicada en este recibo la cuál cubre a la fecha, el importe de mi salario, tiempo extra y todas las percepciones a que tengo derecho por ley, sin que se me adeude cantidad alguna por otro concepto. 
            <p>
            </p>	
        </td>
    </tr>
    <tr>
        <table style="margin-left:auto;margin-top:10px; margin-right:auto;width:670px;border-collapse:collapse;font-size:11px">
            <tr style="font-weight: bold;">
                <th style="width:35%;text-align:center;height:20px" colspan="2">RECIBIÓ</th>
                <th style='width:30%;visibility: hidden;'></th>
                <th style="width:35%;text-align:right;height:20px;margin-left:10%" colspan="2">SELLO Y FIRMA DE RECURSOS HUMANOS</th>
            </tr>
            <tr style="font-weight: bold;">
                <td colspan="2">
                    NOMBRE: <div style="text-decoration: underline; display: inline;">{{$nomina->nombre_real}}</div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-weight: bold;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <p></p>
            <p></p>
            <p></p>
            <tr style="font-weight: bold;">
                <td style="border-bottom:0.5px solid black;" colspan="2"></td>
                <td></td>
                <td style="border-bottom:0.5px solid black;" colspan="2"></td>
            </tr>
            <tr style="font-weight: bold;">
                <td style="text-align: center" colspan="2">FIRMA(s)</td>
                <td></td>
                <td style="text-align: center" colspan="2">FIRMA</td>
            </tr>
        </table>
    </tr>
</table>
</body>

</html>
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

    </style>
</head>
<body>
<table style="height:850px; border:1px solid black; margin-left:auto; margin-right:auto;margin-top:6mm;margin-bottom:6mm;padding:3px;border-spacing:20px;">
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
                <td style="text-align:left;">
                    <img style="margin-right: 100px" src="{{ public_path('assets/tokyoLogo.png') }}" width="80" height="80"> 
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table style="margin-left:auto;margin-top:10px;margin-bottom:10px;margin-right:auto;width:680px;border-collapse:collapse;">
            <tr>
                @if ($titulo == 'Contrato de 30 Dias')
                    <th style="font-size:12;text-align:center;" colspan="3">CONTRATO INDIVIDUAL DE TRABAJO POR 30 DÍAS COMO PERIODO DE PRUEBA</th>
                @else
                    <th style="font-size:12;text-align:center;" colspan="3">CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO INDEFINIDO</th>
                @endif
                <p></p>
            </tr>
            @if ($titulo == 'Contrato de 30 Dias')
                <tr>
                    <td style="font-size:10;text-align:center;font-weight: bold" colspan="3">1er CONTRATO</td>
                </tr>
            @endif
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    CONTRATO INDIVIDUAL DE TRABAJO que de acuerdo a los artículos 35 y 39-a de la ley federal de trabajo,
                    celebran por una parte <div style="font-weight: bold; display: inline;">“EL PATRON” LUIS SANCHEZ DE LA VEGA CASTELLANOS </div>, con domicilio
                    principal : LÓPEZ COTILLA 2009 COL. ARCOS VALLARTA, GUADALAJARA JALISCO y por la otra parte por
                    su propio derecho comparece <div style="font-weight: bold; display: inline;">“EL TRABAJADOR” {{$empleado->nombre}} </div>de nacionalidad
                    <div style="font-weight: bold; display: inline;">{{$empleado->nacionalidad}}</div>, estado civil <div style="font-weight: bold; display: inline;">{{$empleado->estado_civil}}</div> de <div style="font-weight: bold; display: inline;">{{$empleado->edad}}</div> años de edad, sexo <div style="font-weight: bold; display: inline;">{{$empleado->sexo}}</div>, con domicilio en calle 
                    <div style="font-weight: bold; display: inline;">{{$empleado->domicilio}}</div>, GUADALAJARA JALISCO.                  
                </td>
            </tr>
            <p></p>
            <tr>
                <td style="font-size:12px;text-align:center;font-weight: bold" colspan="3">
                    Clausulas:
                </td>
            </tr>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">PRIMERA. “EL PATRON”</div>, contratará a <div style="font-weight: bold; display: inline;">“EL TRABAJADOR”</div> para que bajo su dirección y dependencia
                    preste sus servicios personales como <div style="font-weight: bold; display: inline;text-transform: uppercase;">{{$empleado->puesto}}</div> debiendo desempeñarse en el domicilio de la fuente de trabajo.
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">SEGUNDA. “EL TRABAJADOR” </div>obliga a prestar sus servicios personales por un período de 
                    <div style="font-weight: bold; display: inline;">PRUEBA DE 30 DÍAS </div>para demostrar que cumple con los requisitos y conocimientos necesarios 
                    para desarrollar el trabajo que se solicita, desarrollando siempre con la mayor intensidad, con el máximo esmero que requiere el
                    trabajo, el que desempeñará de manera y forma que “EL PATRON “ le indique, desarrollando todas la
                    actividades inherentes a su trabajo y todas aquellas relacionadas con el mismo, de acuerdo con las
                    instrucciones que al efecto reciba de “EL PATRON “ por conducto de cualquier representante autorizado, por
                    lo que conviene en el desempeño de sus labores acatara todas las ordenes que reciba de sus superiores y las
                    contenidas en cualquier circular o disposición que dicte “EL PATRON” en cumplimiento a las obligaciones que
                    le impone la Ley Federal del Trabajo. En observación a las disposiciones del Reglamento interior de Trabajo.
                </td>
            </tr>
            <p></p>
            @if ($titulo == 'Contrato de 30 Dias')
                <tr style="font-size:12px;">   
                    <td style="text-align:justify;" colspan="3">
                        <div style="font-weight: bold; display: inline;">TERCERA. </div>Las partes acuerdan, que la duración del presente contrato será de <div style="font-weight: bold; display: inline;">30 DÍAS </div> como periodo de
                        prueba; empieza surtir sus efectos desde el día <div style="font-weight: bold; display: inline;">{{$fecha_inicio}};</div> y terminándose en consecuencia el
                        día <div style="font-weight: bold; display: inline;">{{$fecha_fin}}.</div>
                        Ambas partes convienen que al término del período de prueba para el cual “EL TRABAJADOR” fue
                        contratado, “EL PATRON” decidirá si satisface los requisitos necesarios para desarrollar las labores, tomando
                        en cuenta la opinión de la Comisión Mixta de Productividad, Capacitación y Adiestramiento en los términos de
                        la Ley Federal del Trabajo; de cumplirlos será contratado por tiempo indefinido y si no los cumple, al término
                        del tiempo convenido, se dará por terminada la relación de trabajo sin responsabilidad para “EL PATRON”.
                        “EL TRABAJADOR”, declara expresamente, de que se le está haciendo las explicaciones y aclaraciones de la
                        necesidad del periodo de prueba expuesta por “EL PATRON”; igualmente expresa su absoluta conformidad de
                        prestar sus servicios por tiempo de prueba.
                        Las partes acuerdan y el trabajador declara expresamente que acepta: que llegado el término determinado en
                        la cláusula anterior, el presente contrato y la relación SE DARÁ POR TERMINADA, de acuerdo a lo dispuesto
                        por el Artículo 53 Fracc III de la Ley. Y que por lo mismo a su terminación el trabajador únicamente recibirá el
                        importe de sus derechos adquiridos y que se mencionan en este contrato, en la parte proporcional al tiempo
                        determinado en este documento; sin que el patrón tenga obligación alguna de pagar cantidad por concepto de
                        indemnización, ya que se repite, se estará en caso de TERMINACIÓN conforme a lo ordenado por la Ley, en
                        los preceptos que se han mencionado
                    </td>
                </tr>
            @else
                <tr style="font-size:12px;">   
                    <td style="text-align:justify;" colspan="3">
                        <div style="font-weight: bold; display: inline;">TERCERA. </div>
                        Las partes acuerdan, que la duración del presente contrato por <div style="font-weight: bold; display: inline;">TIEMPO INDEFINIDO</div>; empieza a
                        surtir sus efectos desde el día <div style="font-weight: bold; display: inline;">{{$fecha_indefinida}}.</div>
                    </td>
                </tr>
            @endif
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">CUARTA.</div> El lugar de la prestación de los servicios de “EL TRABAJADOR” será el domicilio del patrón. Las
                    partes acuerdan y aceptan el trabajador que cuando por razones administrativas o de desarrollo de la
                    actividad o prestación de servicios contratados, se tenga la necesidad de removerlo, deberá el trabajador
                    trasladarse al lugar que el patrón le asigne, siempre y cuando no se vea menoscabado su salario. “EL
                    PATRON”, le comunicará con anticipación el cambio del lugar de prestación de servicios indicando el nuevo
                    asignado. Para el caso de que el nuevo lugar de prestación de servicios “EL TRABAJADOR”, variara el
                    horario del trabajo, “EL TRABAJADOR” expresamente acepta allanarse a esta modalidad.
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">QUINTA.</div> “EL TRABAJADOR” desarrollará las siguientes funciones que en forma enunciativa y no limitativa
                    se señala a continuación. Acordando “EL PATRON” y “EL TRABAJADOR” que además de las funciones que
                    se listan en esta cláusula, “EL TRABAJADOR” deberá desempeñar las labores y funciones que se detallan en
                    el análisis y descripción de puestos, que “EL PATRON” ha elaborado para el puesto que el trabajador está
                    contratando; agregado al presente contrato como anexo uno: 
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px">   
                @if ($empleado->puesto == 'PRODUCCION')
                <td style="text-align:left;" colspan="3">
                    <div style="font-weight: bold; display: inline;">ACTIVIDADES:</div>
                    <p></p>
                    1. Realizar inventarios diariamente
                    <br>
                    2. Preparación de alimentos en base al programa diario
                    <br>
                    3. Recepción, acomodo y almacenamiento de insumos
                    <br>
                    4. Realizar y coordinar comida de empleados
                    <br>
                    5. Hacer pedidos de emergencia
                    <br>
                    6. Lavar y mantener conforme a normativa los refrigeradores y congeladores
                    <br>
                    7. Lavar trastes estufa, piso, paredes, repisas, mesas y área de wash
                    <br>
                    8. Asistir o ayudar en preparación y ensamble de platillos
                    <br>
                    9. Revisar el reporte de nivel de Gas y hacer el pedido
                    <br>
                    10. Registrar la temperatura de refrigeradores
                    <br>
                </td>
                @elseif (($empleado->puesto == 'MESERO') || ($empleado->puesto == 'SERVICIO') || ($empleado->puesto == 'SERVICIO MIXTO'))
                <td style="text-align:left;" colspan="3">
                    <div style="font-weight: bold; display: inline;">ACTIVIDADES:</div>
                    <p></p>
                    1.Servicio al cliente
                    <br>
                    2.Recepción de pago de cuentas
                    <br>
                    3.Asistir o ayudar el bar o cocina cuando sea necesario
                    <br>
                    4.Almacenar los insumos del área cuando indique su jefe inmediato
                    <br>
                    5.Colocar salseras llenas y limpias en estaciones
                    <br>
                    6.Completar canastas de servicio
                    <br>
                    7.Comprobar y mantener la limpieza de mesas y piso
                    <br>
                    8.Registrar y preparar reservaciones
                    <br>
                    9.Dar mantenimiento a plantas y regarlas
                    <br>
                    10.Inventariar insumo de área
                    <br>
                    11.Lavar baños, barriendo y trapeando el 2do piso, así como las escaleras
                    <br>
                    12.Toma de órdenes para llevar
                    <br>
                    13.Montar y desmontar mesas para el servicio
                    <br>
                    14.Informar a un superior sobre dudas o quejas de los clientes
                    <br>
                    15.Contestar el teléfono y canalizar las llamadas de proveedores al área correspondiente
                    <br>
                    16.Completar el programa de limpieza diaria
                    <br>
                    17.Capacitar al personal de nuevo ingreso siguiendo las guías de capacitación
                    <br>
                </td>
                @elseif ($empleado->puesto == 'COCINERO')
                <td style="text-align:left;" colspan="3">
                    <div style="font-weight: bold; display: inline;">ACTIVIDADES:</div>
                    <p></p>
                    1.Preparación y ensamble de platillos en base a receta
                    <br>
                    2.Completar stocks de la línea al inicio y cierre de acuerdo al checklist y Peps
                    <br>
                    3.Hacer las mease and pleace de acuerdo a cada línea
                    <br>
                    4.Limpiar superficie, piso y paredes todo el día
                    <br>
                    5.Limpieza profunda semanal
                    <br>
                    6.Recepción y almacenamiento de insumos
                    <br>
                    7.Limpiar cocina al cierre y completar montaje
                    <br>
                    8.Realización de Inventarios de insumos, utensilios y vajillas
                    <br>
                    9.Ayudar en los procesos de producción
                    <br>
                    10.Ayudar en el lavado de trastes cuando se requiera
                    <br>
                    11.Registrar temperaturas
                    <br>
                    12.Capacitar al personal de nuevo ingreso
                    <br>
                </td>
                @elseif ($empleado->puesto == 'BARISTA')
                <td style="text-align:left;" colspan="3">
                    <div style="font-weight: bold; display: inline;">ACTIVIDADES:</div>
                    <p></p>
                    1.Preparación de bebidas
                    <br>
                    2.Realizar los stocks de concentrados para bebidas
                    <br>
                    3.Lavar toda la cristalería que se utiliza para las bebidas
                    <br>
                    4.Sacudir, barrer y trapear todo el área de trabajo y realizar programa de limpieza semanal
                    <br>
                    5.Cobrar cuentas, cuando se requiera
                    <br>
                    6.Acomodar Insumos y hacer los Inventarios
                    <br>
                    7.Atender el teléfono
                    <br>
                </td>
                @endif
            </tr>
            <p></p>
            @if ($titulo == 'Contrato de 30 Dias')
                <tr style="font-size:12px;">   
                    @if ($empleado->puesto == 'PRODUCCION')
                    <td style="text-align:left;" colspan="3">
                        <div style="font-weight: bold; display: inline;">RESPONSABILIDADES:</div>
                        <br>
                        Realizar el programa de producción garantizando el cumplimiento del sistema de trabajo:
                        <p></p>
                        1.HIGIENE DE TODAS LAS AREAS DE TRABAJO
                        <br>
                        2.SEGURIDAD DE LOS ALIMENTOS BAJO LAS NORMAS ESTABLECIDAS
                        <br>
                        3.EFICIENCIA PARA CUMPLIR CON EL TIEMPO DE ETREGA DE LOS PLATILLOS
                        <br>
                        4.CALIDAD DE LOS PLATILLOS BASADOS EN LAS RECETAS
                        <br>
                        5.CUIDADO DE LOS UTENCILIOS, VAJILLAS, EQUIPOS E INSUMOS
                        <br>
                    </td>
                    @elseif (($empleado->puesto == 'MESERO') || ($empleado->puesto == 'SERVICIO') || ($empleado->puesto == 'SERVICIO MIXTO'))
                    <td style="text-align:left;" colspan="3">
                        <div style="font-weight: bold; display: inline;">RESPONSABILIDADES:</div>
                        <br>
                        Servicio a la mesa garantizando:
                        <p></p>
                        1. CALIDAD EN EL SERVICIO
                        Comodidad, confianza Y seguridad del CLIENTE
                        <br>
                        2. CUIDADO
                        CONSERVACION y buen uso de mobiliario y equipo de trabajo
                        <br>
                        3. HIGINENE
                        Instalaciones, mobiliario, utensilios y personal
                        <br>
                        4. EFICIENCIA
                        <br>
                        5. SEGURIDAD ALIMENTARIA
                        <br>
                    </td>
                    @elseif ($empleado->puesto == 'COCINERO')
                    <td style="text-align:left;" colspan="3">
                        <div style="font-weight: bold; display: inline;">RESPONSABILIDADES:</div>
                        <p></p>
                        1.HIGIENE DE TODAS LAS AREAS DE TRABAJO
                        <br>
                        2.SEGURIDAD DE LOS ALIMENTOS BAJO LAS NORMAS ESTABLECIDAS
                        <br>
                        3.EFICIENCIA PARA CUMPLIR CON EL TIEMPO DE ETREGA DE LOS PLATILLOS
                        <br>
                        4.CALIDAD DE LOS PLATILLOS BASADOS EN LAS RECETAS
                        <br>
                        5.CUIDADO DE LOS UTENCILIOS, VAJILLAS, EQUIPOS E INSUMOS
                        <br>
                    </td>
                    @elseif ($empleado->puesto == 'BARISTA')
                    <td style="text-align:left;" colspan="3">
                        <div style="font-weight: bold; display: inline;">RESPONSABILIDADES:</div>
                        <p></p>
                        1.HIGIENE DE TODAS LAS AREAS DE TRABAJO
                        <br>
                        2.SEGURIDAD DE LOS ALIMENTOS BAJO LAS NORMAS ESTABLECIDAS
                        <br>
                        3.EFICIENCIA PARA CUMPLIR CON EL TIEMPO DE ETREGA DE LOS PLATILLOS
                        <br>
                        4.CALIDAD DE LOS PLATILLOS BASADOS EN LAS RECETAS
                        <br>
                        5.CUIDADO DE LOS UTENCILIOS, VAJILLAS, EQUIPOS E INSUMOS
                        <br>
                    </td>
                    @endif
                </tr>
            @else
                <tr style="font-size:12px;">   
                    @if ($empleado->puesto == 'PRODUCCION')
                    <td style="text-align:left;" colspan="3">
                        <div style="font-weight: bold; display: inline;">RESPONSABILIDADES:</div>
                        <br>
                        Realizar el programa de producción garantizando el cumplimiento del sistema de trabajo:
                        <p></p>
                        1. HIGIENE
                        <br>
                        2. SEGURIDAD ALIMENTARIA
                        <br>
                        3. CALIDAD
                        <br>
                        4. CUIDADO (Conservación de equipo de trabajo y trabajar bajo gestión 5´S)
                        <br>
                        5. EFICIENCIA Realizar y coordinar comida de empleados
                        <br>
                    </td>
                    @elseif (($empleado->puesto == 'MESERO') || ($empleado->puesto == 'SERVICIO') || ($empleado->puesto == 'SERVICIO MIXTO'))
                    <td style="text-align:left;" colspan="3">
                        <div style="font-weight: bold; display: inline;">RESPONSABILIDADES:</div>
                        <p></p>
                        1.HIGIENE DE TODAS LAS AREAS DE TRABAJO
                        <br>
                        2.SEGURIDAD DE LOS ALIMENTOS BAJO LAS NORMAS ESTABLECIDAS
                        <br>
                        3.EFICIENCIA PARA CUMPLIR CON EL TIEMPO DE ENTREGA DE LOS PLATILLOS
                        <br>
                        4.CALIDAD EN EL SERVICIO AL CLIENTE QUE GENERE SEGURIDAD
                        <br>
                        5.CUIDADO DE LOS UTENCILIOS, VAJILLAS, EQUIPOS E INSUMOS
                        <br>
                    </td>
                    @elseif ($empleado->puesto == 'COCINERO')
                    <td style="text-align:left;" colspan="3">
                        <div style="font-weight: bold; display: inline;">RESPONSABILIDADES:</div>
                        <p></p>
                        1.HIGIENE DE TODAS LAS AREAS DE TRABAJO
                        <br>
                        2.SEGURIDAD DE LOS ALIMENTOS BAJO LAS NORMAS ESTABLECIDAS
                        <br>
                        3.EFICIENCIA PARA CUMPLIR CON EL TIEMPO DE ENTREGA DE LOS PLATILLOS
                        <br>
                        4.CALIDAD DE LOS PLATILLOS BASADOS EN LAS RECETAS
                        <br>
                        5.CUIDADO DE LOS UTENCILIOS, VAJILLAS, EQUIPOS E INSUMOS
                        <br>
                    </td>
                    @elseif ($empleado->puesto == 'BARISTA')
                    <td style="text-align:left;" colspan="3">
                        <div style="font-weight: bold; display: inline;">RESPONSABILIDADES:</div>
                        <p></p>
                        1.HIGIENE DE TODAS LAS AREAS DE TRABAJO
                        <br>
                        2.SEGURIDAD DE LOS ALIMENTOS BAJO LAS NORMAS ESTABLECIDAS
                        <br>
                        3.EFICIENCIA PARA CUMPLIR CON EL TIEMPO DE ENTREGA DE LOS PLATILLOS
                        <br>
                        4.CALIDAD DE LOS PLATILLOS BASADOS EN LAS RECETAS
                        <br>
                        5.CUIDADO DE LOS UTENCILIOS, VAJILLAS, EQUIPOS E INSUMOS
                        <br>
                    </td>
                    @endif
                </tr>
            @endif
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    Estableciéndose que de acuerdo al anexo número uno de este contrato que en el mismo se mencionan los
                    jefes inmediatos y/o mediatos que tendrá el trabajo en el desempeño de sus labores.
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">SEXTA.</div> La duración de la jornada de trabajo será de <div style="font-weight: bold; display: inline;">6 seis horas diarias </div>en la jornada diurna o vespertina,
                    o jornada mixta de <div style="font-weight: bold; display: inline;">8 horas</div>, cuando se le requiera. En consecuencia la jornada de trabajo es continua por lo
                    que se proporcionará al trabajo en <div style="font-weight: bold; display: inline;">las jornadas de 6 horas, 15 quince minutos de descanso </div>de
                    conformidad al dispuesto por la Ley. En forma expresa se obliga el trabajador a prestar sus servicios en
                    cualquiera de los tres turnos que tienen o establezca el patrón de acuerdo a las necesidades de la empresa;
                    obligándose el trabajador a rolar turnos en la forma que le indique el patrón; el patrón notificar al trabajador la
                    asignación o modificación de horarios de trabajo.
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">SEPTIMA.</div> Por cada seis días de trabajo, tendrá el trabajador un descanso semanal de un día con pago de
                    salario; el mismo lo disfrutará un día de lunes a viernes de cada semana, pudiendo variar éste de acuerdo a
                    las necesidades del patrón; en este caso se le dará aviso al trabajador. También el trabajador disfrutará como
                    días de descanso los señalados en el Artículo 74 de la Ley: 1º de Enero, Primer lunes de febrero en
                    conmemoración del 5 de febrero, Tercer lunes de marzo en conmemoración del 21 de Marzo, 1º de Mayo, 16
                    de Septiembre, Tercer lunes de Noviembre en conmemoración del 20 de noviembre, 1º de Diciembre de cada
                    seis años, cuando corresponda la transmisión del Poder Ejecutivo Federal, el 25 de diciembre. El trabajador
                    en los días de descanso obligatorios señalados, deberá trabajarlos cuando se lo solicite el patrón,
                    pagándosele un salario doble como lo dispone el Artículo 75 de la Ley.                    
                </td>
            </tr>
            <p></p>
            @if (!($empleado->puesto == 'MESERO') && !($empleado->puesto == 'SERVICIO') && !($empleado->puesto == 'SERVICIO MIXTO'))
                <tr style="font-size:12px;">   
                    <td style="text-align:justify;" colspan="3">
                        <div style="font-weight: bold; display: inline;">OCTAVA.</div> El trabajador percibirá por la prestación de los servicios, como salario la cantidad de 
                        <div style="font-weight: bold; display: inline;">$ {{$empleado->quincena}} POR QUINCENA</div>, salario que se le pagará los días 15 y 30 o 31 de la quincena laboral vencida, mediante el
                        sistema de pago vía transferencia electrónica bancaria o efectivo; estando obligado el trabajador a firmar las
                        constancias de pago respectivos; teniéndose en cuenta lo dispuesto en los Artículos 101, 108 y 109 de la Ley
                        y sometiéndose el trabajador a los descuentos que deban hacerse por orden expresa de la ley del seguro
                        social y de la ley del impuesto sobre la renta.                                   
                    </td>
                </tr>
                <p></p>
            @endif
        </table>
    </tr>
    <tr>
        <table style="margin-left:auto;margin-top:10px; margin-right:auto;width:680px;border-collapse:collapse;">
            <p></p>
            @if (($empleado->puesto == 'MESERO') || ($empleado->puesto == 'SERVICIO') || ($empleado->puesto == 'SERVICIO MIXTO'))
                <tr style="font-size:12px;">   
                    <td style="text-align:justify;" colspan="3">
                        <div style="font-weight: bold; display: inline;">OCTAVA.</div> El trabajador percibirá por la prestación de los servicios, como salario la cantidad de 
                        <div style="font-weight: bold; display: inline;">$ {{$empleado->quincena}} POR QUINCENA</div>, salario que se le pagará los días 15 y 30 o 31 de la quincena laboral vencida, mediante el
                        sistema de pago vía transferencia electrónica bancaria o efectivo; estando obligado el trabajador a firmar las
                        constancias de pago respectivos; teniéndose en cuenta lo dispuesto en los Artículos 101, 108 y 109 de la Ley
                        y sometiéndose el trabajador a los descuentos que deban hacerse por orden expresa de la ley del seguro
                        social y de la ley del impuesto sobre la renta.                                   
                    </td>
                </tr>
            @endif
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">NOVENA.</div> El trabajador se obliga a checar su tarjeta y firmar las listas de asistencia a la entrada y salida de
                    sus labores; igualmente se obliga a cumplir con las disposiciones que se contienen para el desempeño de su
                    trabajo en el Reglamento Interior de la empresa.                                                    
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">DÉCIMA.</div> El trabajador se obliga a someterse a los reconocimientos y exámenes médicos que periódicamente
                    establezca el patrón en los términos del Artículo 134 Fracción XX de la Ley; el médico que practique los
                    exámenes será designado por el patrón.                                                                   
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">DÉCIMA PRIMERA.</div> El trabajador tendrá la obligación y deberá integrarse a los planes y programas de
                    capacitación y adiestramiento así como a los de Seguridad e Higiene en el trabajo que establezca el patrón en
                    los términos de la Ley; igualmente deberá integrarse a las Comisiones Mixtas de capacitación y
                    Adiestramiento y de Seguridad e Higiene en el trabajo, tomando parte activa de los mismos según los cursos
                    establecidos y de acuerdo a las medidas preventivas de riesgos de trabajo.                                                                                     
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">DÉCIMA SEGUNDA.</div> El trabajador se obliga dar fiel cumplimiento a las disposiciones dispuestas en el Artículo
                    134 de la Ley que son: sus obligaciones en el desempeño de sus labores al servicio del patrón.                                                                                
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">DÉCIMA TERCERA.</div> Las partes acuerdan que todo lo no previsto en el presente contrato: se estará a lo
                    dispuesto por la Ley.
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    Leído que les fue a las partes comparecientes, y enterados de su alcance y consecuencias legales, lo ratifican
                    en todo una de sus partes ante la presencia de dos testigos hábiles para testificar y sin tachas legales.                    
                </td>
            </tr>
            <p></p>
            <tr style="font-size:12px;">   
                <td style="text-align:justify;" colspan="3">
                    El presente contrato individual de trabajo, se firma en este día
                    <div style="font-weight: bold; display: inline;">{{$fechaActual}} EN LA CIUDAD DE GUADALAJARA, JALISCO.</div>
                </td>
            </tr>
            <p></p>
        </table>
    </tr>
    <p></p>
    <tr>
        <table style="margin-left:auto;margin-top:10px; margin-right:auto;width:670px;border-collapse:collapse;font-size:10px">
            <tr style="font-weight: bold;">
                <td style="border-bottom:0.5px solid black;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="border-bottom:0.5px solid black;"></td>
            </tr>
            <tr style="font-weight: bold;">
                <td style="width:30%;text-align:center">PATRÓN DE LA EMPRESA</td>
                <td></td>
                <td></td>
                <td></td>
                <td style="width:30%;text-align:center">TRABAJADOR(A)</td>
            </tr>
            <tr style="font-weight: bold;">
                <td style="text-align: center">LUIS SANCHEZ DE LA VEGA CASTELLANOS</td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;text-transform:uppercase">{{$empleado->nombre}}</td>
            </tr>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <tr style="font-weight: bold;">
                <td style="border-bottom:0.5px solid black;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="border-bottom:0.5px solid black;"></td>
            </tr>
            <tr style="font-weight: bold;text-transform:uppercase">
                <td style="width:30%;text-align:center">Testigo 1</td>
                <td></td>
                <td></td>
                <td></td>
                <td style="width:30%;text-align:center">Testigo 2 </td>
            </tr>
        </table>
    </tr>
    @if (!($empleado->puesto == 'MESERO') && !($empleado->puesto == 'SERVICIO') && !($empleado->puesto == 'SERVICIO MIXTO'))
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
    @else
        <p></p>
    @endif
    <tr>
        <p></p>
        <table style="margin-left:auto; margin-right:auto; width:660px">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td style="text-align:left;">
                    <img style="margin-right: 100px" src="{{ public_path('assets/tokyoLogo.png') }}" width="80" height="80"> 
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <p></p>
        <table style="margin-left:auto;margin-top:10px; margin-right:auto;width:680px;border-collapse:collapse;">
            <tr>
                <th style="font-size:12;text-align:center;" colspan="3">RECIBO DEL REGLAMENTO DE SEGURIDAD E HIGIENE</th>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">RECIBÍ:</div> de <div style="font-weight: bold; display: inline;">“LUIS SANCHEZ DE LA VEGA CASTELLANOS”</div>, un ejemplar del reglamento de Higiene y Seguridad con instrucciones para prestar primero auxilios; y de <div style="font-weight: bold; display: inline;"> LOS CUALES RECIBO EJEMPLAR.</div> Los cuales me obligo a cumplirlos fielmente, ya que son bases para protección de mi vida y de mi salud. Se me ha explicado y se me hacen saber sus alcances y consecuencias legales, incluso para los casos que no les dé cabal y cumplido cumplimiento, los cuales son obligatorios como normas patronales, de conformidad a lo ordenado, por los artículos 47 fracción XII, 134 fracciones II, III, X y XI ambos de la Ley Federal de Trabajo.
                </td>
            </tr>
            <p></p>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    Nombre del trabajador: {{$empleado->nombre}}.
                    <br>
                    Fecha: {{$fechaActual}}.
                    <br>
                    Entregó: Departamento de Recursos Humanos.
                    <p></p>
                    Recibí de conformidad, los documento mencionados:
                    <p></p>
                </td>
            </tr>
            <p></p>
            <p></p>
            <tr style="font-weight: bold;">
                <td style="border-bottom:0.5px solid black;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-weight: bold;font-size:12px;">
                <td style="text-align:center"> FIRMA TRABAJADOR(A)</td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-weight: bold;font-size:12px;">
                <td style="text-align: center;text-transform:uppercase">{{$empleado->nombre}}</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </tr>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <tr>
        <p></p>
        <table style="margin-left:auto; margin-right:auto; width:660px">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td style="text-align:left;">
                    <img style="margin-right: 100px" src="{{ public_path('assets/tokyoLogo.png') }}" width="80" height="80"> 
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table style="margin-left:auto;margin-right:auto;width:680px;border-collapse:collapse;">
            <tr>
                <th style="font-size:12;text-align:center;" colspan="3">RECIBO DE REGLAMENTO INTERIOR DE TRABAJO</th>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">RECIBÍ:</div> de <div style="font-weight: bold; display: inline;">“LUIS SANCHEZ DE LA VEGA CASTELLANOS”</div>, por conducto del Departamento de Recursos Humanos, <div style="font-weight: bold; display: inline;">REGLAMENTO INTERIOR DE TRABAJO Y CODIGO DE CONDUCTA</div>, vigente y que es obligatorio para todo los que trabajamos en esta empresa. Comprometiéndome a cumplirlo; y declaro expresamente, que se me ha explicado su contenido sus alcances y consecuencia legales, incluyendo para el caso de no cumplirlo y así como los elementos técnicos para el desempeño de los trabajos que tengo que ejecutar. Me obligo a cumplirlo y respetarlo de conformidad a lo ordenado por los artículos 422 y 423 de la Ley Federal de Trabajo. Por lo que acepto y reconozco que <div style="font-weight: bold; display: inline;">“LUIS SANCHEZ DE LA VEGA CASTELLANOS”</div>, está cumpliendo su obligación de darle publicidad; y lo recibo de conformidad el ejemplar del reglamento, conociendo el texto del mismo.
                </td>
            </tr>
            <p></p>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    Nombre del trabajador: {{$empleado->nombre}}.
                    <br>
                    Fecha: {{$fechaActual}}.
                    <p></p>
                    Recibí de conformidad.
                    <p></p>
                </td>
            </tr>
            <p></p>
            <p></p>
            <tr style="font-weight: bold;">
                <td style="border-bottom:0.5px solid black;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-weight: bold;font-size:12px;">
                <td style="text-align:center"> FIRMA TRABAJADOR(A)</td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-weight: bold;font-size:12px;">
                <td style="text-align: center;text-transform:uppercase">{{$empleado->nombre}}</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </tr>
    <tr>
        <p></p>
        <table style="margin-left:auto; margin-right:auto; width:660px">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td style="text-align:left;">
                    <img style="margin-right: 100px" src="{{ public_path('assets/tokyoLogo.png') }}" width="80" height="80"> 
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <p></p>
        <table style="margin-left:auto;margin-top:10px; margin-right:auto;width:680px;border-collapse:collapse;">
            <tr>
                <th style="font-size:12;text-align:center;" colspan="3">CONDICIONES LABORALES</th>
            </tr>
            <p></p>
            <tr>
                <td style="font-size:10;text-align:center;font-weight: bold" colspan="3">{{$empleado->puesto}}</td>
            </tr>
            <p></p>
            <tr>
                <td style="font-size:10;text-align:left;font-weight: bold;border-bottom:1px solid rgb(23, 23, 204);" colspan="3">Sueldo ${{$empleado->quincena * 2}} Mensual.</td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">Se extenderán 3 contratos </div> de prueba por 30 días.
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    Para renovación de contrato se evaluará desempeño. En caso de tener faltas injustificadas durante el periodo de los primeros tres meses o falta al reglamento será causa suficiente para NO renovar contrato.
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">Forma de pago</div>
                    <p></p>
                    * El pago será quincenal los días 15, 30 o 31 con pago en efectivo o tarjeta según se indique
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">Horario</div>
                    <p></p>
                    * Lunes a sábados diurno 6:00 am a 12:00 pm. El horario se extenderá o cambiará según las necesidades del restaurante, se avisará con anticipación
                    <br>
                    * Domingos de 2:00 pm a 8:00 pm
                    <br>
                    * Descanso los {{$empleado->descanso}}
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">Prestaciones de Ley:</div>
                    <p></p>
                    * IMMS / INFONAVIT
                    <br>
                    * 15 días de aguinaldo x año cumplido
                    <br>
                    * 12 días de vacaciones el primer año, con opción a tomar los primeros 6 días después de los 6 meses cumplidos
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">Prestaciones adicionales:</div>
                    <p></p>
                    * Servicio de comedor por $150 pesos quincenales
                    <br>
                    * Descuento del 20% en el restaurante
                    <br>
                    * Apoyo a transporte en el turno de la noche o para gasolina en caso de contar con transporte propio
                    <br>
                    * Si eres padre o madre no trabajas en tu día y es con goce de sueldo
                    <br>
                    * El día de tu cumpleaños es ausencia con goce de sueldo
                    <br>
                    * Propinas semanales
                </td>
            </tr>
        </table>
    </tr>
    <tr>
        <table style="margin-left:auto;margin-top:10px; margin-right:auto;width:680px;border-collapse:collapse;">
            <b style="font-size: 18px">Beneficios</b>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">COMPENSACIONES VARIABLES</div>
                    <p></p>
                    * Es mediante los objetivos que se establecen para el cumplimiento del sistema de trabajo
                    <br>
                    * Tiempo extra
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">BALANCE DE VIDA PERSONAL Y LABORAL</div>
                    <p></p>
                    1. Ofrecemos horarios que te permiten tener un equilibrio y realizar otras actividades personales o incluso tener otro trabajo
                    <br>
                    (Horario 12pm a 6pm / Domingos de 12 pm a 8 pm con un día de descanso)
                    <br>
                    2. Un ambiente laboral de respeto y servicio
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">DESARROLLO DE PERSONAS</div>
                    <p></p>
                    3. Tenemos un sistema de trabajo que permite la autogestión de tus funciones y profesionalización para la mejora continúa (Desarrollas mayor responsabilidad)
                    <br>
                    4. Nuestro sistema de capacitación está enfocado en que tu aprendizaje sea entendiendo los objetivos
                    <br>
                    5. Impartimos talleres 3 veces al año para ayudarte a desarrollar habilidades sociales y de liderazgo
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">RECONOCIMIENTO</div>
                    <p></p>
                    6. Una manera de reconocer tu trabajo es mediante la evaluación que nos permite trabajar tus fortalezas y mejorar áreas de oportunidad, para que aspires a promociones y mejores salarios.  
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    <div style="font-weight: bold; display: inline;">Causas de recisión de contrato</div>
                    <p></p>
                    * Cometer alguna falta estipulada dentro del reglamento interior de trabajo y de nuestro código de conducta
                    <br>
                    * Divulgación o falta de discreción respecto al manejo y formas de trabajo de Little Tokyo
                    <br>
                    * Divulgar o comentar los sueldos recibidos
                </td>
            </tr>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    En virtud de que conozco y me han explicado las condiciones laborales que Little Tokyo ofrece, acepto de conformidad y mutuo acuerdo, sin resistencia alguna y comprometido a cumplir con mis responsabilidades en el puesto que se me asigne.
                </td>
            </tr>
            <p></p>
            <p></p>
            <tr style="font-weight: bold;">
                <td style="border-bottom:0.5px solid black;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-weight: bold;font-size:12px;">
                <td style="text-align:center"> FIRMA TRABAJADOR(A)</td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-weight: bold;font-size:12px;">
                <td style="text-align: center;text-transform:uppercase">{{$empleado->nombre}}</td>
                <td></td>
                <td></td>
            </tr>
            <p></p>
            <p></p>
            <tr style="font-size:14px;">   
                <td style="text-align:justify;" colspan="3">
                    Fecha: {{$fechaActual}}.
                </td>
            </tr>
        </table>
    </tr>
</table>
</body>

</html>
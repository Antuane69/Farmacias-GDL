<x-correos-layout>

    @section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        .header {
            max-width: 80rem; /* Equivalente a max-w-7xl en tailwindcss */
            margin-right: auto;
            margin-left: auto;
            padding-top: 1.5rem; /* Ajusta según tus necesidades */
            padding-right: 1rem; /* Ajusta según tus necesidades */
            padding-bottom: 1.5rem; /* Ajusta según tus necesidades */
            padding-left: 1rem; /* Ajusta según tus necesidades */
            width: auto;
        }

        .container {
            padding-top: 3rem;
            max-width: 65rem;
            max-height: 80rem;
            margin: 0 auto;
            width: auto;
        }

        .main-box {
            background-color: #fff;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.15);
            margin-left: 4rem; /* Equivalent to ml-36 */
            width: 70%;
        }

        .header-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 2rem;
            margin-top: 2rem;
            margin-right: 1.5rem;
            text-align: center;
            margin: 0 auto;
            align-items: center;
            width: 100%;
        }

        .header-section > div {
            margin-bottom: 2rem;
        }

        .title-label {
            color: #556575;
            font-weight: bold;
            font-size: 1.5rem;
            /* text-transform: uppercase; */
            margin-bottom: 1rem;
            width: 100%;
            margin-top: 1rem;
            
        }

        .content-section {
            margin-left: 1.5rem;
            margin-right: 1.5rem;
            margin-bottom: -40px;
        }

        .content-paragraph {
            text-align: justify;
            font-size: 1rem;
            color: #6B7280;
            margin-bottom: 1.5rem;
        }

        .data-table {
            background-color: #fff;
            border-radius: 0.5rem;
            padding: 1rem;
            width: 100%;
        }

        .table th,
        .table td {
            text-align: center;
            border: 1px solid #383838;
            border-bottom: 1px solid #383838;
            padding: 0.5rem 1rem;
        }

        .table th {
            background-color: #2e934f;
            color: #FFFFFF;
        }

        .footer-section {
            margin-top: 3rem;
        }

        .footer-text {
            text-align: justify;
            margin-bottom: 2rem;
        }

        .footer-images {
            display: flex;
            flex-direction: column;
            margin-top: 2rem;
            margin-left: 2rem;
        }

        .footer-images a {
            margin-bottom: 3rem;
        }

        .footer-images img {
            border-radius: 0.5rem;
            transition: box-shadow 0.2s ease-in-out;
        }

        .footer-images img:last-child {
            margin-top: 2rem;
            margin-left: 120px;
        }

    </style>
    @endsection

    <div class="container">
        <div class="main-box">
            <div class="header-section w-full">
                <p style="text-align:center" class="title-label">
                    Evaluación Little Tokyo de {{$solicitud}}
                </p>
            </div>
            <div>
                <div class="content-section">
                    <div>
                        <a>
                            <img class="rounded-md md w-2/3 hover:w-10 transition-shadow" src="{{ $message->embed(public_path('assets/tokyoLogo.png')) }}" style="width: 150px; height: 150px;">
                        </a>                          
                    </div>
                    <p class="content-paragraph">
                        Te he invitado a que rellenes un formulario:
                    </p>
                    <p class="content-paragraph">
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfNaWRUMrr5YArbfSmkfodYOyy0j1ir6GekqzGxyCwisuMjaw/viewform?vc=0&amp;c=0&amp;w=1&amp;flr=0&amp;usp=mail_form_link" style="color:rgb(34,105,74);text-decoration:none;vertical-align:middle;font-weight:500" target="_blank">ACTITUDES BASICO</a>
                    </p>
                    <p class="content-paragraph">
                        <form action="https://docs.google.com/forms/u/0/d/e/1FAIpQLSfNaWRUMrr5YArbfSmkfodYOyy0j1ir6GekqzGxyCwisuMjaw/formResponse" method="POST" id="m_9045310091122224635ss-form" target="_blank"><ol role="list" style="padding-left:0;list-style-type:none">

                            <div role="listitem">
                            <div dir="auto" style="margin:12px 0"><div style="margin-bottom:1.5em;vertical-align:middle;margin-left:0;margin-top:0;max-width:100%"><label for="m_9045310091122224635entry_366340186"><div style="display:block;font-weight:bold;margin-top:.83em;margin-bottom:.83em">
                            <label for="m_9045310091122224635itemView.getDomIdToLabel()" aria-label="(Campo obligatorio)">* Campo Obligatorio</label>
                            </div>
                            <div dir="auto" style="display:block;margin:.1em 0 .25em 0;color:#666"></div>

                            <select name="entry.366340186" id="m_9045310091122224635entry_366340186" aria-label="  " aria-required="true"><option value=""></option>
                            <option value="{{$solicitud}}" selected>{{$solicitud}}</option></select>
                            </div></div></div>
                            <input type="hidden" name="partialResponse" value="[null,null,&quot;-1097819217520286780&quot;]">
                            <input type="hidden" name="pageHistory" value="0">
                            
                            <input type="hidden" name="usp" value="mail_form_submit">
                            <input type="hidden" name="fbzx" value="-1097819217520286780">
                            
                            <div style="margin:12px 0"><table id="m_9045310091122224635navigation-table"><tbody><tr><td id="m_9045310091122224635navigation-buttons" dir="ltr" style="margin-bottom:1.5em;vertical-align:middle;margin-left:0;margin-top:0;max-width:100%;display:inline-block">
                            <input style="margin-top: 10px;font-weight:bold;color:#0369a1" type="submit" name="continue" value="Continuar >>" id="m_9045310091122224635ss-submit"></td>
                            </tr></tbody></table></div></ol></form>
                    </p>
                </div>
                <div class="footer-section">
                    <div class="content-section">
                        <p class="content-paragraph">
                            Quedamos a sus órdenes para cualquier pregunta, solicitud o comentario que pueda tener. 
                        </p>
                        <p class="content-paragraph">
                            Little Tokyo. <br> 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</x-correos-layout>
                    
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
                    
<!-- start -->
<div class="content-wrapper theme-3">

    <section class="content">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="tab-pane active" id="timeline">
                    <ul class="timeline">

                        <li class="time-label">
                            <span class="bg-azul"> Mis logros</span>
                        </li>

                        <li>
                            <i class="fa fa-rocket bg-azul text-white"></i>
                            <div class="timeline-item">
                                <span class="time text-azuld txt-20"><i class="fa fa-star"></i></span>
                                <h3 class="timeline-header text-azuld txt-20"><b>¡Despegamos!</b></h3>
                                <div class="timeline-body txt-15 text-black">
                                    Logro por unirte a la plataforma.
                                </div>
                            </div>
                        </li>

                        <!-- Logros por leer lecturas (system) -->
                        <?php
                        if(!empty($logros)){
                            if($logros->total_lecturas > 0){
                                echo "
                                <li class=\"time-label\">
                                    <span class=\"bg-aqua\"> Lector</span>
                                </li>

                                <li>
                                    <i class=\"fa fa-file-text bg-aqua\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-aqua txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-aqua\">Principiante</a> 
                                            ¡Has completado tu primer lectura!
                                        </h3>
                                    </div>
                                </li>";
                            }
                            if($logros->total_lecturas >= 5){
                                echo "
                                <li>
                                    <i class=\"fa fa-book bg-aqua\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-aqua txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-aqua\">¡Buen lector!</a> 
                                            ¡Has completado 5 lecturas!
                                        </h3>
                                    </div>
                                </li>";
                            }
                            if($logros->total_lecturas >= 10){
                                echo "
                                <li>
                                    <i class=\"fa fa-book bg-aqua\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-aqua txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-aqua\">¡Gran lector!</a> 
                                            ¡Has completado 10 lecturas!
                                        </h3>
                                    </div>
                                </li>";
                            }
                            if($logros->total_lecturas >= 20){
                                echo "
                                <li>
                                    <i class=\"fa fa-book bg-aqua\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-aqua txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-aqua\">¡Aficionado!</a> 
                                            ¡Has completado 20 lecturas!
                                        </h3>
                                    </div>
                                </li>";
                            }
                            if($logros->total_lecturas > 50){
                                echo "
                                <li>
                                    <i class=\"fa fa-book bg-aqua\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-aqua txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-aqua\">¡Veterano!</a> 
                                            ¡Has completado más de 50 lecturas!
                                        </h3>
                                    </div>
                                </li>";
                            }
                        }
                        ?>

                        <!-- Logros por aciertos correctos (system) -->
                        <?php
                        if(!empty($logros)){
                            if($logros->total_aciertos >= 10){
                                echo "
                                <li class=\"time-label\">
                                    <span class=\"bg-verde\"> Conocimiento</span>
                                </li>

                                <li>
                                    <i class=\"fa fa-file-text bg-verde\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-verde txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-verde\">Aprendiz</a> 
                                            Has contestado un total de 10 preguntas correctamente.
                                        </h3>
                                    </div>
                                </li>";
                            }
                            if($logros->total_aciertos >= 50){
                                echo "
                                <li>
                                    <i class=\"fa fa-file-text bg-verde\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-verde txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-verde\">Cerebro</a> 
                                            Has contestado un total de 50 preguntas correctamente.
                                        </h3>
                                    </div>
                                </li>";
                            }
                            if($logros->total_aciertos >= 80){
                                echo "
                                <li>
                                    <i class=\"fa fa-file-text bg-verde\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-verde txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-verde\">Maestro</a> 
                                            Has contestado un total de 80 preguntas correctamente.
                                        </h3>
                                    </div>
                                </li>";
                            }
                            if($logros->total_aciertos >= 100){
                                echo "
                                <li>
                                    <i class=\"fa fa-file-text bg-verde\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-verde txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-verde\">Sabelotodo</a> 
                                            Has contestado un total de 100 preguntas correctamente.
                                        </h3>
                                    </div>
                                </li>";
                            }
                            if($logros->total_aciertos > 500){
                                echo "
                                <li>
                                    <i class=\"fa fa-file-text bg-verde\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-verde txt-20\"><i class=\"fa fa-star\"></i></span>
                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-verde\">Sensei</a> 
                                            Has contestado más de 500 preguntas correctamente.
                                        </h3>
                                    </div>
                                </li>";
                            }
                        }
                        ?>

                        <!-- logros perzonalizados por el docente -->
                        <?php 
                        if(!empty($logrosStudent)){
                            echo "
                            <li class=\"time-label\">
                                <span class=\"bg-maroon\"> Aprendizaje</span>
                            </li>";
                            foreach($logrosStudent as $logro){
                                echo "
                                <li>
                                    <i class=\"fa fa-".(!empty($logro->icono)?$logro->icono:'flag')." bg-".$logro->color."\"></i>
                                    <div class=\"timeline-item\">
                                        <span class=\"time text-".$logro->color." txt-20\"><i class=\"fa fa-star\"></i></span>

                                        <h3 class=\"timeline-header\">
                                            <a class=\"text-".$logro->color."\">".(!empty($logro->nombre)?$logro->nombre:'no se pudo cargar')."</a>
                                            ".(!empty($logro->descripcion)?$logro->descripcion:'no se pudo cargar')."
                                        </h3>
                                        ".(($logro->imagen != 'empty')
                                        ?'<div class="timeline-body text-center ach-cont">
                                            <div class="circle-ac">
                                                <img src="'.$logro->imagen.'">
                                            </div>
                                        </div>'
                                        :'')."
                                    </div>
                                </li>";
                            }
                        }
                        ?>

                        <li>
                            <i class="fa fa-clock-o bg-maroon text-white txt-20"></i>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        
    </section>

</div>
<!-- end -->

<ul class="collapsible black-text">
    <li>
        <div class="collapsible-header">
            <i class="material-icons">bookmark</i>
            <span>
                <b>
                    <?PHP 
                        $Compe_Prg = ObtenerCompetenciaPrg($FullPregunCues[$prgs -1]['id_pregunta'], $conex);
                        echo htmlentities($Compe_Prg['competencia']);
                    ?>
                </b>
            </span>
        </div>
    </li>
</ul>
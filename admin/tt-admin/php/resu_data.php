<?php 
//var_dump($DataResul['datos']);
        $Nivel_C1 = "";
        $Nivel_C2 = "";
        $Nivel_C3 = "";
        $Nivel_C4 = "";
        $Nivel_Final = ""; 

        $ColorC1 = "";
        $ColorC2 = "";
        $ColorC3 = "";
        $ColorC4 = "";
        $ColorFi = "";

        $starC1 = 0;
        $starC2 = 0;
        $starC3 = 0;
        $starC4 = 0;
        $starFi = 0;

        $Puntaje_1 = number_format($DataResul['puntaje_c1'],2);
        $Puntaje_2 = number_format($DataResul['puntaje_c2'],2);
        $Puntaje_3 = number_format($DataResul['puntaje_c3'],2);
        $Puntaje_4 = number_format($DataResul['puntaje_c4'],2);
        $Puntaje_Final = number_format($DataResul['puntaje_final'],2);

        if($Puntaje_1 >= 0 && $Puntaje_1 <= 0.58){ $Nivel_C1 = "BAJO"; $ColorC1 = "red"; $starC1+=1;} 
        else if($Puntaje_1 >= 0.59 && $Puntaje_1 <= 0.78){ $Nivel_C1 = "BÁSICO"; $ColorC1 = "orange"; $starC1+=2; }
        else if($Puntaje_1 >= 0.79 && $Puntaje_1 <= 0.90){ $Nivel_C1 = "ALTO"; $ColorC1 = "blue"; $starC1+=3;}
        else if($Puntaje_1 >= 0.91 && $Puntaje_1 <= 1){ $Nivel_C1 = "SUPERIOR"; $ColorC1 = "green"; $starC1+=4; }


        if($Puntaje_2 >= 0 && $Puntaje_2 <= 0.46){ $Nivel_C2 = "BAJO"; $ColorC2 = "red"; $starC2+=1;} 
        else if($Puntaje_2 >= 0.47 && $Puntaje_2 <= 0.62){ $Nivel_C2 = "BÁSICO"; $ColorC2 = "orange"; $starC2+=2; }
        else if($Puntaje_2 >= 0.63 && $Puntaje_2 <= 0.72){ $Nivel_C2 = "ALTO"; $ColorC2 = "blue"; $starC2+=3;}
        else if($Puntaje_2 >= 0.73 && $Puntaje_2 <= 0.80){ $Nivel_C2 = "SUPERIOR"; $ColorC2 = "green"; $starC2+=4;}

        if($Puntaje_3 >= 0 && $Puntaje_3 <= 0.93){ $Nivel_C3 = "BAJO"; $ColorC3 = "red"; $starC3+=1;} 
        else if($Puntaje_3 >= 0.94 && $Puntaje_3 <= 1.25){ $Nivel_C3 = "BÁSICO"; $ColorC3 = "orange"; $starC3+=2; }
        else if($Puntaje_3 >= 1.26 && $Puntaje_3 <= 1.44){ $Nivel_C3 = "ALTO"; $ColorC3 = "blue"; $starC3+=3;}
        else if($Puntaje_3 >= 1.45 && $Puntaje_3 <= 1.60){ $Nivel_C3 = "SUPERIOR"; $ColorC3 = "green"; $starC3+=4;}


        if($Puntaje_4 >= 0 && $Puntaje_4 <= 0.93){ $Nivel_C4 = "BAJO"; $ColorC4 = "red"; $starC4+=1; } 
        else if($Puntaje_4 >= 0.94 && $Puntaje_4 <= 1.25){ $Nivel_C4 = "BÁSICO"; $ColorC4 = "orange"; $starC4+=2;}
        else if($Puntaje_4 >= 1.26 && $Puntaje_4 <= 1.44){ $Nivel_C4 = "ALTO"; $ColorC4 = "blue"; $starC4+=3;}
        else if($Puntaje_4 >= 1.45 && $Puntaje_4 <= 1.60){ $Nivel_C4 = "SUPERIOR"; $ColorC4 = "green"; $starC4+=4;}

        if($Puntaje_Final >= 0 && $Puntaje_Final <= 2.9){ $Nivel_Final = "BAJO"; $ColorFi = "red"; $starFi+=1; } 
        else if($Puntaje_Final >= 3.0 && $Puntaje_Final <= 3.9){ $Nivel_Final = "BÁSICO"; $ColorFi = "orange"; $starFi+=2;}
        else if($Puntaje_Final >= 4.0 && $Puntaje_Final <= 4.5){ $Nivel_Final = "ALTO"; $ColorFi = "blue"; $starFi+=3;}
        else if($Puntaje_Final >= 4.6 && $Puntaje_Final <= 5.0){ $Nivel_Final = "SUPERIOR"; $ColorFi = "green"; $starFi+=4; }



        $arrayResuComp[] =  array( "Puntaje" => $Puntaje_1, "competencia" => "C1", "NoPre" => 80, "Estrellas" => $starC1);
        $arrayResuComp[] =  array( "Puntaje" => $Puntaje_2, "competencia" => "C2", "NoPre" => 100, "Estrellas" => $starC2);
        $arrayResuComp[] =  array( "Puntaje" => $Puntaje_3, "competencia" => "C3", "NoPre" => 160, "Estrellas" => $starC3);
        $arrayResuComp[] =  array( "Puntaje" => $Puntaje_4, "competencia" => "C4", "NoPre" => 160, "Estrellas" => $starC4);              

        foreach ($arrayResuComp as $clave => $fila) {
            $Estrellas[$clave] = $fila['Estrellas'];
            $Puntaje[$clave] = $fila['Puntaje'];            
        }      
        array_multisort($Estrellas,SORT_DESC, $Puntaje, SORT_DESC, $arrayResuComp);


        $arrayCompetencias[] = array( 
            "Puntaje" => $Puntaje_1, 
            "Competencia" => "C1", 
            "NoPre" => 80, 
            "Nivel"=> $Nivel_C1, 
            "Color" => $ColorC1,
            "Estrellas" => $starC1
        );

        $arrayCompetencias[] = array( 
            "Puntaje" => $Puntaje_2, 
            "Competencia" => "C2", 
            "NoPre" => 100, 
            "Nivel"=> $Nivel_C2, 
            "Color" => $ColorC2,
            "Estrellas" => $starC2
        );

        $arrayCompetencias[] = array( 
            "Puntaje" => $Puntaje_3, 
            "Competencia" => "C3", 
            "NoPre" => 160, 
            "Nivel"=> $Nivel_C3, 
            "Color" => $ColorC3,
            "Estrellas" => $starC3
        );

        $arrayCompetencias[] = array( 
            "Puntaje" => $Puntaje_4, 
            "Competencia" => "C4", 
            "NoPre" => 160, 
            "Nivel"=> $Nivel_C4, 
            "Color" => $ColorC4,
            "Estrellas" => $starC4
        );

        $arrayCompetencias[] = array( 
            "Puntaje" => $Puntaje_Final, 
            "Competencia" => "FI", 
            "NoPre" => 500, 
            "Nivel"=> $Nivel_Final, 
            "Color" => $ColorFi,
            "Estrellas" => $starFi
        );




?>
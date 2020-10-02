
<?php
    require './../conex.php';
    include './php/fetch_record.php';
    require './fpdf/fpdf.php';

    //PARA IMPRIMR UN GRUPO
    if(isset($_GET['tk']) && $_GET['tk'] == '4001f77c7e6670877f2dba8bff6686d3')
    {
        if(isset($_GET['grid'])){            
            $data = FullDatosInsctipcion($_GET['grid'], $conex);           
            $estu = ListaEstudiantesGrupo($_GET['grid'], $conex);

            if(count($data) >0 && count($estu)>0){
                
                /*
                print_r($data);
                
                echo "<hr>";
                print_r($estu);
                echo "<hr>";
                echo $estu[0]['cod_estudiante'];
                echo "<hr>";
                echo "<hr>";
                */
                class PDF extends FPDF
                {
                    // Cabecera de página
                    function Header()
                    {
                        // Logo
                        $this->Image('./../../img/logotipo.png',10,8,33);
                        // Arial bold 15
                        $this->SetFont('Arial','B',11);
                        // Movernos a la derecha
                        $this->Cell(200);
                        // Título
                        $this->Cell(50,10,'Listado de Estudiantes',0,0,'C');
                        // Salto de línea
                        $this->Ln(10);
                    }

                    // Pie de página
                    function Footer()
                    {
                        // Posición: a 1,5 cm del final
                        $this->SetY(-15);
                        // Arial italic 8
                        $this->SetFont('Arial','I',8);
                        // Número de página
                        $this->Cell(0,10,utf8_decode('Página Nº ').$this->PageNo().'/{nb}',0,0,'C');
                    }
                }//FIN CLASE

                $pdf = new PDF('L','mm','Letter');
                $pdf-> AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',10);
                $pdf->SetFillColor(232,232,232);

                //DATOS DE LA PRUEBA     
                $pdf->Cell(15,5,utf8_decode('Periodo'),1,0,'C',1);
                $pdf->Cell(50,5,utf8_decode($data['periodo'])." - ".utf8_decode($data['year_periodo']),1,0,'C',0);
                $pdf->Cell(50,5,'Prueba',1,0,'C',1);
                $pdf->Cell(80,5,utf8_decode($data['prueba']),1,0,'C',0);

                $pdf->SetFillColor(174, 228, 249);
                $pdf->Cell(55,5,utf8_decode($data['estado_prueba']),1,1,'C',1);
                //FIN DATOS DEL GRUPO


                //DATOS DEL GRUPO    
                $pdf->SetFillColor(232,232,232);

                $pdf->Cell(15,5,'Grupo',1,0,'C',1);
                $pdf->Cell(50,5,utf8_decode($data['grupo']),1,0,'C',0);

                date_default_timezone_set('America/Bogota'); 
                $FO_Fecha = strftime("%d de %b del %Y",strtotime($data['fecha_aplicacion_prueba']));

                $pdf->Cell(50,5,utf8_decode('Fecha de aplicación'),1,0,'C',1);
                $pdf->Cell(60,5,$FO_Fecha,1,0,'C',0);

                $pdf->Cell(20,5,utf8_decode('Horario'),1,0,'C',1);
                $pdf->Cell(55,5,utf8_decode($data['horario_grupo']),1,1,'C',0);



                $pdf->Cell(15,5,utf8_decode('Sede'),1,0,'C',1);
                $pdf->Cell(50,5,utf8_decode($data['sede']),1,0,'C',0);

                $pdf->Cell(25,5,utf8_decode('Aula'),1,0,'C',1);
                $pdf->Cell(25,5,utf8_decode($data['aula_grupo']),1,0,'C',0);

                $pdf->Cell(25,5,utf8_decode('Lugar'),1,0,'C',1);
                $pdf->Cell(110,5,$data['lugar_sede'],1,0,'C',0);

                
                //FIN DATOS DEL GRUPO

                // Salto de línea
                $pdf->Ln(10);
                $pdf->Cell(250,5,utf8_decode('Listado de estudiantes inscritos en el grupo'),1,1,'C',1);
                
                $pdf->SetFillColor(247, 247, 237);

                $pdf->Cell(11,5,utf8_decode('Nº'),1,0,'C',1);
                $pdf->Cell(21,5,utf8_decode('Código'),1,0,'C',1);
                $pdf->Cell(46,5,utf8_decode('Nombres'),1,0,'C',1);
                $pdf->Cell(46,5,utf8_decode('Apellidos'),1,0,'C',1);
                $pdf->Cell(81,5,utf8_decode('Programa'),1,0,'C',1);
                $pdf->Cell(45,5,utf8_decode('Firma asistencia'),1,1,'C',1);

                $pdf->SetFont('Arial','',8);

                for($es = 0 ; $es < count($estu); $es++){
                    $pdf->Cell(11,5,$es+1,1,0,'L',0);
                    $pdf->Cell(21,5,utf8_decode($estu[$es]['cod_estudiante']),1,0,'L',0);
                    $pdf->Cell(46,5,utf8_decode($estu[$es]['nombres_estudiante']),1,0,'L',0);
                    $pdf->Cell(46,5,utf8_decode($estu[$es]['apellidos_estudiante']),1,0,'L',0);

                    $restProg = substr($estu[$es]['programa'], 0, 40);

                    $pdf->Cell(81,5,"(".$estu[$es]['id_programa'].") - ".utf8_decode($restProg),1,0,'L',0);
                    $pdf->Cell(45,5,'',1,1,'L',0);
                }




                $pdf->Output();
            }//FIN IF
            else{
                echo "No hay datos por mostrar <br>";
                echo "Estas muy perdido, Retornaras a Toolstic.";
            } // FIN ELSE NO HAY DATOS
        }// FIN ISSET GRUPO
        else{
            echo "Estas muy perdido, Retornaras a Toolstic.";
        }
    }// FIN ISSET TOKEN
    else{
        echo "Estas muy perdido, Retornaras a Toolstic.";
    }
?>
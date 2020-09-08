<?php 

    session_start();    
    
    if(isset($_SESSION['user_student']) && isset($_SESSION['error_user']) && ($_SESSION['error_user'] == FALSE)){           
        $_SESSION['error_user'] = FALSE;
        $userlog = $_SESSION['user_student'];
    }
    else{
        $_SESSION['error_user'] = TRUE;
        
    }

?>
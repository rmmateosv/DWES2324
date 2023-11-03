<?php
        if(isset($mensaje)){
            echo '<div class="container p-5 my-5 border">';            
            if($mensaje[0]=='e')
                echo '<h4 class="text-danger">'.$mensaje[1].'</h4>';
            else
                echo '<h4 class="text-success">'.$mensaje[1].'</h4>';
            echo '</div>';
        }
?>
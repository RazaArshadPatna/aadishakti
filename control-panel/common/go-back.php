<?php
                 if($p){
                        $_SESSION['msg']="success";
                       // echo 'successs';
                       header("Location:$goto");
                    }
                    else{
                        //echo 'error';
                         $_SESSION['error']="Error";
                         header("Location:$goto");
                    }
                    ?>

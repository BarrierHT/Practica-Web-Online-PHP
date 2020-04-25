<?php
if( isset($_POST['name']) ){
        $name = $_POST['name'];
        $archivo = fopen($name.'.php','a+');
        fwrite($archivo,"<?php  include('code_user.php' ); ?>");
}



?>
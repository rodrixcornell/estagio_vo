<?php
// load PHPMailer library
include $path."php/phpmailer/class.phpmailer.php";

class phpmailer_connect extends PHPMailer {
    function phpmailer_connect(){
        // Class Constructor.
        // These automatically get set with each new instance.

        $this->IsSMTP();
        $this->SMTPAuth = true;
        $this->Host = "172.17.1.5";

        $this->Username = "admin.sistemaspmm@pmm.am.gov.br";
        $this->Password = "Admin2013";

        $mail->From     = "admin.sistemaspmm@pmm.am.gov.br";
        $mail->FromName = "Sistemas PMM";
    }
}
?>
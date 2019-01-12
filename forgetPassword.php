<?php
include 'Session.php';
$sn= new Session();
$sn->init();
$sn->indexPageLoad();
include 'Core.php';
include 'OAuth/Security.php';
require  'allList.php';
// require 'OAuth/PHPmailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'OAuth/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'OAuth/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'OAuth/PHPMailer-master/PHPMailer-master/src/SMTP.php';
class recoverPass extends Database
{
        function __construct()
        {
            $this->conn =$this->openConnection();
        }
        function __destruct()
        {
            $this->closeConnection();
        }


//encription method
    public function scrypt( $string, $action = 'E') 
    {
        $secret_key = "XoLQDFmBkyKj0fDFEUZCcQ6nExEbWiKr";
        $secret_iv = 'S5ibpaW8DFwj2EKnOI73bfIdoJEfcdpa';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'E' ) 
        {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }

        else if( $action == 'D' )
        {
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
    }

/*

    // mail sending function
    public function sendMail($sub,$des,$eml){
            try {

                $mail = new PHPMailer;
                $mail->isSMTP();

                $mail->Host = 'mail.digicart.xyz';             
                $mail->SMTPAuth = true;                             
                $mail->Username = 'linecrm@digicart.xyz';
                $mail->Password = 'Hello@2018';
                $mail->SMTPSecure = 'ssl'; 
                $mail->Port = 465; 
                $mail->setFrom('linecrm@digicart.xyz', 'From Line CRM');
                $mail->addAddress($eml);     // Add a recipient
                $mail->addReplyTo($eml);
                $mail->Subject = $sub;
                $mail->isHTML(true);
                $mail->Body= $des;
                if($mail-> send()){
                    return true;
                }
                else
                    return false;

            } catch (Exception $e) {
                echo $e->getMessage();
            }
            

    }
*/


public function sendMail($sub,$des,$eml){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.digicart.xyz';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'linecrm@digicart.xyz';                 // SMTP username
        $mail->Password = 'Hello@2018';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('linecrm@digicart.xyz', 'From Line CRM');
        $mail->addAddress(trim($eml),'');     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo(trim($eml),'');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $sub;
        $mail->Body    = $des;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }
}
    //random string genartion
    public function random($x){
            $str = null;
            for($i=0;$i<$x;$i++)
            {
                if($i*3%5==0){
                    $c = chr(65+(rand(100,10000)%26));
                    $str =  $str.$c;
                }
                else{
                    $c = chr(97+(rand(100,10000)%26));
                    $str =  $str.$c;
                }
            }
            return $str;
    }


    public function passRe($username, $pass){

            $sql = "SELECT * FROM user_tb WHERE userName = :username";
            $sql1 = "SELECT * FROM customerinfo_tb WHERE cmpEmail = :use";

            if(($stmt1 = $this->conn->prepare($sql1)) && ($stmt = $this->conn->prepare($sql)))
            {
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt1->bindParam(':use', $username, PDO::PARAM_STR);

                if($stmt1->execute() && $stmt->execute())
                {
                      if($stmt1->rowCount() == 1){
                            $sql="UPDATE customerinfo_tb SET userPassword = :pass WHERE cmpEmail = :mail";
                        }
                        elseif ($stmt->rowCount() == 1) {
                            $sql="UPDATE user_tb SET userPassword = :pass WHERE userName = :mail";
                        }
                        else
                            return false;
                }
            }
            $pre = $this->conn->prepare($sql);
            $pre->bindValue(':mail',$username);
            $pre->bindValue(':pass', $pass);
            if($pre->execute()){
                return true;
            }
        }

}
if(isset($_REQUEST['reset'])){
    $mail = $_POST['mail'];
    $obj = new recoverPass();
    $pass = $obj->random(8);
    if($obj->passRe($mail,$obj->scrypt($pass)))
    { 
        $_SESSION["recoveredPass"] = 'ok';
        $sub = 'Recovery LineCRM System Username and Password';
        $des = 'Username: '.$mail.'<br>';
        $des = $des.'Password: '.$pass;
        $obj->sendMail($sub,$des,$mail);
         echo '<script type="text/javascript">location.href="index.php"</script>';
        // header('location:index.php');
    }
}
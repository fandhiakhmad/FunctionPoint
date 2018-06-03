<?php
class mailler extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('My_PHPMailer');
		$this->load->model('user_model');
		$this->load->library('session');
	
	}
	
    public function send_mail($data_email) 
    {	
		$email = $data_email['email'];
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "fandiakhmad1996@gmail.com";  // user email address
        $mail->Password   = "kopiluwak";            // password in GMail
        $mail->SetFrom('fandiakhmad1996@gmail.com','Fandhi Akhmad');  //Who is sending the email
		//$mail->AddReplyTo("fandiakhmad1996@gmail.com","Fandhi Akhmad");  //email address that receives the response
        $mail->Subject    = $data_email['subject'];
        $mail->Body      = $data_email['pesan'];
		//$mail->SMTPDebug = 4; 
        $mail->AltBody    = "Plain text message";
        $destino = "".$email.""; // Who is addressed the email to
        $mail->AddAddress($destino, " Fandhi Akhmad");

        if(!$mail->Send()) 
        {
            $message = "Error: " . $mail->ErrorInfo;
			return  $message;
        } else {
            $message = "Email berhasil disimpan";
			return $message;
        }
    }
}
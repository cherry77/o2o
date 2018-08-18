<?php
namespace phpmailer;
class Email{
    /**
     * @param $to
     * @param $title
     * @param $content
     * @return array
     */
    public static function sendEmail($to,$title,$content){
        if(empty($to)){
            return return_value(-1,'参数异常');
        }
        try{
            $mail=new Phpmailer();
            $body="<h1>$content</h1>";
            $mail->IsSMTP();
            $mail->SMTPAuth=true;
            $mail->SMTPKeepAlive=true;
            $mail->SMTPSecure= "ssl";
            $mail->Host=config('email.host');
            $mail->Port=config('email.port');
            $mail->Username=config('email.username');
            $mail->Password=config('email.password');
            $mail->From=config('email.username');
            $mail->FromName=config('email.username');
            $mail->Subject=$title;
            $mail->AltBody=$content;
            $mail->WordWrap=50;
            $mail->MsgHTML($body);
            $mail->AddReplyTo($to);
//            $mail->AddAttachment("attachment.jpg");
//            $mail->AddAttachment("attachment.zip");
            $mail->AddAddress($to);
            $mail->IsHTML(true);
            if(!$mail->Send()){
                echo "Mailer Error:".$mail->ErrorInfo;
            }else{
                echo "Message has been sent";
            }
        }catch (phpmailerException $e){
            return return_value(-1,$e->getMessage());
        }
    }
}
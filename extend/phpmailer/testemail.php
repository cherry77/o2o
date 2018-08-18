<?php
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
header("content-type:text/html;charset=utf-8");
require 'class.phpmailer.php';
require 'class.smtp.php';
date_default_timezone_set('PRC');//set time

//Create a new PHPMailer instance
$mail=new PHPMailer();
$body="<h1>欢迎大家来到慕课网学习，我们一起共同进步</h1>";
//设置smtp参数
$mail->IsSMTP();
$mail->SMTPAuth=true;
$mail->SMTPKeepAlive=true;
//$mail->SMTPDebug = 2;
$mail->SMTPSecure= "ssl";
$mail->Host="smtp.qq.com";
$mail->Port=465;
//填写你的email账号和密码
$mail->Username="930289986@qq.com";
$mail->Password="sgucdvswayyvbecg";#注意这里也要填写授权码就是我在上面QQ邮箱开启SMTP中提到的，不能填邮箱登录的密码哦。 //设置发送方，最好不要伪造地址
$mail->From="930289986@qq.com";
$mail->FromName="隗**";
$mail->Subject="隗**发来的一封邮件";
$mail->AltBody=$body;
$mail->WordWrap=50; // set word wrap
$mail->MsgHTML($body);//设置回复地址
$mail->AddReplyTo("424625103@qq.com","隗**");
//添加附件，此处附件与脚本位于相同目录下否则填写完整路径
// //附件的话我就注释掉了
$mail->AddAttachment("attachment.jpg");
$mail->AddAttachment("attachment.zip");
//设置邮件接收方的邮箱和姓名
$mail->AddAddress("424625103@qq.com","hello");
//使用HTML格式发送邮件
$mail->IsHTML(true);
//通过Send方法发送邮件 //根据发送结果做相应处理
 if(!$mail->Send()){
        echo "Mailer Error:".$mail->ErrorInfo;
     }else{
         echo "Message has been sent";
     }

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/*
$ID = "userid";
$Pwd = "password";
$baseurl ="http://www.businesssms.co.in";
$PhNo = "910123456789";
$Text = urlencode("This is an example for message");

//Invoke HTTP Submit url
$url = "$baseurl/sms.aspx?Id=$ID&Pwd=$Pwd&PhNo=$PhNo&text=$Text";
// do sendmsg call
$ret = file($url);
//Process $ret to check whether it contains "Message Submitted"
//..............
//..............


/**
 * Description of SendSMSComponent
 *
 * @author admin
 */
class SendSMSComponent extends CApplicationComponent{
    public $ID="dmaza@nic.in";
    public $Pwd="password";
    public $baseurl ="http://www.businesssms.co.in/sms.aspx";
    public $PhNo="";
    public $Text="";
   public function __construct()
    {
        
    }

    public function init()
    {
        parent::init();
    } 
     public function sendSms($event)
    {
         $x=$event->sender->getSMSDetails();
         if (is_array($x))
         {
            $this->postSms($x['PhNo'], $x['text']);
            // var_dump($x);
             //exit;
         }
         
         
         
     }
    public function postSms($PhNo,$text)
    {
      $url= $this->baseurl."?"."ID=".$this->ID."&Pwd=".$this->Pwd."&PhNo=$PhNo&text=".urlencode($text);
      //print $url;
       //exit;
      $ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// grab URL and pass it to the browser
      $response=  curl_exec($ch);
//$response=curl_getinfo($ch);
// close cURL resource, and free up system resources
curl_close($ch);
//var_dump($response);
//exit;
      if (strstr($response, "Message Submitted")!=FALSE)
        {
            return 1;
        }
        else 
            return 0;
    }
    
  public function addSMSRecords() 
  {
      $cmd=Yii::app()->db->createCommand();
      
  }
}
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
    public $sendsms=true;
    public $ID="";
    public $Pwd="";
    public $baseurl ="http://www.businesssms.co.in";
    public $PhNo="";
    public $Text="";
   public function __construct()
    {
        
    }

    public function init()
    {
        parent::init();
        $this->ID=Yii::app()->params['businesssmsid'];
        $this->Pwd=Yii::app()->params['businesssmspwd'];
    } 
     public function sendSms($event)
    {
         $x=$event->sender->getSMSDetails();
         if (is_array($x))
         {
            $this->postSms1($x['PhNo'], $x['text']);
            // var_dump($x);
             //exit;
         }
         
         
         
     }
      public function postSms1($PhNo,$text)
      {
          $ScheduleSMSDateTime = "";                          //Optional.
        $RetryMinutes = 0;                                  //Optional. Required in case of Schedulling date time is provided.
        $SenderID = "";                                     //Optional. Required in case of Open or Dynamic SenderID only.
        $SenderNo = "";                                     //Optional. Required in case of Open or Dynamic SenderID only.
$options=array('SoapAction'=>'http://www.businesssms.co.in/SubmitSMS','trace'=>1,'soap_version'   => SOAP_1_1
        ,"exception" => 1,'use' => SOAP_LITERAL,'style'=>SOAP_DOCUMENT,'keep_alive'=>false);
            $soapclient = new SoapClient('http://businesssms.co.in/WebService/BSWS.asmx?WSDL',$options);
         
           $soapheader = new SoapHeader("http://www.businesssms.co.in",'ihj');

        $params=array('strID'=>'dmaza@nic.in','strPwd'=>'password','strPhNo'=>$PhNo,'strText'=>$text,'intRetryMin'=>$RetryMinutes,);
        //    'strSchedule'=>$ScheduleSMSDateTime,'strSenderId'=>$SenderID,'strSenderNo'=>$SenderNo);
        //$text="test";
        $x = new \SoapVar(sprintf('
    <SubmitSMS xmlns="http://www.businesssms.co.in/">
      <strID>%s</strID>
      <strPwd>%s</strPwd>
      <strPhNo>%s</strPhNo>
      <strText>%s</strText>
      <strSchedule></strSchedule>
      <intRetryMin>0</intRetryMin>
      <strSenderID></strSenderID>
      <strSenderNo></strSenderNo>
    </SubmitSMS>
  ',$this->ID,$this->Pwd,$PhNo,$text),XSD_ANYXML);
        try{
       // $result=$soapclient->__soapCall("SubmitSMS",array($params));
            $result=$soapclient->submitSMS($x);
            
        //var_dump($result);
        }
        catch(Exception $ex)
        {
            
            print $ex->getMessage();
            return;
           
        }
       try{
		  Yii::app()->user->setFlash('notification',"Message $text sent succesfully  to $PhNo" );
            return 1;
			}catch(Exception $e)
			{
			print "Message $text sent succesfully  to $PhNo"."\n";
			return 1;
			}
        /*
        $respXML = $soapclient->__getLastResponse();
$requXML = $soapclient->__getLastRequest();


var_dump( $soapclient->__getLastRequestHeaders());
var_dump( $requXML);
var_dump($soapclient->__getLastResponseHeaders());
var_dump( $respXML);
         * */
         
      }
    public function postSms($PhNo,$text)
    {
        $ph_arr=explode(",",$PhNo);
        if (is_array($ph_arr))
        {
            foreach($ph_arr as $i=>$ph)
            {
                if (strlen($ph)!=12)
                {
                    unset($ph_arr[$i]);
                }
            }
            if (count($ph_arr)>0)
            {
               
            $PhNo=implode(",",$ph_arr);
            }
            else return;
        }
        $baseurl=$this->baseurl;
        $ID=$this->ID;
        
      $url= "$baseurl/sms.aspx?ID=$ID&Pwd=$this->Pwd&PhNo=$PhNo&text=".rawurlencode($text);
	  //print $url;
     // print $url;
    // if (!$this->sendsms)
      //return;
    //$response=  file_get_contents($url);
    
     $ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// grab URL and pass it to the browser
      $response=  curl_exec($ch);
//$response=curl_getinfo($ch);
// close cURL resource, and free up system resources
curl_close($ch);

//var_dump($url);
//var_dump($response);
//exit;
     
     
      if (strstr($response, "Message Submitted")!=FALSE)
        {
          try{
		  Yii::app()->user->setFlash('notification',"Message $text sent succesfully  to $PhNo" );
            return 1;
			}catch(Exception $e)
			{
			print "Message $text sent succesfully  to $PhNo"."\n";
			return 1;
			}
        }
        else {
            Yii::trace($response, "sms");
		try{
            Yii::app()->user->setFlash('notification',"Could not send message $text  to $PhNo" );
            return 0;
			}
			catch(Exception $e)
			{
			print "Could not send message $text  to $PhNo" ."\n";
			return 0;
			}
        }
    }
    
  public function addSMSRecords() 
  {
      $cmd=Yii::app()->db->createCommand();
      
  }
  /**
 * urlencodes complete string, including alphanumeric characters
 * @param string $string the string to encode
 */
function urlencode_all($string){
    $chars = array();
    for($i = 0; $i < strlen($string); $i++){
        $chars[] = '%'.dechex(ord($string[$i]));
    }
    return implode('', $chars);
}
}

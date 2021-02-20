<?php

class Email {
	
	private $from, $to, $message, $subject;
	
	function __construct($from,$message,$to="mikecivan0@gmail.com"){
		$this-> from = $from;
		$this-> to = $to;
		$this-> subject = "Poruka od " . $from;
		$this-> message = $message;
	}
	
	public function send(){
		$headers = 'MIME-Version: 1.0' . "\r\n";
   	    $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
   	    $headers .= 'From: <' . $this->from . '>' . "\r\n" .
					'Reply-To: <' . $this->from . '>';
		
		mail($this->to, $this->subject, wordwrap($this->message, 85), $headers);
	}

}

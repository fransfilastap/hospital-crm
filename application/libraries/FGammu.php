<?php


class FGammu{

	public function __construct(){

		$this->_CI = &get_instance();
		$this->_CI->load->database();
		$this->_CI->load->model("m_smsgateway","smsg");
	}
	

	public function send_single_message( $number, $message ){

		// hitung berapa jumlah sms dengan membaginya dengan 160
		$jumsms = ceil(strlen($message)/160);
		 
		// process jika jumlah sms hanya 1
		if( $jumsms == 1 )
		{	
			$sms  = array(
						'DestinationNumber' => 	$number,
						'TextDecoded'		=>	$message,
						'SenderID'			=>	"CRM",
						'CreatorID'			=>	"Gammu",
						'Class'				=>	'0'
				);
			$this->smsg->insert_outbox( $sms );
		}
		 
		// process jika jumlah sms lebih dari 1
		if( $jumsms >1 )
		{
			// menghitung jumlah pecahan
			$hitpecah = ceil(strlen($message)/153);
		  			
			// memecah pesan asli
			$pecah  = str_split($message, 153);
		 
			// membuat nilai ID untuk di insert di outbox
			$newID = $this->smsg->get_multipart_id();
			 
			// proses penyimpanan ke tabel outbox dan outbox_multipart untuk setiap pecahan
			for ($i=1; $i<=$hitpecah; $i++)
			{
				// membuat UDH untuk setiap pecahan, sesuai urutannya
			   	$udh = "050003A7".sprintf("%02s", $hitpecah).sprintf("%02s", $i);
			   	// membaca text setiap pecahan
			   	$msg = $pecah[$i-1];
					
				if ($i == 1)
			   	{
					// jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
					$sms = array(
								'DestinationNumber' => 	$number,
								'UDH'				=>	$udh,
								'TextDecoded'		=>	$msg,
								'ID'				=>	$newID,
								'MultiPart'			=>	true,
								'SenderID'			=>	'CRM',
								'CreatorID'			=>	"Gammu",
								'Class'				=>	'0'
						);

					$this->smsg->insert_outbox( $sms );
				}
				else
				{
					// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
					$sms = array(
								'UDH'				=>	$udh,
								'TextDecoded'		=>	$msg,
								'ID'				=>	$newID,
								'SequencePosition'	=>	$id,
					);

					$this->smsg->insert_multipart_outbox( $sms );
				}

			}

		}

	}

	function send_batch_message( array $sms ){
		$this->db->insert_batch("outbox",$sms);
	}
}
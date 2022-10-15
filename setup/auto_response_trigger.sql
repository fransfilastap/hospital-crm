DELIMITER $$

USE `rf_crm`$$

DROP TRIGGER /*!50032 IF EXISTS */ `daftar_kunjungan`$$

CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `daftar_kunjungan` AFTER INSERT ON `inbox` 
    FOR EACH ROW BEGIN
   
    DECLARE job VARCHAR(20);
	DECLARE pasien VARCHAR(30);
	DECLARE poli VARCHAR(30);
	
	SET job = SUBSTRING_INDEX(new.TextDecoded, '#', 1);
	
	IF( job = "REG" OR job = "reg" OR job = "Reg" OR job = "rEG" OR job = "reG" OR job = "REG") THEN
		
		SET pasien 	= SUBSTR(SUBSTRING_INDEX(new.TextDecoded,"#",2),-8);
		SET poli 	= SUBSTR(SUBSTRING_INDEX(new.TextDecoded,"#",3),-7);
		
		/* CHECK ID PASIEN */
		SELECT COUNT(*) INTO @check_pasien FROM pasien WHERE id_pasien = pasien;
		
		IF @check_pasien = 0 THEN
			INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES (new.SenderNumber,"Maaf, ID Pasien salah", 'Gammu');
		ELSE
			/*CHECK ID POLI*/
			SELECT COUNT(*) INTO @check_poliklinik FROM poliklinik WHERE id_poliklinik = poli;
			
			IF @check_poliklinik = 0 THEN
                INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES (new.SenderNumber,"Maaf, ID Poli salah",'Gammu');
			ELSE
				SELECT MAX(no_urut) INTO @no_urut FROM kunjungan_poli WHERE tanggal_kunjungan = DATE( NOW() ) AND id_poli = poli;
				SELECT ROUND(RAND() * 10000) INTO @confirmation_code;
				
				INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES (new.SenderNumber, CONCAT("Anda tlh terdaftar.No. antrian anda adlh ",@no_urut, " Kode Konfirmasi : ", @confirmation_code) , 'Gammu');
                /*CONCAT("Anda tlh terdaftar.No. antrian anda adlh ",@no_urut, " Kode Konfirmasi : ", @confirmation_code);*/

			END IF;
		END IF;
	END IF;
		
    END;
$$

DELIMITER ;

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Formulir Registrasi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="blurBg-false" style="background-color:#EBEBEB">



<!-- Start Formoid form-->
<link rel="stylesheet" href="<?php echo base_url("assets/registrasi/formoid-metro-green.css") ?>" type="text/css" />
<script type="text/javascript" src="<?php echo base_url("assets/registrasi/jquery.min.js"); ?>"></script>
<form class="formoid-metro-green" method="post" action="<?php echo base_url("pasien/register_pasien") ?>" style="background-color:#ffffff;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:570px;min-width:150px" method="post"><div class="title"><h2>Formulir Registrasi</h2></div>
	<div id="messages"><?php echo $messages; ?></div>
	<div class="element-input"  title="Masukan Nama Anda"><label class="title">Nama<span class="required">*</span></label><input class="large" type="text"  required="required" name="name" value="<?php echo $buffered_reg_data["pasien_name"];  ?>"/></div>
	<div class="element-input"  title="Masukan Nomor KTP, Kartu Pengenal Mahasiswa, atau Kartu Pelajar anda"><label class="title">Nomor Identitas<span class="required">*</span></label><input class="large" type="text" name="nomor_identitas" required="required" name="nomor_identitas" value="<?php echo $buffered_reg_data["pasien_nik"];  ?>"/></div>
	<div class="element-input" ><label class="title">Tempat Lahir<span class="required">*</span></label><input class="large" type="text"  required="required" name="tempat_lahir" value="<?php echo $buffered_reg_data["pasien_tempat_lahir"];  ?>"/></div>
	<div class="element-date"  title="Tanggal Lahir Anda"><label class="title">Tanggal Lahir<span class="required">*</span></label><input class="large" placeholder="yyyy-mm-dd" type="date" name="tanggal_lahir" required="required"/></div>
<div class="element-radio" ><label class="title">Jenis Kelamin<span class="required">*</span></label>		<div class="column column1"><input class="sex" type="radio" name="sex" value="Laki-laki" required="required"/><span>Laki-laki</span><br/><input type="radio" name="sex" value="Perempuan" class="sex" required="required"/><span>Perempuan</span><br/></div><span class="clearfix"></span>
	<div class="element-select" ><label class="title">Agama<span class="required">*</span></label><div class="large"><span><select name="agama" required="required">

		<option value="Islam">Islam</option><br/>
		<option value="Protestan">Protestan</option><br/>
		<option value="Katholik">Katholik</option><br/>
		<option value="Hindu">Hindu</option><br/>
		<option value="Budha">Budha</option><br/>
		<option value="Lainnya">Lainnya</option><br/></select><i></i></span></div></div>
	<div class="element-textarea" ><label class="title">Alamat Anda<span class="required">*</span></label><textarea class="medium" name="alamat" cols="20" rows="5" required="required"><?php echo $buffered_reg_data["pasien_name"];  ?></textarea></div>
	<div class="element-input" ><label class="title">Kota<span class="required">*</span></label><input class="large" type="text" name="kota" value="<?php echo $buffered_reg_data["pasien_city"];  ?>" required="required"/></div>
	<div class="element-input" ><label class="title">Pekerjaan</label><input class="large" type="text" name="pekerjaan" value="<?php echo $buffered_reg_data["pasien_job"];  ?>" /></div>
	<div class="element-input" ><label class="title">No. Telepon<span class="required">*</span></label><input class="large" type="text" name="no_telp" value="<?php echo $buffered_reg_data["pasien_phone_number"];  ?>" required="required"/></div>
	<div class="element-email" ><label class="title">Email</label><input class="large" type="email" name="email" value="<?php echo $buffered_reg_data["pasien_email"];  ?>" /></div>
	<div class="element-password" ><label class="title">Password<span class="required">*</span></label><input class="large" type="password" name="password" id="password" value="" required="required"/></div>
	<div class="element-password" ><label class="title">Konfirmasi Password<span class="required">*</span></label><input class="large" type="password"  name="password_conf" value="" id="password_conf" value="" required="required"/></div>
	<div id="password_status"></div>
	<div class="element-input" ><label class="title">Referal Anda</label><input class="large" type="text" name="referal" value="<?php echo $referal ?>" readonly /></div>
	<div class="element-input" >
		<?php echo $captcha; ?>
	</div>
	<div class="element-input" ><label class="title">Captcha<span class="required">*</span></label><input class="large" type="text" name="captcha" placeholder="Masukan captcha di atas" required="required"/></div>

<div class="submit"><input type="submit" value="Daftar"/></div></form>
<script type="text/javascript" src="<?php echo base_url("assets/registrasi/formoid-metro-green.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/registrasi/registration.js") ?>"></script>
<div id="formoid-info">All Right Reserved by  <a href="<?php echo base_url() ?>">CRM RS</a> Community</div>
<p class="frmd"><a href="#">&copy;</a>CRM RS</p>

<!-- Stop Formoid form-->



</body>
</html>

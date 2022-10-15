	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-striped table-bordered" id="jadwal_dokter">
                   <thead>
                      <tr>
                         <th class="hidden-phone">Nama Dokter</th>
                         <th class="hidden-phone">Spesialisasi</th>
                         <th class="hidden-phone">Hari Kerja</th>
                      </tr>
                   </thead>
                   <tbody>
                   	<?php foreach ($jadwals as $key => $jadwal) { ?>
                   		<tr>
                   			<td><?php echo $jadwal->nama; ?></td>
                        <td><?php echo $jadwal->spesialisasi; ?></td>
                   			<td><?php echo $jadwal->jadwal; ?></td>
                   		</tr>
                   	<?php } ?>
                   </tbody>
                </table>
			</div>
		</div>
	</div>
	</section>
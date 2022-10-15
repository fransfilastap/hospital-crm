    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/orgchart/jquery.orgchart.css") ?>">
    <style type="text/css">
       #networkModal{ width:1200px; margin-left: -600px;}
    </style>
    <div class="row-fluid">
          <div class="span4">
            <div class="portlet box blue">
              <div class="portlet-title">
                            <h4><i class="icon-user"></i>Biodata  </h4>
                        </div>
                        <div class="portlet-body ">
                          <table class="table table-hover profile">
                                        
                                        <tbody>
                                          <tr>
                                            <td><b>ID pasien</b></td>
                                            <td><?php echo $profile->id_pasien; ?></td>
                                          </tr>
                                          <tr>
                                            <td><b>No. KTP / SIM </b></td>
                                            <td><?php echo $profile->no_ktp; ?></td>
                                          </tr>
                                          <tr>
                                            <td><b>Nama</b></td>
                                            <td><?php echo $profile->nama_pasien; ?></td>
                                          </tr>
                                          <tr>
                                            <td><b>Tempat Lahir</b></td>
                                            <td><?php echo $profile->tempat_lahir; ?></td>
                                          </tr>
                                          <tr>
                                            <td><b>Tanggal Lahir</b></td>
                                            <td><?php echo format_date( $profile->tanggal_lahir ); ?></td>
                                          </tr>
                                          <!--<tr>
                                            <td><b>Umur</b></td>
                                            <td><?php echo $profile->umur; ?></td>
                                          </tr>
                                        -->
                                            <tr>
                                            <td><b>Jenis Kelamin</b></td>
                                            <td><?php echo $profile->jenis_kelamin; ?></td>
                                          </tr>
                                            <tr>
                                            <td><b>No. Telp</b></td>
                                            <td><?php echo $profile->no_telp; ?></td>
                                          </tr>
<!--                                            <tr>
                                            <td><b>Email</b></td>
                                            <td><?php echo $profile->email; ?></td>
                                          </tr> -->
                                        </tbody>
                                      </table>
                        </div>
                  <div>
              </div>
            </div>
          </div>
          <div class="span8">
            <div class="portlet box green">
              <div class="portlet-title">
                            <h4><i class="icon-user"></i>History Kunjungan  </h4>
                        </div>
                        <div class="portlet-body ">
                          <table class="table table-striped table-bordered table-advance table-hover">
                              <thead>
                                  <tr>
                                    <th><i class="icon-briefcase"></i> Tanggal</th>
                                    <th class="hidden-phone"><i class="icon-user"></i> Poliklinik</th>
                                    <th><i class="icon-shopping-cart"></i> Kode Konfirmasi</th>
                                    <th><i class="icon-shopping-cart"></i> Nomor Urut</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                    <td class="highlight">
                                      <div class="success"></div>
                                      <a href="#">RedBull</a>
                                    </td>
                                    <td class="hidden-phone">Mike Nilson</td>
                                    <td>2560.60$</td>
                                    <td>Edit</td>
                                  </tr>
                              </tbody>
                          </table>
                        </div>
                  <div>
              </div>
            </div>
          </div>
            </div>

          </div>
        </div>


   
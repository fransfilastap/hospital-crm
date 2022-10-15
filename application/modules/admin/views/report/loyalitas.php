            <script type="text/javascript" src="<?php echo site_url("assets/back/js/CRMPublisher.js") ?>"></script>
            <div class="row-fluid">
                  <div class="span12">
                  <form action="#" class="form-vertical" />
                     <div class="control-group">
                        <label class="control-label">Rentang Tanggal :</label>
                        <div class="controls">
                           <div id="range_laporan" class="btn">
                              <i class="icon-calendar"></i>
                              &nbsp;<span></span> 
                              <b class="caret"></b>
                           </div>
                        </div>
                     </div>
                  </form>
                </div>
          </div>
          <div class="row-fluid">
            <div class="portlet box blue">
              <div class="portlet-title">
                        <h4><i class="icon-reorder"></i>Laporan Loyalitas Pasien</h4>
                        <div class="tools">
                              <a href="javascript:;" class="collapse"></a>
                              <a href="#portlet-config" data-toggle="modal" class="config"></a>
                              <a href="#" class="reload" id="refresh"></a>
                         </div>
                     </div>
                     <div class="portlet-body form" id="response">

                     </div>
            </div>
            <a id="cetak" target="_blank" href="<?php echo site_url("admin/report/report_loyalitas") ?>" class="btn green"><i class="icon-print icon-white"></i> Cetak</a>
          </div>

          <script type="text/javascript">
            $(document).ready(function(){
                
                var str;
                var endr;

                $('#range_laporan').daterangepicker({
                            ranges: {
                                'Hari ini': ['today', 'today'],
                                'Kemarin': ['yesterday', 'yesterday'],
                                '7 Hari Terakhir': [Date.today().add({
                                    days: -6
                                }), 'today'],
                                '30 Hari Terakhir': [Date.today().add({
                                    days: -29
                                }), 'today'],
                                'Bulan ini': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                                'Bulan Lalu': [Date.today().moveToFirstDayOfMonth().add({
                                    months: -1
                                }), Date.today().moveToFirstDayOfMonth().add({
                                    days: -1
                                })]
                            },
                            opens: 'right',
                            format: 'MM/dd/yyyy',
                            separator: ' to ',
                            startDate: Date.today().add({
                                days: -29
                            }),
                            endDate: Date.today(),
                            minDate: '01/01/2012',
                            maxDate: '12/31/2014',
                            locale: {
                                applyLabel: 'Submit',
                                fromLabel: 'From',
                                toLabel: 'To',
                                customRangeLabel: 'Custom Range',
                                daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                                monthNames: ['Januari', 'Februari', 'March', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                                firstDay: 1
                            },
                            showWeekNumbers: true,
                            buttonClasses: ['btn-danger']
                        },

                        function (start, end) {
                            $('#range_laporan span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
                            generate(start.toString('yyyy-MM-dd'),end.toString('yyyy-MM-dd'));
                            str = start.toString('yyyy-MM-dd');
                            endr = end.toString('yyyy-MM-dd');
                        });

                $('#range_laporan span').html(Date.today().add({
                            days: -29
                }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));



                var generate = function(start,end){

                    $.post("<?php echo site_url('admin/report/ambil_rloyalitas') ?>",{"start":start,"end":end},function(data){

                        $("#response").html(data);

                    });

                }
            }); 
          </script>
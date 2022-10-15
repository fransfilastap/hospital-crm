
var CRM_APP = function () {
    
    var baseURL = "x";
    var date1 = "";
    var date2 = "";
    var oTable;
    var oTableJadwal;
    var oTableJadwalDokter;
    var daterangepicer;
    var poliklinik;
    var poli;
    var jenis;
    var id_dokter;
    var oTableFeedback;
    var oTableKonsultasi1;
    var oTableKonsultasi2;
    var statusKons;
    var statusPertanyaan = "Visibilitas telah berhasil diubah";
    var kunjunganPlot;


    var OkModal = '<div  id="okModal" class="modal hide fade">'+
                           '<div class="modal-header"><h5><b>Notifikasi</b></h5></div>'+
                           '<div class="modal-body">'+
                              '<div class="span12">'+
                                  '<p>'+statusPertanyaan+'</p>'+
                              '</div>'+

                           '</div>'+
                           '<div class="modal-footer">'+
                              '<a href="#" class="btn" data-dismiss="modal">Ok</a>'+
                           '</div>'+
                        '</div>'+
                      '</div>';


    var fnSendPromosi = function( base_url ){
        this.baseRL = base_url;

        $("input[name=pake_poli]:checkbox").change(function () {

            if ( $(this).prop("checked") ) {
                $("#poliklinik").slideDown();
            }
            else{
                $("#poliklinik").slideUp();
            }
        });

        $("input[name=pake_umur]:checkbox").change(function () {

            if ( $(this).prop("checked") ) {
                $("#custom_umur").slideDown();
            }
            else{
                $("#custom_umur").slideUp();
            }
        });

        var isAllowedToSubmit_check1 = false;
        var isAllowedToSubmit_check2 = false;


        $("#form_promo_publish").submit(function(e){

            e.preventDefault();

            if( $("input[name=pake_umur]:checkbox").prop("checked") ){

                var isSelected = false;

                if( $("input[name=umur_1]:text").val() != "" || $("input[name=umur_2]:text").val() != "" ){
                    isAllowedToSubmit_check1 = true;
                }

            }
            else{
                isAllowedToSubmit_check1 = true;
            }

            if( $("input[name=pake_poli]:checkbox").prop("checked") ){
                isAllowedToSubmit_check2 = true;
            }
            else{
                isAllowedToSubmit_check2 = true;
            }

            if( $("select[name=gender] option:selected").val() == "" ){
                isAllowedToSubmit_check1 = false;
                isAllowedToSubmit_check2 = false;
            }


            if( isAllowedToSubmit_check2 && isAllowedToSubmit_check1 ){
                
                var formObject  =   $(this);
                var formURL     =   formObject.attr("action");
                var postData    =   formObject.serializeArray();

                console.log( postData );

                $.ajax({        

                            url : formURL,
                            type: "POST",
                            data : postData,
                            dataType: 'json',
                            success:function(data, textStatus, jqXHR) 
                            {     
                                var result_type = "";

                                if( textStatus != "undefined" && textStatus == "success" )
                                {
                                    result_type = "<div class='alert alert-success'>"+
                                                        "<button class='close' data-dismiss='alert'></button>"+
                                                       "<strong>Sukses!</strong> Promosi telah dikirimkan :)."+
                                                    "</div>";
                                }
                                else{
                                    result_type = "<div class='alert alert-error'>"+
                                                        "<button class='close' data-dismiss='alert'></button>"+
                                                            "<strong>Gagal!</strong> gagal mengirim promosi :(."+
                                                        "</div>";
                                }
                                        
                                $("#result").html( result_type );


                            },
                            error: function(jqXHR, textStatus, errorThrown) 
                            {
                                var result_type = "<div class='alert alert-error'>"+
                                                        "<button class='close' data-dismiss='alert'></button>"+
                                                        "<strong>Gagal!</strong> gagal menghubungi server."+
                                                       "</div>";
                                alert(jqXHR);
                                $("#result").html( result_type );      
                            }
                });  
            
            }
            else{
                alert( isAllowedToSubmit_check2 +" & "+isAllowedToSubmit_check1 );
            }


        });
    }



    var fnKunjunganPoli = function( sSource ){

                //jquery datatables
                oTable =$('#kunjungan_poli').dataTable({
                                "oLanguage": {
                                    "sProcessing"   : "Memuatkan...",
                                    "sZeroRecords"  : "Tidak ada entri.",
                                    "sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                                    "sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
                                    "sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
                                    "sInfoPostFix"  : "",
                                    "sSearch"       : "Pencarian",
                                    "sUrl"      : "",
                                    "oPaginate": {            
                                        "sFirst":    "Pertama",             
                                        "sPrevious": "Sebelumnya",              
                                        "sNext":     "Selanjutnya",             
                                        "sLast":     "Terakhir"
                                    }
                                },
                                "bProcessing": true,
                                "bServerSide": true,
                                "sServerMethod": "POST",
                                "sAjaxSource": sSource,
                                "fnServerParams": function ( aoData ) {
                                                  aoData.push( { "name": "date1", "value": date1  },
                                                               { "name": "date2", "value": date2  },
                                                               { "name":"poli", "value": poli});
                                                },
                                "bPaginate": true,
                                "bLengthChange": true,
                                "bFilter": true,
                                "bSort": true,
                                "bInfo": true,
                                "bAutoWidth": false,
                                "bSortClasses": true,     
                                "bStateSave": false,
                                "aaSorting": [[0, 'asc']],
                                "iDisplayLength":5,
                                "aLengthMenu": [5,10,25,50,100],
                                "sPaginationType": "bootstrap"
                                });

                //daterangepicker
                daterangepicer = $('#form-date-range1').daterangepicker({
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
                            $('#form-date-range1 span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
                            fnRefresh(start,end);
                        });

                        $('#form-date-range1 span').html(Date.today().add({
                            days: -29
                        }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));

                var fnRefresh= function(start,end){
                    date1 = start.toString('yyyy-MM-dd');
                    date2 = end.toString('yyyy-MM-dd');
                    oTable.fnDraw(true);
                };
    }


    var fnInitDTJadwal = function(sSource){
               //jquery datatables
                oTableJadwal =$('#jadwal_dokter').dataTable({
                                "oLanguage": {
                                    "sProcessing"   : "Memuatkan...",
                                    "sZeroRecords"  : "Tidak ada entri.",
                                    "sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                                    "sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
                                    "sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
                                    "sInfoPostFix"  : "",
                                    "sSearch"       : "Pencarian",
                                    "sUrl"      : "",
                                    "oPaginate": {            
                                        "sFirst":    "Pertama",             
                                        "sPrevious": "Sebelumnya",              
                                        "sNext":     "Selanjutnya",             
                                        "sLast":     "Terakhir"
                                    }
                                },
                                "bProcessing": true,
                                "bServerSide": true,
                                "sServerMethod": "POST",
                                "sAjaxSource": sSource,
                                "bPaginate": true,
                                "bLengthChange": true,
                                "bFilter": true,
                                "bSort": true,
                                "bInfo": true,
                                "bAutoWidth": false,
                                "bSortClasses": true,     
                                "bStateSave": false,
                                "aaSorting": [[0, 'asc']],
                                "iDisplayLength":5,
                                "aLengthMenu": [5,10,25,50,100],
                                "sPaginationType": "bootstrap"
                                });        
    }


    var fnInitDTJadwalDokter = function(sSource){
        oTableJadwalDokter = $('#jadwal_dokter').dataTable({
                                "oLanguage": {
                                    "sProcessing"   : "Memuatkan...",
                                    "sZeroRecords"  : "Tidak ada entri.",
                                    "sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                                    "sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
                                    "sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
                                    "sInfoPostFix"  : "",
                                    "sSearch"       : "Pencarian",
                                    "sUrl"      : "",
                                    "oPaginate": {            
                                        "sFirst":    "Pertama",             
                                        "sPrevious": "Sebelumnya",              
                                        "sNext":     "Selanjutnya",             
                                        "sLast":     "Terakhir"
                                    }
                                },
                                "bProcessing": true,
                                "bServerSide": true,
                                "sServerMethod": "POST",
                                "sAjaxSource": sSource,
                                "fnServerParams": function ( aoData ) {
                                                  aoData.push( { "name": "id_dokter", "value": id_dokter });
                                                },
                                "bPaginate": true,
                                "bLengthChange": true,
                                "bFilter": true,
                                "bSort": true,
                                "bInfo": true,
                                "bAutoWidth": false,
                                "bSortClasses": true,     
                                "bStateSave": false,
                                "aaSorting": [[0, 'asc']],
                                "iDisplayLength":5,
                                "aLengthMenu": [5,10,25,50,100],
                                "sPaginationType": "bootstrap"
                                });
    }



    var fnInitInsertUpdate = function( urlEdit ){
        

        $("#jadwal_add_form").submit(function(e){
           
            e.preventDefault();
            
            var formObject  =   $(this);
            var formURL     =   formObject.attr("action");
            var postData    =   formObject.serializeArray();

            $.ajax({        

                url : formURL,
                type: "POST",
                data : postData,
                dataType: 'json',
                success:function(data, textStatus, jqXHR) 
                {     
                    $("#tambahModal").modal("hide");
                    oTableJadwalDokter.fnDraw(true);
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert("gagal");         
                }
            });  


        });

        $(".edit").live("click",function(){

            var iddokter;
            var idwaktu;

            iddokter    =   $(this).data("iddokter");
            idwaktu     =   $(this).data("idwaktu");

            $.ajax({  

                url : urlEdit,
                type: "POST",
                data : {"id_dokter":iddokter,"id_waktu":idwaktu},
                dataType: 'json',
                success:function(data, textStatus, jqXHR) 
                {     
                    $("#jam_mulai_edit").val( data.waktu_mulai );
                    $("#jam_akhir_edit").val( data.waktu_akhir );
                    $("#hari_edit").val( data.id_waktu );
                    $("input[name=id_waktu_current]:hidden").val( idwaktu );
                      
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert("gagal load data");         
                }
            }); 
        
        });

        $("#jadwal_edit_form").submit(function(e){
           
            e.preventDefault();
            
            var formObject  =   $(this);
            var formURL     =   formObject.attr("action");
            var postData    =   formObject.serializeArray();

            $.ajax({        

                url : formURL,
                type: "POST",
                data : postData,
                dataType: 'json',
                success:function(data, textStatus, jqXHR) 
                {     
                    $("#editModal").modal("hide");
                    oTableJadwalDokter.fnDraw(true);
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    alert("gagal");         
                }
            });  


        });


    }


    var fnDeleteJadwalDokter = function(deleteLink){
        
        var iddokter;
        var idwaktu;     
        var link;
                                       
        $(".delete").live("click", function()
        {
            iddokter    = $(this).data("iddokter");
            idwaktu     = $(this).data("idwaktu");
            link        = deleteLink+"/"+iddokter+"/"+idwaktu;

            $(".yes").attr("href",link);

            $(".yes").live("click", function(e){
                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: link,
                    data: null
                }).done(function(){
                   $("#hapusModal").modal("hide");
                   oTableJadwalDokter.fnDraw(true);
                });
           });
        });
    }


    var fnInitFeedback  =   function( sourceLink ){
        
        oTableFeedback = $('#feedbacks').dataTable({
                                "oLanguage": {
                                    "sProcessing"   : "Memuatkan...",
                                    "sZeroRecords"  : "Tidak ada entri.",
                                    "sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                                    "sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
                                    "sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
                                    "sInfoPostFix"  : "",
                                    "sSearch"       : "Pencarian",
                                    "sUrl"      : "",
                                    "oPaginate": {            
                                        "sFirst":    "Pertama",             
                                        "sPrevious": "Sebelumnya",              
                                        "sNext":     "Selanjutnya",             
                                        "sLast":     "Terakhir"
                                    }
                                },
                                "bProcessing": true,
                                "bServerSide": true,
                                "sServerMethod": "POST",
                                "sAjaxSource": sourceLink,
                                "fnServerParams": function ( aoData ) {
                                                  aoData.push( { "name": "date1", "value": date1  },
                                                               { "name": "date2", "value": date2  },
                                                               { "name":"jenis", "value": jenis});
                                                },
                                "bPaginate": true,
                                "bPaginate": true,
                                "bLengthChange": true,
                                "bFilter": true,
                                "bSort": true,
                                "bInfo": true,
                                "bAutoWidth": false,
                                "bSortClasses": true,     
                                "bStateSave": false,
                                "aaSorting": [[0, 'asc']],
                                "iDisplayLength":5,
                                "aLengthMenu": [5,10,25,50,100],
                                "sPaginationType": "bootstrap"
                                });               


                //daterangepicker
                daterangepicer = $('#form-date-range1').daterangepicker({
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
                            $('#form-date-range1 span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
                            fnRefresh(start,end);
                        });

                        $('#form-date-range1 span').html(Date.today().add({
                            days: -29
                        }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));

                var fnRefresh= function(start,end){
                    date1 = start.toString('yyyy-MM-dd');
                    date2 = end.toString('yyyy-MM-dd');
                    oTableFeedback.fnDraw(true);
                };


        
    }


    var fnInitTableKonsultasi   =   function(sSource){
       
        oTableKonsultasi1 = $( "#t_belum" ).dataTable({
                                "oLanguage": {
                                    "sProcessing"   : "Memuatkan...",
                                    "sZeroRecords"  : "Tidak ada entri.",
                                    "sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                                    "sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
                                    "sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
                                    "sInfoPostFix"  : "",
                                    "sSearch"       : "Pencarian",
                                    "sUrl"      : "",
                                    "oPaginate": {            
                                        "sFirst":    "Pertama",             
                                        "sPrevious": "Sebelumnya",              
                                        "sNext":     "Selanjutnya",             
                                        "sLast":     "Terakhir"
                                    }
                                },
                                "bProcessing": true,
                                "bServerSide": true,
                                "sServerMethod": "POST",
                                "sAjaxSource": sSource,
                                "fnServerParams": function ( aoData ) {
                                                  aoData.push( { "name": "status", "value": "0"  });
                                                },
                                "bPaginate": true,
                                "bPaginate": true,
                                "bLengthChange": true,
                                "bFilter": false,
                                "bSort": true,
                                "bInfo": true,
                                "bAutoWidth": false,
                                "bSortClasses": true,     
                                "bStateSave": false,
                                "aaSorting": [[0, 'asc']],
                                "iDisplayLength":5,
                                "aLengthMenu": [5,10,25,50,100],
                                "sPaginationType": "bootstrap"
                                });  

        oTableKonsultasi2 = $( "#t_sudah" ).dataTable({
                                "oLanguage": {
                                    "sProcessing"   : "Memuatkan...",
                                    "sZeroRecords"  : "Tidak ada entri.",
                                    "sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                                    "sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
                                    "sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
                                    "sInfoPostFix"  : "",
                                    "sSearch"       : "Pencarian",
                                    "sUrl"      : "",
                                    "oPaginate": {            
                                        "sFirst":    "Pertama",             
                                        "sPrevious": "Sebelumnya",              
                                        "sNext":     "Selanjutnya",             
                                        "sLast":     "Terakhir"
                                    }
                                },
                                "bProcessing": true,
                                "bServerSide": true,
                                "sServerMethod": "POST",
                                "sAjaxSource": sSource,
                                "fnServerParams": function ( aoData ) {
                                                  aoData.push( { "name": "status", "value": "1"  });
                                                },
                                "bPaginate": true,
                                "bPaginate": true,
                                "bLengthChange": true,
                                "bFilter": false,
                                "bSort": true,
                                "bInfo": true,
                                "bAutoWidth": false,
                                "bSortClasses": true,     
                                "bStateSave": false,
                                "aaSorting": [[0, 'asc']],
                                "iDisplayLength":5,
                                "aLengthMenu": [5,10,25,50,100],
                                "sPaginationType": "bootstrap"
                                });  

    }

    var fnInitSMSGatewayDT = function( sourceLink, id ){


        oTable = $( id ).dataTable({
                                "oLanguage": {
                                    "sProcessing"   : "Memuatkan...",
                                    "sZeroRecords"  : "Tidak ada entri.",
                                    "sInfo"         : "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                                    "sInfoEmpty"    : "Menampilkan 0 - 0 dari 0 entri",
                                    "sInfoFiltered" : "(Disaring dari _MAX_ total entri)",
                                    "sInfoPostFix"  : "",
                                    "sSearch"       : "Pencarian",
                                    "sUrl"      : "",
                                    "oPaginate": {            
                                        "sFirst":    "Pertama",             
                                        "sPrevious": "Sebelumnya",              
                                        "sNext":     "Selanjutnya",             
                                        "sLast":     "Terakhir"
                                    }
                                },
                                "bProcessing": true,
                                "bServerSide": true,
                                "sServerMethod": "POST",
                                "sAjaxSource": sourceLink,
                                "bPaginate": true,
                                "bPaginate": true,
                                "bLengthChange": true,
                                "bFilter": false,
                                "bSort": true,
                                "bInfo": true,
                                "bAutoWidth": false,
                                "bSortClasses": true,     
                                "bStateSave": false,
                                "aaSorting": [[0, 'asc']],
                                "iDisplayLength":10,
                                "aLengthMenu": [5,10,25,50,100],
                                "sPaginationType": "bootstrap"
                                }); 


    }


    var handleDashboardCharts = function (dataK,refreshLink) {

        if (!jQuery.plot) {
            return;
        }

        var data = dataK;

        $.plot("#kunjungan_statistics", [ data ], {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
                    align: "center"
                }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        });

        $('#dashboard-report-range').daterangepicker({
            ranges: {
                'Hari Ini': ['today', 'today'],
                'Kemarin': ['yesterday', 'yesterday'],
                '7 Hari Terakhir': [Date.today().add({
                    days: -6
                }), 'today'],
                '30 Hari Terakhir': [Date.today().add({
                    days: -29
                }), 'today'],
                'Bulan Ini': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                'Bulan Lalu': [Date.today().moveToFirstDayOfMonth().add({
                    months: -1
                }), Date.today().moveToFirstDayOfMonth().add({
                    days: -1
                })]
            },
            opens: 'left',
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
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            },
            showWeekNumbers: true,
            buttonClasses: ['btn-danger']
        },

        function (start, end) {

            $.post(refreshLink,{"start":start.toString('yyyy-MM-dd'),"end":end.toString('yyyy-MM-dd')},function(data){

                var chart_data = data.kunjungan;

                $.plot("#kunjungan_statistics", [ chart_data ], {
                    series: {
                        bars: {
                            show: true,
                            barWidth: 0.6,
                            align: "center"
                        }
                    },
                    xaxis: {
                        mode: "categories",
                        tickLength: 0
                    }
                });

                hanldeItungItungDash(data.visit,data.totalpasiendaftar,data.kritik);

            },"json");

            $('#dashboard-report-range span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));

        });

        $('#dashboard-report-range').show();

        $('#dashboard-report-range span').html(Date.today().add({
            days: -29
        }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));

        /*function showTooltip(title, x, y, contents) {
            $('<div id="tooltip" class="chart-tooltip"><div class="date">' + title + '<\/div><div class="label label-success">CTR: ' + x / 10 + '%<\/div><div class="label label-important">Imp: ' + x * 12 + '<\/div><\/div>').css({
                position: 'absolute',
                display: 'none',
                top: y - 100,
                width: 75,
                left: x - 40,
                border: '0px solid #ccc',
                padding: '2px 6px',
                'background-color': '#fff',
            }).appendTo("body").fadeIn(200);
        }

        var kunjungan = dataK;

        $('#kunjungan_statistics_loading').hide();
        $('#kunjungan_statistics_content').show();

        var plot_statistics = $.plot($("#kunjungan_statistics"), [{
            data: kunjungan,
            label: "Kunjungan"
        }], {
            series: {
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.05
                        }, {
                            opacity: 0.01
                        }]
                    }
                },
                points: {
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#eee",
                borderWidth: 0
            },
            colors: ["#d12610", "#52e136"],
            xaxis: {
                mode: "categories",
                tickLength: 0,
                ticks: 11,
                tickDecimals: 0
            },
            yaxis: {
                ticks: 11,
                tickDecimals: 0
            }
        });

        var previousPoint = null;
        $("#kunjungan_statistics").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);

                    showTooltip('24 Jan 2013', item.pageX, item.pageY, item.series.label + " of " + x + " = " + y);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });

        $("#kunjungan_activities").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint2 != item.dataIndex) {
                    previousPoint2 = item.dataIndex;
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    showTooltip('24 Feb 2013', item.pageX, item.pageY, x);
                }
            }
        });

        $('#kunjungan_activities').bind("mouseleave", function () {
            $("#tooltip").remove();
        }); */
    }

    var hanldeItungItungDash = function(data_kunjungan,data_pasien,data_kritik){

        $("#tot_pas").html(data_pasien);
        $("#jum_kunj").html(data_kunjungan);
        $("#jum_krit").html(data_kritik);        

    }


    return{

        drawDashboard : function(data,refresh){

            var chart_data = data.kunjungan;
            handleDashboardCharts(chart_data,refresh);
            hanldeItungItungDash(data.visit,data.totalpasiendaftar,data.kritik);

        },

        smsGateaway : function( source , id){
            fnInitSMSGatewayDT( source , id );
        },

        replySMS : function( replyLink , replyAsli,base){

            $(".balas").live("click",function(evt){
                evt.preventDefault();
                
                var link = replyLink+"/reply/"+$(this).data("id");

                $.get(link,function(data){
                    $("#response").html(data);
                    $("#detail").modal("show");
                });

                $("#submitX").live("click",function(evt){
                    
                    evt.preventDefault();

                    $("#loadingDiv").show();

                    
                    var postData = {"no_telp": $("#no_telp").val() ,"isi_sms":$("#isi_sms").val()};

                    $.post(replyAsli, postData, function(data){

                        $("#loadingDiv").html("berhasil");

                    }, "json").fail(function(){
                        $("#loadingDiv").html( postData );
                    });

                });

            });

            $(".view").live("click",function(evt){
                evt.preventDefault();

                var id = $(this).data("id");

                var link = replyLink+"/view/"+id;
                
                $.get(link,function(data){
                    $("#response").html(data);
                    $("#detail").modal("show");

                    $("#detail").find(".read-done").live("click",function(){
                        
                        $.post(base+"/"+id,null,function(){
                            oTable.fnDraw(true);
                        });

                        Notification.updateMessageBar();
                    });
                });



            });


            $(".forward").live("click",function(evt){
                evt.preventDefault();
                
                var link = replyLink+"/teruskan/"+$(this).data("id");

                $.get(link,function(data){
                    $("#response").html(data);
                    $("#detail").modal("show");
                });

            });


            $("#refresh").click(function(evt){
                evt.preventDefault();
                oTable.fnDraw(true);
            });

        },

        snPromosi : function(base_url){
            fnSendPromosi(base_url);
        },

        fnBuildDatatable : function( sSource ){
            fnKunjunganPoli( sSource );
        },

        fnRefreshTable : function(){
            oTable.fnDraw(true);         
        },

        fnRefreshByPoli : function( value ){
            poli = value;
            oTable.fnDraw(true);
        },

        fnBuildDTJadwal : function(sSource){
            fnInitDTJadwal(sSource);
        },

        fnBuildDTJadwalDokter : function( val , sSource ){
            id_dokter = val;
            fnInitDTJadwalDokter(sSource);
        },

        fnInitEditJadwalDokter : function( urlEdit ){
            fnInitInsertUpdate( urlEdit );
        },

        iniDeleteJadwalDokter : function( deleteLink ){
            fnDeleteJadwalDokter(  deleteLink );
        },


        initFeedback : function( link ){
            fnInitFeedback(link);
        },


        fnRefreshFeedbackByJenis : function(value){
            jenis = value;
            oTableFeedback.fnDraw(true);
        },

        fnRefreshFeedback : function(){
            oTableFeedback.fnDraw(true);
        },


        fnViewFeedbackDetail    : function(sSourceLink){

            $(".view").live("click",function(evt){
                evt.preventDefault();
                
                var link = sSourceLink+"/"+$(this).data("id");

                $.get(link,function(data){
                    $("#response").html(data);
                    $("#detail").modal("show");
                });

            });

        },


        fnInitKonsultasi : function(sSource,idTable,status){
            fnInitTableKonsultasi(sSource,idTable,status);
        },

        fnReplyKonsultasi : function(){

            $("#replyForm").submit(function(evt){

                evt.preventDefault();

                var formObject  =   $(this);
                var formURL     =   formObject.attr("action");
                var postData    =   formObject.serializeArray();

                $.post(formURL,postData,function(data){
                    $("#message").html(data.message);
                    $("#message").show();
                },"json");

            });

 /*           $(".jwb").live("click",function(evt){

                var link = replyLink+"/"+$(this).data("id");

                $.get(link,function(data){
                    $("#response").html(data);

                    response = $("#response");
                    formReply = response.find("#replyForm");

                    replyModal = response.find("#replyModal");

                    response.on("click","#submit",function(evt){
                        evt.preventDefault();

                        var formObject  =   formReply;
                        var formURL     =   formObject.attr("action");
                        var postData    =   formObject.serializeArray();

                        $.post(formURL,postData,function(data){
                            oTableKonsultasi1.fnDraw(true);
                            replyModal.modal("hide");
                        });
                    })

                    replyModal.modal("show");

                });



            });

            */

        },


        fnKonsultasiAct : function(updatelink,deleteLink){
            $(".vsbl").live("click",function(evt){
                evt.preventDefault();
                var postData = {"tmpl":1,"id":$(this).data("id")};
                $.post( updatelink, postData, function(data){
                    
                    CRM_APP.statusPertanyaan = "Pertanyaan ditampilkan pada portal";
                    $("#response").html( OkModal );
                    $("#okModal").modal("show");  
                    oTableKonsultasi2.fnDraw(true);
                    oTableKonsultasi1.fnDraw(true);
                } );

            });

            $(".hdn").live("click",function(evt){
                evt.preventDefault();
                var postData = {"tmpl":0,"id":$(this).data("id")};
                $.post( updatelink, postData, function(data){
                    
                    $("#response").html( OkModal );
                    $("#okModal").modal("show"); 
                    oTableKonsultasi2.fnDraw(true);
                    oTableKonsultasi1.fnDraw(true); 
                } );
            });



            //delete
            var id      = "";
            var link    = "";
                                           
            $(".delete").live("click",function(evt){


               id       = $(this).data("id");
               link  = deleteLink+"/"+id;

               $(".yes").attr("href",link);

               $(".yes").live("click",function(e){
                    e.preventDefault();

                    $.post(link, function(){
                        $("#removalModal").modal("hide");
                        oTableKonsultasi2.fnDraw(true);
                        oTableKonsultasi1.fnDraw(true); 
                    });
                });
              

            });
        },

        fnInitMenu : function( base_url ,val ){

            $("#konten_halaman").hide();
            $("#konten_link").hide();
            $("#konten_kategori").hide();
            $("#konten_module").hide();

            $("input[name=menu_type]:radio").change(function () {
                
                $(".pilih_halaman").removeClass("blue");

                if ( $("#halaman").prop("checked") ) {
                    
                    $("#konten_link").hide();
                    $("#konten_kategori").hide();
                    $("#konten_module").hide();
                    $("#konten_halaman").show();

                }
                else if( $("#kategori").prop("checked") ){
                    $("#konten_link").hide();
                    $("#konten_halaman").hide();
                    $("#konten_kategori").show();
                    $("#konten_module").hide();

                    $("#menu_content").val( $( "#kategori_pilih option:selected" ).val() );
                    
                    $('#kategori_pilih').on('change', function (e) {
                            var optionSelected = $("option:selected", this);
                            var valueSelected = this.value;

                            $("#menu_content").val( valueSelected );
                    });
                }
                else if( $("#link").prop("checked") ){
                    $("#konten_halaman").hide();
                    $("#konten_kategori").hide();
                    $("#konten_link").show();
                    $("#konten_module").hide();
                    
                    $("#menu_link").val(val);
                } 
                else if( $("#mod").prop("checked") ){
                    $("#konten_halaman").hide();
                    $("#konten_kategori").hide();
                    $("#konten_link").hide();
                    $("#konten_module").show();
                    
                    
                    $('#mod_selection').on('change', function (e) {
                            var optionSelected = $("option:selected", this);
                            var valueSelected = this.value;

                            $("#menu_content").val( valueSelected );
                    });
                }


            });

            $("#menu_link").keyup( function(){
                $("#menu_content").val( $("#menu_link").val() );
            } );

            $(".pilih_halaman").click(function(e){
                e.preventDefault();
                $(".pilih_halaman").removeClass("blue");
                $(this).addClass("blue");
                    $("#menu_content").val( $(this).attr("data-id") );
            });

            $("#menu_form").submit(function(e){
                e.preventDefault();
                    
                var is_ready = false;  

                if( $("#menu_content").val() == "" || $("#menu_content").val().length == 0 ){
                    alert("Data menu masih kosong!");

                    if( $("#menu_name").val() == "" || $("#menu_name").val().length == 0 ){
                        $("#notif_1").html("<span class='help-inline error' style='color:red'>Masukan Nama Menunya!</span>");
                    }
                   
                    if( $("#link").attr("checked") ){
                        if( $("#menu_link").val() == "" || $("#menu_link").val().length == 0 ){
                            $("#notif_2").html("<span class='help-inline error' style='color:red'>Masukan linknya!</span>");
                        }

                    }
                }
                else{
                        var formObject  =   $(this);
                        var formURL  =   formObject.attr("action");
                        var postData    =   formObject.serializeArray();

                        console.log( postData );

                        $.ajax(
                        {        

                                url : formURL,
                                type: "POST",
                                data : postData,
                                dataType: 'json',
                                success:function(data, textStatus, jqXHR) 
                                {
                                        
                                    var result_type = "";

                                    if( textStatus != "undefined" && textStatus == "success" )
                                    {
                                        result_type = "<div class='alert alert-success'>"+
                                                            "<button class='close' data-dismiss='alert'></button>"+
                                                            "<strong>Sukses!</strong> Menu telah disimpan :)."+
                                                        "</div>";
                                    }
                                    else{
                                        result_type = "<div class='alert alert-error'>"+
                                                            "<button class='close' data-dismiss='alert'></button>"+
                                                            "<strong>Gagal!</strong> gagal menyimpan data :(."+
                                                        "</div>";
                                    }
                                        
                                    $("#result").html( result_type );

                                    setTimeout(function() {
                                                window.location.href = base_url;
                                    }, 2000);
                                },
                                error: function(jqXHR, textStatus, errorThrown) 
                                {
                                    var result_type = "<div class='alert alert-error'>"+
                                                            "<button class='close' data-dismiss='alert'></button>"+
                                                            "<strong>Gagal!</strong> gagal menghubungi server."+
                                                           "</div>";
                                    alert(jqXHR);
                                    $("#result").html( result_type );      
                                }
                        });
                }
            });
        }

    };



}();






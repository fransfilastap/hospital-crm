
var CRMPublisher = {
    baseURL : "",

    init : function( base_url ){
        this.baseURL = base_url;
        $("#konten_halaman").hide();

            $("input[name=metode_publikasi]:radio").change(function () {
                
                $(".pilih_halaman").removeClass("blue");

                if ( $("#halaman").prop("checked") ) {
                    
                    $("#konten_link").hide();
                    $("#konten_kategori").hide();
                    $("#konten_halaman").show();

                }
                else if( $("#kategori").prop("checked") ){
                    $("#konten_link").hide();
                    $("#konten_halaman").hide();
                    $("#konten_kategori").show();

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
                    
                    $("#menu_link").val("");
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

}






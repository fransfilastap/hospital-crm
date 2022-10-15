/**
 * Notification for RF_CRM
 * by RF
 */

var Notification = function () {

    //interval check notifikasi
    var interval = 1000;

    //base url
    var base_url = "";
    var message_link = "";
    var visit_link = "";
    var question_link = "";

    //type notifikasi
    var TYPE_MESSAGE = 1;
    var TYPE_QUESTION = 2;
    var TYPE_VISIT = 3;

    var read_message_tpl = "";


    var unread_msg_total = 0;
    var visit_notif_total = 0;
    var question_notif_total = 0;


    //template untuk list notifikasi
    var vst_list_tpl = "<li>"+
                                "<a href='#'>"+
                                "<span class='label label-success'><i class='icon-plus'></i></span>"+
                                "New user registered. "+
                                "<span class='time'>Just now</span>"+
                                "</a>"+
                            "</li>";

    //menampilkan gritter untuk pesan baru
    var gritter_notification = function(context,message){

            $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: context,
                    // (string | mandatory) the text inside the notification
                    text: message,
                    // (string | optional) the image to display on the left
                    image: "",
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: true,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: 2000,
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'my-sticky-class'
            }); 
    }

    //menandai telah notifikasi telah ditampilkan
    var set_notified = function( type , id ){

        var link = "";

        if( type == TYPE_MESSAGE )
            link = base_url+"/smsgateaway/set_notified/"+id;
        else if( type == TYPE_QUESTION )
            link = base_url+"/ekonsultasi/set_notified/"+id;
        else if( type == TYPE_VISIT )
            link = base_url+"/kunjungan_poli/set_notified/"+id;
        else
            link = base_url+"/smsgateaway/set_notified/"+id;

        $.post(link,null,null);
        //alert(link);

    }

    //menandai telah notifikasi telah ditampilkan
    var set_appended = function( type , id ){

        var link = "";

        if( type == TYPE_MESSAGE )
            link = base_url+"/smsgateaway/set_appended/"+id;
        else if( type == TYPE_QUESTION )
            link = base_url+"/ekonsultasi/set_appended/"+id;
        else if( type == TYPE_VISIT )
            link = base_url+"/kunjungan_poli/set_appended/"+id;
        else
            link = base_url+"/smsgateaway/set_appended/"+id;

        $.post(link,null,null);
        //alert(link);

    }


    var set_read = function( type , id ){

        var link = "";

        if( type == TYPE_MESSAGE )
            link = base_url+"/smsgateaway/set_hide/"+id;
        else if( type == TYPE_QUESTION )
            link = base_url+"/ekonsultasi/set_appended/"+id;
        else if( type == TYPE_VISIT )
            link = base_url+"/kunjungan_poli/set_appended/"+id;
        else
            link = base_url+"/smsgateaway/set_appended/"+id;

        $.post(link,null,null);
        //alert(link);

    }

    var append_message = function( oMessage,position ){

        var nMessage = "<li>"+
                                "<a href='#' class='view-msg-notif' data-id='"+oMessage.ID+"'>"+
                                "<span class='subject'>"+
                                "<span class='from'>"+oMessage.SenderNumber+"</span>"+
                                "<span class='time'>"+oMessage.ReceivingDateTime+"</span>"+
                                "</span>"+
                                "<span class='message'>"+
                                oMessage.TextDecoded+
                                "</span> "+ 
                                "</a>"+
                            "</li>";
        //nMessage.hide();

        if( position == 1 )
        {
            $("#message_append").append( nMessage );
            $('#message_append li:last').hide().fadeIn(1000);
        }
        else{
            $("#message_append").prepend( nMessage );
            $('#message_append li:first').hide().fadeIn(1000);
        }
    }


    var append_question = function(oMessage,position){
        
        var nMessage = "<li>"+
                                "<a href='"+base_url+"/ekonsultasi/reply_page/"+oMessage.id+"'>"+
                                "<span class='label label-success'><i class='icon-question-sign'></i></span>"+
                                "Anda mempunyai pertanyaan Baru "+
                                "<span class='time'>Just now</span>"+
                                "</a>"+
                            "</li>";

        if( position == 1 )
        {
            $("#question_append").append( nMessage );
            $('#question_append li:last').hide().fadeIn(2000);
        }
        else{
            $("#question_append").prepend( nMessage );
            $('#question_append li:first').hide().fadeIn(2000);
        }        
    }
    
    //ambil notifikasi pesan baru
    var message_notification = function(){
            
        var push_link  = base_url+"/smsgateaway/get_push_inbox";
        
        //notification
        $.getJSON( push_link, function( data ) {
            
                    $.each( data, function( key, val ) {
                            gritter_notification(val.SenderNumber,val.TextDecoded);
                            append_message( val,2 );
                            set_appended(TYPE_MESSAGE,val.ID);
                            unread_msg_total = unread_msg_total + 1;
                            $("#message_badge").html( unread_msg_total );
                            $("#total_pesan").html( unread_msg_total );
                    });
        });           
                   
    }

    var unread_message_on_bar = function(){
        
        var sticky_notif_link   = base_url+"/smsgateaway/get_unread_message";

        $("#message_append").html("");

        $.getJSON( sticky_notif_link, function( data ) {
            
            var messageData     = data.mData;
            unread_msg_total    = data.mTotal;
            $.each( messageData, function( key, val ) {
                append_message(val,1);
            });

            $("#message_badge").html( unread_msg_total );
            $("#total_pesan").html( unread_msg_total );

        });          
    }


    var read_message_from_notification = function(){

        var replyLink = base_url+"/smsgateaway/get";
        $(".view-msg-notif").live("click",function(evt){
            
            evt.preventDefault();

            var id = $(this).data("id");

            var link = replyLink+"/reply/"+id;
                
            $.get(link,function(data){
                $("#notification_response").html(data);
                $("#detail").modal("show");

                    $.post(base_url+"/smsgateaway/set_read/"+id,function(){
                        Notification.updateMessageBar();
                    });
            });

            $("#submitX").live("click",function(evt){
                    
                    evt.preventDefault();

                    $("#loadingDiv").show();

                    
                    var postData = {"no_telp": $("#no_telp").val() ,"isi_sms":$("#isi_sms").val()};

                    $.post(base_url+"/smsgateaway/proses_kirim", postData, function(data){

                        $("#loadingDiv").html("berhasil");

                    }, "json").fail(function(){
                        $("#loadingDiv").html( postData );
                    }).done(function(){

                        setTimeout(function(){
                            $("#detail").modal("hide");
                        },1000);

                    });

                });


            $(this).parent().fadeOut(1000);

        });

    }

    //ambil notifikasi kujungan poli
    var visit_notification = function(){

    }

    //ambil notifikasi ekonsultasi
    var question_notification = function(){
        
        var push_link  = base_url+"/ekonsultasi/get_push_notification";
        
        //notification
        $.getJSON( push_link, function( data ) {
            
            $.each( data, function( key, val ) {
                gritter_notification("Notifikasi","Terdapat pertanyaan baru yang masuk ke dalam sistem!");
                append_question( val,2 );
                set_appended(TYPE_QUESTION,val.id);
                question_notif_total = question_notif_total + 1;
                $("#question_badge").html( question_notif_total );
                $("#total_pertanyaan").html( question_notif_total );
            });
        });           
            
    }

    var unread_question_on_bar = function(){
        
        var sticky_notif_link   = base_url+"/ekonsultasi/get_unread_question";

        $.getJSON( sticky_notif_link, function( data ) {
            
            var messageData     = data.mData;
            question_notif_total    = data.mTotal;
            $.each( messageData, function( key, val ) {
                append_question(val,1);
            });

            $("#question_badge").html( question_notif_total );
            $("#total_pertanyaan").html( question_notif_total );

        });          
    }


    //push notification like untuk admin
    var admin_notification = function(){
        
        message_notification();
        visit_notification();

        setTimeout(admin_notification,interval);
    }

     //push notification like untuk superuser
    var super_notification = function(){

        message_notification();
        visit_notification();
        question_notification();

        setTimeout(super_notification,interval);

    }

    //push notification like untuk dokter
    var dokter_notification = function(){
        question_notification();

        setTimeout(dokter_notification,interval);
    }


    return{


        standby : function(link,role){
           
            base_url        = link;
            message_link    = base_url+"/smsgateaway";
            visit_link      = base_url+"/kunjungan_poli";
            question_link   = base_url+"/feedback";

            read_message_from_notification();

            //init notification on bar
            unread_message_on_bar();
            unread_question_on_bar();

            if( role == "superuser" ){
                super_notification();
            }
            else if( role == "admin" ){
                admin_notification();
            }
            else if( role == "dokter" ){
                dokter_notification();
            }
            else{
                //do nothing;
            }
            


        },

        updateMessageBar : function(){
            unread_message_on_bar();
        }

    }



}();
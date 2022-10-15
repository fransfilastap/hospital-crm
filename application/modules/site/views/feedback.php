	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
                <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Formulir Pendaftaran Kunjungan Poliklinik</h3>
          </div>
          <div class="panel-body">
        <form id="feedback_form" method="post" action="<?php echo site_url("site/feedback/submit") ?>" class="form-horizontal" role="form">
          <div class="form-group">
            <label for="email_penanya" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-5">
              <input type="email" name="email" class="form-control" id="email_penanya" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="subject" class="col-sm-2 control-label">Judul Topik</label>
            <div class="col-sm-5">
              <input type="text" name="subject" class="form-control" id="topik" placeholder="Judul Topik">
            </div>
          </div>
          <div class="form-group">
            <label for="type" class="col-sm-2 control-label">Jenis</label>
            <div class="col-sm-8">
              <select name="type">
                  <option value="kritik">Kritik</option>
                  <option value="saran">Saran</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputAsk" class="col-sm-2 control-label">Isi</label>
            <div class="col-sm-10">
              <textarea class="form-control" rows="7" name="message" id="inputAsk"></textarea>
            </div>
          </div>
          <div class="form-group">
                <div id="response" class="hide">
              <img src="<?php echo site_url("assets/loading.gif") ?>" />
            </div>
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </div>
          </div>
        </form>
          </div>
        </div>
			</div>
		</div>
	</div>
	</section>
      <script type="text/javascript">

    $("#feedback_form").submit(function(evt){

      evt.preventDefault();
      
      $("#response").removeClass("hide");

      var formObject = $(this);
      var formData   = formObject.serializeArray();
      var formAction = formObject.attr("action");

      $.post(formAction, formData, function(data){
        
      },"json").success(function(data){

        $("#response").html(data.message);

      }).fail(function(data){
        $("#response").html(data.message);
      });


    });
  </script>
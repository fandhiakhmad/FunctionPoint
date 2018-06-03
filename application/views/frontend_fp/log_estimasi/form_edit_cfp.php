<script >

function PopupCenterDual(url, title, w, h) {
    // Fixes dual-screen position   Most browsers   Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}

function makeAjaxCall(){
  $.ajax({
    type: "post",
    url: "<?php echo base_url(); ?>log_estimasi/edit_cfp/<?php echo $id_aplikasi; ?>",
    cache: false,       
    data: $('#cfp').serialize(),
    success: function(json){            
    try{
    //try to get data count
    var obj = jQuery.parseJSON(json);
      document.getElementById('hasil'). value =obj['hasil'];
      alert( obj['STATUS']);
    }catch(e) {   
      alert(e);
    }   
    },
    error: function(){            
      alert('Error while request..');
    }
 });
}
</script>

<div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>
        <i class="glyphicon glyphicon-usd"></i>Form Estimasi Harga Perangkat Lunak 
        <?php if(isset($edit))
        	{ 
        		echo'<span class="label label-info">Edit</span>';
        	} ?> </h2>
      </div>

  <div class="box-content">
	  <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url();?>log_estimasi/daftar_log_estimasi"> Log Estimasi </a>
        </li>
		
		<li>
            <a href="<?php echo base_url();?>log_estimasi/edit_log_cfp/<?php echo $id_aplikasi;?>">Edit Log CFP</a>
        </li>
    </ul>

     <label class="control-label" for="selectError"><h3>Crude Function Point (CFP) </h3></label>
		<a  class="glyphicon glyphicon-question-sign" onclick="PopupCenterDual('<?php echo base_url(); ?>estimasi/popCFP','NIGRAPHIC','450','450');  " href="javascript:void(0);"></a>

    <form role="form" id="cfp" method="post" action="#">
      <table>
      <?php
      $n=0;
      foreach ($isi->result() as $row) {
          # code...
          $n++;
          ?>
      
      <tr>
        <td>
          <?php echo '' . $n; ?><font color="red">*</font>
        </td>

        <td>
          <?php echo $row->ITEM_DESCRIPTION ?>
        </td>

        <td>
          <?php echo $row->TYPE ?>
        </td>

        <td>
        <label class="control-label">
            <input type="number" name="surveycfp<?php echo $n; ?>" id="labelControl" min="0" style="width: 70px" value="<?php echo $row->VALUE;?>">
            <input type="hidden" name="idcfp<?php echo $n; ?>" id="labelControl" value="<?php echo $row->ID_P_CFP;?>">
            <input type="hidden" name="bobot<?php echo $n; ?>" id="labelControl" value="<?php echo $row->BOBOT;?>">
          </label>
          <p><font id="errkategori<?php echo $n;?>" color="red"></font></p>
        </td>
      </tr>

      <?php }
      ?>
      </table>

      <div class="form-group">
            <label for="exampleInputEmail1">Nilai CFP</label>
            <input type="number" name="hasil" readonly value="<php echo $nilai_cfp; ?>" min="0" class="form-control" id="hasil" style="width: :70px" >
      </div>

      <input type="button" onclick="javascript:makeAjaxCall();" class="btn btn-success" value="Perbarui"/>

      <a class="btn btn-info" onclick="return confirm('Apakah anda yakin?" href="<?php echo base_url();?>log_estimasi/daftar_log_estimasi">
        <i class="glyphicon glyphicon-chevron-left glyphicon-white"></i>Kembali
      </a>
      </form>
      </div>
		</div>
	</div>
</div>
</div>
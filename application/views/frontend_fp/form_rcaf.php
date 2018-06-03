<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>
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
		url: "<?php echo base_url(); ?>estimasi_fp/add_rcaf",
		cache: false,				
		data: $('#rcaf').serialize(),
		success: function(json){						
		try{
		//try to get data count
		var obj = jQuery.parseJSON(json);
		var data = new Array(); 
		var pesan = new Array();
		var data = obj['variable'];
		var pesan = obj['errpesan'];
		
		if(obj['errpesan']!=""){
			var index=1;
		while(index<=obj['size']){
			
				document.getElementById(data[index]).innerHTML=pesan[index];
			index++;
			}
		}
		
		else if(obj['errpesan']==""){
			var index=1;
			while(index<=obj['size']){	
				document.getElementById(data[index]).innerHTML="";
			index++;
		}
			document.getElementById('hasil').value =obj['hasil'];	
			alert( obj['STATUS']);
			window.location.href = "<?php echo base_url();?>estimasi_fp/form_rcaf";	
		}
	}	
	catch(e) 
		{		
			alert (e);
			console.log(json)
		}		
	},
		error: function(e){						
			alert('Error while request..');
		}
 });
}
</script>

<div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-usd"></i>Form Estimasi Harga Perangkat Lunak </h2>
      </div>
      
      <div class="box-content">
      	<ul class="nav nav-tabs" >
			
			<?php if($step >=1){?> 
			<li   ><a href="<?php echo base_url(); ?>estimasi_fp/form_edit_client/<?php echo $this->session->userdata('id_aplikasi')?>">Informasi Client </a></li>
          <?php } else {  ?> 
          <li  ><a href="#info">Informasi Client</a></li>
          <?php } ?>
		  
			<?php if($step >=2){?> 
			<li ><a href="<?php echo base_url(); ?>estimasi_fp/form_edit_aplikasi/<?php echo $this->session->userdata('id_aplikasi')?>">Deskripsi Aplikasi</a></li>
			<?php } else {  ?> 
			<li class="active" ><a href="#info">Deskripsi Aplikasi</a></li>
			<?php } ?>
					
			<?php if($step >=3){?> 
			<li ><a href="<?php echo base_url(); ?>estimasi_fp/form_cfp">CFP </a></li>
			<?php } else {  ?> 
			<li class="active" ><a href="#info">CFP </a></li>
			<?php } ?>
					
			<?php if($step >=4){?> 
			<li ><a href="<?php echo base_url(); ?>estimasi_fp/edit_log_rcaf/<?php echo $this->session->userdata('id_aplikasi')?>"  >RCAF <?php if (isset($edit) && $edit==true) { echo '<span class ="label label-info">Edit</span>';}?> </a></li>
			<?php } else {  ?> 
			<li class="active" ><a href="#">RCAF </a></li>
			<?php } ?>
					
			<!-- <?php if($step >=5){?> 
			<li class="active" ><a href="<?php echo base_url(); ?>estimasi/edit_log_tcf/<?php echo $this->session->userdata('id_aplikasi')?>"  >TCF <?php if(isset($edit) && $edit==true ){ echo'<span class="label label-info">Edit</span>';} ?> </a></li>
			<?php } else {  ?> 
			<li class="active" ><a href="#">TCF</a></li>
			<?php } ?>
					
			<?php if($step >=6){?> 
			<li  ><a href="<?php echo base_url(); ?>estimasi/edit_log_ecf/<?php echo $this->session->userdata('id_aplikasi')?>"  >ECF</a></li>
			<?php } else {  ?> 
			<li class="disabled" ><a href="#"  >ECF</a></li>
			<?php } ?> -->
					
			<?php if($step >=7){?> 
			<li ><a href="<?php echo base_url(); ?>estimasi_fp/result"  >Result</a></li>
			<?php } else {  ?> 
			<li class="disabled" ><a href="#"  >Result</a></li>
			<?php } ?>
         </ul>
        
	<div id="myTabContent" class="tab-content">
    	<div class="tab-pane active" id="info">
        	<label class="control-label" for="selectError">
        		<h3>Relative Complexity Adjustment Factor</h3>
        	</label>
		<a  class="glyphicon glyphicon-question-sign" onclick="PopupCenterDual('<?php echo base_url(); ?>estimasi_fp/popRCAF','NIGRAPHIC','450','450');  " href="javascript:void(0);"></a>
		
	<table>
		<tr>
			<td>
				<img src="<?php echo base_url();?>images/desc_rcaf_factor.PNG" alt="" /> 
			</td>
		</tr>
	</table>
                  
	<form role="form" id="rcaf" method="post" action="#" >
		<table>
			<?php 
			if($edit)
			{ 
				$n=0;
				foreach($isi->result() as $row)
				{
					$n++;

					if($template == 1) {
						if($n == 15){
							break;
						}
					}
			?>
			<tr>
				<td>
					<?php echo '' .$n; ?><font color="red">*</font>
				</td>
				
				<td>
					<?php echo $row->KARAKTERISTIK ?>
				</td>
				
				<td>
				<label class="radio-inline">
                    <input type="radio" 
                    <?php 
                    if($row->VALUE==0)
                    	{
                    		echo 'checked';
                    	}?> 
                    	name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="0"> 0
                </label>
				
				<label class="radio-inline">
                    <input type="radio" 
                    <?php 
                    if($row->VALUE==1 )
                    	{
                    		echo 'checked';
                    	}
                    ?> 
                    name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="1">1
					<input type="hidden" name="idrcaf<?php echo $n;?>" id="inlineRadio2" value="<?php echo $row->ID_P_RCAF; ?>">
					<input type="hidden" name="bobot<?php echo $n;?>" id="inlineRadio2" value="<?php echo $row->BOBOT; ?>">
				</label>
				
				
				<label class="radio-inline">
                	<input type="radio" 
                	<?php 
                	if($row->VALUE==2)
                	{
                		echo 'checked';
                	}
                	?> name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="2"> 2
                </label>
				
				<label class="radio-inline">
                	<input type="radio" 
                	<?php 
                	if($row->VALUE==3)
                		{
                			echo 'checked';
                		}
                	?> name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="3"> 3
                </label>
				
				<label class="radio-inline">
                    <input type="radio" 
                    <?php 
                    if($row->VALUE==4)
                    {
                    	echo 'checked';
                    }
                    ?> name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="4"> 4
                </label>
				
				<label class="radio-inline">
                    <input type="radio" 
                    <?php 
                    if($row->VALUE==5)
                    {
                    	echo 'checked';
                    }
                    ?> name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="5"> 5
                </label>
				<p ><font id="errkategori<?php echo $n;?>" color="red"></font></p>
			</td>
		</tr>
						
		<?php } 
		} 
				
		else {  
			$n=0; 
			foreach($isi->result() as $row){
			$n++;
			if($template == 1) {
				if($n == 15){
					break;
				}
			}
			?>
			
			<tr>
				<td>
				<?php echo '' .$n; ?><font color="red">*</font>
				</td>
				
				<td>
					<?php echo $row->KARAKTERISTIK ?>
				</td>
				<td>
				
				<label class="radio-inline">
                <input type="radio" name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="0"> 0
                </label>
				
				<label class="radio-inline">
                    <input type="radio" name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="1"> 1
					<input type="hidden" name="idrcaf<?php echo $n;?>" id="inlineRadio2" value="<?php echo $row->ID_P_RCAF; ?>">
					<input type="hidden" name="bobot<?php echo $n;?>" id="inlineRadio2" value="<?php echo $row->BOBOT; ?>">
				</label>
				
				
				<label class="radio-inline">
                	<input type="radio" name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="2"> 2
                </label>
				
				<label class="radio-inline">
                	<input type="radio" name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="3"> 3
                </label>
				
				<label class="radio-inline">
                	<input type="radio" name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="4"> 4
                </label>
				
				<label class="radio-inline">
                	<input type="radio" name="surveyrcaf<?php echo $n;?>" id="inlineRadio2" value="5"> 5
                </label>
				<p ><font id="errkategori<?php echo $n;?>" color="red"></font></p>
			</td>
		</tr>
		<?php }
		}
		?>
		</table>
			<p class="help-block">NB: <font color="red">*</font> Wajib Diisi</p>

			<?php 
			if($edit)
				{
					?>		
			<input type="button" onclick="javascript:makeAjaxCall();" class="btn btn-success" value="Perbarui"/>
					<?php 
				} 
			else 
				{ 
					?>
			<input type="button" onclick="javascript:makeAjaxCall();"  id="gantiTombol"class="btn btn-success" value="Simpan"/>
            		<?php 
            	}?>

            <br>
            </br>

            <?php if($step<=4 && isset($nilai_rcaf)) {?>

			<a class="btn btn-primary" id="next" onclick="return confirm('Apakah anda yakin? Pastikan semua indikator telah diisi')"  style="float: right;"  href="<?php echo base_url(); ?>estimasi_fp/result">    
            Berikutnya
			<i class="glyphicon glyphicon-chevron-right glyphicon-white"></i> </a>
			<?php }?>
			</form>		
		</div>
			
		<div class="form-inline " >
        	<b> 
        	<label for="exampleInputEmail1">Nilai RCAF : </label>
        	<label id="hasil">&nbsp;&nbsp;<?php 
        		if(isset($nilai_rcaf))
        			{ 
        				echo $nilai_rcaf;
        			} 
        			else {
        				echo 0;
        			}?>
        	</label> 
        	</b> 
		</div>        
	</div>
    </div>
    <!--/span-->
        <!--/span-->	
      </div>
    </div>
  </div>
  <!--/span-->
</div>
<!--/row-->
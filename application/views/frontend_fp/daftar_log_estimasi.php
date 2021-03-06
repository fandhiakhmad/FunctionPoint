<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>
<script>

 function print(url, title, w, h) {
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
  
</script>


<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-book"></i> Daftar Log Estimasi Aplikasi</h2>

      
    </div>
    <div class="box-content">
	
	<?php 
	if(isset($pesan)){
		echo'
	<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Well done!</strong>'.$pesan.'.
                </div>
				';
	}
				?>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
		<th>No</th>
        <th>Tanggal estimasi</th>
		<th>Nama Client</th>
        <th>Nama Aplikasi</th>
		<?php if($role==3 || $role==1 ){ ?> 
		<th>CFP</th>
		<th>RCAF</th>
		<th>Effort Estimate</th>
		<th>Effort Real</th>
		<?php }?>
		<th>Biaya Estimasi (Total)</th>
		<th>Tim Pengembang</th>
		<th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
	<?php $no =0;
	
	foreach($isi->result() as $row){
	
	$no++; ?>
	
	<tr>
	<td>
	<?php echo $no; ?>
	</td>
	<td>
	<?php echo $row->DATE_CREATED; ?>
	</td>
	<td>
	<?php echo $row->NAMA; ?>
	</td>
	<td>
	<?php echo $row->NAMA_APLIKASI; ?>
	</td>
	
	<?php if($role==3 || $role==1 ){ ?> 
	<td>
	<?php echo $row->CFP; ?> 
	</td>
	<td>
	<?php echo $row->RCAF; ?> 
	</td>
	<td>
	<?php echo $row->EFFORT_ESTIMATE; ?>
	</td>
	<td>
	<?php if($row->STATUS==4 && $row->STEP ==8){?>
		<a data-toggle="tooltip"  data-original-title="Masukan Actual Effort" href="<?php echo base_url() ?>log_estimasi/form_effort/<?php echo $row->ID_APLIKASI; ?><?php ?>"><?php echo number_format($row->EFFORT_REAL,2,',','.');?>  </a>
	<?php } 
	else{ ?>
		<?php echo $row->EFFORT_REAL; ?>
	<?php }?>
	</td>
	<?php }?>
	
	<td>
	<?php echo 'Rp. ' . number_format($row->BIAYA_ESTIMASI,2,',','.');?>
	</td>
	
	<td>
	<?php if($role <=2){?>
	<a href="<?php echo base_url() ?>estimasi_fp/lihat_tim/<?php echo $row->ID_APLIKASI; ?>"><?php echo $row->NAMA_TIM;?> </a>
	<?php }
	else{ ?>
			<?php echo $row->NAMA_TIM;?> 

	<?php }?>
	</td>
	
	<td>
	<?php if($row->STATUS==0){ ?>
	Belum lengkap
	<?php }

	else if($row->STATUS==1){ ?>
	<i class="btn-warning btn-sm" >Pending</i>
	<?php 
	}	

	else if($row->STATUS==2){ ?>
	<center><i class="btn-success btn-sm" >Disetujui</i></center>
 	<center>(Belum Cetak Penawaran)</center>
	
	<?php } else if($row->STATUS==3){ ?>
	<i class="btn-primary btn-sm" >Disetujui</i>
	<?php } 

	else if($row->STATUS==4  || $row->STATUS==5){ ?>	
	<i class="btn-primary btn-sm" >Goal</i>
	<?php } ?>
	</td>
	
	 <td class="center">
	 <?php if($role <=3 && ($row->STATUS ==4 || $row->STATUS<=1) && $row->STEP !=9  ){ ?>
            <a class="btn btn-info" href="<?php echo base_url(); ?>estimasi_fp/current_step/<?php echo $row->ID_APLIKASI; ?>-<?php echo $row->STEP; ?>" >
                <i class="glyphicon glyphicon-edit icon-white">  </i>
                Edit
            </a>
	 <?php }?>
	 <?php if( $row->STATUS ==5  && $row->STEP ==9 ){ ?>
            <a class="btn btn-info" href="<?php echo base_url(); ?>estimasi_fp/current_step/<?php echo $row->ID_APLIKASI; ?>-<?php echo $row->STEP; ?>" >
                <i class="glyphicon glyphicon-search icon-white">  </i>
                Lihat Detail
            </a>
	 <?php }?>
	 
           <?php if($row->STATUS>=2 && $role !=3){ ?>
			<a class="btn btn-default"   data-toggle="tooltip"  data-original-title="Cetak Penawaran" onclick="print('<?php echo base_url(); ?>log_estimasi/print_penawaran/<?php echo $row->ID_APLIKASI; ?> ','NIGRAPHIC','900','900');  " href="javascript:void(0);"  href="<?php echo base_url(); ?>log_estimasi/print_penawaran/<?php echo $row->ID_APLIKASI; ?> " > 
                <i class="glyphicon glyphicon-print icon-white"></i> 
                Print
			</a>
		   <?php }?>
		   
		    <?php if($row->STATUS==3&& $role <=3){ ?>
			<a class="btn btn-default"   data-toggle="tooltip"  data-original-title="Project Goal" href="<?php echo base_url(); ?>log_estimasi/goal/<?php echo $row->ID_APLIKASI; ?> " > 
                <i class="glyphicon glyphicon-check icon-white"></i> 
                Goal
			</a>
		   <?php }?>
        </td>
	</tr>
	<?php }?>
    </tbody>
	</table>
    </div>
    </div>
    </div>
    <!--/span-->
    </div><!--/row-->
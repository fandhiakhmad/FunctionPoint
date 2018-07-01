<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2>
        	<i class="glyphicon glyphicon-tags"></i>  Daftar Karakteristik Software (RCAF)
        </h2>
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
        <th>KARAKTERISTIK</th>
        <th>Actions</th>
    </tr>
    </thead>
    
    <tbody>
	<?php $no =0;
	foreach($isi->result() as $row){ $no++; ?>
	
	<tr>
	<td>
	<?php echo $no; ?>
	</td>
	
	<td>
	<?php echo $no; ?>
	</td>
	
	<td>
	<?php echo $row->KARAKTERISTIK; ?>
	</td>

	<td class="center">
    	<a class="btn btn-info"  href="<?php echo base_url(); ?>rcaf/edit/<?php echo $row->ID_RCAF;?>  ">
    		<i class="glyphicon glyphicon-edit icon-white" ></i>
    		Edit
        </a>
            
        <a class="btn btn-danger"  onclick="return confirm('Anda yakin untuk menghapus user <?php echo $row->DESKRIPSI; ?> ?')"  href="<?php echo base_url(); ?>rcaf/delete/<?php echo $row->ID_RCAF;?> "><i class="glyphicon glyphicon-trash icon-white"></i>
            Delete
		</a>
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

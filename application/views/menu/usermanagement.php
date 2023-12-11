<!-- DataTales Example -->
<div class="container mt-3">
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between">
		  	<h6 class="m-0 font-weight-bold text-primary"><?= $title_page; ?></h6>
		  	<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#formModal" data-url="<?= base_url(); ?>" id="addNewMenu">
				<i class="fas fa-plus"></i> Tambah Pengguna
			</a>			
		</div>
		<div class="card-body">
			<div class="table-responsive">
			    <table class="table table-bordered table-striped table-hover" id="postsList" width="100%" cellspacing="0">
			      <thead>
			        <tr>
						<th style="max-width: 5%;">No</th>
						<th style="width: 30%; min-width: 250px;">Nama</th>
						<th style="width: 20%; min-width: 250px;">Email</th>
						<th style="width: 20%; min-width: 250px;">Role</th>
						<th style="width: 25%; min-width: 200px;">Action</th>
			        </tr>
			      </thead>
			      <tbody>
			      	<?php 
			      	$number = 0;
			      	foreach($menu as $m): ?>
			      	<tr>
			      		<td><?= ++$number; ?></td>
			      		<td><?= $m['name']; ?></td>
			      		<td><?= $m['email']; ?></td>
			      		<td>
			      		     <?php foreach($role as $r): ?>
    						        <?php 
    						            if($r['id'] == $m['role_id']){
    						                echo $r['role']; 
    						            }
    						        ?>
    						  <?php endforeach; ?>
			      		</td>
			      		<td>
			      			<a href="#" class="btn btn-sm btn-warning p-2 tampilModalUbah" data-id="<?= $m['id']; ?>" data-url="<?= base_url(); ?>" data-toggle="modal" data-target="#formModal">
								<i class="fas fa-pen"></i> Edit
							</a>
							<a href="#" class="btn btn-sm btn-danger p-2 tampilModalAlert" data-id="<?= $m['id']; ?>" data-url="<?= base_url(); ?>" data-toggle="modal" data-target="#alertModal">
								<i class="fas fa-trash"></i> Delete
							</a>
			      		</td>
			      	</tr>
				    <?php endforeach; ?>
			      </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>

<!-- form Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formModalAction" action="" method="post" enctype="multipart/form-data">
				    <input type="text" name="id" id="id" class="form-control" value="" hidden="hidden">
				    <div class="row">
				        <div class="col-md-6">
        					<div class="form-group">
        						<input type="email" name="email" class="form-control" required="" id="formModalEmail" placeholder="Email">
        						<span id="peringatan"></span>
        					</div>
        				</div>
    					<div class="col-md-6">
        					<div class="form-group">
        						<input type="password" name="password" class="form-control" required="" id="formModalInput" placeholder="password">
        					</div>
        				</div>
    					<div class="col-md-6">
        				    <div class="form-group">
        						<select name="role_id" class="form-control" required="" id="formModalInput">
        						    <option value="">Pilih Role</option>
        						    <?php 
                    		        foreach($role as $r): ?>
        						        <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
        						    <?php endforeach; ?>
        						</select>
        					</div>
        				</div>
        				<div class="col-md-6">
        					<div class="form-group">
        						<div class="form-check">
        	                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked="">
        	                        <label class="form-check-label" for="is_active">Active?</label>
        						</div>
        					</div>
        				</div>
        			</div>
					<div class="row">
    					<div class="col-md-12">
        					<div class="form-group">
        						<input type="text" name="name" class="form-control" required="" id="formModalInput" placeholder="Nama">
        					</div>
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-6">
        					<div class="form-group">
        					    <label for="upload_kk">Upload Foto:</label>
        						<input type="file" name="image" class="form-control" required="" id="formModalInput" placeholder="Upload Foto">
        					</div>
        				</div>
        				<div class="col-md-6">
        				    <center>
        				        <img id="image1" width="100%">
        				    </center>
        				</div>
    				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" required="">Close</button>
				<button hidden="hidden" type="submit" class="btn btn-primary" id="formModalBtn"></button>
			    </form>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="alertModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<p id="paragrafBodyModal"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="" id="anchorAlertModal"></a>
			</div>
		</div>
	</div>
</div>


<script>
    $(document).ready(function() {
        // $('#formModalEmail').on('blur', function() {
        //     var email = $(this).val();
            
        //     $.ajax({
        //         url: '<?php echo site_url('menu/checkEmail'); ?>', // Sesuaikan dengan URL controller Anda
        //         type: 'post',
        //         data: {email: email},
        //         dataType: 'json',
        //         success: function(response) {
        //             var peringatanElem = $('#peringatan');
        //             if (response.status === 'exists') {
        //                 // Lakukan tindakan saat email sudah ada di database
        //                 peringatanElem.text('Email sudah ada').show();
        //                 $('.modal-footer button[type=submit]').attr('hidden', 'hidden');
        //                 console.log('Email sudah terdaftar.');
        //             } else {
        //                 // Lakukan tindakan saat email belum ada di database
        //                 peringatanElem.text('Email belum ada').show();
        //                 $('.modal-footer button[type=submit]').removeAttr('hidden', 'hidden');
        //                 console.log('Email tersedia.');
        //             }
        //         }
        //     });
        // });
    
		$('#formModalInput').on('keyup',function(){
			if ($(this).val().length == 0) {
				$('.modal-footer button[type=submit]').attr('hidden', 'hidden');
			}else{
				$('.modal-footer button[type=submit]').removeAttr('hidden', 'hidden');
			}
		});
	
		// menampilkan alert konfirmasi hapus data
		$('.tampilModalAlert').on('click', function(){
			const id = $(this).data('id');
			const url = $(this).data('url');
			$('#anchorAlertModal').attr('href', url + '/menu/userdelete/' + id);
			$('#alertModalLabel').html('Hapus');
			$('#anchorAlertModal').attr('class', 'btn btn-danger');
			$('#anchorAlertModal').html('Hapus');
			$('#paragrafBodyModal').html('Apakah anda yakin..?');
		});

		// modal tambah data
		$('#addNewMenu').on('click', function(){
			const url = $(this).data('url') + 'menu';
			$('#is_active').attr('checked', '');
			$('option').removeAttr('selected','');
			$('input[name=name]').val('');
			$('input[name=email]').val('');
			$('input[name=password]').val('');
			$('input[name=kk]').val('');
			$('input[name=nik]').val('');
			$('input[name=jk]').val('');
			$('input[name=ttl]').val('');
			$('input[name=pendidikan]').val('');
			$('input[name=pekerjaan]').val('');
			$('input[name=gol_darah]').val('');
			$('input[name=status_perkawinan]').val('');
			$('textarea[name=alamat]').val('');
			$('input[name=nama_keluarga]').val('');
			$('input[name=status_warga]').val('');
			$('input[name=role_id]').val('');
			$('#image1').attr('src', '').hide();
			$('#image2').attr('src', '').hide();
			$('#formModalLabel').html('Tambah Pengguna');
			$('#formModalBtn').html('Tambah Pengguna');
			$('#formModalInput').removeAttr('value');
		});

		// modal edit data
		$('.tampilModalUbah').on('click', function(){
// 			$('.modal-footer button[type=submit]').attr('hidden', 'hidden');
			$('#image1').attr('src', '').hide();
			$('#image2').attr('src', '').hide();
			$('input[name="image"]').removeAttr("required");
			$('input[name="upload_kk"]').removeAttr("required");
			$('input[name=name]').val('');
			$('input[name=email]').val('');
			$('input[name=password]').val('').removeAttr("required");
			$('input[name=kk]').val('');
			$('input[name=nik]').val('');
			$('input[name=jk]').val('');
			$('input[name=ttl]').val('');
			$('input[name=pendidikan]').val('');
			$('input[name=pekerjaan]').val('');
			$('input[name=gol_darah]').val('');
			$('input[name=status_perkawinan]').val('');
			$('textarea[name=alamat]').val('');
			$('input[name=nama_keluarga]').val('');
			$('input[name=status_warga]').val('');
			$('input[name=role_id]').val('');
			$('#formModalLabel').html('Edit Pengguna');
			$('#formModalBtn').html('Edit Pengguna');
			const id = $(this).data('id');
			const url = $(this).data('url');
			$('#formModalAction').attr('action', url + 'menu/useredit');
			$.ajax({
				url: url + 'menu/userdetail',
				data: {id: id},
				method: 'post',
				dataType: 'json',
				success: function(data){
					$('option[value='+ data.role_id +']').attr('selected','');
					$('option[value="'+ data.status_warga +'"]').attr('selected','');
					$('option[value="'+ data.jk +'"]').attr('selected','');
					$('input[name=id]').val(data['id']);
					$('input[name=email]').val(data['email']);
					$('input[name=gol_darah]').val(data['gol_darah']);
					$('input[name=nama_keluarga]').val(data['nama_keluarga']);
					$('input[name=nik]').val(data['nik']);
					$('input[name=kk]').val(data['kk']);
					$('input[name=pekerjaan]').val(data['pekerjaan']);
					$('input[name=pendidikan]').val(data['pendidikan']);
					$('textarea[name=alamat]').val(data['alamat']);
					$('input[name=ttl1]').val(data['ttl1']);
					$('input[name=ttl2]').val(data['ttl2']);
					$('input[name=name]').val(data['name']);
					$('#image1').attr('src', '<?php echo base_url("/assets/img/profile/") ?>' + data.image).show();
					$('#image2').attr('src', '<?php echo base_url("/assets/img/profile/") ?>' + data.upload_kk).show();
					$('input[name=id]').attr('value', data['id']);
					if (data.is_active == 1) {
						$('#is_active').attr('checked', '');
					}else{
						$('#is_active').removeAttr('checked', '');
					}
					$('option[value="'+ data.status_perkawinan +'"]').attr('selected','');
				}
			});
		});
	});
</script>
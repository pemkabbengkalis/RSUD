<?php $__env->startSection('content'); ?>
<form class="editor-form" action="<?php echo e(URL::full()); ?>" method="post" enctype="multipart/form-data">
   <?php echo csrf_field(); ?>
   <div class="row">
      <div class="col-lg-12">
         <h3 style="font-weight:normal"> <i class="fa <?php echo e(get_module_info('icon')); ?>" aria-hidden="true"></i> <?php echo e(get_module_info('title_crud')); ?> <a href="<?php echo e(admin_url(get_post_type())); ?>" class="btn btn-outline-danger btn-sm pull-right" data-toggle="tooltip" title="Kembali Ke Index Data"> <i class="fa fa-undo" aria-hidden></i> Kembali</a></h3>
         <br>
         <?php if(!empty($edit && get_module_info('detail') && $edit->post_title)): ?>
         <div style="border-left:3px solid green" class="alert alert-success"><b>URL : </b><a title="Kunjungi URL" data-toggle="tooltip" href="<?php echo e(url($edit->post_url)); ?>" target="_blank"><i><u><?php echo e(url($edit->post_url)); ?></u></i></a> <span title="Klik Untuk Menyalin alamat URL <?php echo e(get_module_info('title')); ?>" data-toggle="tooltip" class="pointer copy pull-right badge badge-primary" data-copy="<?php echo e(url($edit->post_url)); ?>"><i class="fa fa-copy" aria-hidden></i> <b>Salin</b></span></div>
         <?php endif; ?>
      </div>
      <div class="col-lg-9">
         <div class="form-group">
            <input data-toggle="tooltip" title="Masukkan <?php echo e(get_module_info('data_title')); ?>"  required name="post_title"  type="text" value="<?php echo e($edit->post_title ?? ''); ?>" placeholder="Masukkan <?php echo e(get_module_info('data_title')); ?>" class="form-control form-control-lg">
          
         </div>
         
         <?php if(get_module_info('editor')): ?>
         <div class="form-group">
           <?php if($edit->mime_type=='html'): ?>
           <textarea style="height:70vh" class="form-control text-white bg-dark" name="post_content" placeholder="Masukkan Script HTML"><?php echo e(get_custom_view($edit->post_id)); ?></textarea>
          <?php else: ?>
            <textarea name="post_content" placeholder="Keterangan..." id="editor"><?php echo e($edit->post_content ?? ''); ?></textarea>
            <?php endif; ?>
         </div>
         <?php endif; ?>
         <?php if(get_module_info('post_parent')): ?>
         <?php 
         if(isset(get_module_info('post_parent')[1])){
            if(isset(get_module_info('post_parent')[2]) && get_module_info('post_parent')[2]!='all'){
                  // echo "<script>alert('oi');</script>";
                  $par =  App\Models\Post::withwherehas('group.group',function($q){
                     $q->where('slug',get_module_info('post_parent')[2]);
                  })->wherePostType(get_module_info('post_parent')[1])->wherePostStatus('publish')->select('post_id','post_title')->get(); 
                  
               }
               else{
                  $par =  App\Models\Post::wherePostType(get_module_info('post_parent')[1])->wherePostStatus('publish')->select('post_id','post_title')->get(); 
   
            }
            }
         ?>
         <h6><?php echo e(get_module_info('post_parent')[0]); ?></h6>
         <select <?php if(isset(get_module_info('post_parent')[3]) && get_module_info('post_parent')[3]=='required'): ?> required <?php endif; ?> class="form-control form-control-sm" name="post_parent">
            <option value="">--pilih--</option>
         
            <?php $__currentLoopData = $par; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php if($edit && $edit->post_parent == $row->post_id): ?> selected <?php endif; ?> value="<?php echo e($row->post_id); ?>"><?php echo e($row->post_title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

         </select>
        
         <?php endif; ?>

         <?php if(get_module_info('custom_field')): ?>
         <?php $__currentLoopData = get_module_info('custom_field'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php if(is_array($r[1])): ?>
         <small><?php echo e($r[0]); ?></small> 
         <select class="form-control form-control-sm" name="<?php echo e(underscore($r[0])); ?>">
            <option value="">--pilih--</option>
            <?php $__currentLoopData = $r[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php echo e((!empty($field) && isset($field[underscore($r[0])]) && $field[underscore($r[0])]==$i)? 'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </select>
         <?php elseif($r[1]=='file'): ?>
         <small for=""><?php echo e($r[0]); ?></small>
         <input  <?php if(isset($r[2]) && $r[2] =='required'): ?> required <?php endif; ?> <?php if($field && isset($field[underscore($r[0])]) && $field[underscore($r[0])] && file_exists(public_path($field[underscore($r[0])]))): ?> disabled   title="Hapus dokumen terlebih dahulu sebelum mengganti"  <?php else: ?>  data-toggle="tooltip"  title="Pilih dokumen baru"  <?php endif; ?> onchange="readFile(this);" <?php if(!empty($field[underscore($r[0])])): ?>  <?php endif; ?> value="<?php echo e($field[underscore($r[0])] ?? ''); ?>" class="form-control-file form-control form-control-sm" name="<?php echo e(underscore($r[0])); ?>" type="file" placeholder="Masukkan <?php echo e($r[0]); ?>">

         <input value="<?php echo e($field && isset($field[underscore($r[0])]) && file_exists(public_path($field[underscore($r[0])])) ? $field[underscore($r[0])] : null); ?>" name="old_<?php echo e(underscore($r[0])); ?>" type="hidden">
         <?php if($field && isset($field[underscore($r[0])]) && $field[underscore($r[0])] && file_exists(public_path($field[underscore($r[0])]))): ?><small> <a data-toggle="tooltip"  title="Lihat Dokumen" class="badge badge-primary" href="<?php echo e(asset($field[underscore($r[0])])); ?>" ><i class="fa fa-eye" aria-hidden="true"></i> </a> <i style="cursor:pointer" onclick="if(confirm('Hapus dokumen ?')){exeurl('<?php echo e($field[underscore($r[0])]); ?>')}" data-toggle="tooltip"  title="Hapus dokumen" class="fa fa-trash text-danger"></i></small> <br> <?php endif; ?>
         <?php elseif($r[1]=='break'): ?>
         <br>
         <h6 for="" style="border-bottom:1px dashed #000"><?php echo e($r[0]); ?></h6>
         <?php elseif($r[1]=='array'): ?>
        
         <?php elseif(underscore($r[0])=='tanggal_entry'): ?>
        
         <small for=""><?php echo e($r[0]); ?></small>
         <input <?php if(isset($r[2]) && $r[2] =='required'): ?> required <?php endif; ?> type="datetime-local" value="<?php echo e($field[underscore($r[0])] ?? ''); ?>" class="form-control form-control-sm" name="<?php echo e(underscore($r[0])); ?>" placeholder="Entri <?php echo e($r[0]); ?>">

         <?php else: ?>
         <small for=""><?php echo e($r[0]); ?></small>
         <input <?php if(isset($r[2]) && $r[2] =='required'): ?> required <?php endif; ?> <?php if($r[1]=='number'): ?> oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" <?php endif; ?> value="<?php echo e($field[underscore($r[0])] ?? ''); ?>" class="form-control form-control-sm" name="<?php echo e(underscore($r[0])); ?>" type="<?php echo e($r[1]=='number'?'text':$r[1]); ?>" placeholder="Entri <?php echo e($r[0]); ?>">
         <?php endif; ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endif; ?>



      <?php if((get_module_info('looping') && get_post_type() !='halaman') || (get_post_type() =='halaman' && $edit->mime_type=='html')): ?>
         <br>
         <h6 style="border-bottom:1px dashed #000;font-weight:normal"><b><?php echo e(get_module_info('looping')); ?></b> <span class="text-muted pull-right"><?php echo e(get_module_info('looping_for')); ?></span> </h6>

         <?php if(get_module_info('post_type') != 'menu'): ?>
            <?php if(get_module_info('post_type') == 'lasyanan'): ?>
               <?php echo $__env->make('admin.hasil-skm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
               <?php echo $__env->make('admin.looping-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
         <?php else: ?>
            <?php echo $__env->make('admin.list-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php endif; ?>

      <?php endif; ?>
      </div>
      <div class="col-lg-3">
         <?php if(get_module_info('thumbnail')): ?>
         <div class="card">
            <p class="card-header"> <i class="fa fa-image" aria-hidden></i> Gambar</p>
            <!-- <img style="height: 200px; width: 100%; display: block;" src="https://user-media-prod-cdn.itsre-sumo.mozilla.net/uploads/products/2020-04-14-08-36-13-8dda6f.png"> -->
            <img class="img-responsive" style="border:none" id="thumb" src="<?php echo e(thumb($edit->post_thumbnail)); ?>" />
            <input onchange="readURL(this);" type="file" class="form-control-file form-control-sm" name="post_thumbnail" value="">
            <?php if(get_module_info('index') && get_module_info('detail')): ?>
            <span style="padding:10px">
            <textarea placeholder="Keterangan Gambar" type="text" class="form-control form-control-sm" name="post_thumbnail_description"><?php echo e($edit->post_thumbnail_description ?? ''); ?></textarea>
            </span>
            <?php endif; ?>
         </div>
         <script>
            function readURL(input) {
              const allow = ['gif','png','jpeg','jpg','GIF','PNG','JPEG','JPG'];
              var ext = input.value.replace(/^.*\./, '');
              if(!allow.includes(ext)){
                alert('Pilih hanya gambar');
                input.value='';
              }else {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#thumb')
                            .attr('src', e.target.result)
                            .width('100%')
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            }

         </script>
         <?php endif; ?>
         <?php if(get_module_info('post_type')=='halaman'): ?>
         <small>Tampilan Halaman</small>
         <select class="form-control form-control-sm" name="mime_type">
           <option value="">Bawaan Template</option>
            <option value="html" <?php echo e($edit && $edit->mime_type=='html'?'selected':''); ?>>Kustom HTML</option>
         </select>
         <!-- <small>Nama Domain <?php echo help("Opsi Jika Ingin mengakses halaman ini sebagai domain khusus"); ?> </small>
         <input type="text" class="form-control form-control-sm" name="domain_custom" placeholder="namadomain.com" value="<?php echo e($edit->domain_custom ?? ''); ?>"> -->
         <?php endif; ?>
         <?php if(get_module_info('detail')): ?>
         <small>Pengalihan URL <?php echo help("Opsi Jika Ingin Mengalihkan Konten Ini ke suatu halaman web atau url"); ?> </small>
         <input type="text" class="form-control form-control-sm" name="redirect_to" placeholder="URL dimulai https:// atau http://" value="<?php echo e($edit->redirect_to ?? ''); ?>">
         <small for="">Deskripsi <?php echo help("Opsi deskripsi singkat tentang konten yang dapat ditelusuri oleh mesin pencarian"); ?> </small>
         <textarea placeholder="Tulis Deskripsi" type="text" class="form-control form-control-sm" name="post_meta_description"><?php echo e($edit->post_meta_description ?? ''); ?></textarea>
         <small for="">Kata Kunci  <?php echo help("Kata kunci tentang konten yang dapat ditelusuri oleh mesin pencarian"); ?></small>
         <input placeholder="Keyword1,Keyword2,Keyword3" type="text" class="form-control form-control-sm" name="post_meta_keyword" value="<?php echo e($edit->post_meta_keyword ?? ''); ?>">
         <?php endif; ?>
         <?php if(get_module_info('group')): ?>
         <small for="">Kategori  <?php echo help("Pengelompokan kategori konten"); ?></small><br>
         <select  class="form-control form-control-sm" id="demoSelect" multiple="" name="post_group[]">
            <optgroup label="Pilih">
               <?php $__currentLoopData = App\Models\Group::where('status',1)->where('type',get_post_type())->orderBy('sort','asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option value="<?php echo e($row->id); ?>" <?php echo e(($edit && in_array($row->id,json_decode($edit->group->pluck('group_id'),true)) ? 'selected=selected' : '')); ?>><?php echo e($row->name); ?></option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </optgroup>
         </select>
         <div class="text-right"><small class="text-primary"><a href="<?php echo e(admin_url(get_post_type().'/group')); ?>"> <i class="fa fa-plus" aria-hidden></i> Tambah Baru</a></small></div>
         <?php else: ?>
         
         <?php endif; ?>

         <?php if(get_module_info('detail')): ?>
         
         <div <?php if(!get_module_info('group')): ?> style="margin-top:10px" <?php endif; ?>  class="animated-checkbox">
            <label>
            <input type="checkbox" <?php echo e(($edit && $edit->allow_comment == 1)? 'checked=checked':''); ?> name="allow_comment" value="1"><span class="label-text"><small>Izinkan Komentar  <?php echo help("Jika dicentang, maka pengunjung bisa mengirim komentar pada postingan ini"); ?></small></span>
            </label>
         </div>
         <?php endif; ?>
         <?php if(get_module_info('thumbnail')): ?>
         <div class="animated-checkbox">
            <label>
            <input <?php echo e(($edit && $edit->post_pin == 1)? 'checked=checked':''); ?> type="checkbox" name="post_pin" value="1"><span class="label-text"><small>Sematkan  <?php echo help("Jika dicentang, maka postingan ini akan menjadi prioritas dihalaman jika dikondisikan pada template "); ?></small></span>
            </label>
         </div>
         <?php endif; ?>
         <div class="form-group form-inline">
            <div class="animated-radio-button">
               <label>
               <input <?php echo e(($edit && $edit->post_status == 'publish')? 'checked=checked':''); ?> required type="radio" name="post_status" value="publish"><small class="label-text">Publikasikan</small>
               </label>
            </div>
            &nbsp;&nbsp;&nbsp;
            <div class="animated-radio-button">
               <label>
               <input <?php echo e(($edit && $edit->post_status == 'draft')? 'checked=checked':''); ?> required type="radio" name="post_status" value="draft"><small class="label-text">Draft</small>
               </label>
            </div>
         </div>
         <button <?php if(Auth::user()->level=='admin' || Auth::user()->id==$edit->author->id): ?> name="save" value="<?php if(empty($edit)): ?>add <?php else: ?> <?php echo e(enc64($edit->post_id)); ?> <?php endif; ?>" type="submit" data-toggle="tooltip" title="Simpan Perubahan" <?php else: ?> type="button"  onclick="alert('Anda bukan pemilik konten ini!')" <?php endif; ?> class="btn btn-md btn-outline-primary w-100 add">SIMPAN</button><br><br>
      </div>
   </div>
</form>
<?php if($edit->mime_type != 'html'): ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<?php echo $__env->make('admin.layout.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<script type="text/javascript">
   function readFile(input) {
     const allow = ['gif','png','jpeg','jpg','zip','docx','doc','rar','pdf','xlsx','xls'];
     var ext = input.value.replace(/^.*\./, '');
     if(!allow.includes(ext)){
       alert("Format didukung : gif,png,jpeg,jpg,zip,docx,doc,rar,pdf,xlsx,xls");
       input.value='';
     }
   }
function delloop(path){
  var url = "<?php echo e(admin_url(get_post_type().'/loop')); ?>";
     $.get( "ajax/test.html", function( data ) {
  $( ".result" ).html( data );
  alert( "Load was performed." );
});
   }
   function exeurl(url){
   $.get("<?php echo e(url(admin_path().'/unlink?link=')); ?>"+url, function(data, status){
      
     notif("File Berhasil Dihapus","success");


       setTimeout(() => {
         location.reload();
 }, "1000")


 });
 }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app',['title'=>get_module_info('title_crud')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\cmsv2\app\View/admin/form-default.blade.php ENDPATH**/ ?>
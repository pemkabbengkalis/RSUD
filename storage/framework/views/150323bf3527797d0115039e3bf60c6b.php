<div class="table-responsive" style="height:75vh;">

   <table class="table table-bordered table-hover table-striped" style="background:#fff;font-size:small;">
      <thead style="background:#f7f7f7">
         <tr>
            <?php $__currentLoopData = get_module_info('looping_data'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th class="text-center" <?php if($r[0] == 'Sort'): ?>style="width:10px"<?php endif; ?>><?php echo e($r[0]); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th class="text-center">#</th>
         </tr>
      </thead>
      <tbody class="coldata">
        <!--  -->
         <?php if($looping_data): ?>

         <!--  -->
         <?php $__currentLoopData = json_decode($looping_data); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y=> $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr id='data-<?php echo e($y); ?>'>
         <?php $__currentLoopData = get_module_info('looping_data'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ky=>$r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php $k = underscore($r[0]);?>
         <td align="center" <?php if('file'==$r[1]): ?>  onmouseover="$('.edit-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?>').show()" onmouseout="$('.edit-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?>').hide()" <?php endif; ?>>
            <?php if('file'==$r[1]): ?>
            <?php
            if(!empty($l->$k) && file_exists(public_path($l->$k))){
              $f[$y] = true;
              // echo $f[$ky].'df';
            }
            ?>
            <span <?php if(!empty($l->$k) && file_exists(public_path($l->$k)) && allowed_ext(get_ext($l->$k))): ?>style="display:none"<?php endif; ?> class="input-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?>">

              <input title="Format: <?php echo e(allowed_ext()); ?>" data-toggle="tooltip" onchange="readFile(this);"  placeholder="Masukkan <?php echo e($r[0]); ?>" type="file" style="width:74px;" class="form-control-sm" name="<?php echo e(underscore($r[0])); ?>[]"/>


            </span>
               <input type="hidden" class="oldfile-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?>"  name="<?php echo e(underscore($r[0])); ?>[]" value="<?php echo e($l->$k ?? 'nofile'); ?>">
            <?php if(!empty($l->$k) && file_exists(public_path($l->$k)) && allowed_ext(get_ext($l->$k))): ?><a target="_blank" href="<?php echo e(asset($l->$k)); ?>" class="file-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?> btn btn-sm btn-outline-info"> <?php echo e(strtoupper(get_ext($l->$k))); ?> </a>
          <i  style="display:none" class="fa fa-trash pointer text-danger edit-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?>" onclick="if(confirm('Hapus file ?')) { exeurl('<?php echo e($l->$k); ?>'); this.remove();$('.input-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?> input[type=file]').removeAttr('disabled','');$('.file-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?>').remove();$('.input-<?php echo e(underscore($r[0])); ?>-<?php echo e($y); ?>').show();}" aria-hidden></i>

          <?php endif; ?>
            <?php elseif(is_array($r[1])): ?>
            <select class="form-control form-control-sm" name="<?php echo e(underscore($r[0])); ?>[]">
               <option value="">-pilih-</option>
               <?php $__currentLoopData = $r[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option <?php echo e(isset($l->$k) && $l->$k==$r ? 'selected':''); ?> value="<?php echo e($r); ?>"><?php echo e($r); ?></option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php else: ?>
            <input  placeholder="Entri Data <?php echo e(ucwords(mb_strtolower($r[0]))); ?>" type="<?php echo e($r[1]); ?>"  class="form-control form-control-sm" style="min-width:80px" name="<?php echo e(underscore($r[0])); ?>[]" value="<?php echo e($l->$k ?? null); ?>">
            <?php endif; ?>
         </td>

         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <td class="text-center" >  <i <?php if(isset($f[$y])): ?> onclick="alert('Hapus file terlebih dahulu')" <?php else: ?> onclick="if(confirm('Hapus Data Baris?')){$('#data-<?php echo e($y); ?>').remove()}" <?php endif; ?> class="fa fa-trash pointer text-danger" style="display:inline" aria-hidden></i>  </td>
         </tr>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

         <?php endif; ?>
      </tbody>
      <tfoot style="background:#f7f7f7">
         <tr>
            <td colspan="<?php echo e(count(get_module_info('looping_data'))+1); ?>" align="right">
           <button style="display:none" type="button" class="btn btn-sm btn-outline-danger delbut" onclick="$('.coldata tr.nw:last').remove();$('.btnadd').show();$('.delbut').hide();">&nbsp;&nbsp;<i class="fa fa-times" aria-hidden></i></button> <button onclick="$('.coldata').append('<tr class=\'nw\'>'+ $('.addcol').html()+'</tr>');$('.coldata tr.nw select').removeAttr('disabled');$('.coldata tr.nw input').removeAttr('disabled');$('.delbut').show();$('.btnadd').hide()" type="button" class="btn btn-sm btn-outline-info btnadd" name="button"> &nbsp; <i class="fa fa-plus"></i></button></td>
         </tr>
         <tr style="display:none" class="addcol">
            <?php $__currentLoopData = get_module_info('looping_data'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td class="text-center">
               <?php if($r[1]=='file'): ?>
               <input  disabled onchange="readFile(this)" type="<?php echo e($r[1]); ?>"  class="form-control-sm" style="width:74px;"   name="<?php echo e(underscore($r[0])); ?>[]" >
               <?php elseif(is_array($r[1])): ?>
            <select disabled  class="form-control form-control-sm" name="<?php echo e(underscore($r[0])); ?>[]">
               <option value="">-pilih <?php echo e(ucwords(mb_strtolower($r[0]))); ?>-</option>
               <?php $__currentLoopData = $r[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option value="<?php echo e($r); ?>"><?php echo e($r); ?></option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php else: ?>
               
               <input style="min-width:80px" disabled placeholder="Entri Data <?php echo e(ucwords(mb_strtolower($r[0]))); ?>" type="<?php echo e($r[1]); ?>"  class="form-control form-control-sm"  name="<?php echo e(underscore($r[0])); ?>[]" >
               <?php endif; ?>
            </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td></td>
         </tr>
      </tfoot>
   </table>
</div>
<?php /**PATH /home/kulipixe/cmsv2/app/View/admin/looping-data.blade.php ENDPATH**/ ?>
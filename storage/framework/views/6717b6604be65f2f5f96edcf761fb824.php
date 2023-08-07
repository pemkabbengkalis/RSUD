<?php echo get_banner('<div  class="modal fade text-center py-5" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content" style="overflow:hidden;"><div class="modal-body" style="padding:0"> <a title="Tutup" class="btn btn-warning" style="position: absolute;color:white;cursor:pointer;top: 0;right: 0;margin-top: 0;border-top-left-radius: 0;border-bottom-right-radius: 0;" onclick="$(\'.modal\').modal(\'hide\')"> <i class="fa fa-times"></i> </a>','</div></div></div></div>','popup'); ?>


<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', function() {
      setTimeout(() => {
  $('#popup').modal('show');
}, "2000")

    });
</script>
<?php /**PATH C:\laragon\www\cmsv2\app\View/modal.blade.php ENDPATH**/ ?>
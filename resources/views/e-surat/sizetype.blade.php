<script>
  function nohp(phone) {
    const prefix = phone.slice(0, 4);
    if (['0831', '0832', '0833', '0838'].includes(prefix)) return 'axis';
    if (['0895', '0896', '0897', '0898', '0899'].includes(prefix)) return 'three';
    if (['0817', '0818', '0819', '0859', '0878', '0877'].includes(prefix)) return 'xl';
    if (['0814', '0815', '0816', '0855', '0856', '0857', '0858'].includes(prefix)) return 'indosat';
    if (['0812', '0813', '0852', '0853', '0821', '0823', '0822', '0851', '0811'].includes(prefix)) return 'telkomsel';
    if (['0881', '0882', '0883', '0884', '0885', '0886', '0887', '0888', '0889'].includes(prefix)) return 'smartfren';
    return null;
}
    function ceksizetype(el)
{
     var file =el.value;
     if(file!='')
     {
           var checkimg = file.toLowerCase();
          if (!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.PDF|\.pdf)$/)){ // validation of file extension using regular expression before file upload
            el.value='';
              alert('File hanya mendukuing format gambar JPG , PNG dan PDF');
              return false;
           }
          //   var src = el; 
          //   // alert(src.files[0].size);
          //   if(src.files[0].size >  1024000)  // validation according to file size
          //   {
          //   el.value='';

          //  alert('Ukuran file terlalu besar, Maksimal hanya 500KB');
          //       return false;
          //    }
             return true;
      }
}
</script>
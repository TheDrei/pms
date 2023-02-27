<script type="text/javascript">
        function ShowMsg(title,subtitle,type,url)
        {
            Swal.fire({
              title : title,
              text : subtitle,
              type : type,
              allowOutsideClick: false
            }).then((result) => {
      			  if (result.value) {

                if(url == "")
                {
                  location.reload();
                }
                else
                {
                  window.location.href=url;  
                }
      			    
      			  }
      			})
        }

        function ConfirmAction(frm)
        {
          Swal.fire({
            title: 'Save Record?',
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.value) {
              $("#"+frm).submit();
            }
          });
        }

        function ConfirmActionFrm(frm,url)
        {
          Swal.fire({
            title: 'Save Record?',
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.value) {
              postAjax(url);
            }
          });
        }
</script>
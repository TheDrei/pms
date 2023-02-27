<script type="text/javascript">
	var uri = "";

  //AJAX POST ACTION
  function postAjax(urli)
  {
  		uri = urli;
  		$("#frm").submit();
  }

  $("#frm").submit(function(e) {
	    e.preventDefault();    
	    var formData = new FormData(this);
	    $.ajax({
	        url: uri,
	        type: 'POST',
	        beforeSend: function (xhr) {
	            var token = $('meta[name="csrf_token"]').attr('content');

	            if (token) {
	                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },
	        data: formData,
	        success:function(data){
	          ShowMsg("Success!","","success","");

	        },error:function(XMLHttpRequest, textStatus, errorThrown){ 
	            ShowMsg("Oopps!","Something went wrong..","warning","");
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	  });

</script>
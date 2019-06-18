<script>
 
 $(document).ready(function() {
			 $('#deleteqr').click(function(){   
      			
            $.ajax({

                type: "GET",
      
                url: "./CFLXdel.php",
                data: 'delqr=' + $('#qrCFLGstatement').val(),
                success: function(msg){
                    $('#reshowQR').html(msg);
                }

            }); // Ajax Call
        }); //event handler .click function ({
    }); //document.ready
 
</script>   
   
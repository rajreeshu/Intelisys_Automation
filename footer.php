<script>

    $("#form_submit").click(function(e){
        var type=$("#type").val();
        // e.preventDefault();
        if(type==""){
            e.preventDefault();
            alert("Select a File Type");
            
        }else if(type=='currency'){
            $("#header_form").attr("action","currencyfinal.php");
        }else if(type=="equity"){
            $("#header_form").attr("action","equityfinal.php");
        }else if(type=="index"){
            $("#header_form").attr("action","indexfinal.php");
        }else if(type=="mcx"){
            $("#header_form").attr("action","mcxfinal.php");
        }
        else{
            e.preventDefault();
        }

    });

</script>
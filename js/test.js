$(document).ready(function(){
    $('#search').keyup(function(){
        var txt = $(this).val();
        if(txt != ''){
            $.ajax({
                url:"../php/fetch.php",
                method:"post",
                data:{search:txt},
                dataType:"text",
                success:function(data){
                    $('.tablita').html(data);
                }
            });
        } else {
            $.ajax({
                url:"../php/fetch.php",
                method:"post",
                data:{search:''},
                dataType:"text",
                success:function(data){
                    $('.tablita').html(data);
                }
            });
        }
    });
});
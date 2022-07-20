$(document).ready(function(){

    // check the Admin Password correct or not
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert(current_password);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:"/admin/check-admin-password",
            data:{current_password:current_password},
            success:function(res){
                if(res == 'false'){
                    $('#currentPassword').html('<strong style="color:red;">current password is incorrect</strong>')
                }else{
                    $('#currentPassword').html('<strong style="color:green;">current password is correct</strong>') 
                }
            },
            error:function(){
                alert('error');
            }
        })
    })


});
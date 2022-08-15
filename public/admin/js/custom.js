$(document).ready(function(){
    // dataTable jquery
    $('#adminTable').DataTable();
    $('#section').DataTable();
    $('#category').DataTable();
    $('#brand').DataTable();
    $('#product').DataTable();
    $('#productAttributea').DataTable();

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
// update admin status
    $(document).on('click','.updateAdminStatus',function(){
        let status = $(this).children('i').attr('status');
        let admin_id = $(this).attr('admin-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:'/admin/update-admin-status',
            data:{status:status,adminid:admin_id},
            success:function(resp){

                if(resp['status'] == 1){
                    $('#admin-'+admin_id).html(" <i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='active'></i>")
                }else if(resp['status'] == 0){
                    console.log($('#admin-'+admin_id).html());
                    console.log(resp['status']);
                    $('#admin-'+admin_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='inactive'></i>")

                }
                // alert(res);
            },
            error:function(){
                alert("error");
            }
        })
    })
    // update brand status
    $(document).on('click','.updateBrandStatus',function(){
        let status = $(this).children('i').attr('status');
        let brand_id = $(this).attr('brand-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:'/admin/update-brand-status',
            data:{status:status,brand_id:brand_id},
            success:function(resp){

                if(resp['status'] == 1){
                    $('#brand-'+brand_id).html(" <i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='active'></i>")
                }else if(resp['status'] == 0){
                    console.log($('#brand-'+brand_id).html());
                    console.log(resp['status']);
                    $('#brand-'+brand_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='inactive'></i>")

                }
                // alert(res);
            },
            error:function(){
                alert("error");
            }
        })
    })
    // update product status
    $(document).on('click','.updateproductStatus',function(){
        let status = $(this).children('i').attr('status');
        let product_id = $(this).attr('product-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:'/admin/update-product-status',
            data:{status:status,product_id:product_id},
            success:function(resp){
                if(resp['status'] == 1){
                    $('#product-'+product_id).html(" <i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='active'></i>")
                }else if(resp['status'] == 0){
                    console.log($('#product-'+product_id).html());
                    console.log(resp['status']);
                    $('#product-'+product_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='inactive'></i>")

                }
                // alert(res);
            },
            error:function(){
                alert("error");
            }
        })
    })
    // updatae section status
    $(document).on('click','.updateSectionStatus',function(){
        let status = $(this).children('i').attr('status');
        let Section_id = $(this).attr('Section-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:'/admin/update-section-status',
            data:{status:status,Section_id:Section_id},
            success:function(resp){

                if(resp['status'] == 1){
                    $('#Section-'+Section_id).html(" <i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='active'></i>")
                }else if(resp['status'] == 0){
                    console.log($('#Section-'+Section_id).html());
                    console.log(resp['status']);
                    $('#Section-'+Section_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='inactive'></i>")

                }
                // alert(res);
            },
            error:function(){
                alert("error");
            }
        })
    })
    // update category status
    $(document).on('click','.updatecategoryStatus',function(){
        let status = $(this).children('i').attr('status');
        let category_id = $(this).attr('category-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp){

                if(resp['status'] == 1){
                    $('#category-'+category_id).html(" <i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='active'></i>")
                }else if(resp['status'] == 0){
                    console.log($('#category-'+category_id).html());
                    console.log(resp['status']);
                    $('#category-'+category_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='inactive'></i>")

                }
                // alert(res);
            },
            error:function(){
                alert("error");
            }
        })
    })
    // update Product Attribute status
    $(document).on('click','.updateProductAttributeStatus',function(){
        let status = $(this).children('i').attr('status');
        let attribute_id = $(this).attr('attribute-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:'/admin/update-attribute-status',
            data:{status:status,attribute_id:attribute_id},
            success:function(resp){

                if(resp['status'] == 1){
                    $('#attribute-'+attribute_id).html(" <i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='active'></i>")
                }else if(resp['status'] == 0){
                    console.log($('#attribute-'+attribute_id).html());
                    console.log(resp['status']);
                    $('#attribute-'+attribute_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='inactive'></i>")

                }
            },
            error:function(){
                alert("error");
            }
        })
    })
    // update Product image status
    $(document).on('click','.updateProductimageStatus',function(){
        let status = $(this).children('i').attr('status');
        let image_id = $(this).attr('image-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            url:'/admin/update-image-status',
            data:{status:status,image_id:image_id},
            success:function(resp){

                if(resp['status'] == 1){
                    $('#image-'+image_id).html(" <i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='active'></i>")
                }else if(resp['status'] == 0){
                    console.log($('#image-'+image_id).html());
                    console.log(resp['status']);
                    $('#image-'+image_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='inactive'></i>")

                }
            },
            error:function(){
                alert("error");
            }
        })
    })

    $('.confirmDelete').click(function(){
        let module = $(this).attr('module');
        let moduleId = $(this).attr('moduleId');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            //   alert("delete-"+module+"/"+moduleId);
              location = "/admin/delete-"+module+"/"+moduleId;
            }
          })

    })
    // Append category level
    $('#section_id').change(function(){

        let section_id = $(this).val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'get',
            url:'/admin/append-categories-lavel',
            data:{section_id:section_id},
            success:function(resp){
                $('.appendCategoriesLavel').html(resp);
            },
            error:function(){
                alert("error");
            }
        })

    })
    // if ($('#section_id').val()) {

    //     let section_id = $('#section_id').val()
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type:'get',
    //         url:'/admin/append-categories-lavel',
    //         data:{section_id:section_id},
    //         success:function(resp){
    //             $('.appendCategoriesLavel').html(resp);
    //         },
    //         error:function(){
    //             alert("error");
    //         }
    //     })

    // }
    $('.nav-link').parents('.collapse').removeClass('show');
    // $('.nav-link').parent().removeClass('active');
    $('.nav-link.activeClass').parents('.collapse').addClass('show');
    // $('.nav-link.activeClass1').parent().addClass('active');


    let aItem1 = $('.sidebar >.nav >.nav-item > .nav-link')
    let aItemshow = $('.sidebar >.nav >.nav-item > .nav-link.activeClass1')
    aItem1.siblings('.collapse').removeClass('show');
    aItem1.parent().removeClass('active');
    aItemshow.siblings('.collapse').addClass('show');
    aItemshow.parent().addClass('active');

// add remove attributes js
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = `<div><input type="text" name="size[]" placeholder="size" />
    <input type="text" name="SKU[]" placeholder="SKU" />
    <input type="text" name="price[]" placeholder="price" />
    <input type="text" name="stock[]" placeholder="stock" /><a href="javascript:void(0);" class="remove_button">Remove</a></div>`; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


});



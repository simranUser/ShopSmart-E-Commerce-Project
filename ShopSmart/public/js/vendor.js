$('document').ready(function()
{
    //insert/update product
    $('#productForm').submit(function(e)
    {
        e.preventDefault();
        var action = $('#action').val();
        var formData = new FormData($('#productForm')[0]);

        //insert
        if(action=="insert")
        {
            $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/insertProduct',
                processData: false,
                contentType: false,
                data:formData,
                success:function(data)
                {
                    //alert(data);
                    $("#insertsuccess").text(data);
                    $("#insertsuccess").fadeIn(3000);
                    $("#insertsuccess").fadeOut(1000);
                    $("#productForm")[0].reset();
                }
            });  
        } 
        //update product
        else
        {
            $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/updateProduct',
                processData: false,
                contentType: false,
                data:formData,
                success:function(data)
                {
                    $("#editsuccess").text(data);
                    $("#editsuccess").fadeIn(3000);
                    $("#editsuccess").fadeOut(1000);

                }
            });  
        }
    });

});

//delete product
function removeproduct(id)
{
   var del=confirm("Do You really want to delete this product");
   if(del==true)
   {
    $.ajax({
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:'/deleteproduct',
        data:{id:id},
        success:function(data)
        {
            //alert(data);
            $("#"+data.id).remove();
            $("#deletesuccess").text(data.message);
            $("#deletesuccess").fadeIn(3000);
            $("#deletesuccess").fadeOut(1000);
        }
    });  
   }
}
function uploadproduct(id)
{
   var del=confirm("Do You really want to delete this product");
   if(del==true)
   {
    $.ajax({
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:'/uploadproduct',
        data:{id:id},
        success:function(data)
        {
            //alert(data);
            $("#"+data.id).remove();
            $("#deletesuccess").text(data.message);
            $("#deletesuccess").fadeIn(3000);
            $("#deletesuccess").fadeOut(1000);
        }
    });  
   }
}
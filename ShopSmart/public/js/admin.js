$('document').ready(function()
{
    //insert/update category
    $('#categorysubmit').click(function(e)
    {
        e.preventDefault();
        var category=$('#categoryname').val();
        var action=$('#action').val();

        //insert
        if(action=="insert")
        {
            $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'addCategory',
                data:{category:category},
                success:function(data)
                {
                //alert(data);
                $('#Modal').modal('hide');
                $('#adminmsg').text(data);
                $('#adminmsg').fadeIn(3000);
                $('#adminmsg').fadeOut(100);

                }
            });   
        }
        //update
        else
        {
            var id=$('#editid').val();
            $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'updateCategory',
                data:{category:category,id:id},
                success:function(data)
                {
                    //alert(data);
                    $('#Modal').modal('hide');
                    $('#adminmsg').text(data.message);
                    $('#adminmsg').fadeIn(3000);
                    $('#adminmsg').fadeOut(100);

                    $('#catname'+data.id).text(data.name);
                    $('#action').val('insert');
                    $('#categorysubmit').text('Submit');
                }
            });   
        }
    });

    //update product's price
    $('#updateproduct').click(function(e)
    {
        var price=$('#price').val();
        var id=$('#editid').val();
        e.preventDefault();

        $.ajax
        ({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'updateproduct',
            data:{id:id,price:price},
            success:function(data)
            {
                $('#Modal').modal('hide');
                $('#price'+data.id).text(data.price);
                $('#Modal').modal('hide');
                $('#adminmsg').text(data.message);
                $('#adminmsg').fadeIn(3000);
                $('#adminmsg').fadeOut(100);
            }
        });   
    });

    //filter for searching vendor
    $('#vendorfilter').change(function(e)
    {
        e.preventDefault();
        var input=$('#vendorfilter').val();

        $.ajax({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'vendorfilter',
            data:{input:input},
            success:function(data)
            {
              
              $('#allproduct').text(''); 
              var tr="";
              $.each(data, function(i, data) 
                {
                    tr += `<tr id=${data.id}><td>${data.id}</td><td>${data.name}</td><td>${data.description}</td><td id="price${data.id}">${data.price}</td><td> ${data.vendor} </td><th id="status${data.id}"> ${data.status}
                    </th><td class="td-actions"><a href="/editproduct/${data.uuid}"  class="btn btn-success"> <i class="material-icons">edit</i> </a> <button type="button" rel="tooltip" class="btn btn-danger" onclick="reject(${data.id})"> <i class="material-icons"> close </i> </button> <button type="button" rel="tooltip" class="btn btn-success"id="acceptbtn" onclick="accept(${data.id})">Accept</button></td>`;
                });
              $('#allproduct').html(tr);
            }
        });   
    });

});

//getting info for choosen category to be updated
function editCategory(id)
{
    $.ajax
    ({
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:'editcategory',
        data:{id:id},
        success:function(data)
        {
          // alert("success");
          $('#categoryname').val(data.name);
          $('#action').val('update');
          $('#categorysubmit').text('Update');
          $('#editid').val(data.id);


        }
    });   
}

//delete category
function removeCategory(id)
{
    var del=confirm("Do you really want to delete this category");
    if(del==true)
    {
        $.ajax
        ({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'deletecategory',
            data:{id:id},
            success:function(data)
            {
            // alert("success");
                //alert(data);
                $('#adminmsg').text(data.message);
                $('#adminmsg').fadeIn(3000);
                $('#adminmsg').fadeOut(100);
                $('#cat'+data.id).remove();
            }
        });   
    }
}

//choosen product info for price updation
function editproduct(id)
{
    $.ajax
    ({
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:'editproduct',
        data:{id:id},
        success:function(data)
        {
          // alert("success");
          $('#price').val(data.price);
          $('#editid').val(data.id);
        }
    });   
}

//remove product
/*function removeproduct(id)
{
    $.ajax
    ({
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:'removeproduct',
        data:{id:id},
        success:function(data)
        {
          // alert("success");
          $('#price').val(data.price);
        }
    });   
}*/

//reject product request
function reject(id)
{
    var del=confirm("Do you really want to reject this request");
    if(del==true)
    {
        $.ajax
        ({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'reject',
            data:{id:id},
            success:function(data)
            {
                $('#Modal').modal('hide');
                $('#adminmsg').text(data.message);
                $('#adminmsg').fadeIn(3000);
                $('#adminmsg').fadeOut(100);
                $('#status'+data.id).text("rejected");
            }
        });   
    }
}

//accept product request 
function accept(id)
{
    var del=confirm("Do you really want to accept this request");
    if(del==true)
    {
        $.ajax
        ({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'accept',
            data:{id:id},
            success:function(data)
            {
                $('#Modal').modal('hide');
                $('#adminmsg').text(data.message);
                $('#adminmsg').fadeIn(3000);
                $('#adminmsg').fadeOut(100);                
                $('#status'+data.id).text("accepted");
            }
        });   
    }
}

//accept vendor request 
function acceptVendor(id)
{
    var del=confirm("Do you really want to accept this request");
    if(del==true)
    {
        $.ajax
        ({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'acceptVendor',
            data:{id:id},
            success:function(data)
            {
                $('#Modal').modal('hide');
                $('#adminmsg').text(data.message);
                $('#adminmsg').fadeIn(3000);
                $('#adminmsg').fadeOut(100);

                $('#vstatus'+data.id).text("accepted");
                $('#acceptvendorbtn').text("Reject");
                $('#acceptvendorbtn').css({'background':'#f33527'});
                $('#acceptvendorbtn').attr('onclick',`rejectVendor(${data.id})`);
                $('#acceptvendorbtn').attr('id','rejectvendorbtn');

            }
        });   
    }
}

//reject product request
function rejectVendor(id)
{
    var del=confirm("Do you really want to reject this request");
    if(del==true)
    {
        $.ajax
        ({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'rejectVendor',
            data:{id:id},
            success:function(data)
            {
                $('#Modal').modal('hide');
                $('#adminmsg').text(data.message);
                $('#adminmsg').fadeIn(3000);
                $('#adminmsg').fadeOut(100);

                $('#vstatus'+data.id).text("rejected");
                $('#rejectvendorbtn').text("Accept");
                $('#rejectvendorbtn').css({'background':'#4caf50'});
                $('#rejectvendorbtn').attr('onclick',`acceptVendor(${data.id})`);
                $('#rejectvendorbtn').attr('id','acceptvendorbtn');
            }
        }); 
    }
}

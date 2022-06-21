function addtocart(id,uuid)
{
    $.ajax({
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:'/addtocart',
        data:{id:id},
        success:function(data)
        {
           // alert(data);
            $('#cartmsg').text(data);
            $('#cartmsg').show(100);
            window.location.reload();
        }
    });  
}


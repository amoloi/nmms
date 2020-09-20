$(document).ready(function(){
var dataObj={};
 $('#ajax').click(function(){
            $(this).hide();
            $.ajax({
            url: '/ajax/index/',
            type: 'GET',
            cache:false,
            data: dataObj,
            beforeSend: function (request){
            // This sends the user who authenticates against the dotCMS server
            // In a real world example, you could use session based authentication
            //request.setRequestHeader("DOTAUTH", window.btoa("admin@dotcms.com:admin"));
            },

            success: function(data,status,xhr) {
            //alert("Success: Data = " + data );
            if($('fieldset' , $('#address_container')).length == 0){
                
                $('#address_container').html(data);
                //$('#ajax').html('Remove Address');
            }else{
                alert('Address Container is already available with length - ' + $('fieldset' , $('#address_container')).length);
            }
            
            //window.location = "/Blogpost/"+$('#title').val();
            },
            error: function(data,status,xhr) {
            alert("fail: " + data );
            console.log(data );
            },
            });
 });
})
function removecontainer(c){
    var ok = confirm('Do you really want to remove address and contact section ?');
    if(ok){
        $('#ajax').show();
        $(c).parent('fieldset').slideUp(function(){
            $(this).remove();
        });
    }else{
        return;
    }
    
}
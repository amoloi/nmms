/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $('.hasdatepicker').datepicker({ dateFormat: 'dd/mm/yyyy',
                                         showOn: "button",
                                    buttonImage: "/images/calendar.png",
                                buttonImageOnly: true});
        //trigger modal view
        $('#btn-new-member').on('click' , (function(){
        $('#modal-company').modal('view',{
        easing : 'linear',
        position : 'center',
        animation : 'top left',
        speed : 1000,
        overlayClose : false,
        overlayColor : 'black',
        overlayOpacity : 0.5,
        close : '.closeMe'
        
        });
        }));
        /*
         * Working out a dynamic total
         */
        $("input[name^=';sum']").sum("keyup", "#totalSum");
        
        $('#btn-new-dept').on('click' , (function(){
        $('#modal-department').modal('view',{
        easing : 'linear',
        position : 'center',
        animation : 'top left',
        speed : 1000,
        overlayClose : false,
        overlayColor : 'black',
        overlayOpacity : 0.5,
        close : '.closeMe'
        
        });
        }));
        //trigger modal close
        $('.someOtherElement').click(function(){
        $('#modal').modal('close');
        });
        
 $('#member_contribution').calx(); 
 
 $('#cmd_new_row').on('click' , function(){
            var $calx = $('#member_contribution');
            $.ajax({
            url: '/ajax/years-row/',
            type: 'GET',
            data:{rowId : $('#member_contribution tbody tr').size()},
            cache:false,
            beforeSend: function (request){
                $('#progress_indicator').html('<i class="ion ion-loading-d"></i>');
            },

            success: function(data,status,xhr) {

                    $('#member_contribution').append(data);
                    $('')
                    refreshCalculator();
            },
            error: function(data,status,xhr) {
            alert("fail: " + data );
            console.log(data );
            },
            complete:function(){
            $('#progress_indicator').html('');
            }
            });
 });
 
    
    
 /*
  * Deleting a row
  */
//     $("#member_contribution tbody tr").click(function() {
//        //change the background color to red before removing
//        $('input , select' , this).css("background-color","#FF3700");
//         
//        $(this).fadeOut(400, function(){
//            $(this).remove();
//        });
//    });

 $('button[name=cmd_company]').on('click' , function(){
     //validateform();
  var dataObj={
    'company_name':$('#acompany_name').val(),
    'sector':$('#company_sector').val(),
    'telephone_number':$('#telephone_number').val(),
    'fax_number':$('#fax_number').val(),
    'contact_person':$('#contact_person').val(),
    'email_address':$('#email_address').val(),
    'postal_address':$('#postal_address').val()
};         
            $.ajax({
            url: '/ajax/company/',
            type: 'POST',
            cache:false,
            data: dataObj,
            beforeSend: function (request){
            $('button[name=cmd_company]').html('<i class="fa fa-spinner"></i> Saving company...');

            },

            success: function(data,status,xhr) {
                if('success' == data){
                    $('#member-company').val($('#acompany_name').val());
                    $('#modal-company').modal('close');
                    
                    $('#company_name').append('<option value=' + dataObj.company_name + ' selected=selected >' + dataObj.company_name + '</option>'); 
                }
            },
            error: function(data,status,xhr) {
            alert("fail: " + data );
            console.log(data );
            },
            complete:function(){
            $('#modal-company').find('input[type=text]').val('');
            $('button[name=cmd_company]').html('New company');
            }
            });
            
 });
 $('button[name=cmd_save_dept]').on('click' , function(){
     //validateform();
  var dataObj={
    'sector_name':$('#sector_name').val(),
    'sector_description':$('#sector_description').val()
};         
            $.ajax({
            url: '/ajax/dept/',
            type: 'POST',
            cache:false,
            data: dataObj,
            beforeSend: function (request){
            // This sends the user who authenticates against the dotCMS server
            // In a real world example, you could use session based authentication
            //request.setRequestHeader("DOTAUTH", window.btoa("admin@dotcms.com:admin"));
            },

            success: function(data,status,xhr) {
                if('success' == data){
                    $('#modal-department').find('input[type=text]').val('');
                    $('#modal-department').modal('close');
                    $('#sector').append('<option value=' + dataObj.sector_name + ' selected=selected >' + dataObj.sector_name + '</option>');                     
                }
            },
            error: function(data,status,xhr) {
            alert("fail: " + data );
            console.log(data );
            },
            });
            
 });            
    $("input[name^='yearOne']").sum("keyup", "#totalYearOneSum");
    $("input[name^='yearTwo']").sum("keyup", "#totalYearTwoSum");
    $("input[name^='yearThree']").sum("keyup", "#totalYearThreeSum");
    $("input[name^='yearFour']").sum("keyup", "#totalYearFourSum");
    $("input[name^='yearFive']").sum("keyup", "#totalYearFiveSum");
    //$("input[name^=';year1']").sum("keyup", "#yearOneSum");
    
    /*
     * Dialog box
     */
        $('#example31').bind('click', function(e) {
            e.preventDefault();
            $.Zebra_Dialog('<strong>Zebra_Dialog</strong>, a small, compact and highly configurable dialog box plugin for jQuery', {
                'type':     'question',
                'title':    'Custom buttons',
                'buttons':  [
                                {caption: 'Yes', callback: function() { alert('"Yes" was clicked')}},
                                {caption: 'No', callback: function() { alert('"No" was clicked')}},
                                {caption: 'Cancel', callback: function() { alert('"Cancel" was clicked')}}
                            ]
            });
        });    
});

function validateform(){
    $('input[type=text]').each(function(index , value){
        alert(value);
    })
}

function terminate(message){
    var OK = confirm(message);
    if(OK){
        return true;
    }else{
        return false;
    }
}
function removeContribution(rowId){
            $.Zebra_Dialog('Are you sure that you want to permanently remove the selected contribution row ?', {
                'overlay_close':              false,
                'overlay_opacity':            '.5',           //  The opacity of the overlay (between 0 and 1)
                'type':     'warning',
                'title':    'NATAU MMS',
                'buttons':  [
                                {caption: 'Yes', callback: function() {
                                                                        row = $('#row_' + rowId);
                                                                        $('input , select' , row).css("background-color","#FF3700");

                                                                        $(row).fadeOut(500, function(){
                                                                            $(this).remove();
                                                                        });
                                }},
                                {caption: 'Cancel', callback: function() { }}
                            ]
            });    
}

function refreshCalculator(){
    $calx = $('#member_contribution');
    $calx.calx('refresh');
                    
}
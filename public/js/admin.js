$(window).load(function(){
$('#att_filename').change(function(e) {
    var filepath = this.value;
    var m = filepath.match(/([^\/\\]+)$/);
    var filename = m[1];
    $('#lbl_filename').html(" &rarr; " + filename);
    /*setTimeout((function(form) {
        return function() {
            form.submit();
        }
    })(this.form), 1000);*/
});

$('.review-menu').lksMenu();
$(".inline").colorbox({inline:true, width:"80%"});
});
$(document).ready(function(){
      	$("form[name=NatauForm]").validate({
		errorLabelContainer: $("#errors")
	});
        
        $('.datepicker').datepicker({
				format: 'dd/mm/yyyy'
			});
});
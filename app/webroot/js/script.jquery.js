/* Auto attach ui-Date to cakephp's form helper method date*/
if(jQuery('.date .error-message').length)
{
	jQuery('.date .error-message').before('<input type="text" class="ui-dateinput" disabled="disabled" />');
}
else
{
	jQuery('<input type="text" class="ui-dateinput" disabled="disabled" />').appendTo('.date');	
}
$( ".ui-dateinput").datepicker({
			showOn			: "button",
			buttonImage		: ASSETURL+"img/cal.png",
			buttonImageOnly	: true,
			changeMonth		: false,
			changeYear		: false,
			dateFormat		: 'dd/mm/yy',
			minDate			: "-255M",
			maxDate			: "+5M",
			onSelect		: function(DateText, inst) {
								var DateArray = DateText.split('/');
								$(this).parent().children('select').each(function(index){
									$(this).val(DateArray[index]);									
								});
							}
		});


$('[rel=postlink]').on('click',function(){
	var _this = $(this);
	var id = _this.prev().attr('id');
	uiConfirm({		message 	: _this.data('confirmmessage'),
				   	title   	: _this.data('confirmtitle'),
				   	success 	: function(){
				   		$('#'+id).submit();
				   	}
		});
});

function uiConfirm(options)
{
	var ConfirmBox = {	title 		: 'MyParichay',
						message 	: 'Are you sure you wnat to do this?',
						resizable	: false,
						height		: "auto",
						modal		: true,
						buttons: {
							"Continue": function() {

								jQuery(this).dialog("close");
								if(jQuery.isFunction(ConfirmBox.success)){
									ConfirmBox.success.call(this);
								}
							},

							Cancel: function() {

								jQuery(this).dialog("close");
								if(jQuery.isFunction(ConfirmBox.cancel)){
									ConfirmBox.cancel.call(this);
								}
							}
						}	
					};
			
	jQuery.extend(ConfirmBox,options); 
	
	uiAppend({
				title : ConfirmBox.title,
				body  : ConfirmBox.message,
				type  : 'alert'
	});
	jQuery( "#dialog-confirm" ).dialog(ConfirmBox);
}

function uiAlert(options)
{
	var ConfirmBox = {	title 		: 'MyParichay',
						resizable	: false,
						height		: "auto",
						modal		: true,
						buttons: {
							"Ok": function() {

								jQuery(this).dialog("close");
								if(jQuery.isFunction(ConfirmBox.success)){
									ConfirmBox.success.call(this);
								}
							}
						}	
					};
			
	jQuery.extend(ConfirmBox,options); 

	uiAppend({
				title : ConfirmBox.title,
				body  : ConfirmBox.message,
				type  : 'alert'
	});

	jQuery( "#dialog-confirm" ).dialog(ConfirmBox);
	
}


function uiAppend(ConfirmBox)
{
	if(jQuery('#dialog-confirm').length !== 0)
	{
		jQuery('#dialog-confirm').remove();
	}
	
	if(ConfirmBox.type == 'alert')
	{
		jQuery('<div id="dialog-confirm" title="'+ConfirmBox.title+'"></div>')
			.appendTo('body')
			.html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'+ConfirmBox.body+'</p>');
	}
	else
	{
		jQuery('<div id="dialog-confirm" title="'+ConfirmBox.title+'"></div>')
			.appendTo('body')
			.html('<p>'+ConfirmBox.body+'</p>');
	}
}


$('a.AddNew').click(function(){
	var block = $(this).closest('.addnew');
	block.find('.repeatefield:first').clone().val('').insertAfter(block.find(".repeatefield:last"));
	return false
})
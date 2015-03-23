$(function() {
/// load about

$("#show_details").click(function () {
  $("#about_details").slideToggle("slow");
}); 

function preview(img, selection) 
{
    if (!selection.width || !selection.height)
        return;

    //200 is the #preview dimension, change this to your liking

    var scaleX = 200 / selection.width; 
    var scaleY = 100 / selection.height;

    $('#preview img').css({
        width: Math.round(scaleX * $('#big').attr('width')),
        height: Math.round(scaleY * $('#big').attr('height')),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });
    
	$('.x1').val(selection.x1);
    $('.y1').val(selection.y1);
    $('.x2').val(selection.x2);
    $('.y2').val(selection.y2);
    $('.width').val(selection.width);
    $('.height').val(selection.height);    
}

$("#upload_big").submit(function() {
	var fname = $(this).attr('name');

	//check if they have made a thumbnail selection
	$('#big').imgAreaSelect({hide:true});	
	$('#notice').fadeIn();						  
	$('#upload_target').unbind().load( function(){
	
		var img = $('#upload_target').contents().find('body').html();
	
		if(fname == 'upload_big')
		{
			// load to preview image
			$('#preview').html(img);
			var img_id = 'big';
			/////// get image source , this will be passed into PHP
			$('.img_src').attr('value',img)				
			$('#preview').html('<img id="" src="'+img+'" />');
			$('#save_thumbnail').val(img);	
		}

		if(img=='noimgerror')
		{
			alert("Please select image path");
		}
		else if(img=='sizeerror')
		{
			alert("Please note image size must be 2MB or less")
		}
		else
		{
			$('#div_'+fname).html('<img id="'+img_id+'" src="'+img+'" />');	
			$("#div_upload_big .pu-submit").css('display','none');
			if($(img).attr('class') != 'uperror')
			{
				$('#upload_thumb').show();
				//area select plugin http://odyniec.net/projects/imgareaselect/examples.html
			}
			else
			{
				//hide them
				$('#upload_thumb').hide();		
			}
		}					

		$('#notice').fadeOut();	
		//$("#div_upload_big #big").css('display','none');		
		// we have to remove the values
		$('.width , .height , .x1 , .y1 , #file').val('');
	  });
  });
});
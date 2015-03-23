
/**
 * 
 * 
 * @name Common : Common functions
 * @license Business Market
 * @author Riadh H.
 * @package Forum
 * 
 *
 */


// Common object to store configuration forum params
var mymessages = mymessages || {};


mymessages.showChar = 300; // How many characters are shown by default
mymessages.ellipsesText = "...";
mymessages.moreText = "read more >>";
mymessages.lessText = "<< read less";

/*
 * 
 * Common functions
 * 
 */ 

// Add a new comment
// params : message
// params : listingId 
// params : commentReference 
// params : event 
// params : attachement

mymessages.addComment = function(message, listingId, commentReference ,subject , event, attachement){

        alert(message);
            if( message == "" ){

                mymessages.blockWriteInForum("You should write a comment before to contiune.");
                
                return false;
                
            }
            
            // Add an attachement
            if( (attachement.val() != "") ){

                mymessages.uploadAttachement(event, attachement);
                
                // Upload attachement success
                if( (attachement.attr("uploadsuccess") == "0") || (attachement.attr("uploadfile") == "null")  ){
                    
                    return false;
                    
                }
                
                
            }
        
            // Get messages appropriate with the current language
            jQuery.ajax({
                 // The url must be appropriate for your configuration;
                 // this works with the default config of 1.1.11
                 url: "../../mymessage/mymessages/addMessage",
                 type: "POST",
                 dataType: 'json',
                 async: true,
                 data: {
                     message : message,
                     listingId: listingId,
                     commentReference : commentReference,
                     subject:subject,
                     attachementUploadFile : attachement.attr("uploadfile")

                 },  
                 error: function(xhr,tStatus,e){

                             if( xhr.status == 302 ){
                                 // User in not loggued in
                                 mymessages.blockWriteInForum("You must be logged in to leave a comment.");

                             }else{

                                 if(!xhr){
                                     console.log(" We have an error ");
                                     console.log(tStatus+" "+e.message);
                                 }else{
                                     console.log("else: "+e.message); // the great unknown
                                 }
                             }
                     },
                success: function(resp){
                    var viewLimitValue = $("#messageViewLimit").val();
                    var pageSelected = $('.messagePageNumbers').find('.active').eq(0).attr('page');
                    var viewOffsetValue = $('.messagePageNumbers').find('.active').eq(0).attr('offset');

                    mymessages.Navigate(viewLimitValue, pageSelected, viewOffsetValue);

                },
                 complete: function(){

                         // Rest attachement values to avoid conflict for multiple post a comment with attachement
                         attachement.attr("uploadsuccess", "0");
                         attachement.attr("uploadfile", "null");
                     }

             });

}

// Ban user action by show a bloc contain
// params : listingId
// params : viewLimitValue number of comment to display
mymessages.UpdateViewLimit = function( viewLimitValue){

    // Get messages appropriate with the current language
    jQuery.ajax({
        // The url must be appropriate for your configuration;
        // this works with the default config of 1.1.11
        url: "../../mymessage/mymessages/UpdateViewLimit",
        type: "POST",
        dataType: 'json',
        data: {
            viewLimitValue: viewLimitValue,
        },
        error: function(xhr,tStatus,e){

            if(!xhr){
                console.log(" We have an error ");
                console.log(tStatus+" "+e.message);
            }else{
                console.log("else: "+e.message); // the great unknown
            }
        },
        success: function(resp){

            $(".messagePage").html("");
            $(".messagePage").html(resp.listingView);

        },
        complete: function(){

            mymessages.showMoreComment();

        }
    });

}




// like or dislike a new message
// params : messageId
// params : likeAction
mymessages.likeMessage = function(messageId, likeAction){
        
               // Get messages appropriate with the current language
                jQuery.ajax({
                    // The url must be appropriate for your configuration;
                    // this works with the default config of 1.1.11
                    url: "../../mymessage/mymessages/likeMessage",
                    type: "POST",
                    dataType: 'json',
                    async: true,
                    data: {
                        messageId : messageId,
                        likeAction: likeAction
                        
                    },  
                    error: function(xhr,tStatus,e){

                                if( xhr.status == 302 ){
                                    // User in not loggued in
                                    mymessages.blockWriteInForum("You must be logged in to leave a message.");
                                    
                                }else{
                            
                                    if(!xhr){
                                        console.log(" We have an error ");
                                        console.log(tStatus+" "+e.message);
                                    }else{
                                        console.log("else: "+e.message); // the great unknown
                                    }
                                }
                        },
                    success: function(resp){

                        var listingId = $('#voice-your-opinion').attr('listingid');
                        var viewLimitValue = $("#commentViewLimit").val();
                        var pageSelected = $('.forumPageNumbers').find('.active').eq(0).attr('page');
                        var viewOffsetValue = $('.forumPageNumbers').find('.active').eq(0).attr('offset');

                        mymessages.Navigate( viewLimitValue, pageSelected, viewOffsetValue);

                    },
                    complete: function(){

                            
                        }
                });

}
// Navigate the comment list, useful to render the pagination
// params : listingId
// params : viewLimitValue number of comment to display
// params : pageSelected
// params : viewOffsetValue offset to start get data from database
// params : commentOrderBy criteria to sort the comment list

mymessages.Navigate = function(viewLimitValue, pageSelected, viewOffsetValue){

    // Get messages appropriate with the current language
    jQuery.ajax({
        // The url must be appropriate for your configuration;
        // this works with the default config of 1.1.11
        url: "../../mymessage/mymessages/Navigate",
        type: "POST",
        dataType: 'json',
        data: {
            viewLimitValue: viewLimitValue,
            pageSelected : pageSelected,
            viewOffsetValue : viewOffsetValue

        },
        error: function(xhr,tStatus,e){

            if(!xhr){
                console.log(" We have an error ");
                console.log(tStatus+" "+e.message);
            }else{
                console.log("else: "+e.message); // the great unknown
            }
        },
        success: function(resp){
            $(".messagePage").html("");
            $(".messagePage").html(resp.listingView);

        },
        complete: function(){

            mymessages.showMoreComment();

        }
    });

}



// Ban user action by show a bloc contain
// params : message to dispplay
mymessages.blockWriteInForum = function(message){
    
    $('#light').show();
    $('#fade').show();
    
    $("#light").find(".text-message").html(message);
    
}

// Close notification
// params : no params
mymessages.closeNotification = function(){
    
    $('#light').hide();
    $('#fade').hide();
    
}

// Upload a new file attached to a message
// params : event
// params : attachement file to attach
mymessages.uploadAttachement = function(event, attachement){

        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // Create a formdata object and add the files
        var formData = new FormData();

        var fileSelect = document.getElementById(attachement.attr('id'));

        // Loop through each of the selected files.
        for (var i = 0; i < fileSelect.files.length; i++) {

          var file = fileSelect.files[i];

          // Add the file to the request.
          formData.append('attachement', file, file.name);

        }

        $.ajax({
            
            url: "../../mymessage/mymessages/uploadAttachement",
            type: 'POST',
            data: formData,
            async: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            
            success: function(resp)
            {
                if( resp.action_status == '0')
                {
                    mymessages.blockWriteInForum(resp.message);

                }else
                {
                    
                    attachement.attr("uploadsuccess", "1");
                    attachement.attr("uploadfile", resp.file_name);

                }
            },
            error: function(xhr,tStatus,e){

                    if( xhr.status == 302 ){
                        // User in not loggued in
                        mymessages.blockWriteInForum("You must be logged in to leave a comment.");

                    }else{

                        if(!xhr){
                            console.log(" We have an error ");
                            console.log(tStatus+" "+e.message);
                        }else{
                            console.log("else: "+e.message); // the great unknown
                        }
                    }
             },
            complete: function()
            {
                
            }
            
        });
    
}

// Show more comment
// params : no params
mymessages.showMoreComment = function(){

	// Event for show more comment text button
	$('.more').each(function() {
            
		var content = $(this).html();

		if( content.length > mymessages.showChar ) {
                    
			var c = content.substr(0, mymessages.showChar);
			var h = content.substr(mymessages.showChar, content.length - mymessages.showChar);

			var html = c + '<span class="moreellipses">' + mymessages.ellipsesText+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + mymessages.moreText + '</a></span>';

			$(this).html(html);
		}

	});

}
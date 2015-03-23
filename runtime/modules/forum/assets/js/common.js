
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
var forum = forum || {};


forum.showChar = 300; // How many characters are shown by default
forum.ellipsesText = "...";
forum.moreText = "read more >>";
forum.lessText = "<< read less";

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

forum.addComment = function(message, listingId, commentReference, event, attachement){        
    
            if( message == "" ){
                
                forum.blockWriteInForum("You should write a comment before to contiune.");
                
                return false;
                
            }
            
            // Add an attachement
            if( (attachement.val() != "") ){
                
                forum.uploadAttachement(event, attachement);
                
                // Upload attachement success
                if( (attachement.attr("uploadsuccess") == "0") || (attachement.attr("uploadfile") == "null")  ){
                    
                    return false;
                    
                }
                
                
            }
        
            // Get messages appropriate with the current language
            jQuery.ajax({
                 // The url must be appropriate for your configuration;
                 // this works with the default config of 1.1.11
                 url: "../forum/forum/addComment",
                 type: "POST",
                 dataType: 'json',
                 async: true,
                 data: {
                     message : message,
                     listingId: listingId,
                     commentReference : commentReference,
                     attachementUploadFile : attachement.attr("uploadfile")

                 },  
                 error: function(xhr,tStatus,e){

                             if( xhr.status == 302 ){
                                 // User in not loggued in
                                 forum.blockWriteInForum("You must be logged in to leave a comment.");

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

                         forum.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue);

                     },
                 complete: function(){

                         // Rest attachement values to avoid conflict for multiple post a comment with attachement
                         attachement.attr("uploadsuccess", "0");
                         attachement.attr("uploadfile", "null");

                     }

             });

}




// like or dislike a new comment
// params : commentId
// params : likeAction
forum.likeComment = function(commentId, likeAction){    
        
               // Get messages appropriate with the current language
                jQuery.ajax({
                    // The url must be appropriate for your configuration;
                    // this works with the default config of 1.1.11
                    url: "../forum/forum/likeComment",
                    type: "POST",
                    dataType: 'json',
                    async: true,
                    data: {
                        commentId : commentId,
                        likeAction: likeAction
                        
                    },  
                    error: function(xhr,tStatus,e){

                                if( xhr.status == 302 ){
                                    // User in not loggued in
                                    forum.blockWriteInForum("You must be logged in to leave a comment.");
                                    
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

                            forum.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue);
                            
                        },
                    complete: function(){                        
                
                            
                            
                        }
                });

}

// Ban user action by show a bloc contain
// params : message to dispplay
forum.blockWriteInForum = function(message){ 
    
    $('#light').show();
    $('#fade').show();
    
    $("#light").find(".text-message").html(message);
    
}

// Close notification
// params : no params
forum.closeNotification = function(){ 
    
    $('#light').hide();
    $('#fade').hide();
    
}



// Ban user action by show a bloc contain
// params : listingId
// params : viewLimitValue number of comment to display
forum.UpdateViewLimit = function(listingId, viewLimitValue){ 
    
                var userProfession;
    
                if( $(".userProfession").find(".result-selected") ){
                    
                    $(".userProfession").find("select").find("option").each(function(){
                
                        if( $(this).html() === $(".userProfession").find(".result-selected").html()){

                            userProfession = $(this).attr("value");

                        }
                    
                    });
                    
                }
    
                var userReputation;
    
                if( $(".userReputation").find(".result-selected") ){
                    
                    $(".userReputation").find("select").find("option").each(function(){
                
                        if( $(this).html() === $(".userReputation").find(".result-selected").html()){

                            userReputation = $(this).attr("value");

                        }
                    
                    });
                    
                }
                
                // Get messages appropriate with the current language
                jQuery.ajax({
                    // The url must be appropriate for your configuration;
                    // this works with the default config of 1.1.11
                    url: "../forum/forum/UpdateViewLimit",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        listingId : listingId,
                        viewLimitValue: viewLimitValue,
                        commentOrderBy : userReputation,
                        userProfession : userProfession
                        
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
                
                            $(".forumPage").html("");
                            $(".forumPage").html(resp.listingView);
                            
                        },
                    complete: function(){                        
                
                        forum.showMoreComment();
                
                        }
                });
    
}

// Navigate the comment list, useful to render the pagination
// params : listingId
// params : viewLimitValue number of comment to display
// params : pageSelected
// params : viewOffsetValue offset to start get data from database
// params : commentOrderBy criteria to sort the comment list

forum.Navigate = function(listingId, viewLimitValue, pageSelected, viewOffsetValue, commentOrderBy){    
                
                var userProfession;
    
                if( $(".userProfession").find(".result-selected") ){
                    
                    $(".userProfession").find("select").find("option").each(function(){
                
                        if( $(this).html() === $(".userProfession").find(".result-selected").html()){

                            userProfession = $(this).attr("value");

                        }
                    
                    });
                    
                }
            
    
                // Get messages appropriate with the current language
                jQuery.ajax({
                    // The url must be appropriate for your configuration;
                    // this works with the default config of 1.1.11
                    url: "../forum/forum/Navigate",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        listingId : listingId,
                        viewLimitValue: viewLimitValue,
                        pageSelected : pageSelected,
                        viewOffsetValue : viewOffsetValue,
                        commentOrderBy : commentOrderBy,
                        userProfession : userProfession
                        
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
                
                            $(".forumPage").html("");
                            $(".forumPage").html(resp.listingView);
                            
                        },
                    complete: function(){                        
                
                        forum.showMoreComment();
                
                        }
                });
    
}


// Report a comment as a spam
// params : reportAsSpam onject to update after action
// params : listingId
// params : commentId
forum.reportAsSpam = function(reportAsSpam, listingId, commentId){ 
    
                // Get messages appropriate with the current language
                jQuery.ajax({
                    // The url must be appropriate for your configuration;
                    // this works with the default config of 1.1.11
                    url: "../forum/forum/reportAsSpam",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        listingId : listingId,
                        commentId: commentId
                        
                    },
                    error: function(xhr,tStatus,e){

                                if( xhr.status == 302 ){
                                    // User in not loggued in
                                    forum.blockWriteInForum("You must be logged in to leave a comment.");
                                    
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
                
                            //$(this).parents('#voice-your-opinion').find(".dd_coment").atfind(".reportAsSpam").eq(0)
                            
                            reportAsSpam.html("Comment under review");
                            reportAsSpam.addClass("redText");                            
                            
                            $("body").find("[commentId='"+commentId+"']").find('.replpToPostComment').eq(0).addClass("grayedOut");
                            $("body").find("[commentId='"+commentId+"']").find('.like_button').eq(0).addClass("grayedOut");
                            $("body").find("[commentId='"+commentId+"']").find('.dislike_button').eq(0).addClass("grayedOut");
                            
                        },
                    complete: function(){  
                
                        forum.showMoreComment();
                        
                        }
                });
    
}

// Upload a new file attached to a comment
// params : event
// params : attachement file to attach
forum.uploadAttachement = function(event, attachement){

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
            
            url: "../forum/forum/uploadAttachement",
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
                    forum.blockWriteInForum(resp.message);

                }else
                {
                    
                    attachement.attr("uploadsuccess", "1");
                    attachement.attr("uploadfile", resp.file_name);

                }
            },
            error: function(xhr,tStatus,e){

                    if( xhr.status == 302 ){
                        // User in not loggued in
                        forum.blockWriteInForum("You must be logged in to leave a comment.");

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


// Update the comment list throught a criteria selected by the user
// params : listingId
// params : viewLimitValue number of comment to display
// params : commentOrderBy the criteria
forum.setViewByCriteria = function(listingId, viewLimitValue, commentOrderBy){ 
    
                
                var userProfession;
    
                if( $(".userProfession").find(".result-selected") ){
                    
                    $(".userProfession").find("select").find("option").each(function(){
                
                        if( $(this).html() === $(".userProfession").find(".result-selected").html()){

                            userProfession = $(this).attr("value");

                        }
                    
                    });
                    
                }
            
    
                // Get messages appropriate with the current language
                jQuery.ajax({
                    // The url must be appropriate for your configuration;
                    // this works with the default config of 1.1.11
                    url: "../forum/forum/setViewByCriteria",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        listingId : listingId,
                        viewLimitValue: viewLimitValue,
                        commentOrderBy : commentOrderBy,
                        userProfession : userProfession
                        
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
                
                            $(".forumPage").html("");
                            $(".forumPage").html(resp.listingView);
                            
                        },
                    complete: function(){
                
                            forum.showMoreComment();
                            
                        }
                        
                });
    
}


// Delete a comment
// params : listingId
// params : commentId
forum.deleteComment = function(listingId, commentId){ 
    
                // Get messages appropriate with the current language
                jQuery.ajax({
                    // The url must be appropriate for your configuration;
                    // this works with the default config of 1.1.11
                    url: "../forum/forum/deleteComment",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        listingId : listingId,
                        commentId: commentId
                        
                    },
                    error: function(xhr,tStatus,e){

                                if( xhr.status == 302 ){
                                    // User in not loggued in
                                    forum.blockWriteInForum("You must be logged in to leave a comment.");
                                    
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

                            forum.Navigate(listingId, viewLimitValue, pageSelected, viewOffsetValue);
                            
                        },
                    complete: function(){                        
                        }
                        
                });
    
}


// Show more comment
// params : no params
forum.showMoreComment = function(){

	// Event for show more comment text button
	$('.more').each(function() {
            
		var content = $(this).html();

		if( content.length > forum.showChar ) {
                    
			var c = content.substr(0, forum.showChar);
			var h = content.substr(forum.showChar, content.length - forum.showChar);

			var html = c + '<span class="moreellipses">' + forum.ellipsesText+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + forum.moreText + '</a></span>';

			$(this).html(html);
		}

	});

}
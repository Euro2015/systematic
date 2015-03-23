
/**
 * 
 * 
 * @name Engine : Engine js file
 * @license Business Market
 * @author RH
 * @package Forrum
 * 
 *
 */


jQuery(document).ready(function ($){
       
       
        // Event for post a comment button
        $('body').on('click', '.dd_post_msg_button', function(event){

            if( $(this).parents('form').find("#message").attr('placeholder') != ""  ){
                
                mymessages.blockWriteInForum("You must be logged in to leave a comment.");
                
                return false;
                
            }
            
            var message = $(this).parents('form').find("#message").val();
            var listingId = $(this).parents('form').attr('listingid');
            var commentReference = $(this).parents('form').attr('commentreference');
            var subject = $(this).parents('form').attr('subject');
            var attachement = $(this).parents('.postBlock').find('.attachement-file');
            
            mymessages.addComment(message, listingId, commentReference,subject, event, attachement);
            
            $(this).parents('form').find("#message").val("");
            
            
        });
        
        
        // Event for reply a comment button
        $('body').on('click', '.replpToPostMsgComment', function(){
            if( $(this).hasClass("grayedOut") ){
                return false;
            }
            $('.raty-icons').hide();
            var commentId = $(this).attr('commentId');            
            var form = $(this).parents('.dd_coment_box').find(".replyToPostCommentForm-"+commentId);

            if( !form.is(":visible") ){
                form.show();                
            }else{                
                form.hide();
            }
            
        });

    $('body').on('click', '.closeMsg', function(){
        if( $(this).hasClass("grayedOut") ){
            return false;
        }
        var commentId = $(this).attr('commentId');
        var form = $(this).parents('.dd_coment_box').find(".replyToPostCommentForm-"+commentId);

        if( !form.is(":visible") ){
            form.show();
        }else{
            form.hide();
        }

        if( !$('.raty-icons').is(":visible") ){
            $('.raty-icons').show();
        }else{
            $('.raty-icons').hide();
        }

    });
        
        // Event for like or dislike button
        $('body').on('click', '.msg_like_button, .msg_dislike_button', function(){
            
            if( $(this).hasClass("grayedOut") ){
                return false;
            }
            
            var messageId = $(this).parents('.msg_like_buuton_box').attr('commentId');
            var likeAction = $(this).attr('likeAction');

            mymessages.likeMessage(messageId, likeAction);
           
        });

    // Event for update the number of comment to display
    $('body').on('click', '.user-msgpage-nav .active-result', function(){

        var viewLimitValue = parseInt($(this).html());

        mymessages.UpdateViewLimit( viewLimitValue);

    });

    // Event for navigation (pagination)
    $('body').on('click', '.messagePageNumbers a', function(){

        var viewLimitValue = $("#messageViewLimit").val();
        var pageSelected = $(this).attr('page');
        var viewOffsetValue = $(this).attr('offset');

        mymessages.Navigate(viewLimitValue, pageSelected, viewOffsetValue);

    });
        
        // Event for report a comment as a spam button
        $('body').on('click', '.reportAsSpam', function(){
                        
            var listingId = $(this).parents('#voice-your-opinion').attr('listingid');
            var commentId = $(this).attr('commentId');

            mymessages.reportAsSpam($(this), listingId, commentId);
            
        });
        
        // Event to prevent user action access
        $('body').on('click', '.notAllowed', function(){            
            
            mymessages.blockWriteInForum();
                    
            $("#light").find(".text-message").html("You must be logged in to show the attachement.");
            
            
        });
        
        // Event for attachement icon
        $('body').on('click', '.attachement-icon', function(){
                    
            $(this).parents('.attachement-div').find('.attachement-file').click();            
            
        });
        
        // Event for attachement input
        $('body').on('change', '.attachement-file', function(){
                    
            $(this).parents('.attachement-div').find('.attachement-icon').html(
                    "<span class='defaultCursor'>"+$(this).val()+"</span><a style='padding-left:20px;' onclick=\"$(this).parents('.attachement-div').find('.attachement-icon').html('Add attachement'); $(this).val('');\" class='deleteAttachement'>Delete</a>"
            );
            
        });
        
        
        // Event for set comment list by criteria
        $('body').on('click', '.viewByCriteria', function(){
                    
            var listingId = $(this).parents('#voice-your-opinion').attr('listingid');
            var viewLimitValue = $("#commentViewLimit").val();
            var commentOrderBy = $(this).attr('orderby');

            mymessages.setViewByCriteria(listingId, viewLimitValue, commentOrderBy);
            
        });        
        
        // Event for open / close comment button
        $('body').on('click', '.openCloseMessages', function(){
            
            if( $(this).attr('status') == 'closed' ){
                
                $(this).parents('.dd_coment_box').find('.hiddenPostComments').each(function(){
                
                    $(this).removeClass('hiddenPostComments');
                    $(this).addClass('visiblePostComments');
                    
                });
                
                $(this).attr('status', 'opened');
                $(this).html('Close all<span class="classic openCloseCommentsTooltip">Close all comments</span>');
                
                
            }else{
                
                $(this).parents('.dd_coment_box').find('.visiblePostComments').each(function(){
                
                    $(this).removeClass('visiblePostComments');
                    $(this).addClass('hiddenPostComments');
                    
                });
                
                $(this).attr('status', 'closed');
                $(this).html('Open all<span class="classic openCloseCommentsTooltip">Open all comments</span>');
                
            }
                    
            
        });        
        
        
        var showChar = mymessages.showChar;
        var ellipsestext = mymessages.ellipsesText;
        var moretext = mymessages.moreText;
        var lesstext = mymessages.lessText;


        // Event for show more comment text button
        $('.more').each(function() {
            
            var content = $(this).html();

            if( content.length > showChar ) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        // Event for show more comment text button
        $('body').on('click', '.moremsglink', function(){
            
            if($(this).hasClass("less")) {
                
                $(this).removeClass("less");
                $(this).html(moretext);
                
            }else {
                
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            
            return false;
            
        });
        
        
        // Event for delete a comment button
        $('body').on('click', '.deleteComment', function(){
                        
            var listingId = $(this).parents('#voice-your-opinion').attr('listingid');
            var commentId = $(this).attr('commentId');

            mymessages.deleteComment(listingId, commentId);
            
        });

    
});
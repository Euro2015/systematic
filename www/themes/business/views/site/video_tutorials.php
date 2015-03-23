<?php 
$this->breadcrumbs = array('Video Tutorials'); 
?>
<!-- Where business meets invention -->
    <div id="main-content">
        <div id="main-title">
            <h1 style="font-size: 2.4em;">Video tutorials are a quick and easy way to get started</h1>
        </div> <!-- /main-title -->
        <div id="main-copy">
            <div id="copy-column-1">
                <p style="text-align: left;">
                    <span>In todays fast paced life style we have very little time to get upto speed. With that in mind we have a selection of short videos to quickly get you upto speed and get you going. To find out more and how to get started  
		    <a href="javascript:void(0)" onclick="play_video('http://youtu.be/HR6KfAwux1o');"  title='How business supermarket can help you video'><strong> click here>></strong></a><br />
                </span></p>
            </div>
            <div id="copy-column-2">
                <p style="text-align: left;"><span>Got a great idea and don't know what to do next? Then find out more <a href="javascript:void(0)" onclick="play_video('http://youtu.be/ORu_3dSYDV0');" title='How dragonsnet business supermarket can help launch a new business idea' ><strong>click here>></strong></a><br />
                Not all of us like the business environment but would like to improve our quality of life instead. To find out more <a href="javascript:void(0)" onclick="play_video('http://youtu.be/YlIhWEhFyE4');" title='How dragonsnet business supermarket can help the consumer' ><strong>click here>></strong></a></span></p>
            </div>
            <div class="clear"></div>
        </div> <!-- /main-copy --> 
    </div> <!-- /main-content -->    
    <div class="clear"></div>
    <?php 
    $this->renderPartial('bottom_slider');
    ?>
    <div class="page_content"> <?php if($model && $model->desc) echo $model->desc;?></div>
	<script type="text/javascript">

	function play_video(video)

	{

		$('.home-slider-wrap').fadeOut();

		$('.home-video-wrap').fadeIn('slow'); 

		 jwplayer('my-video').setup({

                file: video,

                image: '/themes/business/images/robot/defult-video.png',

                width: '640',

                height: '360',

                autostart:'true',

                events: {  

				onComplete: function()

				{

				$('.home-slider-wrap').fadeIn('slow');	
				
				$('.home-video-wrap').fadeOut('fast'); 
				
				}               

				}                

            });

		

	}	
	</script>
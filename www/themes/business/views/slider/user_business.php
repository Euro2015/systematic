<div class='home-slider-wrap'><div id='carousel-wrapper'><div id='dragongallery' class='stepcarousel'><div class='belt'><!-- /panel -->

                            <!-- End of carousel content -->

                        </div>

                        <!-- /belt -->

                    </div>

                    <p class='hideme'> <b>Current Panel:</b> <span id='statusA'></span> <b style='margin-left: 30px'>Total Panels:</b> <span id='statusC'></span> </p>

                    <div id='gallery-navigation'>

                        <p id='dragongallery-paginate' style='width: 740px'> <img src='/themes/business/images/opencircle.png' alt='Dragonsnet business supermarket navigation buttons' data-over='/themes/business/images/graycircle.png' data-select='/themes/business/images/closedcircle.png' data-moveby='1' /> </p>

                    </div>

                    <!-- /gallery-navigation -->                  <div id='search-tab'>

                        <input type='text' onblur='this.value='Search site...';' onfocus='this.value='';' value='Search site...'>

                        <a href='user_listing_search.php' title='Search the site' >

                            <input type='submit' value=''>

                        </a> </div>

                    <!-- /search-tab -->

                </div>

                <!-- /carousel-wrapper -->

            </div>

            <!-- /slider-wrapper ends here -->          <div class='home-video-wrap' style='display:none'> <!-- slider-wrapper start--->

                <a href='javascript:void(0)' onclick='show_slider();' class='video-close'><img src='/themes/business/images/close.png' alt='business supermarket close button' width='24' />

                </a>

                <div id='carousel-wrapper'>

                    <div id='dragongallery' class='stepcarousel'>

                        <div id='my-video'></div>

                      <script type='text/javascript'>                      </script>

                    </div>

                    <!-- /dragongallery End -->

                </div>

                <!-- /carousel-wrapper End -->

            </div>
			<script type='text/javascript'>

    function show_video(video)

    {

        $('.home-slider-wrap').fadeOut();

        $('.home-video-wrap').fadeIn('slow');

        jwplayer('my-video').setup({

            file: video,

            image: 'http://business-supermarket.com/themes/business/images/robot/defult-video.png',

            width: '640',

            height: '360',

            autostart:'true',

            events: {

                onComplete: function() { window.location='../index.php'; }

            }

        });



    }



    function show_slider()

    {

        $('.home-slider-wrap').fadeIn('slow');

        $('.home-video-wrap').fadeOut('fast');

    }

</script>

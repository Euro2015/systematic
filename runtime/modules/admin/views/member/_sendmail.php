<?php 
//$themepath = Yii::app()->theme->baseUrl;
//Yii::app()->clientScript->registerCoreScript('jquery'); 
//Yii::app()->clientScript->registerScriptFile($themepath.'/js/tinymce/tinymce.min.js');
//Yii::app()->clientScript->registerCssFile($themepath.'/css/button.css');
?>

<div class="form">  
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'member-send-mail',
    	'enableAjaxValidation'=>true,
        //'action'=>Yii::app()->createUrl("member/sendmail",array("id"=>$model->drg_id)),
    )); ?> 
        
        <div class="clearBoth"></div> 
            <div class="userData">                
            <fieldset>    	 
                   <table>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <?php
                                    foreach(Yii::app()->user->getFlashes() as $key => $message) {
                                        echo '<div class="' . $key . '">' . $message . "</div>\n";
                                        if($key=='success'){
                                        ?>
                                            <script type="text/javascript">
                                                parent.jQuery.fancybox.close();
                                            </script>
                                        <?php
                                        }
                                    }
                                ?>
                            </td>
                        </tr> 
                        <tr>
                            <input type="hidden" name="sendmail" id="sendmail"  value="true" />
                            <td valign="top" width="15%">Send To  :</td>
                            <td width="85%"><?php echo $model->drg_email; ?></td>
                        </tr>
                        <tr>
                            <td valign="top">Subject :</td>
                            <td><input type="text" name="subject" id="subject" size="100" /></td>                    
                        </tr>
                        <tr>
                            <td valign="top">Message : </td>
                            <td> 
                                <textarea name="bodymessage" id="bodymessage" rows="15" style="width:100%"></textarea>  
                            </td>
                        </tr> 
                        <tr>
                            <td> </td>
                            <td><?php echo CHtml:: submitButton('Send', array('class' => 'button green','id'=>'btnsendmail')); ?></td>
                        </tr>  
                    </table> 
            </fieldset>
            </div>  

<?php $this->endWidget(); ?>
</div><!-- form -->  

 <script type="text/javascript"> 
 
    //  tinymce.init({
    //     selector: "#bodymessage",
    //     plugins: [
    //         "advlist autolink lists link  charmap  preview anchor",
    //         "searchreplace visualblocks  ",
    //     ],
    //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    // });  
</script> 
  
   
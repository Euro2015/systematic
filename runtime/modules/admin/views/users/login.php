<div class="header">
            <div align="center">
                <div class="maincont">
                    <div class="outerdiv">
                        <div class="topbar"><h3><?php echo Yii::app()->params['company_name']; ?>! Administration Login</h3>                              
                            <?php
                                foreach(Yii::app()->user->getFlashes() as $key => $message) {
                                    echo '<h4 class="' . $key . ' " align="center">' . $message . "</h4>\n";
                                }
                            ?>
                        </div>

                        <div class="formright">
                            <?php $form=$this->beginWidget('CActiveForm', array('id'=>'adminuser-login-form','enableAjaxValidation'=>true,'htmlOptions'=>array('onsubmit'=>"return form_validation()"))); ?>

                           <!-- <form method="post" autocomplete="off" enctype="multipart/form-data" class="fullform" name="brandform" id="brandform" onsubmit="return form_validation()">-->
                                <table cellpadding="5" cellspacing="1" align="center" width="100%">
                                    <tr>
                                        <td width="130"><?php echo $form->labelEx($model,'admin_email'); ?> </td>
                                        <td>
                                        <?php echo $form->textField($model,'admin_email',array('title'=>'Username','class'=>'R','tabindex'=>1)); ?> 
                                        <?php echo $form->error($model,'admin_email'); ?>                                       
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $form->labelEx($model,'admin_password'); ?> </td>
                                        <td>
                                            <?php echo $form->passwordField($model,'admin_password',array('class'=>'R','tabindex'=>2)); ?>    
                                         <?php echo $form->error($model,'admin_password'); ?>                                       
                                        </td>
                                    </tr>    

                                    <tr>
                                        <td></td>
                                        <td class="center">
                                            <input type="submit" class="button black-button" name="btnlogin" value="Login" />&nbsp;&nbsp;
                                            <input type="reset" class="button black-button" name="btncancel" value="Cancel" />
                                        </td>
                                    </tr>
                                </table>
                            <?php $this->endWidget(); ?> 
                        </div>  
                        <div class="lock_img"></div>
                    </div>
                </div>
            </div>


<div class="header">
            <div align="center">
                <div class="maincont">
                    <div class="outerdiv">
                        <div class="topbar"><h3><?php echo Yii::app()->name; ?>! Administration Login</h3>                              
                            <?php
                                foreach(Yii::app()->user->getFlashes() as $key => $message) {
                                    echo '<h4 class="' . $key . ' " align="center">' . $message . "</h4>\n";
                                }
                            ?>
                        </div>

                        <div class="formright">
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'top-websites-cr-form',
                                    'enableAjaxValidation'=>false,
                                    'clientOptions' => array(
                                  'validateOnSubmit'=>true,
                                  //'validateOnChange'=>true,
                                  //'validateOnType'=>false,
                                     ),
                            )); ?>

                           <!-- <form method="post" autocomplete="off" enctype="multipart/form-data" class="fullform" name="brandform" id="brandform" onsubmit="return form_validation()">-->
                                <table cellpadding="5" cellspacing="1" align="center" width="100%">
                                    <tr>
                                        <td width="130"><?php echo $form->labelEx($model,'username'); ?> </td>
                                        <td>
                                        <?php echo $form->textField($model,'username',array('title'=>'Username','class'=>'R','tabindex'=>1)); ?> 
                                        <?php echo $form->error($model,'username'); ?>                                       
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $form->labelEx($model,'password'); ?> </td>
                                        <td>
                                            <?php echo $form->passwordField($model,'password',array('class'=>'R','tabindex'=>2)); ?>    
                                         <?php echo $form->error($model,'password'); ?>                                       
                                        </td>
                                    </tr>    

                                    <tr>
                                        <td></td>
                                        <td class="center">
                                            <input style="cursor:pointer;" type="submit" class="button black-button" name="btnlogin" value="Login" />&nbsp;&nbsp;
                                            <input style="cursor:pointer;" type="reset" onclick="window.location='<?php echo $this->createAbsoluteUrl('/');?>';" class="button black-button" name="btncancel" value="Cancel" />
                                        </td>
                                    </tr>
                                </table>
                            <?php $this->endWidget(); ?> 
                        </div>  
                    </div>
                </div>
            </div>
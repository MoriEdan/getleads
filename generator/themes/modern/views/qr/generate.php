<?php
$this->pageTitle = Yii::app()->name . ' - Generator';
$this->breadcrumbs = array(
    'Generator',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => false,
    ),
        ));

echo $form->hiddenField($model, 'qr_type', array('id' => 'qr-type'));
//    echo $form->hiddenField(<input type="hidden" name="qr_type" id="qr-type" value="text" />);
?>

<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x90') ?>
</div>

<div class="well">
    <div id="qr-types" class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <li><a class="tab-qr-type active" href="#tab1" data-toggle="tab" data-qrtype="text">Text</a></li>
            <li><a class="tab-qr-type" href="#tab2" data-toggle="tab" data-qrtype="website">Website</a></li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle tab-qr-type" href="#">Social network <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a class="tab-qr-type" href="#tab3" data-toggle="tab" data-qrtype="facebook_profile">Facebook Profile</a></li>
                    <li><a class="tab-qr-type" href="#tab4" data-toggle="tab" data-qrtype="facebook_like">Facebook Like</a></li>
                    <li><a class="tab-qr-type" href="#tab5" data-toggle="tab" data-qrtype="twitter_profile">Twitter Profile</a></li>
                    <li><a class="tab-qr-type" href="#tab6" data-toggle="tab" data-qrtype="twitter_status">Twitter Status</a></li>
                    <li><a class="tab-qr-type" href="#tab7" data-toggle="tab" data-qrtype="linkedin_profile">LinkedIn Profile</a></li>
                    <li><a class="tab-qr-type" href="#tab8" data-toggle="tab" data-qrtype="linkedin_share">LinkedIn Share</a></li>
                </ul>
            </li>
            <li><a class="tab-qr-type" href="#tab9" data-toggle="tab" data-qrtype="telephone">Telephone</a></li>
            <li><a class="tab-qr-type" href="#tab10" data-toggle="tab" data-qrtype="sms">SMS</a></li>
            <li><a class="tab-qr-type" href="#tab11" data-toggle="tab" data-qrtype="email">E-mail</a></li>
            <li><a class="tab-qr-type" href="#tab12" data-toggle="tab" data-qrtype="email_msg">E-mail Message</a></li>
            <li><a class="tab-qr-type" href="#tab13" data-toggle="tab" data-qrtype="vcard">V-Card</a></li>
            <li><a class="tab-qr-type" href="#tab14" data-toggle="tab" data-qrtype="mecard">Me-Card</a></li>
        </ul>
        <div class="tab-content">
            <?php $error = $form->error($model, 'title', array('class' => 'help-inline')); ?>
            <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                <?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
                <?php echo $form->textField($model, 'title', array('class' => 'control-label')); ?>
                <?php if ($error): ?>
                    <?php echo $error ?>
                <?php endif ?>
            </div>

            <div class="tab-pane active" id="tab1">
                <div id="text-qwrap">
                    <?php $error = $form->error($model, 'text_data_text', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'text_data_text', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'text_data_text', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div id="website-qwrap">
                    <?php $error = $form->error($model, 'website_data_url', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'website_data_url', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'website_data_url', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                <div id="facebook_profile-qwrap">
                    <?php $error = $form->error($model, 'facebook_profile_data_url', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'facebook_profile_data_url', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'facebook_profile_data_url', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab4">
                <div id="facebook_like-qwrap">
                    <?php $error = $form->error($model, 'facebook_like_data_url', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'facebook_like_data_url', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'facebook_like_data_url', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'facebook_like_data_title', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'facebook_like_data_title', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'facebook_like_data_title', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab5">
                <div id="twitter_profile-qwrap">
                    <?php $error = $form->error($model, 'twitter_profile_data_url', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'twitter_profile_data_url', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'twitter_profile_data_url', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab6">
                <div id="twitter_status-qwrap">
                    <?php $error = $form->error($model, 'twitter_status_data_tweet', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'twitter_status_data_tweet', array('class' => 'control-label')); ?>
                        <?php echo $form->textarea($model, 'twitter_status_data_tweet', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab7">
                <div id="linkedin_profile-qwrap">
                    <?php $error = $form->error($model, 'linkedin_profile_data_url', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'linkedin_profile_data_url', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'linkedin_profile_data_url', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab8">
                <div id="linkedin_share-qwrap">
                    <?php $error = $form->error($model, 'linkedin_share_data_url', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'linkedin_share_data_url', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'linkedin_share_data_url', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab9">
                <div id="telephone-qwrap">
                    <?php $error = $form->error($model, 'telephone_data_number', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'telephone_data_number', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'telephone_data_number', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab10">
                <div id="sms-qwrap">
                    <?php $error = $form->error($model, 'sms_data_number', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'sms_data_number', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'sms_data_number', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab11">
                <div id="email-qwrap">
                    <?php $error = $form->error($model, 'email_data_email', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'email_data_email', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'email_data_email', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab12">
                <div id="email_msg-qwrap">
                    <?php $error = $form->error($model, 'email_msg_data_email', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'email_msg_data_email', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'email_msg_data_email', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'email_msg_data_subject', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'email_msg_data_subject', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'email_msg_data_subject', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'email_msg_data_body', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'email_msg_data_body', array('class' => 'control-label')); ?>
                        <?php echo $form->textarea($model, 'email_msg_data_body', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab13">
                <div id="vcard-qwrap">
                    <?php $error = $form->error($model, 'vcard_data_fname', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_fname', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_fname', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'vcard_data_lname', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_lname', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_lname', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'vcard_data_job_title', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_job_title', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_job_title', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'vcard_data_telephone', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_telephone', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_telephone', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'vcard_data_cell', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_cell', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_cell', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'vcard_data_fax', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_fax', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_fax', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'vcard_data_email', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_email', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_email', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'vcard_data_website', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_website', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_website', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'vcard_data_org', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'vcard_data_org', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'vcard_data_org', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab14">
                <div id="mecard-qwrap">
                    <?php $error = $form->error($model, 'mecard_data_fname', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'mecard_data_fname', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'mecard_data_fname', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'mecard_data_lname', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'mecard_data_lname', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'mecard_data_lname', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'mecard_data_telephone', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'mecard_data_telephone', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'mecard_data_telephone', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'mecard_data_email', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'mecard_data_email', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'mecard_data_email', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                    <?php $error = $form->error($model, 'mecard_data_website', array('class' => 'help-inline')); ?>
                    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
                        <?php echo $form->labelEx($model, 'mecard_data_website', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($model, 'mecard_data_website', array('class' => 'qrblr')); ?>
                        <?php if ($error): ?>
                            <?php echo $error ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton(Yii::t('dict', 'Save'), array('class' => 'btn btn-primary')); ?>
    </div>
    <?php $this->endWidget(); ?>

</div>

<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x90') ?>
</div>

<script>
    $('#qr-types a[data-toggle="tab"]').on('shown', function (e) {
        
        var type = $(e.target).data('qrtype');
        $('#qr-type').val(type);
    });
    
<?php if ($qr_type): ?>
            $(function(){
                $('.tab-qr-type[data-qrtype="<?php echo $qr_type ?>"]').tab('show');
            });
<?php endif ?>
</script>
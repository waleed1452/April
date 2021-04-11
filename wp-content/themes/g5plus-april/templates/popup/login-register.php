<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 13/04/2018
 * Time: 10:37 SA
 */
?>
<div id="gsf-popup-login-wrapper" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form id="gsf-popup-login-form" class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                    aria-label="<?php _e('Close', 'g5plus-april'); ?>"><i class="fa fa-remove"></i>
            </button>
            <div class="modal-header">
                <h4 class="modal-title"><?php _e('Login', 'g5plus-april'); ?></h4>
                <p><?php _e('Hello. Welcome to your account.', 'g5plus-april'); ?></p>
            </div>
            <div class="modal-body">
                <div class="gsf-popup-login-content">
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="text" class="form-control" name="username"
                                   required="required"
                                   placeholder="<?php _e('Username', 'g5plus-april') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="password" name="password" class="form-control"
                                   required="required"
                                   placeholder="<?php _e('Password', 'g5plus-april') ?>">
                        </div>
                    </div>
                    <div class="login-message text-left fs-12"></div>
                </div>
            </div>
            <div class="modal-footer">
                <?php do_action('login_form'); ?>
                <input type="hidden" name="action" value="gsf_user_login_ajax"/>
                <div class="modal-footer-left">
                    <input id="remember-me" type="checkbox" name="rememberme" checked="checked"/>
                    <label for="remember-me" no-value="<?php _e('NO', 'g5plus-april') ?>"
                           yes-value="<?php _e('YES', 'g5plus-april') ?>"></label>
                    <?php _e('Remember me', 'g5plus-april') ?>
                </div>
                <div class="modal-footer-right">
                    <button data-style="zoom-in" data-spinner-size="30" data-spinner-color="#fff"
                            type="submit"
                            class="ladda-button btn btn-primary btn-classic btn-rounded btn-sm"><?php echo __('Login', 'g5plus-april'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="gsf-popup-register-wrapper" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form id="gsf-popup-register-form" class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                    aria-label="<?php _e('Close', 'g5plus-april'); ?>"><i class="fa fa-remove"></i>
            </button>
            <div class="modal-header">
                <h4 class="modal-title"><?php _e('Register', 'g5plus-april'); ?></h4>
                <p><?php _e('Hello. Welcome to your account.', 'g5plus-april'); ?></p>
            </div>
            <div class="modal-body">
                <div class="gsf-popup-login-content">
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="text" class="form-control" name="username"
                                   required="required"
                                   placeholder="<?php _e('Username', 'g5plus-april') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="email" name="email" class="form-control"
                                   required="required"
                                   placeholder="<?php _e('Email', 'g5plus-april') ?>">
                        </div>
                    </div>
                    <div class="login-message text-left fs-12"></div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="action" value="gsf_user_sign_up_ajax"/>
                <div class="">
                    <button data-style="zoom-in" data-spinner-size="30" data-spinner-color="#fff" type="submit"
                            class="ladda-button btn btn-primary btn-classic btn-rounded btn-sm btn-block"><?php echo __('Register', 'g5plus-april'); ?></button>
                </div>
                <div
                    class="mg-top-20"><?php _e('The password will be emailed to you!', 'g5plus-april') ?></div>
            </div>
        </form>
    </div>
</div>
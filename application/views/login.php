<?php include 'template/config.php'; ?>
<?php include 'template/template_start.php'; ?>

    <!-- Full Background -->
    <!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
    <img src="/assets/template/img/placeholders/layout/login2_full_bg.jpg" alt="Full Background"
         class="full-bg animation-pulseSlow">
    <!-- END Full Background -->

    <!-- Login Container -->
    <div id="login-container">
        <!-- Login Header -->
        <h1 class="h2 text-light text-center push-top-bottom animation-pullDown">
            <i class="fa fa-cube text-light-op"></i> <strong>Stupid Timesheets...</strong>
        </h1>
        <!-- END Login Header -->

        <!-- Login Block -->
        <div class="block animation-fadeInQuick">
            <!-- Login Title -->
            <div class="block-title">
                <h2>Please Login</h2>
            </div>
            <!-- END Login Title -->
            <?php
            if (strlen(trim($message)) > 0)
            {
                ?>
                <div class="alert alert-danger alert-dismissable animation-bigEntrance">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                    <!--<h4><strong>Error</strong></h4>-->
                    <p><?php print $message; ?></p>
                </div>
                <?php
            }
            ?>
            <!-- Login Form -->
            <form id="form-login" action="/login/proc" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="login-user" class="col-xs-12">Username</label>

                    <div class="col-xs-12">
                        <input type="text" id="login-user" name="login-user" class="form-control"
                               placeholder="Your Username...">
                    </div>
                </div>
                <div class="form-group">
                    <label for="login-password" class="col-xs-12">Password</label>

                    <div class="col-xs-12">
                        <input type="password" id="login-password" name="login-password" class="form-control"
                               placeholder="Your password...">
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-8">
                        <label class="csscheckbox csscheckbox-primary">
                            <input type="checkbox" id="login-remember-me" name="login-remember-me"
                                   value="1"/><span></span> Remember Me?
                        </label>
                    </div>
                    <div class="col-xs-4 text-right">
                        <button type="submit" class="btn btn-effect-ripple btn-sm btn-success">Log In</button>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->

        </div>
        <!-- END Login Block -->

        <!-- Footer -->
        <footer class="text-muted text-center animation-pullUp">
            <small><span id="year-copy"></span> &copy; <a href="#"
                                                          target="_blank"><?php echo $template['name'] . ' ' . $template['version']; ?></a>
            </small>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Login Container -->

<?php include 'template/template_scripts.php'; ?>

    <!-- Load and execute javascript code used only in this page -->
    <script src="/assets/template/js/pages/readyLogin.js"></script>
    <script>$(function ()
        {
            ReadyLogin.init();
        });</script>

<?php include 'template/template_end.php'; ?>
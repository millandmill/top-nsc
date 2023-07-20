<div class="col-xs-offset-0 col-sm-offset-2 col-md-offset-3 col-lg-offset-4 col-xs-12 col-sm-8 col-md-6 col-lg-4 text-center">
    <form method="POST" name="form_authen" action="login">
        <div class="form-login">
            <ul>
                <li><span class="font30">Login</span></li>
                <li class="text-left"><span class="font20">Username</span></li>
                <li><input type="text" name="username"/></li>
                <li class="text-left"><span class="font20">Password</span></li>
                <li><input type="password" name="password"/></li><br/>
                <?php if(validation_errors() != ''){ ?>
                    <div class="alert alert-danger">
                        <span class="font12"><?php echo validation_errors(); ?></span>
                    </div>
                <?php } ?>
                <li><div class="h20"></div></li>
                <li class="text-left"><button class="bt-login" name="btn_submit" value="login">Login</button><span class="space20"></span>
                    <a href="<?php echo base_url(); ?>welcome/register" class="font12">Register</a><span class="space20"></span>
                    <a href="<?php echo base_url(); ?>welcome/changePassword" class="font12">Change Password</a>
                </li>
            </ul>
        </div>
    </form>
    
    <span class="grey">Copyright 2015 © Powered by TOP-NSC</span>
</div>

</body>
</html>
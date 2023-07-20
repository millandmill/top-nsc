    <div class="col-xs-offset-0 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 col-xs-12 col-sm-8 col-md-6 col-lg-5">
        <form method="POST" name="form_authen" action="register">
            <div class="form-register">
                <ul>
                    <li><span class="font30">สมัครสมาชิก</span></li>
                    <li><span class="font20">Username</span></li>
                    <li><input type="text" name="username" maxlength="13"/></li>
                    <li><span class="font20">Password</span></li>
                    <li><input type="password" name="password"/></li>
                    <li><span class="font20">E-mail</span></li>
                    <li><input type="text" name="email"/></li><br/>
                    <?php if(validation_errors() != ''){ ?>
                        <div class="alert alert-danger">
                            <span class="font12"><?php echo validation_errors(); ?></span>
                        </div>
                    <?php } ?>
                    <li><div class="h20"></div></li>
                    <li class="text-center"><input type="submit" value="สมัคร" class="bt-submit" name="btn_submit"/>
                        <button name="btn_back" class="bt-reset" name="btn_back">กลับ</button> 
                    </li>
                </ul>
            </div>
        </form>
        
        <div class="grey text-center">Copyright 2015 © Powered by TOP-NSC</div>
    </div>

</body>
</html>
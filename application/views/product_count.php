<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    if(isset($product_count)){
        $resultData = $product_count;
    }

?>


            <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
                <div class="content">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <div style="font-size:1.6em;margin-top:6px;">
                                    <i class="fa fa-cubes"></i>&nbsp;เพิ่มจำนวนสินค้า
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-12"> 
                                <form method="POST" name="form_authen" action="product_count">
                                    <div class="form-addproduct">
                                        <ul>
                                            <li><span class="font12">จำนวน</span></li><br/>
                                            <li><input class="form-control" type="number" name="product_count"/></li>
                                            <li><input type="hidden" name="product_id" value="<?php if(isset($resultData[0]['product_id'])){ echo $resultData[0]['product_id']; } ?>"/></li>
                                            <li><input type="hidden" name="product_company_id" value="<?php if(isset($resultData[0]['product_company_id'])){ echo $resultData[0]['product_company_id']; } ?>"/></li>
                                            <li><input type="hidden" name="product_name" value="<?php if(isset($resultData[0]['product_name'])){ echo $resultData[0]['product_name']; } ?>"/></li>
                                            <li><input type="hidden" name="product_type" value="<?php if(isset($resultData[0]['product_type'])){ echo $resultData[0]['product_type']; } ?>"></li>
                                            <li><input type="hidden" name="product_gen" value="<?php if(isset($resultData[0]['product_gen'])){ echo $resultData[0]['product_gen']; } ?>"/></li>
                                            <li><input type="hidden" name="product_exp" value="<?php if(isset($resultData[0]['product_exp'])){ echo $resultData[0]['product_exp']; } ?>"/></li>
                                            <li><input type="hidden" name="product_price" value="<?php if(isset($resultData[0]['product_price'])){ echo $resultData[0]['product_price']; } ?>"/></li>
                                            <li><input type="hidden" name="user_id" value="<?php if(isset($resultData[0]['user_id'])){ echo $resultData[0]['user_id']; } ?>"/></li>
                                            <li><div class="h20"></div></li>
                                            <?php if(validation_errors() != ''){ ?>
                                                    <li><?php echo validation_errors() ?></li>
                                            <?php } ?>
                                            <li><input type="submit" value="บันทึก"  class="bt-submit" name="btn_submit"/>
                                                <input type="reset" value="ยกเลิก" class="bt-reset" /> 
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                          </div><!-- class = row -->
                        </div>
                    </div>
                </div><!-- end content -->
            </div><!-- end col-xs-12 -->
        </div>
    </div>
</body>
</html>
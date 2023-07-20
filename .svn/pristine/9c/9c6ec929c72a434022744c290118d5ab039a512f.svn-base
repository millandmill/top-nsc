<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    if(isset($product_edit)){
        $resultData = $product_edit;
    }

?>

            <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
                <div class="content">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <div style="font-size:1.6em;margin-top:6px;">
                                    <i class="fa fa-cubes"></i>&nbsp;ข้อมูลสินค้า
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-12"> 
                                <form method="POST" name="form_authen" action="add_product">
                                    <div class="form-addproduct">
                                        <ul>
                                            <li><input id="product_id" type="hidden" name="product_id" value="<?php if(isset($resultData[0]['product_id'])){ echo $resultData[0]['product_id']; } ?>"/></li>
                                            <li><input type="hidden" name="product_company_id_2" value="<?php if(isset($resultData[0]['product_company_id'])){ echo $resultData[0]['product_company_id']; } ?>"/></li>
                                            <li><span class="font12">รหัสสินค้า</span></li>
                                            <li><input class="form-control" type="text" name="product_company_id" value="<?php if(isset($resultData[0]['product_company_id'])){ echo $resultData[0]['product_company_id']; } ?>"/></li><br/>
                                            <li><span class="font12">ชื่อสินค้า</span></li>
                                            <li><input class="form-control" type="text" name="product_name" value="<?php if(isset($resultData[0]['product_name'])){ echo $resultData[0]['product_name']; } ?>"/></li><br/>
                                            <li><span class="font12">ประเภทสินค้า</span></li>
                                            <li>
                                                <select id="select_type" name="product_type" class="slt" onchange="chk_count()">
                                                    <option value="">----- กรุณาเลือก -----</option>
                                                    <option value="มีวันหมด" <?php if(isset($resultData[0]['product_type'])){ if($resultData[0]['product_type'] == 'มีวันหมด'){ echo 'selected'; }} ?>>มีวันหมด</option>
                                                    <option value="ไม่มีวันหมด" <?php if(isset($resultData[0]['product_type'])){ if($resultData[0]['product_type'] == 'ไม่มีวันหมด'){ echo 'selected'; }} ?>>ไม่มีวันหมด</option>
                                                </select>
                                            </li><br/>
                                            <li><span class="font12">สถานะสินค้า</span></li>
                                            <li>
                                                <select name="product_status" class="slt">
                                                    <option value="">----- กรุณาเลือก -----</option>
                                                    <option value="1" <?php if(isset($resultData[0]['status_name'])){ if($resultData[0]['status_name'] == 'คงเหลือ'){ echo 'selected'; }} ?>>คงเหลือ</option>
                                                    <option value="2" <?php if(isset($resultData[0]['status_name'])){ if($resultData[0]['status_name'] == 'หมดสต็อก'){ echo 'selected'; }} ?>>หมดสต็อก</option>
                                                </select>
                                            </li><br/>
                                            <li><span class="font12">วันที่ผลิต&nbsp;</span><i class="fa fa-calendar"></i></li>
                                            <li><input class="form-control" type="date" name="product_gen" value="<?php if(isset($resultData[0]['product_gen'])){ echo $resultData[0]['product_gen']; } ?>"/></li><br/>
                                            <li><span class="font12">วันหมดอายุ&nbsp;</span><i class="fa fa-calendar"></i></li>
                                            <li><input class="form-control" type="date" name="product_exp" value="<?php if(isset($resultData[0]['product_exp'])){ echo $resultData[0]['product_exp']; } ?>"/></li><br/>
                                            <div id="product_count">
                                                <li><span class="font12">จำนวน</span></li>
                                                <li><input class="form-control" type="number" name="product_count" value="1" min="1"/></li><br/>
                                            </div>
                                            <li><span class="font12">ราคา</span></li>
                                            <li><input class="form-control" type="text" name="product_price" value="<?php if(isset($resultData[0]['product_price'])){ echo $resultData[0]['product_price']; } ?>"/></li><br/>
                                            <li><div class="h20"></div></li>
                                            <?php if(validation_errors() != ''){ ?>
                                                <div class="alert alert-danger">
                                                    <span class="font12"><?php echo validation_errors(); ?></span>
                                                </div>
                                            <?php } ?>
                                            <li><input type="submit" value="บันทึก"  class="bt-submit" name="btn_submit"/>
                                                <input type="reset" value="ยกเลิก" class="bt-reset" name="btn_back" /> 
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
    <script>
        $("#product_count").hide();
        function chk_count() {
            var type = document.getElementById("select_type").value;
            var id = document.getElementById("product_id").value;
            if(id == ""){
                if(type == "มีวันหมด"){
                    $("#product_count").show();
                }else{
                    $("#product_count").hide();
                }
            }
        }
    </script>
</body>
</html>
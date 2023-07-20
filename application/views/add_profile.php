<?php
	if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
	
	if(isset($profile_edit)){
		$resultData = $profile_edit;
	}
	
?>

		    <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
		        <div class="content">
		            <div class="panel panel-warning">
		                <div class="panel-heading">
		                    <div class="pull-left">
		                        <div style="font-size:1.6em;margin-top:6px;">
		                            <i class="fa fa-cubes"></i>&nbsp;ข้อมูลส่วนตัว
		                        </div>
		                    </div>
		                    <div class="clearfix"></div>
		                </div>
		                <div class="panel-body">
		                  	<div class="row">
			                    <div class="col-md-12"> 
			                        <form method="POST" name="form_authen" action="profile_add" enctype="multipart/form-data">
			                            <div class="form-addproduct">
			                                <ul>
			                                	<li><input type="hidden" name="profile_id" value="<?php if(isset($resultData[0]['profile_id'])){ echo $resultData[0]['profile_id']; } ?>"/></li>
								                <li><span class="font12">คำนำหน้าชื่อ</span></li>
								                <li>
								                	<select name="before_name">
								                		<option value="ไม่ใส่">==คำนำหน้าชื่อ==</option>
								                		<option value="นาย" <?php if(isset($resultData[0]['profile_before_name'])){ if($resultData[0]['profile_before_name'] == "นาย"){ echo "selected"; } } ?>>นาย</option>
								                		<option value="นาง" <?php if(isset($resultData[0]['profile_before_name'])){ if($resultData[0]['profile_before_name'] == "นาง"){ echo "selected"; } } ?>>นาง</option>
								                		<option value="นางสาว" <?php if(isset($resultData[0]['profile_before_name'])){ if($resultData[0]['profile_before_name'] == "นางสาว"){ echo "selected"; } } ?>>นางสาว</option>
								                	</select>
								                </li><br/>
								                <li><span class="font12">ชื่อจริง</span>&nbsp<font color="red"><sup>*จำเป็น</sup></font></li>
								                <li><input class="form-control" type="text" name="fname" maxlength="80" value="<?php if(isset($resultData[0]['profile_fname'])){ echo $resultData[0]['profile_fname']; } ?>"/></li><br/>
								                <li><span class="font12">นามสกุล</span></li>
								                <li><input class="form-control" type="text" name="lname" maxlength="80" value="<?php if(isset($resultData[0]['profile_lname'])){ echo $resultData[0]['profile_lname']; } ?>"/></li><br/>
								                <li><span class="font12">ที่อยู่</span></li>
								                <li><input class="form-control" type="text" name="address" maxlength="80" value="<?php if(isset($resultData[0]['profile_address'])){ echo $resultData[0]['profile_address']; } ?>"/></li><br/>
								                <li><span class="font12">รหัสไปรษณีย์</span>&nbsp<font color="red"><sup>*จำเป็น</sup></font></li>
								                <li><input class="form-control" type="text" name="postcost" maxlength="5" value="<?php if(isset($resultData[0]['profile_postcost'])){ echo $resultData[0]['profile_postcost']; } ?>"/></li><br/>
								                <li><span class="font12">เลขประจำตัวผู้เสียภาษีอากรผู้มีหน้าที่หัก ณ ที่จ่าย</span></li>
								                <li><input class="form-control" type="text" name="id_man_tax" maxlength="10" value="<?php if(isset($resultData[0]['profile_man_tax'])){ echo $resultData[0]['profile_man_tax']; } ?>"/></li><br/>
								                <li><span class="font12">เลขที่สาขา ผู้มีหน้าที่หัก ภาษี ณ ที่จ่าย</span></li>
								                <li><input class="form-control" type="text" name="number_branch" maxlength="4" value="<?php if(isset($resultData[0]['profile_branch'])){ echo $resultData[0]['profile_branch']; } ?>"/></li><br/>
								                <li><span class="font12">เลขประจำตัวผู้เสียภาษีอากร 13 หลัก ของผู้ถูกหัก ณ ที่จ่าย</span>&nbsp<font color="red"><sup>*จำเป็น</sup></font></li>
								                <li><input class="form-control" type="text" name="id_iden" maxlength="13" value="<?php if(isset($resultData[0]['profile_iden'])){ echo $resultData[0]['profile_iden']; } ?>"/></li><br/>
								                <li><span class="font12">เลขประจำตัวผู้เสียภาษีอากรผู้มีเงินได้</span></li>
								                <li><input class="form-control" type="text" name="id_iden_money" maxlength="10" value="<?php if(isset($resultData[0]['profile_iden_money'])){ echo $resultData[0]['profile_iden_money']; } ?>"/></li><br/>
								                <li><span class="font12">รหัสเงินได้</span>&nbsp<font color="red"><sup>*จำเป็น</sup></font></li>
								                <li>
								                	<select name="money_id">
								                		<option value="ไม่ใส่">==เลือกรหัสเงินได้==</option>
								                		<option value="40(1)" <?php if(isset($resultData[0]['profile_money_id'])){ if($resultData[0]['profile_money_id'] == "40(1)"){ echo "selected"; } } ?>>40(1)</option>
								                		<option value="40(2)ร้อยละ 3" <?php if(isset($resultData[0]['profile_money_id'])){ if($resultData[0]['profile_money_id'] == "40(2)ร้อยละ 3"){ echo "selected"; } } ?>>40(2)ร้อยละ 3</option>
								                		<option value="40(1)(2) ออกจากงาน" <?php if(isset($resultData[0]['profile_money_id'])){ if($resultData[0]['profile_money_id'] == "40(1)(2) ออกจากงาน"){ echo "selected"; } } ?>>40(1)(2) ออกจากงาน</option>
								                		<option value="40(2) ผู้รับอยู่ในประเทศไทย" <?php if(isset($resultData[0]['profile_money_id'])){ if($resultData[0]['profile_money_id'] == "40(2) ผู้รับอยู่ในประเทศไทย"){ echo "selected"; } } ?>>40(2) ผู้รับอยู่ในประเทศไทย</option>
								                		<option value="40(2) ผู้รับไม่อยู่ในประเทศไทย" <?php if(isset($resultData[0]['profile_money_id'])){ if($resultData[0]['profile_money_id'] == "40(2) ผู้รับไม่อยู่ในประเทศไทย"){ echo "selected"; } } ?>>40(2) ผู้รับไม่อยู่ในประเทศไทย</option>
								                	</select>
								                </li><br/>
								                <li><span class="font12">วันที่จ่ายเงินได้</span>&nbsp<font color="red"><sup>*จำเป็น</sup></font></li>
								                <li><input class="form-control" type="date" name="money_date" value="<?php if(isset($resultData[0]['profile_money_date'])){ echo $resultData[0]['profile_money_date']; } ?>"/></li><br/>
								                <li><span class="font12">เงื่อนไขการหักภาษี ณ จ่าย</span>&nbsp<font color="red"><sup>*จำเป็น</sup></font></li>
								                <li>
								                	<select name="condition_id">
								                		<option value="ไม่ใส่">==เลือกเงื่อนไข==</option>
								                		<option value="หัก ณ ที่จ่าย" <?php if(isset($resultData[0]['profile_condition_id'])){ if($resultData[0]['profile_condition_id'] == "หัก ณ ที่จ่าย"){ echo "selected"; } } ?>>หัก ณ ที่จ่าย</option>
								                		<option value="ออกตลอดไป" <?php if(isset($resultData[0]['profile_condition_id'])){ if($resultData[0]['profile_condition_id'] == "ออกตลอดไป"){ echo "selected"; } } ?>>ออกตลอดไป</option>
								                		<option value="ออกให้ครั้งเดียว" <?php if(isset($resultData[0]['profile_condition_id'])){ if($resultData[0]['profile_condition_id'] == "ออกให้ครั้งเดียว"){ echo "selected"; } } ?>>ออกให้ครั้งเดียว</option>
								                	</select>
								                </li><br />
								                <li><div class="h20"></div></li>
								                <?php if(validation_errors() != ''){ ?>
								                    <div class="alert alert-danger">
								                        <span class="font12"><?php echo validation_errors(); ?></span>
								                    </div>
								                <?php } ?>
								                <li><input type="submit" value="บันทึก" class="bt-submit" name="btn_submit"/>
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
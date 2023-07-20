<?php 
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    if(isset($company)){
        $resultData = $company;
    }

?>
            <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
                <div class="content">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <div style="font-size:1.6em;margin-top:6px;">
                                    <i class="glyphicon glyphicon-briefcase"></i></i>&nbsp;ข้อมูลบริษัท
                                </div>
                            </div>
                            <div class="pull-right">
                                <!-- START CONTROL BUTTON -->
                                    <?php if(!isset($resultData)){ ?>
                                    <button name="add" type="button" class="btn btn-success" onclick="location.href='<?php echo base_url(); ?>company/add_company';">
                                        <i class="glyphicon glyphicon-plus"></i>&nbsp;
                                        <span>เพิ่มข้อมูลบริษัท</span>
                                    </button>
                                    <?php } ?>
                                    <?php if(isset($resultData)){ ?>
                                        <button name="add" type="button" class="btn btn-info" onclick="location.href='<?php echo base_url(); ?>company/add_company?c_id=<?php echo $resultData[0]['company_id']; ?>';">
                                            <i class="glyphicon glyphicon-plus"></i>&nbsp;
                                            <span>แก้ไขข้อมูลบริษัท</span>
                                        </button>
                                    <?php } ?>
                                <!-- END CONTROL BUTTON -->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <table class="table table-hover">
                                        <thead class="pon-thead">
                                            <tr>
                                                <th style="width:45%; text-align:left;">รายละเอียดและข้อมูลบริษัท</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td><strong>ชื่อบริษัท</strong></td>
                                            <td><?php if(isset($resultData[0]['company_name'])){ echo $resultData[0]['company_name']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ที่อยู่</strong></td>
                                            <td><?php if(isset($resultData[0]['company_address'])){ echo $resultData[0]['company_address']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>อาคาร</strong></td>
                                            <td><?php if(isset($resultData[0]['company_building'])){ echo $resultData[0]['company_building']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ชั้น</strong></td>
                                            <td><?php if(isset($resultData[0]['company_floor'])){ echo $resultData[0]['company_floor']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ถนน</strong></td>
                                            <td><?php if(isset($resultData[0]['company_road'])){ echo $resultData[0]['company_road']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ตำบล/แขวง</strong></td>
                                            <td><?php if(isset($resultData[0]['company_district'])){ echo $resultData[0]['company_district']; } ?></td>
    						            </tr>
                                        <tr>
                                            <td><strong>เขต/อำเภอ</strong></td>
                                            <td><?php if(isset($resultData[0]['company_county'])){ echo $resultData[0]['company_county']; } ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td><strong>จังหวัด</strong></td>
                                            <td><?php if(isset($resultData[0]['company_province'])){ echo $resultData[0]['company_province']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>รหัสไปรษณีย์</strong></td>
                                            <td><?php if(isset($resultData[0]['company_zip'])){ echo $resultData[0]['company_zip']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>เบอร์โทรศัพท์</strong></td>
                                            <td><?php if(isset($resultData[0]['company_tel'])){ echo $resultData[0]['company_tel']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>FAX</strong></td>
                                            <td><?php if(isset($resultData[0]['company_fax']) && $resultData[0]['company_fax'] != 0){ echo $resultData[0]['company_fax']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>เลขประจำตัวผู้เสียภาษี</strong></td>
                                            <td><?php if(isset($resultData[0]['company_tax_code'])){ echo $resultData[0]['company_tax_code']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>E-mail</strong></td>
                                            <td><?php if(isset($resultData[0]['company_email'])){ echo $resultData[0]['company_email']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Logo</strong></td>
                                            <td>
                                                <?php if(isset($resultData[0]['company_logo']) && trim($resultData[0]['company_logo'] != "")) { ?> 
                                                    <img border="0" width="120px" height="120px" src="<?php echo base_url('uploads/img/'.$resultData[0]['company_logo'].'') ?>" >
                                                <?php }else { ?>
                                                    <img border="0" width="120px" height="120px" src="<?php echo base_url('uploads/img/default-image.jpg') ?>" >
                                                <?php } ?> 
                                            </td>
                                        </tr>
                                    </table>
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
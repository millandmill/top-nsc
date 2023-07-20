<?php 
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    if(isset($profile)){
        $resultData = $profile;
        if($resultData[0]['profile_before_name'] == "ไม่ใส่"){
            $resultData[0]['profile_before_name'] = "";
        }
    }

?>
            <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
                <div class="content">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <div style="font-size:1.6em;margin-top:6px;">
                                    <i class="glyphicon glyphicon-briefcase"></i></i>&nbsp;ข้อมูลส่วนตัว
                                </div>
                            </div>
                            <div class="pull-right">
                                <!-- START CONTROL BUTTON -->
                                    <?php if(!isset($resultData)){ ?>
                                    <button name="add" type="button" class="btn btn-success" onclick="location.href='<?php echo base_url(); ?>exportTxt/profile_add';">
                                        <i class="glyphicon glyphicon-plus"></i>&nbsp;
                                        <span>เพิ่มข้อมูลส่วนตัว</span>
                                    </button>
                                    <?php } ?>
                                    <?php if(isset($resultData)){ ?>
                                        <button name="add" type="button" class="btn btn-info" onclick="location.href='<?php echo base_url(); ?>exportTxt/profile_add?p_id=<?php echo $resultData[0]['profile_id']; ?>';">
                                            <i class="glyphicon glyphicon-plus"></i>&nbsp;
                                            <span>แก้ไขข้อมูลส่วนตัว</span>
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
                                            <td><strong>ชื่อผู้เสียภาษี</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_fname'])){ echo $resultData[0]['profile_before_name']." ".$resultData[0]['profile_fname']." ".$resultData[0]['profile_lname']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ที่อยู่</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_address'])){ echo $resultData[0]['profile_address']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>รหัสไปรษณีย์</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_postcost'])){ echo $resultData[0]['profile_postcost']; } ?></td>
    						            </tr>
                                        <tr>
                                            <td><strong>เลขประจำตัวผู้เสียภาษีอากรผู้มีหน้าที่หัก ณ ที่จ่าย</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_man_tax'])){ echo $resultData[0]['profile_man_tax']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>เลขที่สาขา ผู้มีหน้าที่หัก ภาษี ณ ที่จ่าย</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_branch'])){ echo $resultData[0]['profile_branch']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>เลขประจำตัวผู้เสียภาษีอากร 13 หลัก ของผู้ถูกหัก ณ ที่จ่าย</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_iden'])){ echo $resultData[0]['profile_iden']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>เลขประจำตัวผู้เสียภาษีอากรผู้มีเงินได้</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_iden_money'])){ echo $resultData[0]['profile_iden_money']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>รหัสเงินได้</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_money_id'])){ echo $resultData[0]['profile_money_id']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>วันที่จ่ายเงินได้</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_money_date'])){ echo $resultData[0]['profile_money_date']; } ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>เงื่อนไขการหักภาษี ณ จ่าย</strong></td>
                                            <td><?php if(isset($resultData[0]['profile_condition_id'])){ echo $resultData[0]['profile_condition_id']; } ?></td>
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
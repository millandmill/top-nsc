<?php
  if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
  
  $text = "<font color='red'>No Customer.Please add customer first</font>";
  if(isset($customer)){
    $resultData = $customer;
    $countData = count($resultData);
  }
  if(isset($search)){
        $resultData = $search;
        $countData = count($resultData);
        if($search == "Not found."){
            $search = null;
            $resultData = $search;
            $text = "<font color='red'>Not found. Please click search again for refresh page.</font>";
        }
    }
  $primaryID = 'customer_id';
  $dataShow = array(
        'customer_id' => array('รหัสคู่ค้า', 'customer_id', '15%', 'center', 'center'),
        'customer_name' => array('ชื่อคู่ค้า', 'customer_name', '35%', 'center', 'left'),
        'telephone' => array('เบอร์โทรติดต่อ', 'customer_tel', '15%', 'center', 'center'),
        'email' => array('อีเมล์', 'customer_email', '15%', 'center', 'center'),
        'option' => array('ตัวเลือก', '', '15%', 'center', 'center'),
        );

?>
        <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
          <div class="content">
              <div class="panel panel-warning">
                  <div class="panel-heading">
                      <div class="pull-left">
                          <div style="font-size:1.2em;margin-top:6px;">
                              <i class="glyphicon glyphicon-user"></i>&nbsp;คู่ค้า<span name="total">&nbsp;-&nbsp;<?php if(isset($countData)){ echo $countData; }else{ echo "0"; }?>&nbsp;รายการ</span>
                          </div>
                      </div>
                      <div class="pull-right">
                          <!-- START CONTROL BUTTON -->
                              <button name="add" type="button" class="btn btn-success btn-addp" onclick="location.href='<?php echo base_url(); ?>customer/customer_add';">
                                  <i class="glyphicon glyphicon-plus"></i>&nbsp;
                                  <span>เพิ่มรายการคู่ค้า</span>
                              </button>
                          <!-- END CONTROL BUTTON -->
                      </div>
                      <div class="clearfix"></div>
                  </div>
                  <div class="panel-body">

                    <div class="row">
                      <div class="col-md-12"> 
                      
                        <form action="customer_detail" method="POST">
                          <div style="margin-bottom:15px;">
                              <div class="input-group">
                                  <input type="text" name="search_query" placeholder="คำค้น..." class="form-control search-box">
                                  <div class="input-group-btn">
                                      <button name="btn_search" class="btn btn-theme btn-seach">
                                          คำค้น&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i>
                                      </button>
                                  </div>
                              </div>
                          </div>
                        </form>
                      
                              <table class="table table-striped table-bordered" id="main-table">
                                <thead class="pon-thead">
                                  <tr>
                                    <?php foreach($dataShow as $key => $value) { ?>
                                      <th width="<?php echo $dataShow[$key][2]; ?>" style="text-align:<?php echo $dataShow[$key][3]; ?>">
                                        <?php echo $value[0]; ?>
                                      </th>
                                    <?php } ?>
                                  </tr>
                                </thead>
                                <tbody id="view_inventory">
                                  <?php if(isset($links)){ echo $links; } ?>
                                  <?php if(isset($resultData)){ ?>
                                      <?php foreach ($resultData as $rows) {
                                        $rowID = $rows[$primaryID]; ?>
                                            <tr>
                                              <?php foreach($dataShow as $key => $value) { ?>
                                                <?php switch ($key) {
                                                  case 'option': ?>
                                                    <td style="width:100px;text-align:center;">
                                                        <button name="edit" class="btn btn-grey" onclick="location.href='<?php echo base_url(); ?>customer/customer_add?c_id=<?php echo $rowID; ?>';"><i class="fa fa-edit"></i></button>
                                                    </td>
                                                    <?php break;
                                                  default: ?>
                                                    <td class="text2input" style="text-align:<?php echo $dataShow[$key][4]; ?>;">
                                                      <?php if(!isset($rows[$dataShow[$key][1]])){
                                                        $rows[$dataShow[$key][1]] = " ";
                                                        echo $rows[$dataShow[$key][1]];
                                                      }else{
                                                        echo $rows[$dataShow[$key][1]];
                                                      } ?>
                                                    </td>
                                                  <?php break; ?>
                                                <?php } ?>
                                              <?php } ?>
                                            </tr>
                                      <?php } ?>
                                  <?php }else { echo $text; } ?>
                                </tbody>
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
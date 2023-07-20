<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    $text = "<font color='red'>No Product.Please add product first</font>";
    if(isset($product)){
        $resultData = $product;
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
    $num = -1;
    $num2 = 0;
    $check_product = "";
    $check_first = "";
    $primaryID = 'product_id';
    $dataShow = array(
        'add' => array('เพิ่ม', '', '5%', 'center', 'center'),
        'product_company_id' => array('รหัสสินค้า', 'product_company_id', '13%', 'center', 'center'),
        'product_name' => array('ชื่อสินค้า', 'product_name', '24%', '', ''),
        'product_price' => array('ราคา/ชิ้น', 'product_price', '10%', 'center', 'center'),
        'product_type' => array('ชนิดของสินค้า', 'product_type', '15%', 'center', 'center'),
        'have' => array('คงเหลือ', '', '10%', 'center', 'center'),
        'sold' => array('ขายไปแล้ว', '', '11%', 'center', 'center'),
        'option' => array('ตัวเลือก', '', '12%', 'center', 'center')
        );
    if(isset($resultData)){
        for($i=0; $i<$countData; $i++){
            if($check_first != $resultData[$i]['product_company_id']){
                $num++;
                $check_first = $resultData[$i]['product_company_id'];
                $have[$num] = 1;
                $sold[$num] = 0;
                if($resultData[$i]['status_name'] == "หมดสต็อก"){
                    $have[$num] = 0;
                    $sold[$num] = 1;
                }
            }else{
                if($resultData[$i]['status_name'] == "คงเหลือ"){
                    $have[$num]++;
                }else{
                    $sold[$num]++;
                }
            }
        }
    }

?>
            <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
                <div class="content">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <div style="font-size:1.4em;margin-top:6px;">
                                    <i class="fa fa-cubes"></i>&nbsp;สต๊อคสินค้า<span name="total">&nbsp;-&nbsp;<?php if(isset($num)){ echo $num+1; } ?>&nbsp;รายการ</span>
                                </div>
                            </div>
                            <div class="pull-right">
                                <!-- START CONTROL BUTTON -->
                                    <button name="add" type="button" class="btn btn-success" onclick="location.href='<?php echo base_url(); ?>product_stock/add_product';">
                                        <i class="glyphicon glyphicon-plus"></i>&nbsp;
                                        <span>เพิ่มรายการสินค้า</span>
                                    </button>
                                <!-- END CONTROL BUTTON -->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <form action="product" method="POST">
                                        <div style="margin-bottom:15px;">
                                            <div class="input-group">
                                                <input type="text" name="search_query" onkeydown="search_text(0,$(this).val(),event.keyCode);" placeholder="คำค้น..." class="form-control search-box">
                                                <div class="input-group-btn">
                                                    <button name="btn_search" class="btn btn-theme btn-seach">
                                                        คำค้น&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive col-md-12" style="margin-top:15px;">
                                        <table class="table table-striped table-bordered" id="main-table">
                                            <thead class="pon-thead">
                                                <tr>
                                                    <?php foreach($dataShow as $key => $value) { ?>
                                                        <th width="<?php echo $dataShow[$key][2]; ?>" style="text-align:<?php echo $dataShow[$key][3]; ?>">
                                                            <?php echo $value[0]; ?>
                                                        </th>
                                                    <?php } ?>
                                                </tr>
                                                
                                                  <!--<th width="40px" style="text-align:center;"></th>
                                                  <th width="15%" style="text-align:center;">รหัสสินค้า</th>
                                                  <th>ชื่อสินค้า</th>
                                                  <th width="20%" name="balance_adjust" style="text-align:center;">ปริมาณคงเหลือ</th>
                                                  <th width="20%" class="hidden-xs" style="text-align:center;">สถานะ
                                                  </th>
                                                  <th style="text-align:center;">ตัวเลือก</th>
                                                </tr>-->
                                            </thead>
                                            <tbody id="view_inventory">
                                                <?php if(isset($resultData)){ ?>
                                                    <?php foreach ($resultData as $rows) {
                                                        $rowID = $rows[$primaryID];
                                                        ?>
                                                        <?php if($check_product != $rows['product_company_id']){ ?>
                                                            <tr>
                                                                <?php foreach ($dataShow as $key => $value) { ?>
                                                                    <?php switch ($key) {
                                                                        case 'add': ?>
                                                                            <td style="text-align:<?php echo $dataShow[$key][4]; ?>;">
                                                                                <?php if($rows['product_type'] == "มีวันหมด"){ ?>
                                                                                    <a class="label label-success show0 lb-plus" href="<?php echo base_url(); ?>product_stock/product_count?p_id=<?php echo $rowID; ?>"><i class="fa fa-plus" style="color:#fff"></i></a>
                                                                                <?php }else{ ?>
                                                                                    <a class="label label-warning show0 lb-plus"><i class="glyphicon glyphicon-remove" style="color:#fff"></i></a>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <?php break;
                                                                        case 'option': ?>
                                                                            <td style="text-align:<?php echo $dataShow[$key][4]; ?>;">
                                                                                <button name="edit" class="btn btn-grey" onclick="location.href='<?php echo base_url(); ?>product_stock/add_product?p_id=<?php echo $rowID; ?>';"><i class="fa fa-edit"></i></button>
                                                                            </td>
                                                                            <?php break;
                                                                        case 'have' ?>
                                                                            <?php if($rows['product_type'] == "ไม่มีวันหมด"){ ?>
                                                                                <td style="text-align:<?php echo $dataShow[$key][4]; ?>;">∞</td>
                                                                            <?php }else{ ?>
                                                                                <td style="text-align:<?php echo $dataShow[$key][4]; ?>;"><?php echo $have[$num2]; ?></td>
                                                                            <?php } ?>
                                                                            <?php break;
                                                                        case 'sold' ?>
                                                                            <td style="text-align:<?php echo $dataShow[$key][4]; ?>;"><?php echo $sold[$num2]; ?></td>
                                                                            <?php break;
                                                                        default: ?>
                                                                            <td class="text2input" style="text-align:<?php echo $dataShow[$key][3]; ?>">
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
                                                        <?php $check_product = $rows['product_company_id']; $num2++; } ?>
                                                    <?php } ?>
                                                <?php }else { echo $text; } ?>
                                                    <!--<tr>
                                                        <td><a class="label label-success show0 lb-plus" href="javascript:;" onclick="showDetail(0,14015)"><i class="fa fa-plus" style="color:#fff"></i></a>
                                                            <a class="label label-danger hide0 lb-plus" href="javascript:;" onclick="hideDetail(0)" style="display:none;"><i class="fa fa-remove" style="color:#fff"></i></a>
                                                        </td>
                                                        <td class="text2input" name="product_id" style="text-align:center;">0001</td>
                                                        <td class="text2input" name="product_name">มิลล</td>
                                                        <td name="balance" style="text-align:center;">
                                                            <a href="https://www.trcloud.org/application/inventory/detail.php?id=14015">0.00</a>
                                                        </td>
                                                        <td style="text-align:center;" class="hidden-xs">
                                                            เน่าเสีย
                                                        </td>
                                                        <td style="width:100px;text-align:center;">
                                                            <button name="edit" class="btn btn-grey" onclick="click_edit(this);"><i class="fa fa-edit"></i></button><button name="edit" class="btn btn-pink" onclick="delete_confirm(this);" style="margin-left:5px;"><i class="fa fa-remove"></i></button><button name="save" class="btn btn-theme" onclick="click_save(this);" style="display:none;"><i class="fa fa-save"></i></button><button name="save" class="btn btn-grey" onclick="window.location=&quot;&quot;" ;="" style="margin-left:5px;display:none;"><i class="fa fa-refresh"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a class="label label-success show1 lb-plus" href="javascript:;" onclick="showDetail(1,14016)"><i class="fa fa-plus" style="color:#fff"></i></a>
                                                            <a class="label label-danger hide1 lb-plus" href="javascript:;" onclick="hideDetail(1)" style="display:none;"><i class="fa fa-remove" style="color:#fff"></i></a>
                                                        </td>
                                                        <td class="text2input" name="product_id" style="text-align:center;">0002</td>
                                                        <td class="text2input" name="product_name">มิลล</td>
                                                        <td name="balance" style="text-align:center;">
                                                            <a href="https://www.trcloud.org/application/inventory/detail.php?id=14016">6.00</a>
                                                        </td>
                                                        <td style="text-align:center;" class="hidden-xs"> ปกติ</td>
                                                        <td style="width:100px;text-align:center;">
                                                            <button name="edit" class="btn btn-grey" onclick="click_edit(this);"><i class="fa fa-edit"></i></button><button name="edit" class="btn btn-pink" onclick="delete_confirm(this);" style="margin-left:5px;"><i class="fa fa-remove"></i></button><button name="save" class="btn btn-theme" onclick="click_save(this);" style="display:none;"><i class="fa fa-save"></i></button><button name="save" class="btn btn-grey" onclick="window.location=&quot;&quot;" ;="" style="margin-left:5px;display:none;"><i class="fa fa-refresh"></i></button>
                                                        </td>
                                                    </tr>-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- class = row -->
                        </div>
                    </div>
                </div><!-- end content -->
            </div><!-- end col-xs-12 -->
        </div>
    </div>
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    </script>
</body>
</html>
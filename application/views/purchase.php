<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    $text = "<font color='red'>No purchase data, Please add purchase first.</font>";
    if(isset($purchase)) {
        $resultData = $purchase;
    }
    if(isset($search)){
        $resultData = $search;
        if($search == "Not found."){
            $search = null;
            $resultData = $search;
            $text = "<font color='red'>Not found. Please click search again for refresh page.</font>";
        }
    }
    $primaryID = 'purchase_paper';
    $dataShow = array(
        'date' => array('วันที่', 'purchase_date', '13%', 'center', 'center'),
        'PO#' => array('PO&nbsp;#', 'purchase_text', '10%', 'center', 'center'),
        'detail' => array('ชื่อผู้ขาย', 'customer_name', '32%', 'left', 'center'),
        'price' => array('มูลค่า', 'product_grand_total', '12%', 'center', 'center'),
        'status' => array('สถานะ', 'purchase_status', '15%', 'center', 'center'),
        'option' => array('ตัวเลือก', '', '18%', 'center', 'center')
        );
?>

            <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
                <div class="content">
                    <form action="purchase_display" method="POST">
                    	<div class="header-content">
                            <div class="font20"><i class="glyphicon glyphicon-bitcoin"></i>ใบสั่งซื้อ
                                <div class="btn-group" style="float: right;">
                                    <button type="button" class="btn btn-danger" onclick="location.href='<?php echo base_url(); ?>purchase/add_purchase';">
                                        <i class="fa fa-plus"></i>&nbsp;
                                        <span class="font12">สร้างใบสั่งซื้อ</span>
                                    </button>
                                </div>
                            </div>
                        </div><!-- end header-content --><br/>
                        <div class="row">
                            <div class="col-xs-8 col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control search-box" id="search_seller" name="search_seller" placeholder="ต้นหาชื่อลูกค้า">
                                    <div class="input-group-btn">
                                        <button id="btn_search" name="btn_search" class="btn btn-pink btn-seach">
                                            ค้นหา&nbsp;<i class="fa fa-arrow-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div><!-- end col-xs-8-->
                        </div><!-- end row -->
                    </form>
                        <div class="row row2">
                            <div class="col-xs-12">
                                <div id="table_show" class="table-responsive col-md-12">
                                <table class="table table-bordered table-buy" id="datatable_orders" width="100%">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <?php foreach($dataShow as $key => $value){ ?>
                                                <th style="width:<?php $dataShow[$key][2]; ?>">
                                                     <?php echo $dataShow[$key][0]; ?>
                                                 </th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody id="view_ledger_output">
                                        <?php if(isset($links)){ echo $links; } ?>
                                        <?php if(isset($resultData)){ ?>
                                            <?php foreach ($resultData as $rows){
                                                $rowID = $rows[$primaryID]; ?>
                                                <tr>
                                                    <?php foreach ($dataShow as $key => $value) { ?>
                                                        <?php switch($key){
                                                            case 'date': ?>
                                                                <td style="text-align:center;">
                                                                    <?php echo date("d/m/Y", strtotime($rows[$dataShow[$key][1]]));?>
                                                                </td>
                                                            <?php break;
                                                            case 'option': ?>
                                                                <td style="text-align:center;">
                                                                    <button name="edit" class="btn btn-grey btn-o" onclick="location.href='<?php echo base_url(); ?>purchase/add_purchase?p_id=<?php echo $rowID; ?>';" title="แก้ไขใบสั่งซื้อ"><i class="fa fa-edit "></i></button>
                                                                    <button name="detail" class="btn btn-grey btn-o" onclick="javascript:window.open('<?php echo base_url(); ?>generate_pdf/generate_purchase?purchase_paper=<?php echo $rows['purchase_paper']; ?>&type=purchase');" title="ดูใบสั่งซื้อ"><i class="fa fa-search-plus"></i></button>
                                                                    <button name="copy_detail" class="btn btn-grey btn-o" onclick="javascript:window.open('<?php echo base_url(); ?>generate_pdf/generate_purchase?purchase_paper=<?php echo $rows['purchase_paper']; ?>&type=purchase_copy');" title="ดูสำเนาใบสั่งซื้อ"><i class="fa fa-copy"></i></button>
                                                                    <button name="dele" class="btn btn-grey btn-o" onclick="location.href='<?php echo base_url(); ?>purchase/change_status?p_id=<?php echo $rowID; ?>';" title="ยกเลิก"><i class="fa fa-close"></i></button>
                                                                </td>
                                                                <?php break;
                                                            case 'status': ?>
                                                                <td style="text-align:center;">
                                                                    <?php if($rows[$dataShow[$key][1]] == "เสร็จสิ้น"){ ?>
                                                                        <label class="label label-sm label-success font14">เสร็จสิ้น</label>
                                                                    <?php }else if($rows[$dataShow[$key][1]] == "ยกเลิก"){ ?>
                                                                        <label class="label label-sm label-danger font14">ยกเลิก</label>
                                                                    <?php } ?>
                                                                </td>
                                                                <?php break;
                                                            case 'PO#' ?>
                                                                <td style="text-align:<?php echo $dataShow[$key][3]; ?>">
                                                                    <?php echo $rows[$dataShow[$key][1]].$rows['purchase_number']; ?>
                                                                </td>
                                                                <?php break;
                                                            default: ?>
                                                                <td style="text-align:<?php echo $dataShow[$key][3]; ?>">
                                                                    <?php $data_passing = $rows[$dataShow[$key][1]]; ?>
                                                                    <?php if(!isset($data_passing)){ ?>
                                                                        <?php $data_passing = " ";
                                                                        echo $data_passing; ?>
                                                                    <?php }else{ ?>
                                                                        <?php echo $rows[$dataShow[$key][1]]; ?>
                                                                    <?php } ?>
                                                                </td>
                                                                <?php break; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        <?php }else{ echo $text; } ?> 
                                    </tbody>
                                </table>
                                </div>
                                <br>
                                <center><div id="dyn_page" style="margin:-10px 0 10px 0;"><span></span></div></center>
                            </div>
                        </div>
                    
                </div><!-- end content -->
            </div><!-- end col-xs-12 -->
        </div>
    </div>
</body>
</html>
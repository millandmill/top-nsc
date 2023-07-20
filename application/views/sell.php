<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    $text = "<font color='red'>No Quotation data, Please add Quotation first.</font>";
    if(isset($quotation)){
        $resultData = $quotation;
    }
    if(isset($search)){
        $resultData = $search;
        if($search == "Not found."){
            $search = null;
            $resultData = $search;
            $text = "<font color='red'>Not found. Please click search again for refresh page.</font>";
        }
    }
    $primaryID = 'quotation_paper';
    $secondID = 'quotation_id';
    $dataShow = array(
        'date' => array('วันที่', 'quotation_date', '13%', 'center', 'center'),
        'PO#' => array('QO&nbsp;#', 'quotation_text', '10%', 'center', 'center'),
        'detail' => array('รายละเอียด', 'customer_name', '32%', 'left', 'center'),
        'price' => array('มูลค่า', 'product_grand_total', '12%', 'center', 'center'),
        'status' => array('สถานะ', 'quotation_status', '15%', 'center', 'center'),
        'option' => array('ตัวเลือก', '', '18%', 'center', 'center')
        );
    
?>

        <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
            <div class="content">
                <form action="quotation_display" method="POST">
                    <div class="header-content">
                        <div class="font24"><i class="glyphicon glyphicon-bitcoin"></i></i>ใบเสนอราคา
                            <div class="btn-group" style="float: right;">
                                <button type="button" class="btn btn-danger" onclick="location.href='<?php echo base_url(); ?>quotation/quotation_add';">
                                    <i class="fa fa-plus"></i>&nbsp;
                                    <span class="font12">สร้างใบเสนอราคา</span>
                                </button>
                            </div>
                        </div>
                    </div><!-- end header-content -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-3">
                            <select name="quotationOrder_status" class="form-control" onclick="search_text(13, 0, 0);" style="font-size: 14px;">
                                <option value="">สถานะ</option>
                                <option value="รอใบวางบิล">รอใบวางบิล</option>
                                <option value="ออกใบวางบิลแล้ว">ออกใบวางบิล</option>
                            </select>
                        </div><!-- end col-xs-4-->
                        <div class="col-xs-8 col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control search-box" name="search_query" onkeyup="search_text(event.keyCode, 0, 0);" placeholder="คำค้นหา...">
                                <div class="input-group-btn">
                                    <button class="btn btn-pink btn-seach" name="btn_search" onclick="search_text(13, 0, 0);">
                                        ค้นหา&nbsp;<i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                    
                                </div>
                            </div>

                        </div><!-- end col-xs-8-->
                    </div><!-- end row -->
                </form>
                    <div class="row row2">
                        <div class="col-xs-12">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered font10 table-buy" id="datatable_orders" width="100%">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <?php foreach($dataShow as $key => $value){ ?>
                                                <th style="width:<?php echo $dataShow[$key][2] ?>">
                                                     <?php echo $dataShow[$key][0]; ?>
                                                </th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody id="view_ledger_output">
                                        <?php if(isset($links)){ echo $links; } ?>
                                              <?php if(isset($resultData)){ ?>
                                                <?php foreach ($resultData as $rows){
                                                    $rowID = $rows[$primaryID];
                                                    $priID = $rows[$secondID]; ?>
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
                                                                        <button name="edit" class="btn btn-grey btn-o" onclick="location.href='<?php echo base_url(); ?>quotation/quotation_add?q_id=<?php echo $rowID; ?>';" title="แก้ไข"><i class="fa fa-edit "></i></button>
                                                                        <button name="detail" class="btn btn-grey btn-o" onclick="javascript:window.open('<?php echo base_url(); ?>generate_pdf/generate_quotation?quotation_paper=<?php echo $rows['quotation_paper']; ?>&type=quotation');" title="ดูใบเสนอราคา"><i class="fa fa-search-plus" ></i></button>
                                                                        <button name="copy_detail" class="btn btn-grey btn-o" onclick="javascript:window.open('<?php echo base_url(); ?>generate_pdf/generate_quotation?quotation_paper=<?php echo $rows['quotation_paper']; ?>&type=quotation_copy');" title="ดูสำเนาใบเสนอราคา"><i class="fa fa-copy" ></i></button>
                                                                        <!--<button name="dele" class="btn btn-grey btn-o" onclick="location.href='<?php echo base_url(); ?>quotation/change_status?q_id=<?php echo $rowID; ?>&quo_id=<?php echo $priID; ?>';" title="ยกเลิก"><i class="fa fa-close"></i></button>-->
                                                                        <?php if($rows[$dataShow['status'][1]] == "ออกใบวางบิลแล้ว"){ ?>
                                                                            <button name="next" class="btn btn-primary btn-o" onclick="location.href='<?php echo base_url(); ?>billingnote/billingnote_display?q_id=<?php echo $rowID; ?>';" title="ออกใบวางบิล"><i class="fa fa-sign-out"></i></button>
                                                                        <?php }else{ ?>
                                                                            <button name="next" class="btn btn-grey btn-o" onclick="location.href='<?php echo base_url(); ?>billingnote/billingnote_display?q_id=<?php echo $rowID; ?>';" title="ออกใบวางบิล"><i class="fa fa-sign-out"></i></button>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <?php break;
                                                                case 'status': ?>
                                                                    <?php if($rows[$dataShow[$key][1]] == "ออกใบวางบิลแล้ว"){ ?>
                                                                        <td style="text-align:center;"><label class="label label-sm label-primary font14">ออกใบวางบิลแล้ว</label></td>
                                                                    <?php }else if($rows[$dataShow[$key][1]] == "รอใบวางบิล"){ ?>
                                                                        <td style="text-align:center;"><label class="label label-sm label-info font14">รอใบวางบิล</label></td>
                                                                    <?php }else if($rows[$dataShow[$key][1]] == "เสร็จสิ้น"){ ?>
                                                                        <td style="text-align:center;"><label class="label label-sm label-success font14">เสร็จสิ้น</label></td>
                                                                    <?php }else if($rows[$dataShow[$key][1]] == "ยกเลิก"){ ?>
                                                                        <td style="text-align:center;"><label class="label label-sm label-danger font14">ยกเลิก</label></td>
                                                                    <?php } ?>
                                                                    <?php break;
                                                                case 'PO#' ?>
                                                                    <td style="text-align:<?php echo $dataShow[$key][3]; ?>">
                                                                        <?php echo $rows[$dataShow[$key][1]].$rows['quotation_number']; ?>
                                                                    </td>
                                                                    <?php break;
                                                                default: ?>
                                                                    <td style="text-align:<?php echo $dataShow[$key][3]; ?>" >
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
                                                            <!--<td style="display:none;">1311</td>
                                                            <td style="text-align:center;" class="hidden-xs">20/09/2015</td>
                                                            <td style="text-align:center;">PO1</td>
                                                            <td>ชัยกุล<br>เล็กๆ<br>22222<br><a href="create_invoice.php?qid=1311" style="margin-top:5px;" class="btn btn-xs btn-grey"><i class="fa fa-pencil"></i> บันทึกใบเสร็จซื้อ</a></td>
                                                            <td style="text-align:center;" class="hidden-xs">8,560,000.00</td>
                                                            <td style="text-align:center;"><label class="label label-sm label-info font14">รอการสั่งซื้อ</label></td>-->
                                                        <?php } ?>
                                                           <!-- <div class="dropdown">
                                                              <a class="dropdown-toggle btn btn-white a_invoice_left" data-toggle="dropdown" href="javascript:;" style="text-decoration:none;" aria-expanded="false">
                                                                ตัวเลือก <i class="fa fa-caret-down"></i>
                                                              </a>
                                                              <ul class="dropdown-menu invoice_left pull-right" role="menu">
                                                                
                                                                <li>
                                                                    <a href="view_purchaseOrder.php?qid=1311">
                                                                        <i class="fa fa-search-plus"></i>&nbsp;
                                                                        ดูรายละเอียด            </a>
                                                                </li>
                                                                
                                                                <li>
                                                                    <a href="javascript:;" onclick="change_status('1311','0','undefined');">
                                                                        <i class="fa fa-edit"></i>&nbsp;
                                                                        เปลี่ยนสถานะ            </a>
                                                                </li>
                                                                
                                                                <li>
                                                                    <a href="javascript:;" onclick="pdf_option(1311)">
                                                                        <i class="fa fa-print"></i>&nbsp;
                                                                        พิมพ์           </a>
                                                                </li>
                                                                
                                                                <li class="divider"></li>
                                                                
                                                                <li>
                                                                    <a href="javascript:;" onclick="window.status_option = 'cancel';change('1311','undefined');">
                                                                        <i class="fa fa-remove"></i>&nbsp;
                                                                        ยกเลิก          </a>
                                                                </li>
                                                              </ul>
                                                            </div> -->
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
<?php 
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
?>

    <script type="text/javascript">
        $(function () {
            $('#dpMonths').datepicker({
                    viewMode: 'years',
                    format: 'MM/YYYY'
            });
            $('#dpMonths')
                .datepicker()
                .on('changeDate', function (ev) {
                console.log(ev.date);
            });
        });
    </script>

        <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
            <div class="content">
                <div class="header-content">
                    <div class="font24"><i class="glyphicon glyphicon-open-file"></i></i>รายงานภาษีขาย</div>
                </div><!-- end header-content --><br/>
                <div class="row">
                    <div class="col-xs-4 col-sm-3">
                        <div class="container">
                            <div class="col-sm-6" style="height:130px;">
                                <div class="form-group">
                                  <div class="input-group date" id="dpMonths"  data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy">
                                    <input type="text" value="" readonly="">
                                    <span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-xs-4-->
                </div><!-- end row -->
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
                                                                    <button name="detail" class="btn btn-grey btn-o" onclick="click_detail(this);" title="พิมพ์"><i class="fa fa-print"></i></button>
                                                                    <button name="print" class="btn btn-grey btn-o" onclick="javascript:window.open('<?php echo base_url(); ?>generate_pdf/generate_quotation?q_id=<?php echo $rowID; ?>&quotation_paper=<?php echo $rows['quotation_paper']; ?>&type=quotation');" title="ดูใบเสนอราคา"><i class="fa fa-search-plus" ></i></button>
                                                                    <button name="copy_print" class="btn btn-grey btn-o" onclick="click_print(this);" title="ดูสำเนาใบเสนอราคา"><i class="fa fa-copy" ></i></button>
                                                                    <button name="dele" class="btn btn-grey btn-o" onclick="location.href='<?php echo base_url(); ?>quotation/change_status?q_id=<?php echo $rowID; ?>&quo_id=<?php echo $priID; ?>';" title="ยกเลิก"><i class="fa fa-close"></i></button>
                                                                    <button name="next" class="btn btn-grey btn-o" onclick="location.href='<?php echo base_url(); ?>billingnote/billingnote_display?q_id=<?php echo $rowID; ?>';" title="ออกใบวางบิล"><i class="fa fa-sign-out"></i></button>
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
                                        <?php }else{ echo "<font color='red'>No Quotation data, Please add Quotation first.</font>"; } ?>
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
<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    $address = "";
    $chkLoop = 1;
    $head = '';
    if(isset($paper)){
        $purchase_paper = $paper+1;
    }
    if(isset($company)){
        $head = "เพิ่ม";
        $resultData = $company;
        $arr_com = array('company_address', 'company_district', 'company_road', 'company_county', 'company_building', 'company_floor', 'company_province', 'company_zip');
        $count_com = count($arr_com);
        $run = 0;
        for($i=0; $i<$count_com; $i++){
            if(isset($resultData[0][$arr_com[$i]])){
                $part_address[$run] = $resultData[0][$arr_com[$i]];
                $run++;
            }
        }
        $count_address = count($part_address);
        for($i=0; $i<$count_address; $i++){
            $address = $address." ".$part_address[$i];
        }
    }else if(isset($edtPurchase)){
        $head = "แก้ไข";
        $resultData = $edtPurchase;
        $chkLoop = count($resultData);
        $address = $resultData[0]['company_address_all'];
        $purchase_paper = $resultData[0]['purchase_paper'];
        if(isset($resultData[0]['purchase_text'])){
            $randomString = $resultData[0]['purchase_text'];
        }
        if(isset($resultData[0]['purchase_number'])){
            $randomNumber = $resultData[0]['purchase_number'];
        }
    }
?>
    <script>
        $(function() {
            $(".datepicker").datepicker({ 
                dateFormat: "dd/mm/yyyy"
            });
        });
    </script>
        <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
            <div class="content">
                <div class="header-content">
                    <div class="font24"><i class="fa fa-cubes"></i><?php echo $head; ?>ใบสั่งซื้อ
                        </div>
                    </div>
                </div><!-- end header-content -->
            	<div class="col-xs-12">
                    <content>
                        <form action="add_purchase" method="POST" class="grid-form grid-form-special form-addbuy" style="border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;background:#f5f5f5;">
                            <fieldset>
                                <div data-row-span="12">
                                    <div data-field-span="9" style="height: 70px;">
                                        <input type="hidden" name="purchase_id" value="<?php if(isset($resultData[0]['purchase_id'])){ echo $resultData[0]['purchase_id']; } ?>">
                                        <input type="hidden" name="purchase_paper" value="<?php if(isset($purchase_paper)){ echo $purchase_paper; } ?>">
                                        <input type="hidden" name="purchase_status" value="<?php if(isset($resultData[0]['purchase_status'])){ echo $resultData[0]['purchase_status']; } ?>">
                                        <label>ข้อมูลคู่ค้า&nbsp;<font color="red"><sup>*จำเป็น</sup></font></label>
                                        <select name="customer_option" style="width:100%; height:25px; color:#000;">
                                            <option value="0">==โปรดเลือกคู่ค้า==</option>
                                            <?php if(isset($customer)){ ?>
                                                <?php for($i=1; $i<=count($customer); $i++) { ?>
                                                    <option value="<?php echo $customer[$i-1]['customer_id']; ?>" <?php if(isset($resultData[0]['customer_id'])){ if($resultData[0]['customer_id'] == $customer[$i-1]['customer_id']){ echo "selected"; }} ?>>
                                                        <?php echo $i.". ".$customer[$i-1]['customer_name']." จาก ".$customer[$i-1]['customer_address']; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div data-field-span="3" style="height: 70px;">
                                        <label>เลขที่เอกสารภายใน</label>
                                        <div class="col-xs-3" style="padding:0px!important;">
                                            <input type="text" class="form-control" name="company_format" placeholder=" " style="text-align:center;" value="<?php if(isset($resultData[0]['purchase_text'])){ echo $resultData[0]['purchase_text']; }else{ echo "PO"; } ?>" readonly="readonly">
                                        </div>
                                        <div class="col-xs-9" style="padding:0px!important;">
                                            <input type="number" pattern="[0-9]" min="0" class="form-control" name="invoice_no" placeholder="AUTO" value="<?php if(isset($resultData[0]['purchase_number'])){ echo $resultData[0]['purchase_number']; }else{ echo $purchase_paper; } ?>" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div data-row-span="10">
                                    <div data-field-span="5" style="height: 70px;">
                                        <label>องค์กร</label>
                                        <input type="text" name="organization" value="<?php if(isset($resultData[0]['company_name'])){ echo $resultData[0]['company_name']; } ?>">
                                    </div>
                                    <div data-field-span="3" style="height: 70px;">
                                        <label>เงื่อนไขชำระเงิน&nbsp;<font color="red"><sup>*จำเป็น</sup></font></label>
                                        <select name="condition_pay" style="width:30%;color:#000;">
                                            <option value="0">=เลือกเงื่อนไข=</option>
                                            <option value="เงินสด" <?php if(isset($resultData[0]['condition_pay'])){ if($resultData[0]['condition_pay'] == "เงินสด"){ echo "selected"; }} ?>>เงินสด</option>
                                            <option value="เช็ค" <?php if(isset($resultData[0]['condition_pay'])){ if($resultData[0]['condition_pay'] == "เช็ค"){ echo "selected"; }} ?>>เช็ค</option>
                                            <option value="ผ่อน" <?php if(isset($resultData[0]['condition_pay'])){ if($resultData[0]['condition_pay'] == "ผ่อน"){ echo "selected"; }} ?>>ผ่อน</option>
                                        </select>
                                        &nbsp;จำนวน : &nbsp;<input type="text" name="pay_day" style="width:20%;" value="<?php if(isset($resultData[0]['pay_day'])){ echo $resultData[0]['pay_day']; } ?>">&nbsp;&nbsp;วัน
                                    </div>
                                    <div data-field-span="2" style="height: 70px;">
                                        <label>วันที่เอกสาร&nbsp;<font color="red"><sup>*จำเป็น</sup></font><i class="fa fa-calendar"></i></label>
                                        <input type="date" name="due_date" value="<?php if(isset($resultData[0]['purchase_date'])){ echo $resultData[0]['purchase_date']; } else { echo date('Y-m-d'); } ?>" onchange="calculateDate()">
                                    </div>
                                </div>

                                <div data-row-span="1">
                                    <div data-field-span="1" style="height: 70px;">
                                        <label>ที่อยู่</label>
                                        <input type="text" name="address" value="<?php if(isset($address)){ echo $address; } ?>" >
                                    </div>
                                </div>
                                <div data-row-span="8">
                                    <div data-field-span="2" style="height: 70px;">
                                        <label>อีเมล์</label>
                                        <input type="text" name="email" value="<?php if(isset($resultData[0]['company_email'])){ echo $resultData[0]['company_email']; } ?>">
                                    </div>
                                    <div data-field-span="2" style="height: 70px;">
                                        <label>โทรศัพท์</label>
                                        <input type="text" name="telephone" value="<?php if(isset($resultData[0]['company_tel'])){ echo $resultData[0]['company_tel']; } ?>" maxlength="16">
                                    </div>
                                    <div data-field-span="2" style="height: 70px;">
                                        <label>เลขประจำตัวผู้เสียภาษี</label>
                                        <input type="text" name="tax_id" value="<?php if(isset($resultData[0]['company_tax_code'])){ echo $resultData[0]['company_tax_code']; } ?>" maxlength="13">
                                    </div>
                                    <div data-field-span="2" style="height: 70px;">
                                        <label>เลขที่ใบเสนอราคา</label>
                                        <input type="text" name="reference" value="<?php if(isset($resultData[0]['quotation_number'])){ echo $resultData[0]['quotation_number']; } ?>" maxlength="13">
                                    </div>
                                </div>
                            </fieldset>
                            <!-- here -->
                        <div class="row row-0">
                          <div class="table-responsive col-md-12" style="margin-top:15px;">
                            <table class="table table-bordered table-pink" style="background:#f5f5f5;" id="myTable">
                              <thead class="invoice">
                                <tr>
                                  <th style="width:11%">รหัส</th>
                                  <th>สินค้า&nbsp;<font color="red"><sup>*จำเป็น</sup></font></th>
                                  <th style="width:12%">ราคา&nbsp;<font color="red"><sup>*จำเป็น</sup></font></th>
                                  <th style="width:8%">จำนวน&nbsp;<font color="red"><sup>*จำเป็น</sup></font></th>
                                  <th style="width:12%">ส่วนลด</th>
                                  <th style="width:16%">
                                    <select id="price_option" name="price_option" style="width:100%;color:#000;" onchange="autoCalculate();">
                                        <option value="ex" <?php if(isset($resultData[0]['product_option'])){ if($resultData[0]['product_option'] == "ex"){ echo "selected"; }} ?>>คิดภาษี</option>
                                        <option value="in" <?php if(isset($resultData[0]['product_option'])){ if($resultData[0]['product_option'] == "in"){ echo "selected"; }} ?>>ไม่คิดภาษี</option>
                                    </select>
                                  </th>
                                  <th style="width:25px;"></th>
                                </tr>
                              </thead>
                              <tbody class="grid-form" id="content">
                                <?php for($i=0; $i<$chkLoop; $i++){ ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="id[]" onkeyup="auto_product($(this));return false;" value="<?php if(isset($resultData[$i]['product_company_id'])){ echo $resultData[$i]['product_company_id']; } ?>">
                                        </td>
                                        <td>
                                            <input type="text" name="product[]" onkeyup="auto_product($(this));return false;" value="<?php if(isset($resultData[$i]['product_name'])){ echo $resultData[$i]['product_name']; } ?>">
                                        </td>
                                        <td>
                                            <input type="number" pattern="[0-9]" name="price[]" onchange="autoCalculate()" value="<?php if(isset($resultData[$i]['product_price'])){ echo $resultData[$i]['product_price']; } ?>">
                                        </td>
                                        <td>
                                            <input type="number" pattern="[0-9]" name="quantity[]" onchange="autoCalculate()" value="<?php if(isset($resultData[$i]['product_amount'])){ echo $resultData[$i]['product_amount']; } ?>">
                                        </td>
                                        <td>
                                            <input type="text" name="discount[]" onkeyup="autoCalculate()" value="<?php if(isset($resultData[$i]['product_discount'])){ echo $resultData[$i]['product_discount']; } ?>">
                                        </td>
                                        <td>
                                            <input type="text" name="amount[]" class="amount" onkeydown="last_line(event,$(this));" style="text-align:right;" value="<?php if(isset($resultData[$i]['product_total'])){ echo $resultData[$i]['product_total']; } ?>">
                                        </td>
                                        <td style="text-align:center;vertical-align:middle;">
                                            <?php if(isset($statusOfInvoice) || isset($statusOfReceipt)){ ?>
                                            <?php }else{ ?>
                                                <button class="btn btn-grey" onclick="delete_this_line($(this));" tabindex="-1">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                              </tbody>
                              <tfoot class="grid-form">
                                <tr>
                                    <td colspan="5">
                                        <a href="#" onclick="add_new_line();">
                                            <i class="fa fa-plus" style="color:green;"></i>เพิ่มรายการ</a>
                                    </td>
                                    <td><input type="text" style="text-align:right;" name="sum_amount" value="<?php if(isset($resultData[0]['product_total_real'])){ echo $resultData[0]['product_total_real']; }else{ echo "0.00"; }?>" onkeyup="calculate_grand_total();return false;"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><input type="text" name="invoice_note" value="<?php if(isset($resultData[0]['purchase_note'])){ echo $resultData[0]['purchase_note']; } ?>" placeholder="หมายเหตุ..."></td>
                                    <td style="font-weight:bold;text-align:right;">
                                        ภาษี:
                                    </td>
                                    <td><input id="sum_tax" type="text" style="text-align:right;" name="sum_tax" value="<?php if(isset($resultData[0]['product_vat'])){ echo $resultData[0]['product_vat']; }else{ echo "7%"; } ?>" onkeyup="autoCalculate();"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><input type="text" name="write_text" placeholder="จำนวนเงินเป็นตัวหนังสือ (จำเป็น)" value="<?php if(isset($resultData[0]['write_text'])){ echo $resultData[0]['write_text']; } ?>"></td>
                                    <td style="font-weight:bold;text-align:right;">
                                        ยอดเงินสุทธิ:
                                    </td>
                                    <td><input type="text" style="text-align:right;" name="grand_total" value="<?php if(isset($resultData[0]['product_grand_total'])){ echo $resultData[0]['product_grand_total']; }else{ echo "0.00"; }?>" ></td>
                                    <td></td>
                                </tr>
                                <?php if(validation_errors() != ''){ ?>
                                    <tr>
                                        <td colspan="7" style="text-align:center;">
                                            <div class="alert alert-danger">
                                                <span class="font12"><?php echo validation_errors(); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                <td colspan="7" style="text-align:center;">
                                    <button class="btn btn-success" name="btn_submit" value="submit">
                                        <i class="fa fa-save"></i>
                                        บันทึก
                                    </button>
                                    &nbsp;&nbsp;
                                    <button class="btn btn-grey" name="btn_back">
                                        <i class="fa fa-refresh"></i>
                                        ยกเลิก
                                    </button>
                                </td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                      </div>
                        <!-- end here -->
                        </form>
                        <br><br><br><br><br>
                     </content>
                </div>
            </div><!-- end content -->
        </div><!-- end col-xs-12 -->
        <table style="display:none;">
            <tbody id="content_to_be_added">
                <tr>
                    <td>
                        <input type="text" name="id[]" onkeyup="auto_product($(this));return false;">
                    </td>
                    <td>
                        <input type="text" name="product[]" onkeyup="auto_product($(this));return false;">
                    </td>
                    <td>
                        <input type="number" name="price[]" onkeyup="autoCalculate()">
                    </td>
                    <td>
                        <input type="text" name="quantity[]" onkeyup="autoCalculate()">
                    </td>
                    <td>
                        <input type="text" name="discount[]" onkeyup="autoCalculate()">
                    </td>
                    <td>
                        <input type="text" name="amount[]" class="amount" onkeydown="last_line(event,$(this));" style="text-align:right;">
                    </td>
                    <td style="text-align:center;vertical-align:middle;">
                        <button class="btn btn-grey" onclick="delete_this_line($(this));" tabindex="-1">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><!-- end row -->
	</div><!-- end container-fluid -->
<script>
    function autoCalculate(){
        var allamount = 0;
        var amount;
        var value;
        var valueTotal;
        var grand_total;
        var sum_amount = 0;
        var price_quan;
        var vat_cal;
        var dis = 0;
        var vat = document.getElementsByName("sum_tax");
        var discount = document.getElementsByName("discount[]");
        var quantity = document.getElementsByName("quantity[]");
        var price = document.getElementsByName("price[]");
        var amountShow = document.getElementsByName("amount[]");
        for(var i=0; i<price.length-1; i++){
            price_quan = price[i].value*quantity[i].value;
            amountShow[i].value = price_quan;
            /*if(vat.value == ""){
                vat_cal = 0+vat.value;
                vat.value = 0;
            }*/
            if(discount[i].value.substr(discount[i].value.length-1) == "%"){
                dis = discount[i].value.substr(0, discount[i].value.length-1);
                dis = price_quan*dis/100;
            }else{
                dis = discount[i].value;
            }
            amount = price_quan-dis;
            amountShow[i].value = amount.toFixed(2);
            allamount = allamount+amount;
            if(vat[0].value.substr(vat[0].value.length-1) == "%"){
                vat_cal = vat[0].value.substr(0, vat[0].value.length-1);
                valueTotal = allamount*vat_cal/100;
                //var rec = 100+parseInt(vat_cal);
                //vat_cal = allamount*vat_cal/100;
                //valueTotal = allamount*100/rec;
            }else{
                valueTotal = vat[0].value;
            }
            if(document.getElementById("price_option").value == "ex"){
                document.getElementById("sum_tax").disabled = false;
                sum_amount = allamount;
                grand_total = allamount+parseInt(valueTotal);
            }else{
                vat[0].value = 0;
                sum_amount = allamount;
                grand_total = allamount;
                document.getElementById("sum_tax").disabled = true;
            }
            document.getElementsByName("grand_total")[0].value = grand_total.toFixed(2);
            document.getElementsByName("sum_amount")[0].value = sum_amount.toFixed(2);
        }
    }

    function add_new_line()
    {
        var add = $("#content_to_be_added").html();
        if( $("#content").children().length < 9 )
        {
            $("#content").append(add);
        }
        else
        {
            alert("ไม่สามารถเพิ่มได้อีก");
        }
    }
    
    function delete_this_line(ele)
    {
        ele.parents("tr").remove();
        autoCalculate();     
    }
</script>
</body>

</html>
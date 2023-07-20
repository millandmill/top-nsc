<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    $address = "";
    $chkScript = 0;
    $chkLoop = 1;
    $id_product = "";
    $name_product = "";
    $price_product = "";
    $type_product = "";
    $check_product = "";
    $count_product = "";
    $count_normal = 0;
    $count_quantity = 0;
    $head = "";
    if(isset($product)){
        $resultProduct = $product;
        $countProduct = count($resultProduct);
    }
    if(isset($invoice_all)){
        $invoice_paper = $invoice_all[0]['receipt_paper'];
        $invoice_number = $invoice_all[0]['receipt_number'];
        $invoice_text = $invoice_all[0]['receipt_text'];
        $invoice_date = $invoice_all[0]['receipt_date'];
        $billingnoteText = $invoice_all[0]['billingnote_text'];
        $billingnoteNumber = $invoice_all[0]['billingnote_number'];
    }
    if(isset($paper)){
        $quotation_paper = $paper+1;
    }
    if(isset($company)){
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
    }else if(isset($edtQuotation)){
        $head = "แก้ไข";
        $resultData = $edtQuotation;
        $chkLoop = count($resultData);
        $address = $resultData[0]['company_address_all'];
        $quotation_paper = $resultData[0]['quotation_paper'];
        if(isset($resultData[0]['quotation_text'])){
            $randomString = $resultData[0]['quotation_text'];
        }
        if(isset($resultData[0]['quotation_number'])){
            $randomNumber = $resultData[0]['quotation_number'];
        }
    }
?>

        <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
            <div class="content">
                <div class="header-content">
                    <div class="font24"><i class="fa fa-cubes"></i><?php echo $head; ?>ใบเสร็จรับเงิน
                        </div>
                    </div>
                </div><!-- end header-content -->
                <div class="col-xs-12">
                    <content>
                        <form action="receipt_add" method="POST" class="grid-form grid-form-special form-addbuy" style="border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;background:#f5f5f5;">
                            <fieldset>
                                <div data-row-span="12">
                                    <div data-field-span="9" style="height: 65px;">
                                        <input type="hidden" name="quotation_id" value="<?php if(isset($resultData[0]['quotation_id'])){ echo $resultData[0]['quotation_id']; } ?>">
                                        <input type="hidden" name="quotation_paper" value="<?php if(isset($quotation_paper)){ echo $quotation_paper; } ?>">
                                        <input type="hidden" name="quotation_status" value="<?php if(isset($resultData[0]['quotation_status'])){ echo $resultData[0]['quotation_status']; } ?>">
                                        <input type="hidden" name="qText" value="<?php if(isset($billingnoteText)){ echo $billingnoteText; } ?>">
                                        <input type="hidden" name="qNumber" value="<?php if(isset($billingnoteNumber)){ echo $billingnoteNumber; } ?>">
                                        <input type="hidden" name="quotation_date" value="<?php if(isset($resultData[0]['quotation_date'])){ echo $resultData[0]['quotation_date']; } ?>">
                                        <input type="hidden" name="is_date" value="<?php if(isset($resultData[0]['issue_date'])){ echo $resultData[0]['issue_date']; } ?>">
                                        <input type="hidden" name="payment_date" value="<?php if(isset($resultData[0]['payment_date'])){ echo $resultData[0]['payment_date']; } ?>">
                                        <input type="hidden" name="con_pay" value="<?php if(isset($resultData[0]['condition_pay'])){ echo $resultData[0]['condition_pay']; } ?>">
                                        <input type="hidden" name="pay_day" value="<?php if(isset($resultData[0]['pay_day'])){ echo $resultData[0]['pay_day']; } ?>">
                                        <input type="hidden" name="con_date" value="<?php if(isset($resultData[0]['condition_date'])){ echo $resultData[0]['condition_date']; } ?>">
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
                                    <div data-field-span="3" style="height: 65px;">
                                        <label>เลขที่เอกสารภายใน</label>
                                        <div class="col-xs-3" style="padding:0px!important;">
                                            <input type="text" class="form-control" name="company_format" placeholder=" " style="text-align:center;" value="<?php if(isset($invoice_text)){ echo $invoice_text; }else{ echo "IN"; } ?>" readonly="readonly">
                                        </div>
                                        <div class="col-xs-9" style="padding:0px!important;">
                                            <input type="number" class="form-control" pattern="[0-9]" min="0" name="invoice_no" placeholder="   AUTO" value="<?php if(isset($invoice_number)){ echo $invoice_number; } ?>" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div data-row-span="4">
                                    <div data-field-span="3" style="height: 65px;">
                                        <label>องค์กร</label>
                                        <input type="text" name="organization" value="<?php if(isset($resultData[0]['company_name'])){ echo $resultData[0]['company_name']; } ?>">
                                    </div>
                                    <!--<div data-field-span="1" style="height: 65px;">
                                        <label>เงื่อนไขชำระเงิน&nbsp;</label>
                                        <select name="condition_pay" style="width:30%;color:#000;">
                                            <option value="0">=เลือกเงื่อนไข=</option>
                                            <option value="เงินสด" <?php if(isset($resultData[0]['condition_pay'])){ if($resultData[0]['condition_pay'] == "เงินสด"){ echo "selected"; }} ?>>เงินสด</option>
                                            <option value="เช็ค" <?php if(isset($resultData[0]['condition_pay'])){ if($resultData[0]['condition_pay'] == "เช็ค"){ echo "selected"; }} ?>>เช็ค</option>
                                            <option value="ผ่อน" <?php if(isset($resultData[0]['condition_pay'])){ if($resultData[0]['condition_pay'] == "ผ่อน"){ echo "selected"; }} ?>>ผ่อน</option>
                                        </select>
                                        &nbsp;จำนวน : &nbsp;<input type="text" name="pay_day" style="width:20%;" value="<?php if(isset($resultData[0]['pay_day'])){ echo $resultData[0]['pay_day']; } ?>" onkeyup="calculateDate()">&nbsp;&nbsp;วัน
                                    </div>-->
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>วันที่เอกสาร&nbsp;<font color="red"><sup>*จำเป็น</sup></font><i class="fa fa-calendar"></i></label>
                                        <input type="date" name="due_date" value="<?php if(isset($invoice_date)){ echo $invoice_date; } else { echo date('Y-m-d'); } ?>" onchange="calculateDate()">
                                    </div>
                                </div>
                                <div data-row-span="4">
                                    <div data-field-span="4" style="height: 65px;">
                                        <label>ที่อยู่</label>
                                        <input type="text" name="address" value="<?php if(isset($address)){ echo $address; } ?>" >
                                    </div>
                                    <!--<div data-field-span="1" style="height: 65px;">
                                        <label>วันกำหนดส่ง&nbsp;<i class="fa fa-calendar"></i></label>
                                        <input type="date" id="con_date" name="con_date" value="<?php if(isset($resultData[0]['condition_date'])){ echo $resultData[0]['condition_date']; } else { echo date('Y-m-d'); } ?>">
                                    </div>-->
                                </div>
                                <div data-row-span="4">
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>อีเมล์</label>
                                        <input type="text" name="email" value="<?php if(isset($resultData[0]['company_email'])){ echo $resultData[0]['company_email']; } ?>">
                                    </div>
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>โทรศัพท์</label>
                                        <input type="text" name="telephone" value="<?php if(isset($resultData[0]['company_tel'])){ echo $resultData[0]['company_tel']; } ?>" maxlength="16">
                                    </div>
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>เลขประจำตัวผู้เสียภาษี</label>
                                        <input type="text" name="tax_id" value="<?php if(isset($resultData[0]['company_tax_code'])){ echo $resultData[0]['company_tax_code']; } ?>" maxlength="13">
                                    </div>
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>เลขที่ใบวางบิล</label>
                                        <input type="text" name="reference" value="<?php if(isset($billingnoteText)){ echo $billingnoteText.$billingnoteNumber; } ?>" disabled>
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
                                        <?php if(isset($statusOfInvoice) || isset($statusOfReceipt)){ ?>
                                            <td>
                                                <input type="text" name="id[]" onkeyup="auto_product($(this));return false;" value="<?php if(isset($resultData[$i]['product_company_id'])){ echo $resultData[$i]['product_company_id']; } ?>" readonly="readonly">
                                            </td>
                                            <td>
                                                <input type="text" name="product[]" onkeyup="auto_product($(this));return false;" value="<?php if(isset($resultData[$i]['product_name'])){ echo $resultData[$i]['product_name']; } ?>" readonly="readonly">
                                            </td>
                                            <td>
                                                <input type="number" pattern="[0-9]" name="price[]" min="0" onchange="autoCalculate()" value="<?php if(isset($resultData[$i]['product_price'])){ echo $resultData[$i]['product_price']; } ?>">
                                            </td>
                                            <td>
                                                <input type="number" pattern="[0-9]" name="quantity[]" min="1" onchange="autoCalculate()" value="<?php if(isset($resultData[$i]['product_amount'])){ echo $resultData[$i]['product_amount']; } ?>" readonly="readonly">
                                            </td>
                                        <?php }else{ ?>
                                            <td>
                                                <input type="text" name="id[]" onkeyup="auto_product($(this));return false;" value="<?php if(isset($resultData[$i]['product_company_id'])){ echo $resultData[$i]['product_company_id']; } ?>" readonly="readonly">
                                            </td>
                                            <td>
                                                <select name="product[]" onchange="getDataProduct()">
                                                    <option value="">==เลือกสินค้า==</option>
                                                    <?php if(isset($resultProduct)){ ?>
                                                        <?php for($j=0; $j<$countProduct; $j++){ ?>
                                                            <?php if($check_product != $resultProduct[$j]['product_name']){ ?>
                                                                <?php 
                                                                    $id_product[$count_normal] = $resultProduct[$j]['product_company_id'];
                                                                    $name_product[$count_normal] = $resultProduct[$j]['product_name'];
                                                                    $price_product[$count_normal] = $resultProduct[$j]['product_price'];
                                                                    $type_product[$count_normal] = $resultProduct[$j]['product_type'];
                                                                    $count_normal++;
                                                                    $count_quantity = 0;
                                                                 ?>
                                                                <option value="<?php echo $resultProduct[$j]['product_name']; ?>" <?php if(isset($resultData[$i]['product_company_id'])){ if($resultData[$i]['product_company_id'] == $resultProduct[$j]['product_company_id']){ echo "selected"; } } ?>>
                                                                    <?php echo $resultProduct[$j]['product_name']; ?>
                                                                </option>
                                                            <?php 
                                                                }$check_product = $resultProduct[$j]['product_name'];
                                                                $count_product[$count_normal-1] = $count_quantity+1;
                                                                $count_quantity++;
                                                            ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <!--<input type="text" name="product[]" onkeyup="auto_product($(this));return false;" value="<?php if(isset($resultData[$i]['product_name'])){ echo $resultData[$i]['product_name']; } ?>">-->
                                            </td>
                                            <td>
                                                <input type="number" pattern="[0-9]" name="price[]" min="0" onchange="autoCalculate()" value="<?php if(isset($resultData[$i]['product_price'])){ echo $resultData[$i]['product_price']; } ?>">
                                            </td>
                                            <td>
                                                <input type="number" pattern="[0-9]" name="quantity[]" min="1" onchange="autoCalculate()" value="<?php if(isset($resultData[$i]['product_amount'])){ echo $resultData[$i]['product_amount']; } ?>">
                                            </td>
                                        <?php } ?>
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
                                    <?php if(isset($statusOfInvoice) || isset($statusOfReceipt)){ ?>
                                        <td colspan="6">
                                        </td>
                                    <?php }else{ ?>
                                        <td colspan="6">
                                            <a href="#" onclick="add_new_line();">
                                                <i class="fa fa-plus" style="color:green;"></i>เพิ่มรายการ</a>
                                        </td>
                                    <?php } ?>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><input type="text" name="write_text2" placeholder="จำนวนเงินต้นเป็นตัวหนังสือ (จำเป็น)" value="<?php if(isset($resultData[0]['write_text_principle'])){ echo $resultData[0]['write_text_principle']; } ?>"></td>
                                    <td style="font-weight:bold;text-align:right;">
                                        รวมเงิน : 
                                    </td>
                                    <td><input type="text" style="text-align:right;" name="sum_amount" value="<?php if(isset($resultData[0]['product_total_real'])){ echo $resultData[0]['product_total_real']; }else{ echo "0.00"; }?>" onkeyup="calculate_grand_total();return false;"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td style="font-weight:bold;text-align:right;">
                                        ภาษี :
                                    </td>
                                    <td><input id="sum_tax" type="text" style="text-align:right;" name="sum_tax" value="<?php if(isset($resultData[0]['product_vat'])){ echo $resultData[0]['product_vat']; }else{ echo "7%"; } ?>" onkeyup="autoCalculate();"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><input type="text" name="write_text" placeholder="จำนวนเงินรวมภาษีเป็นตัวหนังสือ (จำเป็น)" value="<?php if(isset($resultData[0]['write_text'])){ echo $resultData[0]['write_text']; } ?>"></td>
                                    <td style="font-weight:bold;text-align:right;">
                                        ยอดเงินสุทธิ :
                                    </td>
                                    <td><input type="text" style="text-align:right;" name="grand_total" value="<?php if(isset($resultData[0]['product_grand_total'])){ echo $resultData[0]['product_grand_total']; }else{ echo "0.00"; }?>" ></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><input type="text" name="invoice_note" value="<?php if(isset($resultData[0]['quotation_note'])){ echo $resultData[0]['quotation_note']; } ?>" placeholder="หมายเหตุ..."></td>
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
                                    </button>&nbsp;&nbsp;
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
                        <?php $count_normal = 0; $check_product=""; ?>
                        <select name="product[]" onchange="getDataProduct()">
                            <option value="">==เลือกสินค้า==</option>
                            <?php if(isset($resultProduct)){ ?>
                                <?php for($j=0; $j<$countProduct; $j++){ ?>
                                    <?php if($check_product != $resultProduct[$j]['product_name']){ ?>
                                        <?php 
                                            $id_product[$count_normal] = $resultProduct[$j]['product_company_id'];
                                            $name_product[$count_normal] = $resultProduct[$j]['product_name'];
                                            $price_product[$count_normal] = $resultProduct[$j]['product_price'];
                                            $type_product[$count_normal] = $resultProduct[$j]['product_type'];
                                            $count_normal++;
                                            $count_quantity = 0;
                                         ?>
                                        <option value="<?php echo $resultProduct[$j]['product_name']; ?>"><?php echo $resultProduct[$j]['product_name']; ?></option>
                                    <?php 
                                        }$check_product = $resultProduct[$j]['product_name'];
                                        $count_product[$count_normal-1] = $count_quantity+1;
                                        $count_quantity++;
                                    ?>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" pattern="[0-9]" min="0" name="price[]" onkeyup="autoCalculate()">
                    </td>
                    <td>
                        <input type="number" pattern="[0-9]" min="1" name="quantity[]" onchange="autoCalculate()">
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
    function getDataProduct(){
        var input_id = document.getElementsByName('id[]');
        var input_name = document.getElementsByName('product[]');
        var input_price = document.getElementsByName('price[]');
        var input_quantity = document.getElementsByName('quantity[]');
        var product_id = "";
        var product_name = "";
        var product_price = "";
        var product_type = "";
        var product_qualtity = "";
        var check_point = new Array();
        for(var i=0; i<input_id.length-1; i++){
            <?php foreach ($name_product as $key => $value) { ?>
                product_name = "<?php echo $name_product[$key] ?>";
                if(input_name[i].value == product_name){
                    product_id = "<?php echo $id_product[$key] ?>";
                    product_name = "<?php echo $name_product[$key] ?>";
                    product_price = "<?php echo $price_product[$key] ?>";
                    product_qualtity = "<?php echo $count_product[$key] ?>";
                    product_type = "<?php echo $type_product[$key] ?>";
                    input_id[i].value = product_id;
                    input_price[i].value = product_price;
                    if(product_type == "มีวันหมด"){
                        input_quantity[i].setAttribute("max", product_qualtity);
                    }
                    check_point[i] = product_id;
                    for(var j=0; j<check_point.length; j++){
                        if(i != j){
                            if(check_point[j]==check_point[i]){
                                input_id[i].value = "";
                                input_price[i].value = "";
                                input_quantity[i].value = "";
                                input_quantity[i].setAttribute("max", "");
                                input_name[i].value = "";
                                alert("สินค้า : "+product_name+" อยู่ในรายการแล้ว");
                            }
                        }
                    }
                }
            <?php } ?>
        }
    }
    
    function calculateDate(){
        var day = document.getElementsByName("pay_day");
        var due_date = document.getElementsByName("due_date");
        var start_date = new Date(due_date[0].value);
        var con_date = document.getElementsByName("con_date");
        start_date.setDate(start_date.getDate()+parseInt(day[0].value));
        var final_date = start_date.getFullYear()+'-'+('0' + (start_date.getMonth()+1)).slice(-2)+'-'+('0'+start_date.getDate()).slice(-2);
        $("#con_date").val(final_date.toString());
    }
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
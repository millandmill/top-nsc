<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TOP-NSC</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../bootstrap3.3.4/css/bootstrap-theme.css"/>
<link rel="stylesheet" type="text/css" href="../bootstrap3.3.4/css/bootstrap.css"/>
<link rel="stylesheet" href="../font-awesome-4.4.0/css/font-awesome.css">
<script src="../bootstrap3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/gridforms.css">
<link rel="stylesheet" href="../css/jquery-ui.css">
<link rel="stylesheet" href="../css/datepicker.css">
<script src="../js/jquery-1.10.1.min.js"></script>
<script src="../css/jquery-ui.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../bootstrap3.3.4/js/bootstrap.js"></script>

<style type="text/css">
            /* Custom style */

    #content td:hover{
        background: #fffded;
    }
    thead.purchaseOrder th
    {
        background: #ffffff!important;
        color: #ED4F4F;
    }
    thead.purchaseOrder tr th
    {
        font-weight:bold;
    }
    thead tr th
    {
        text-align: center;
    }
    tbody.grid-form tr td input
    {
        height: 100% !important;
    }
    tbody.grid-form tr td, 
    tfoot.grid-form tr td
    {
        height: 51px;
        vertical-align: middle;
    }
</style>
</head>
<body>
	<div class="container-fluid war">
	<div class="row">
       <? include "../include/head.inc.php" ; ?>
    </div><!-- end row-->

    <div class="row">
    	<div class="col-xs-12 col-lg-3 col-sm-5 col-md-5">
    		<? include "../include/main-menu.inc.php" ; ?>
        </div><!-- end col-xs-12 -->
        <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
            <div class="content">
                <div class="header-content">
                    <div class="font24"><i class="fa fa-cubes"></i>เพิ่มใบสั่งซื้อ
                        </div>
                    </div>
                </div><!-- end header-content -->
            	<div class="col-xs-12">
                    <content>
                 
                        <form class="grid-form grid-form-special form-addbuy" style="border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;background:#f5f5f5;">
                            <fieldset>
                                <div data-row-span="12">
                                    <div data-field-span="9" style="height: 65px;">
                                        <label>ชื่อ</label>
                                        <input type="text" name="fullname" placeholder="ใส่ชื่อเต็ม หรือ ค้นหาจากบัญชีรายชื่อ(คำค้นอาจเป็น ที่อยู่  ชื่อบริษัท หรือ อื่นๆ)">
                                    </div>
                                    <div data-field-span="3" style="height: 65px;">
                                        <label>เลขที่เอกสารภายใน</label>
                                        <div class="col-xs-3" style="padding:0px!important;">
                                            <input type="text" class="form-control" name="company_format" placeholder=" " style="text-align:right;">
                                        </div>
                                        <div class="col-xs-9" style="padding:0px!important;">
                                            <input type="number" class="form-control" name="invoice_no" placeholder="   AUTO">
                                        </div>
                                    </div>
                                </div>
                                <div data-row-span="4">
                                    <div data-field-span="2" style="height: 65px;">
                                        <label>องค์กร</label>
                                        <input type="text" name="organization">
                                    </div>
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>วันที่ตามใบเสร็จ&nbsp;<i class="fa fa-calendar"></i></label>
                                        <input type="text" name="date" id="datepicker" class="date-picker" data-date-format="dd/mm/yyyy" value="21/09/2015" style="background:#fff;text-align:center;border:1px solid #7E7E7E;">
                                    </div>
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>วันที่ในรายงานภาษีซื้อ&nbsp;<i class="fa fa-calendar"></i></label>
                                        <input type="text" name="due_date" id="datepicker2" class="date-picker" data-date-format="dd/mm/yyyy" value="21/09/2015" style="background:#fff;text-align:center;border:1px solid #7E7E7E;">
                                    </div>
                                </div>

                                <div data-row-span="1">
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>ที่อยู่</label>
                                        <input type="text" name="address">
                                    </div>
                                </div>
                                <div data-row-span="4">
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>อีเมล์</label>
                                        <input type="text" name="email">
                                    </div>
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>โทรศัพท์</label>
                                        <input type="text" name="telephone">
                                    </div>
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>เลขประจำตัวผู้เสียภาษี</label>
                                        <input type="text" name="tax_id">
                                    </div>
                                    <div data-field-span="1" style="height: 65px;">
                                        <label>เลขที่ใบเสร็จ</label>
                                        <input type="text" name="reference">
                                    </div>
                                </div>
                            </fieldset>
                            <!-- here -->
                        <div class="row row-0">
                          <div class="table-responsive col-md-12" style="margin-top:15px;">
                            <table class="table table-bordered table-pink" style="background:#f5f5f5;">
                              <thead class="invoice">
                                <tr>
                                  <th style="width:11%">รหัส</th>
                                  <th>สินค้า</th>
                                  <th style="width:12%">ราคา</th>
                                  <th style="width:8%">จำนวน</th>
                                  <th style="width:12%">ส่วนลด</th>
                                  <th style="width:16%">
                                    <select name="price_option" style="width:100%;color:#000;" onchange="calculate_sum();">
                                        <option value="ex" selected="">ราคา ไม่ รวมภาษี</option>
                                        <option value="in">ราคารวมภาษี</option>
                                    </select>
                                  </th>
                                  <th style="width:25px;"></th>
                                </tr>
                              </thead>
                              <tbody class="grid-form" id="content">
                                <tr>
                                      <td>
                                        <input type="text" name="id[]" onkeyup="auto_product($(this));return false;">
                                      </td>
                                      <td>
                                        <input type="text" name="product[]" onkeyup="auto_product($(this));return false;">
                                      </td>
                                      <td>
                                        <input type="number" name="price[]">
                                      </td>
                                      <td>
                                        <input type="text" name="quantity[]">
                                      </td>
                                      <td>
                                        <input type="text" name="discount[]">
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
                              <tfoot class="grid-form">
                                <tr>
                                    <td colspan="5">
                                        <a href="#" onclick="add_new_line();return false;">
                                            <i class="fa fa-plus" style="color:green;"></i> เพิ่มรายการ                         </a>
                                    </td>
                                    <td><input type="text" style="text-align:right;" name="sum_amount" value="0.00" onkeyup="calculate_grand_total();return false;"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><input type="text" name="invoice_note" placeholder="หมายเหตุ..."></td>
                                    <td style="font-weight:bold;text-align:right;">
                                        ภาษี:
                                    </td>
                                    <td><input type="text" style="text-align:right;" name="sum_tax" value="0.00" onkeyup="calculate_grand_total();return false;"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align:center;">
                                        <a href="javascript:;" class="btn btn-grey" onclick="$('#cancel_modal').modal();return false;">
                                            <i class="fa fa-refresh"></i>
                                            ยกเลิก                          </a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:;" class="btn btn-success" onclick="save_modal();return false;">
                                            <i class="fa fa-save"></i>
                                            บันทึก
                                        </a>
                                    </td>
                                    <td style="font-weight:bold;text-align:right;">
                                        ยอดเงินสุทธิ:
                                    </td>
                                    <td><input type="text" style="text-align:right;" name="grand_total" value="0.00"></td>
                                    <td></td>
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
    </div><!-- end row -->
	</div><!-- end container-fluid -->
<script>
    $(function() {
    $( "#datepicker" ).datepicker();
    });
</script>
</body>

</html>
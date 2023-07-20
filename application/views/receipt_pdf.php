<?php
if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
require_once('mpdf/mpdf.php');
ob_start();
?>

<?php
if(isset($receipt) && trim($receipt[0]['receipt_number']) != '') {
    $resultData = $receipt;
    $arr_cus = array('customer_address', 'customer_building', 'customer_floor', 'customer_road', 'customer_district', 'customer_county', 'customer_province', 'customer_zip');
        $count_cus = count($arr_cus);
        $run = 0;
        for($i=0; $i<$count_cus; $i++){
            if(isset($resultData[0][$arr_cus[$i]])){
                $part_address[$run] = $resultData[0][$arr_cus[$i]];
                $run++;
            }
        }
        
        $count_address = count($part_address);
        $address = "";
        for($i=0; $i<$count_address; $i++){
            if($i == 0) {
                $address = $part_address[$i];
            }else {
                $address = $address." ".$part_address[$i];
            }
        }
}
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"> 

    <style  type="text/css">
        <!--
        body{
            font-size: 14px;
            padding-top: 10px;
        }
        table{
            border-collapse: collapse;
            border-spacing: 0;
            table-layout: fixed;
        }
        .funfai{
            width: 40%;
            display: inline-block;
            background-color: red;
        }
        .head{
            height: 100px;
            vertical-align: top;
            padding-top: 10px;
        }
        .receipt_word{
            height: 100px;
            text-align: right;
            vertical-align: top;
            padding-top: 10px;
            font-size: 20px;
            color: #FF0033;
        }
        .data_table {
            padding-bottom: 5px;
            padding-right: 4px;
        }
        .receiptid{
            height: 70px;
            vertical-align: top;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            text-align: center;
            color: white;
        }
        .refQuotation {
            height: 70px;
            vertical-align: top;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            color: white;
            text-align: center;
        }
        .head_table {
            text-align: center;
            padding-top: 10px;
            vertical-align: top;
            height: 50px;
            color: #990066;
        }
        .head_table_right {
            text-align: right;
            padding-top: 10px;
            vertical-align: top;
            height: 50px;
            color: #990066;
        }
        .general_style {
            font-size: 14px;
            padding-top: 10px;
            vertical-align: top;
        }
        .data_receipt {
            padding-top: 10px;
            vertical-align: bottom;
        }
            
        -->
    </style>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    </head>
    
    <body>
        <table width="100%" border="0">
            <tr class="linehead">
                <td width="10%" class="head" style="text-align: center; vertical-align: central; padding-top: 0px;">
                    <img width="80px" height="80px" src="<?php if(isset($resultData[0]['company_logo']) && trim($resultData[0]['company_logo'] != '')){ echo base_url(); ?>/uploads/img/<?php echo $resultData[0]['company_logo']; }else { echo base_url(); ?>/uploads/img/<?php echo 'default-image.jpg'; } ?>"></img>
                </td>
                <td width="50%" class="head" style="padding-left: 10px; font-size: 20px; color: #990066"><b><?php if(isset($resultData[0]['company_name'])) { echo $resultData[0]['company_name']; } else { echo ""; }?></b>
                    <font style="font-size: 14px; padding-top: 10px; color: #CC3399;"><br /><?php if(isset($resultData[0]['company_address_all'])) { echo $resultData[0]['company_address_all']; } else { echo ""; } ?></font>
                    <font style="font-size: 14px; padding-top: 10px; color: #CC3399;"><br />โทร:&nbsp;<?php if(isset($resultData[0]['company_tel'])) { echo $resultData[0]['company_tel']; } else { echo ""; } ?> แฟกซ์:&nbsp;<?php if(isset($resultData[0]['company_fax'])) { echo $resultData[0]['company_fax']; } else { echo ""; } ?></font>
                    <font style="font-size: 14px; padding-top: 10px; color: #CC3399;"><br />เลขประจำตัวผู้เสียภาษี:&nbsp;<?php if(isset($resultData[0]['company_tax_code'])) { echo $resultData[0]['company_tax_code']; } else { echo ""; } ?></font>
                </td>
                <td width="40%" class="head" style="text-align: right; color: #CC3399;"><?php if(isset($resultData[0]['company_email'])) { echo $resultData[0]['company_email']; } ?></td>
            </tr>
        </table>
        <hr style="color: #CC3399;" />
        
        <table width="100%" border="0">
            <tr>
                <td class="general_style" colspan="2"><font style="color: #CC3399;">ชื่อผู้ขาย</font>
                    <br/><br /><font style="color: #990066;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php if(isset($resultData[0]['customer_name'])) { echo $resultData[0]['customer_name']; } ?></b></font>
                    <br/><font style="color: #CC3399;"><?php if(isset($address)) { echo $address; } ?></font>
                    <br/><font style="color: #CC3399;"><?php if(isset($resultData[0]['customer_tax_code'])) { echo "เลขประจำตัวผู้เสียภาษี:"." ".$resultData[0]['customer_tax_code']; } ?></font>
                    <br/><font style="color: #CC3399;"><?php if(isset($resultData[0]['customer_tel'])) { echo "โทร:"." ".$resultData[0]['customer_tel']; } ?></font>&nbsp;&nbsp;&nbsp;&nbsp;<font style="color: #CC3399"><?php if(isset($resultData[0]['customer_email'])) { echo "อีเมล์:"." ".$resultData[0]['customer_email']; } ?></font>
                </td>
                <td class="receipt_word" colspan="3" >ใบเสร็จรับเงิน<br />RECEIPT</td>
            </tr>
            
            <tr style="background: #FF0099;">
                <td width="40%" style="background:#fff;"></td>
                <td width="20%" class="refQuotation">อ้างอิงใบวางบิล
                    <br /><br /><font><?php if(isset($resultData[0]['billingnote_text'])) { echo $resultData[0]['billingnote_text']; } ?><?php if(isset($resultData[0]['billingnote_number'])) { echo $resultData[0]['billingnote_number']; } ?></font>
                </td>
                <td width="20%" class="receiptid">เงื่อนไขการชำระเงิน
                    <br /><br /><font>(<?php if(isset($resultData[0]['condition_pay'])) { echo $resultData[0]['condition_pay']; } ?>&nbsp;&nbsp;<?php if(isset($resultData[0]['pay_day'])) { echo $resultData[0]['pay_day']."  วัน"; } ?>)</font>
                </td>
                <td width="10%" class="receiptid">วันที่
                    <br /><br/><font><?php if(isset($resultData[0]['receipt_date'])) { echo date('d/m/Y', strtotime($resultData[0]['receipt_date'])); } else { echo date('d/m/Y'); }  ?></font>
                </td>
                <td width="10%" class="receiptid">เลขที่เอกสาร
                    <br /><br /><font><?php if(isset($resultData[0]['receipt_text'])) { echo $resultData[0]['receipt_text']; } if(isset($resultData[0]['receipt_number'])) { echo $resultData[0]['receipt_number']; } ?></font>
                </td>
            </tr>
        </table>
        
        <table width="100%" border="0">
            <tr>
                <td width="40%" style="color: #990066;">รายละเอียดสินค้า<br />Prod.Description</td>
                <td width="15%" class="head_table">จำนวน<br />Quantity</td>
                <td width="15%" class="head_table_right">ราคาต่อหน่วย<br/>Unit Price</td>
                <td width="15%" class="head_table_right">ส่วนลด<br />Discount</td>
                <td width="15%" class="head_table_right">จำนวนเงิน<br />Amount</td>
                
            </tr>
            
            
            
            <!-- loop for data receipt. -->
            <?php for($i=0; $i<9; $i++) { ?>
            <tr>
                
                <?php if($i%2 == 0) { ?>
                    <td width="50%" height="40px" class="data_receipt data_table" style="background: #FFC0CB; padding-left: 5px;"><?php if(isset($resultData[$i]['product_name'])) { echo $resultData[$i]['product_name']; }  ?></td>
                    <td width="15%" class="data_receipt data_table" style="text-align: center; background: #FFC0CB;"><?php if(isset($resultData[$i]['product_amount'])) { echo number_format($resultData[$i]['product_amount']); } ?></td>
                    <td width="15%" class="data_receipt data_table" style="text-align: right; background: #FFC0CB;"><?php if(isset($resultData[$i]['product_price'])) { echo number_format($resultData[$i]['product_price'], 2, '.', ','); } ?></td>
                    <td width="10%" class="data_receipt data_table" style="text-align: right; background: #FFC0CB;"><?php if(isset($resultData[$i]['product_discount'])) { echo $resultData[$i]['product_discount']; } ?></td>
                    <td width="10%" class="data_receipt data_table" style="text-align: right; background: #FFC0CB;"><?php if(isset($resultData[$i]['product_total'])) { echo number_format($resultData[$i]['product_total'], 2, '.', ','); } ?></td>
                <?php }else { ?>
                    <td width="50%" height="40px" class="data_receipt data_table" style="padding-left: 5px;"><?php if(isset($resultData[$i]['product_name'])) { echo $resultData[$i]['product_name']; } ?></td>
                    <td width="15%" class="data_receipt data_table" style="text-align: center;"><?php if(isset($resultData[$i]['product_amount'])) { echo number_format($resultData[$i]['product_amount']); } ?></td>
                    <td width="15%" class="data_receipt data_table" style="text-align: right;"><?php if(isset($resultData[$i]['product_price'])) { echo number_format($resultData[$i]['product_price'], 2, '.', ','); } ?></td>
                    <td width="10%" class="data_receipt data_table" style="text-align: right;"><?php if(isset($resultData[$i]['product_discount'])) { echo $resultData[$i]['product_discount']; } ?></td>
                    <td width="10%" class="data_receipt data_table" style="text-align: right;"><?php if(isset($resultData[$i]['product_total'])) { echo number_format($resultData[$i]['product_total'], 2, '.', ','); } ?></td>
                <?php } ?>
            </tr>
             <?php } ?>
            
            <!-- empty space for spacing line. -->
            <tr>
                <td colspan="5" height="20px;"></td>
            </tr>
            
            <tr>
            <td colspan="2" style="height: 50px; padding-left: 20px; background-color: #FF99CC;" ><b><?php if(isset($resultData[0]['write_text'])) { echo $resultData[0]['write_text']; } ?></b></td>
                <td colspan="2" style="text-align: center;"><font style="color: #CC3399;">รวมเงิน<br />SUBTOTAL</font></td>
                <td class="data_table" style="text-align: right;"><?php if(isset($resultData[0]['product_total_real'])) { echo number_format($resultData[0]['product_total_real'], 2, '.', ','); } ?></td>
            </tr>
            
            <tr>
                <td rowspan="2" style="padding-left: 20px; padding-top: 30px; padding-bottom: 30px; vertical-align: top; word-wrap: break-word;">
                    <font style="color: #CC3399;"><b>วันนัดชำระเงิน:</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($resultData[0]['payment_date'])); ?><br /><font style="color: #CC3399;"><b>หมายเหตุ</b></font><br /><br />&nbsp;&nbsp;<?php if(isset($resultData[0]['receipt_note'])) { echo $resultData[0]['receipt_note']; } ?></td>
                <td height="55px;"></td>
                <td colspan="2" style="text-align: center;"><font style="color: #CC3399;">ภาษีมูลค่าเพิ่ม<br />VAT <?php if(isset($resultData[0]['product_vat'])) { echo $resultData[0]['product_vat']; } ?></font></td>
                <td class="data_table" style="text-align: right;"><?php if(isset($resultData[0]['total_vat_baht'])) { echo number_format($resultData[0]['total_vat_baht'], 2, '.', ','); } ?></td>
            </tr>
            
            <tr style="background: #FF0099;">
                <td height="55px;" style="background: white;"></td>
                <td colspan="2" style="text-align: center;"><font style="color: white;">ยอดเงินสุทธิ<br />NET TOTAL</font></td>
                <td class="data_table" style="text-align: right; color: white;"><?php if(isset($resultData[0]['product_grand_total'])) { echo number_format($resultData[0]['product_grand_total'], 2, '.', ','); } ?></td>
            </tr>
        </table>
        
        <br />
        
        <table width="100%" border="0" style="color: #CC3399;">
            <tr>
                <td height="100px" width="33%" style="text-align: center;"></td>
                <td height="100px" width="33%" style="text-align: center;">
                    ผู้รับเงิน Collector<br /><br />
                    __________________<br /><br />
                    <font style="text-align: left;">วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
                <td height="100px" width="33%" style="text-align: center;">
                    ผู้ตรวจสอบ Auditor<br /><br />
                    __________________<br /><br />
                    <font style="text-align: left;">วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
            </tr>
        </table>
        <br />
        <hr style="color: #CC3399;" />
        
        <table width="100%" border="0">
            <tr>
                <td style="text-align: right; color: #CC3399; font-size: 12px;">เอกสารชุดนี้จัดทำโดย TOP-NSC</td>
            </tr>
        </table>
        
    </body>
    
</html>


<?php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSarabun', '4', '5', '4', '6');
$pdf->SetTitle('Receipt.pdf');
$pdf->SetAuthor('TOP-NSC');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 0);
$pdf->Output('receipt_'.date('d/m/Y', strtotime($resultData[0]['receipt_date'])).'', 'I');
?>
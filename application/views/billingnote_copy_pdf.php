<?php
if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
require_once('mpdf/mpdf.php');
ob_start();
?>

<?php
if(isset($billingnote) && trim($billingnote[0]['billingnote_number']) != '') {
    $resultData = $billingnote;
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
        .billingnote_word{
            height: 100px;
            text-align: right;
            vertical-align: top;
            padding-top: 10px;
            font-size: 20px;
            color: #4682B4;
        }
        .data_table {
            padding-bottom: 5px;
            padding-right: 4px;
        }
        .billingnoteid{
            height: 70px;
            vertical-align: top;
            text-align: center;
            padding-top: 10px;
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
            color: #4682B4;
        }
        .head_table_right {
            text-align: right;
            padding-top: 10px;
            vertical-align: top;
            height: 50px;
            color: #4682B4;
        }
        .head_table_center {
            text-align: center;
            padding-top: 10px;
            vertical-align: middle;
            height: 50px;
            color: #4682B4;
        }
        .general_style {
            font-size: 14px;
            padding-top: 10px;
            vertical-align: top;
        }
        .data_billingnote {
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
                <td width="50%" class="head" style="padding-left: 10px; font-size: 20px; color: #4682B4;"><b><?php if(isset($resultData[0]['company_name'])) { echo $resultData[0]['company_name']; } else { echo ""; }?></b>
                    <font style="font-size: 14px; padding-top: 10px; color: #4682B4;"><br /><?php if(isset($resultData[0]['company_address_all'])) { echo $resultData[0]['company_address_all']; } else { echo ""; } ?></font>
                    <font style="font-size: 14px; padding-top: 10px; color: #4682B4;"><br />โทร:&nbsp;<?php if(isset($resultData[0]['company_tel'])) { echo $resultData[0]['company_tel']; } else { echo ""; } ?> แฟกซ์:&nbsp;<?php if(isset($resultData[0]['company_fax'])) { echo $resultData[0]['company_fax']; } else { echo ""; } ?></font>
                    <font style="font-size: 14px; padding-top: 10px; color: #4682B4;"><br />เลขประจำตัวผู้เสียภาษี:&nbsp;<?php if(isset($resultData[0]['company_tax_code'])) { echo $resultData[0]['company_tax_code']; } else { echo ""; } ?></font>
                </td>
                <td width="40%" class="head" style="text-align: right; color: #4682B4;"><?php if(isset($resultData[0]['company_email'])) { echo $resultData[0]['company_email']; } ?></td>
            </tr>
        </table>
        <hr style="color: #4682B4;" />
        
        <table width="100%" border="0">
            <tr>
                <td class="general_style" colspan="2"><font style="color: #4682B4;">ชื่อผู้ขาย</font>
                    <br/><br /><font style="color: #4682B4;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php if(isset($resultData[0]['customer_name'])) { echo $resultData[0]['customer_name']; } ?></b></font>
                    <br/><font style="color: #4682B4;"><?php if(isset($address)) { echo $address; } ?></font>
                    <br/><font style="color: #4682B4;"><?php if(isset($resultData[0]['customer_tax_code'])) { echo "เลขประจำตัวผู้เสียภาษี:"." ".$resultData[0]['customer_tax_code']; } ?></font>
                    <br/><font style="color: #4682B4;"><?php if(isset($resultData[0]['customer_tel'])) { echo "โทร:"." ".$resultData[0]['customer_tel']; } ?></font>&nbsp;&nbsp;&nbsp;&nbsp;<font style="color: #4682B4"><?php if(isset($resultData[0]['customer_email'])) { echo "อีเมล์:"." ".$resultData[0]['customer_email']; } ?></font>
                </td>
                <td class="billingnote_word" colspan="3" >สำเนาใบวางบิล<br />Copy of BILLING NOTE</td>
            </tr>
            
            <tr style="background: #4682B4;">
                <td width="40%" style="background: #fff;"></td>
                <td width="20%" style="background: #fff;"></td>
                <td width="20%" class="billingnoteid">เลขที่ใบสั่งซื้อ
                    <br /><br /><font><?php if(isset($resultData[0]['numberOfPurchase'])) { echo $resultData[0]['numberOfPurchase']; } ?></font>
                </td>
                <td width="10%" class="billingnoteid">วันที่
                    <br /><br/><font><?php if(isset($resultData[0]['billingnote_date'])) { echo date('d/m/Y', strtotime($resultData[0]['billingnote_date'])); } else { echo date('d/m/Y'); }  ?></font>
                </td>
                <td width="10%" class="billingnoteid">เลขที่เอกสาร
                    <br /><br /><font><?php if(isset($resultData[0]['billingnote_text'])) { echo $resultData[0]['billingnote_text']; } if(isset($resultData[0]['billingnote_number'])) { echo $resultData[0]['billingnote_number']; } ?></font>
                </td>
            </tr>
        </table>
        
        <table width="100%" border="0">
            <tr>
                <td width="15%" class="head_table_center">เลขใบเสนอราคา<br />Quotation No.</td>
                <td width="15%" class="head_table_center">ลงวันที่<br />Issue date</td>
                <td width="15%" class="head_table_center">วันที่ครบกำหนด<br />Due date</td>
                <td width="15%" class="head_table_right">จำนวนเงิน<br />Amount</td>
                <td width="5%" class="head_table_center"></td>
                <td width="15%" class="head_table_center"></td>
                <td width="20%" class="head_table_center">เงื่อนไขการชำระเงิน</td>
                
            </tr>
            
            
            
            <!-- loop for data billingnote. -->
            <?php for($i=0; $i<9; $i++) { ?>
            <tr>
                
                <?php if($i%2 == 0) { ?>
                    <td height="40px" class="data_billingnote data_table" style="text-align: center; background: #F0F8FF;"><?php if(isset($resultData[$i]['quotation_text'])) { echo $resultData[$i]['quotation_text']; } if(isset($resultData[$i]['quotation_number'])) { echo $resultData[$i]['quotation_number']; } ?></td>
                    <td class="data_billingnote data_table" style="text-align: center; background: #F0F8FF;"><?php if(isset($resultData[$i]['issue_date'])) { echo date('d/m/Y', strtotime($resultData[0]['issue_date'])); }  ?></td>
                    <td class="data_billingnote data_table" style="text-align: center; background: #F0F8FF;"><?php if(isset($resultData[$i]['condition_date'])) { echo date('d/m/Y', strtotime($resultData[0]['condition_date'])); }  ?></td>
                    <td class="data_billingnote data_table" style="text-align: right; background: #F0F8FF;"><?php if(isset($resultData[$i]['product_total_real'])) { echo number_format($resultData[$i]['product_total_real'], 2, '.', ','); } ?></td>
                    <td class="data_billingnote data_table" style="background: #F0F8FF;"></td>
                    <td class="data_billingnote data_table" style="background: #F0F8FF;"></td>
                    <td  class="data_billingnote data_table" style="text-align: center; background: #F0F8FF;"><?php if(isset($resultData[$i]['condition_pay'])) { echo $resultData[$i]['condition_pay']; } ?></td>
                <?php }else { ?>
                    <td height="40px" class="data_billingnote data_table" style="text-align: center;"><?php if(isset($resultData[$i]['quotation_text'])) { echo $resultData[$i]['quotation_text']; } if(isset($resultData[$i]['quotation_number'])) { echo $resultData[$i]['quotation_number']; } ?></td>
                    <td class="data_billingnote data_table" style="text-align: center;"><?php if(isset($resultData[$i]['issue_date'])) { echo $resultData[$i]['issue_date']; }  ?></td>
                    <td class="data_billingnote data_table" style="text-align: center;"><?php if(isset($resultData[$i]['condition_date'])) { echo $resultData[$i]['condition_date']; }  ?></td>
                    <td class="data_billingnote data_table" style="text-align: right;"><?php if(isset($resultData[$i]['product_total_real'])) { echo number_format($resultData[$i]['product_total_real'], 2, '.', ','); } ?></td>
                    <td class="data_billingnote data_table"></td>
                    <td class="data_billingnote data_table"></td>
                    <td class="data_billingnote data_table" style="text-align: center;"><?php if(isset($resultData[$i]['condition_pay'])) { echo $resultData[$i]['condition_pay']; } ?></td>
                <?php } ?>
            </tr>
             <?php } ?>
            
            <!-- empty space for spacing line. -->
            <tr>
                <td colspan="7" height="20px;"></td>
            </tr>
            
            <tr>
                <td colspan="4" style="height: 50px; padding-left: 20px; background-color: #F0F8FF;" ><b><?php if(isset($resultData[0]['write_text_principle'])) { echo $resultData[0]['write_text_principle']; } ?></b></td>
                <td></td>
                <td style="text-align: center; background: #4682B4;"><font style="color: white;">รวมเป็นเงิน</font></td>
                <td class="data_table" style="text-align: right; background: #4682B4; color: white;"><?php if(isset($resultData[0]['product_total_real'])) { echo number_format($resultData[0]['product_total_real'], 2, '.', ','); } ?></td>
            </tr>
            
            <tr>
                <td height="55px;" colspan="4" rowspan="2" style="padding-left: 20px; padding-top: 30px; padding-bottom: 30px; vertical-align: top; word-wrap: break-word;">
                    <font style="color: #4682B4;"><b>วันนัดชำระเงิน:</b></font>&nbsp;&nbsp;<?php if(isset($resultData[0]['payment_date'])) { echo date('d/m/Y', strtotime($resultData[0]['payment_date'])); } ?>
                    <font style="color: #4682B4;"><br/><br /><b>หมายเหตุ</b><br /></font>&nbsp;&nbsp;<?php if(isset($resultData[0]['billingnote_note'])) { echo $resultData[0]['billingnote_note']; } ?>
                </td>
                <td colspan="2" style="text-align: center;"></td>
                <td class="data_table" style="text-align: right;"></td>
            </tr>
            
        </table>    
        
        <table height="100px" width="100%" border="0" style="color: #4682B4;">
            <tr>
                <td width="25%" style="text-align: center;">
                    ผู้รับวางบิล Bill recipient<br /><br />
                    __________________<br /><br />
                    <font style="text-align: left;">วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
                <td width="25%" style="text-align: center;">
                    วางบิลโดย Billing by<br /><br />
                    __________________<br /><br />
                    <font style="text-align: left;">วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
                <td width="25%" style="text-align: center;">
                    ผู้รับเงิน Collector<br /><br />
                    __________________<br /><br />
                    <font style="text-align: left;">วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
                <td width="25%" style="text-align: center;">
                    ตรวจสอบโดย Auditor<br /><br />
                    __________________<br /><br />
                    <font style="text-align: left;">วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
            </tr>
        </table>
        <br />
        <hr style="color: #4682B4;" />
        
        <table width="100%" border="0">
            <tr>
                <td style="text-align: right; color: #4682B4; font-size: 12px;">เอกสารชุดนี้จัดทำโดย TOP-NSC</td>
            </tr>
        </table>
        
    </body>
    
</html>


<?php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSarabun', '4', '5', '4', '6');
$pdf->SetTitle('Copy of Billingnote.pdf');
$pdf->SetAuthor('TOP-NSC');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 0);
$pdf->Output('copy-of-billingnote_'.date('d/m/Y', strtotime($resultData[0]['billingnote_date'])).'', 'I');
?>

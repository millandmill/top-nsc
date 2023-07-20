<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    $count=0;
    $all_product=0;
    $all_product_vat=0;
    if(isset($export_sell)){
        $resultData = $export_sell;
        $count = count($resultData);
    }
?>

        <div class="col-md-12 table-responsive">
            <table class="table tb-tax" id="main-table">
              <tbody><tr class="top-less">
                <td>ลำดับ</td>
                <td>เลขที่เอกสาร</td>
                <td>วันที่เอกสาร</td>
                <td>ใบกำกับภาษี</td>
                <td>รายละเอียด</td>
                <td class="right">ราคาไม่รวมภาษี</td>
                <td class="right">ราคารวมภาษี</td>
              </tr>
              </tbody>
                <tbody name="sale_tax_report">
                    <?php if(isset($resultData)){ ?>
                        <?php for($i=0; $i<$count; $i++){ ?>
                            <tr>
                                <td><?php if(isset($i)){ echo $i+1; } ?></td>
                                <td><?php if(isset($resultData[$i]['billingnote_text'])){ echo $resultData[$i]['billingnote_text'].$resultData[$i]['billingnote_number']; } ?></td>
                                <td><?php if(isset($resultData[$i]['invoice_date'])){ echo date("d/m/Y", strtotime($resultData[$i]['invoice_date'])); } ?></td>
                                <td><?php if(isset($resultData[$i]['invoice_text'])){ echo $resultData[$i]['invoice_text'].$resultData[$i]['invoice_number']; } ?></td>
                                <td><?php if(isset($resultData[$i]['customer_name'])){ echo $resultData[$i]['customer_name']; } ?></td>
                                <td><?php if(isset($resultData[$i]['product_total_real'])){ echo $resultData[$i]['product_total_real']; $all_product = $all_product+$resultData[$i]['product_total_real']; } ?></td>
                                <td><?php if(isset($resultData[$i]['product_grand_total'])){ echo $resultData[$i]['product_grand_total']; $all_product_vat = $all_product_vat+$resultData[$i]['product_grand_total']; } ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>รวม</td>
                            <td class="right"><?php if(isset($all_product)){ echo number_format($all_product, 2); } ?></td>
                            <td class="right"><?php if(isset($all_product_vat)){ echo number_format($all_product_vat, 2); } ?></td>
                        </tr>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="6"><center><span style="color:red;">No Data</span></center></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <center><button name="next" class="btn btn-danger btn-o" onclick="location.href='<?php echo base_url(); ?>exportTxt/export_txt_sell?price_all=<?php echo $all_product; ?>&price_vat=<?php echo $all_product_vat; ?>&user_id=<?php echo $user_id; ?>&dateStart=<?php echo $dateEnd; ?>';">ส่งออก</button></center>
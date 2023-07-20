<?php
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    if(isset($search)) {
        $resultData = $search;
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
                            <button name="detail" class="btn btn-grey btn-o" onclick="javascript:window.open('<?php echo base_url(); ?>generate_pdf/generate_purchase?p_id=<?php echo $rowID; ?>&purchase_paper=<?php echo $rows['purchase_paper']; ?>&type=purchase');" title="ดูใบสั่งซื้อ"><i class="fa fa-search-plus"></i></button>
                            <button name="copy_detail" class="btn btn-grey btn-o" onclick="javascript:window.open('<?php echo base_url(); ?>generate_pdf/generate_purchase?p_id=<?php echo $rowID; ?>&purchase_paper=<?php echo $rows['purchase_paper']; ?>&type=purchase_copy');" title="ดูสำเนาใบสั่งซื้อ"><i class="fa fa-copy"></i></button>
                        </td>
                        <?php break;
                    case 'status': ?>
                        <td style="text-align:center;">
                            <?php if($rows[$dataShow[$key][1]] == "เสร็จสิ้น"){ ?>
                                <label class="label label-sm label-success font14">เสร็จสิ้น</label>
                            <?php }else{ ?>
                                <label class="label label-sm label-success font14">เสร็จสิ้น</label>
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
<?php }else{ echo "<font color='red'>Not Found.</font>"; } ?>
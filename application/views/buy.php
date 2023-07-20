
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
                    <div class="font24"><i class="fa fa-cubes"></i>ใบสั่งซื้อ
                        <div class="btn-group" style="float: right;">
                            <button type="button" class="btn btn-danger" onclick="window.location='new_purchaseOrder.php';">
                                <i class="fa fa-plus"></i>&nbsp;
                                <span class="font12">สร้างใบสั่งซื้อ</span>
                            </button>
                        </div>
                    </div>
                </div><!-- end header-content -->
                <div class="row">
                    <div class="col-xs-4 col-sm-3">
                        <select name="purchaseOrder_status" class="form-control" onclick="search_text(13, 0, 0);" style="font-size: 18px;">
                            <option value="">สถานะ</option>
                            <option value="0">รอการสั่งซื้อ</option>
                            <option value="other">ออกใบเสร็จแล้ว</option>
                            <option value="1">ยกเลิก</option>
                        </select>
                    </div><!-- end col-xs-4-->
                    <div class="col-xs-8 col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control search-box" name="search_query" onkeyup="search_text(event.keyCode, 0, 0);" placeholder="คำค้นหา...">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-pink btn-seach" onclick="search_text(13, 0, 0);">
                                    ค้นหา&nbsp;<i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>

                    </div><!-- end col-xs-8-->
                </div><!-- end row -->
                <div class="row row2">
                    <div class="col-xs-12">
                        <table class="table table-bordered font14 table-buy" id="datatable_orders" width="100%">
                            <thead>
                            <tr role="row" class="heading">
                                <th style="width:92px;">
                                     วันที่             
                                 </th>
                                <th width="5%" style="text-align:center;">
                                     PO&nbsp;#
                                </th>
                                <th width="60%" style="text-align:center;">
                                     รายละเอียด             
                                 </th>
                                <th class="hidden-xs" width="10%" style="text-align:center;">
                                     มูลค่า             
                                 </th>
                                <th width="10%" style="text-align:center;">
                                     สถานะ 
                                 </th>
                                <th width="15%" style="text-align:center;">
                                     ตัวเลือก
                                 </th>
                            </tr>
                            </thead>
                            <tbody id="view_ledger_output">
                                <tr>
                                    <td style="display:none;">1311</td>
                                    <td style="text-align:center;">20/09/2015</td>
                                    <td style="text-align:center;">PO1</td>
                                    <td>ชัยกุล<br>เล็กๆ<br>22222<br><a href="create_invoice.php?qid=1311" style="margin-top:5px;" class="btn btn-xs btn-grey"><i class="fa fa-pencil"></i> บันทึกใบเสร็จซื้อ</a></td>
                                    <td style="text-align:center;" class="hidden-xs">8,560,000.00</td>
                                    <td style="text-align:center;"><label class="label label-sm label-info">รอการสั่งซื้อ</label></td>
                                    <td style="text-align:center;">
                                         <button name="edit" class="btn btn-grey btn-o" onclick="click_edit(this);"><i class="fa fa-edit "></i></button><button name="detail" class="btn btn-grey btn-o" onclick="click_detail(this);"><i class="fa fa-search-plus"></i></button><button name="print" class="btn btn-grey btn-o" onclick="click_print(this);"><i class="fa fa-print"></i></button><button name="dele" class="btn btn-grey btn-o" onclick="click_detail(this);"><i class="fa fa-trash"></i></button>
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
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <center><div id="dyn_page" style="margin:-10px 0 10px 0;"><span></span></div></center>
                    </div>
                </div>
            </div><!-- end content -->
        </div><!-- end col-xs-12 -->
    </div><!-- end row -->
	</div><!-- end container-fluid -->
</body>
</html>
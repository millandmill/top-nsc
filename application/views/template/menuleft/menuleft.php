
  <div class="row">
    <div class="col-xs-12 col-lg-3 col-sm-5 col-md-5">
      <div class="nav-side-menu">
          <div class="brand">TOP-NSC</div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
              <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                  <li>
                    <i class="glyphicon glyphicon-briefcase"></i>
                    <a href="<?php echo base_url(); ?>company/detail">
                      ข้อมูลบริษัท
                    </a>
                  </li>
                  <li data-toggle="collapse" data-target="#products">
                    <i class="fa fa-cubes"></i>
                    <a href="#">คลังสินค้า<span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="products">
                      <li><a href="<?php echo base_url(); ?>product_stock/product">จัดการสินค้า</a></li>
                  </ul>
                  <li  data-toggle="collapse" data-target="#purchase" class="collapsed active">
                    <i class="glyphicon glyphicon-bitcoin"></i>
                    <a href="#">ซื้อ<span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="purchase">
                      <li><a href="<?php echo base_url(); ?>purchase/purchase_display">ใบสั่งซื้อ</a></li>
                  </ul>
                  <li data-toggle="collapse" data-target="#service" class="collapsed">
                    <i class="glyphicon glyphicon-bitcoin"></i>
                    <a href="#">ขาย<span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="service">
                    <li><a href="<?php echo base_url(); ?>quotation/quotation_display">ใบเสนอราคา</a></li>
                    <li><a href="<?php echo base_url(); ?>billingnote/billingnote_display">ใบวางบิล</a></li>
                    <li><a href="<?php echo base_url(); ?>receipt/receipt_display">ใบเสร็จรับเงิน</a></li>
                    <li><a href="<?php echo base_url(); ?>invoice/invoice_display">ใบกำกับภาษี</a></li>
                  </ul>
                  <li  data-toggle="collapse" data-target="#customer">
                    <i class="glyphicon glyphicon-user"></i>
                    <a href="#">คู่ค้า<span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="customer">
                      <li><a href="<?php echo base_url(); ?>customer/customer_detail">จัดการคู่ค้า</a></li>
                  </ul>
                  
                  <li data-toggle="collapse" data-target="#new" class="collapsed">
                    <i class="glyphicon glyphicon-align-justify"></i>
                    <a href="#">รายงาน ภ.พ.30 (แบบปกติ)<span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="new">
                    <li><a href="<?php echo base_url(); ?>exportTxt/profile_display">กรอกข้อมูลในการ Export</a></li>
                    <li><a href="<?php echo base_url(); ?>exportTxt/exportTxt_sell">ส่งออกไฟล์ .txt (ขาย)</a></li>
                    <li><a href="<?php echo base_url(); ?>exportTxt/exportTxt_buy">ส่งออกไฟล์ .txt (ซื้อ)</a></li>
                  </ul>
                  <li>
                    <i class="glyphicon glyphicon-off"></i>
                    <a href="<?php echo base_url(); ?>welcome/logout">ออกจากระบบ</a>
                  </li>
                </ul>
              </div>
      </div><!-- end nav-side-menu -->
    </div><!-- end col-xs-12 -->
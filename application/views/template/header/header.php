<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>TOP-NSC</title>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">TOP-NSC</a>
	    </div>
	  </div>
	</nav> -->

	<link href="<?php echo base_url().'public/lib/';?>css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'public/lib/';?>bootstrap3.3.4/css/bootstrap-theme.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'public/lib/';?>bootstrap3.3.4/css/bootstrap.css"/>
	<link rel="stylesheet" href="<?php echo base_url().'public/lib/';?>css/gridforms.css">
	<link rel="stylesheet" href="<?php echo base_url().'public/lib/';?>css/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url().'public/lib/';?>bootstrap3.3.4/css/datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url().'public/lib/';?>font-awesome-4.4.0/css/font-awesome.css"></script>
	<link rel="stylesheet" href="<?php echo base_url().'public/lib/';?>font-awesome-4.4.0/css/font-awesome.min.css"></script>
	<script src="<?php echo base_url().'public/lib/';?>css/jquery-ui.js"></script>
	<script src="<?php echo base_url().'public/lib/';?>js/jquery-1.10.1.min.js"></script>
	<script src="<?php echo base_url().'public/lib/';?>bootstrap3.3.4/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url().'public/lib/';?>bootstrap3.3.4/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url().'public/lib/';?>bootstrap3.3.4/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'public/lib/';?>jquery-easyui-1.4.4/themes/default/easyui.css">
    <script type="text/javascript" src="<?php echo base_url().'public/lib/';?>jquery-easyui-1.4.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'public/lib/';?>jquery-easyui-1.4.4/jquery.easyui.min.js"></script>

	<style type="text/css">
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
        
        <script type="text/javascript">
            
            function previewImg(input) {
                if(input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img_company')
                                .attr('src', e.target.result)
                                .width(120)
                                .height(120);
                    };
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
        </script>
        
</head>
<body>
<div class="container-fluid war">
  <div class="row">
    <nav class="navbar navbar-inverse navbar-fixed-top header">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>company/detail">TOP-NSC</a>       
        </div>
        <!--<div class="nav navbar-right head-user">
                <p>ปิยะทัศน์ ดอเล็ก</p>
                <p>ปิยะทัศน์ ดอเล็ก</p>
        </div> -->
      </div>
    </nav>
  </div><!-- end row-->
<?php 
    if($this->session->userdata('user_id') == ""){ redirect('welcome/logout'); }
    
    if(isset($company)){
        $resultCom = $company;
    }

?>
        <div class="col-xs-12 col-lg-9 col-sm-7 col-md-7">
            <div class="content">
            	<div class="header-content">
                    <div class="font24"><i class="fa fa-cubes"></i> รายงานภาษีขาย
                    </div>
                </div><!-- end header-content -->
                <div class="row">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <span class="hidden-print">รายงานภาษีขาย</span>
                            </div>
                            <div class="pull-right pf-date">
                                Tax ID:<span id="tax_id"><?php if(isset($resultCom[0]['company_tax_code'])){ echo $resultCom[0]['company_tax_code']; } ?></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 form-inline" style="text-align:center;display:none;" name="time_range">
                                    <div class="form-group hidden-print">
                                        <div class="input-icon">
                                            <i class="fa fa-calendar"></i>
                                            <input type="text" class="form-control date-picker hidden-print" name="calendar_from" value="30/08/2015" style="text-align:center;" data-date-format="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="hidden-print">
                                            &nbsp;ถึง&nbsp;
                                        </span>
                                    </div>
                                    <div class="form-group hidden-print">
                                        <div class="input-icon">
                                            <i class="fa fa-calendar"></i>
                                            <input type="text" class="form-control date-picker" name="calendar_to" value="29/09/2015" style="text-align:center;" data-date-format="dd/mm/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-inline" style="text-align:center;" name="monthly" onchange="gen_date();">
                                    <div class="form-group hidden-print">
                                        <div class="input-icon">
                                            <i class="fa fa-calendar fa-none"></i>
                                            <select name="month" class="form-control">
                                                <option value="00">==เลือกเดือน==</option>
                                                <option value="01">มกราคม</option>
                                                <option value="02">กุมภาพันธ์</option>
                                                <option value="03">มีนาคม</option>
                                                <option value="04">เมษายน</option>
                                                <option value="05">พฤษภาคม</option>
                                                <option value="06">มิถุนายน</option>
                                                <option value="07">กรกฎาคม</option>
                                                <option value="08">สิงหาคม</option>
                                                <option value="09">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤศจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group hidden-print">
                                        <input type="text" class="form-control" name="year" value="<?php echo date("Y"); ?>" style="text-align:center;width:80px;" onkeyup="gen_date();">
                                    </div>
                                    <button name="search" class="btn btn-grey" onclick="loadDoc()"><i class="fa fa-search"></i></button>
                                </div>
                                <br>
                                <input type="hidden" name="startDate">
                                <input type="hidden" name="endDate">
                                <div id="showData">
                                
                                </div>
                            </div><!-- end row -->
                            
                        </div>
                    </div>

                </div><!-- end row -->
 
            </div><!-- end content -->
        </div><!-- end col-xs-12 -->
    </div><!-- end row -->
	</div><!-- end container-fluid -->

<script>
    function gen_date(){
        var startDate = document.getElementsByName('startDate');
        var endDate = document.getElementsByName('endDate');
        var picked_mounth = document.getElementsByName('month');
        var picked_year = document.getElementsByName('year');
        var date = new Date();
        var firstDay = new Date(picked_year[0].value, picked_mounth[0].value-1, 1);
        var lastDay = new Date(picked_year[0].value, picked_mounth[0].value, 0);
        var final_firstDay = firstDay.getFullYear()+'-'+('0' + (firstDay.getMonth()+1)).slice(-2)+'-'+('0'+firstDay.getDate()).slice(-2);
        var final_lastDay = lastDay.getFullYear()+'-'+('0' + (lastDay.getMonth()+1)).slice(-2)+'-'+('0'+lastDay.getDate()).slice(-2);
        startDate[0].value = final_firstDay;
        endDate[0].value = final_lastDay;
    }

    function loadDoc() {
        var dateStart = document.getElementsByName('startDate');
        var dateEnd = document.getElementsByName('endDate');
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
         document.getElementById("showData").innerHTML = xhttp.responseText;
        }
      };
      xhttp.open("POST", "../exportTxt/calculate_sell", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("ds="+dateStart[0].value+"&de="+dateEnd[0].value);
    }
</script>
</body>
</html>
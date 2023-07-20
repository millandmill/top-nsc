<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class generate_pdf extends CI_Controller {
    
    public function generate_purchase() {
        $data['blank'] = "";        //intitial array $data

        if($_GET['purchase_paper']) {
            $id['purchase_paper'] = $_GET['purchase_paper'];        //if send model check same paper.
            $id['user_id'] = $this->session->userdata('user_id');
            $this->load->model('mol_purchase');
            $data['purchase'] = $this->mol_purchase->getPurchaseReport($id);
            
            //calculate total vat become baht.
            $vatPercent = (int)$data['purchase'][0]['product_vat'];
            $totalPrice = $data['purchase'][0]['product_total_real'];
            $totalVatBaht = (($vatPercent/100) * $totalPrice);
            
            $data['purchase'][0]['total_vat_baht'] = $totalVatBaht; 
        }
        
        if($_GET['type'] == "purchase") {
            $this->load->view('purchase_pdf', $data);
        }else if($_GET['type'] == "purchase_copy") {
            $this->load->view('purchase_copy_pdf', $data);
        }
        
    }
    
    public function generate_quotation() {
        $data['blank'] = "";
        
        if($_GET['quotation_paper']) {
            $id['quotation_paper'] = $_GET['quotation_paper'];
            $id['user_id'] = $this->session->userdata('user_id');
            $this->load->model('mol_quotation');
            $data['quotation'] = $this->mol_quotation->getQuotationReport($id);
            
            //calculate total vat become baht.
            $vatPercent = (int)$data['quotation'][0]['product_vat'];
            $totalPrice = $data['quotation'][0]['product_total_real'];
            $totalVatBaht = (($vatPercent/100) * $totalPrice);
            
            $data['quotation'][0]['total_vat_baht'] = $totalVatBaht;
            
        }
        
        if($_GET['type'] == "quotation") {
            $this->load->view('quotation_pdf', $data);
        }else if($_GET['type'] == "quotation_copy") {
            $this->load->view('quotation_copy_pdf', $data);
        }
        
    }
    
    public function generate_billingnote() {
        $data['blank'] = "";
        
        if($_GET['billingnote_paper']) {
            $id['billingnote_paper'] = $_GET['billingnote_paper'];
            $id['user_id'] = $this->session->userdata('user_id');
            $this->load->model('mol_billingnote');
            $data['billingnote'] = $this->mol_billingnote->getBillingnoteReport($id);
            
        }
        
        if($_GET['type'] == "billingnote") {
            $this->load->view('billingnote_pdf', $data);
        }else if($_GET['type'] == "billingnote_copy") {
            $this->load->view('billingnote_copy_pdf', $data);
        }
    }
    
    public function generate_receipt() {
        $data['blank'] = "";        //intitial array $data

        if($_GET['receipt_paper']) {
            $id['receipt_paper'] = $_GET['receipt_paper'];        //if send model check same paper.
            $id['user_id'] = $this->session->userdata('user_id');
            $this->load->model('mol_receipt');
            $data['receipt'] = $this->mol_receipt->getReceiptReport($id);
            
            //calculate total vat become baht.
            $vatPercent = (int)$data['receipt'][0]['product_vat'];
            $totalPrice = $data['receipt'][0]['product_total_real'];
            $totalVatBaht = (($vatPercent/100) * $totalPrice);
            
            $data['receipt'][0]['total_vat_baht'] = $totalVatBaht;
        }
        
        if($_GET['type'] == "receipt") {
            $this->load->view('receipt_pdf', $data);
        }else if($_GET['type'] == "receipt_copy") {
            $this->load->view('receipt_copy_pdf', $data);
        }
        
    }
    
    public function generate_invoice() {
        $data['blank'] = "";        //intitial array $data

        if($_GET['invoice_paper']) {
            $id['invoice_paper'] = $_GET['invoice_paper'];        //if send model check same paper.
            $id['user_id'] = $this->session->userdata('user_id');
            $this->load->model('mol_invoice');
            $data['invoice'] = $this->mol_invoice->getInvoiceReport($id);
            
            //calculate total vat become baht.
            $vatPercent = (int)$data['invoice'][0]['product_vat'];
            $totalPrice = $data['invoice'][0]['product_total_real'];
            $totalVatBaht = (($vatPercent/100) * $totalPrice);
            
            $data['invoice'][0]['total_vat_baht'] = $totalVatBaht;
  
        }
        
        if($_GET['type'] == "invoice") {
            $this->load->view('invoice_pdf', $data);
        }else if($_GET['type'] == "invoice_copy") {
            $this->load->view('invoice_copy_pdf', $data);
        }
        
    }
    
    /*
	function __construct() {
		parent::__construct();
        $this->load->library("Pdf");    //file Pdf in folder controllers/libraries
	}

	public function generate() {

    $data['blank'] = "";

    if($_GET['p_id']) {
        $id['purchase_id'] = $_GET['p_id'];
        $id['user_id'] = $this->session->userdata('user_id');
        $this->load->model('mol_purchase');
        $data['purchase'] = $this->mol_purchase->getPurchase($id);
        $data['company'] = $this->mol_purchase->getCompany($id['user_id']);
    }

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 
    // set document information
    $pdf->SetCreator('TOP-NSC');
    $pdf->SetAuthor('TOP-NSC');
    $pdf->SetTitle('Purchase');
    $pdf->SetSubject('Purchase PDF');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');  
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);


    //$pdf->setFooterData(array(0,64,0), array(0,64,128)); 

    // set header and footer fonts
    //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  

    // set default monospaced font
    //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 

    // set margins
    //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    

    // set auto page breaks
    //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

    // set image scale factor
    //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   

    // ---------------------------------------------------------    

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);   

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('thsarabun', '', 12);   

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 

    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>false, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

    $content = $this->purchasePDF($data);   

    // Set some content to print
    $html = <<<EOD
    <h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
    <i>This is the first example of TCPDF library.</i>
    <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
    <p>Please check the source code documentation and other examples for further information.</p>

EOD;
  
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);   
  
    // ---------------------------------------------------------    
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('example_001.pdf', 'I');    
  
    //============================================================+
    // END OF FILE
    //============================================================+

    }

    public function purchasePDF($data = array()) {
        DEFINE('PATH', base_url('uploads/img'));        //path folder image company logo.
        $path = PATH;
        
$html = <<<HTML
        <link href="{$path}/public/lib/css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{$path}/public/lib/bootstrap3.3.4/css/bootstrap-theme.css"/>
	<link rel="stylesheet" type="text/css" href="{$path}/public/lib/bootstrap3.3.4/css/bootstrap.css"/>
	<link rel="stylesheet" href="{$path}/public/lib/css/gridforms.css">
	<link rel="stylesheet" href="{$path}/public/lib/css/jquery-ui.css">
	<link rel="stylesheet" href="{$path}/public/lib/bootstrap3.3.4/css/datepicker.css">
        
        <button type="button" class="btn btn-default">Default</button>
        
        <center>
            <table border="1" style="width:100%;" cellpadding="1">
                <tr>
HTML;

                    //check company_logo in table company.
                    if(isset($data['company'][0]['company_logo'])) {
$html .= <<<HTML
                    <td align="center" style="width:10%;"><img src="{$path}/{$data['company'][0]['company_logo']}" /></td>
                    <td align="center" style="width:3%;"></td>
HTML;
                    }
                    
                    //check company_name in table purchase.
                    if(isset($data['purchase'][0]['company_name'])) {
$html .= <<<HTML
                    <td align="left" style="width:60%;"><div style="font-size:20px;">{$data['purchase'][0]['company_name']}</div>
                    
               
HTML;
                    }
                    
                    //check company_address in table purcahse.
                    if(isset($data['purchase'][0]['company_address_all'])) {
$html .= <<<HTML
                    <div>{$data['company'][0]['company_address']}</div>
                    </td>
HTML;
                    }

$html .= <<<HTML
                    <td align="right" style="width:27%;">dasd</td>
                            </tr>
                        </table>
                    </center>
HTML;
        
$html .= <<<HTML
       <table border="1" style="width:100%;" cellpadding="1">
                <tr>
                    <td align="center" style="width:10%;"><img src="{$path}/{$data['company'][0]['company_logo']}" /></td>
                    <td align="center" style="width:3%;"></td>
                    <td align="left" style="width:60%;"><font size="20px">{$data['company'][0]['company_name']}</font>
                        <br>{$data['company'][0]['company_address']}
                         </td>
                    <td align="right" style="width:27%;">dasd</td>
                </tr>
            </table> 
HTML;
    
    return $html;
    }
    */
}

?>
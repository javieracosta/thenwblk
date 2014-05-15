<?php 

	require_once('./tcpdf/config/lang/eng.php');
require_once('./tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 61 mm from bottom
        $this->SetY(-61);
        // Set font
        $this->SetFont('din1451std', 'I', 10);
        // Page number
        $cur_y = $this->y;
		//set style for cell border
		$line_width = (1 / $this->k);
		$this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => $this->footer_line_color));
		
		$w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';

		//Print page number
		$this->Cell(0,60,'THIS SPACE FOR CUSTOMER USE ONLY',0,0,'R');
		if ($this->getRTL()) {
			$this->SetX($this->original_rMargin);
			$this->Cell(0, 0, $pagenumtxt, 'T', 0, 'L');
		} else {
			$this->SetX($this->original_lMargin);
			$this->Cell(0, 0, $this->getAliasRightShift().$pagenumtxt, 'T', 0, 'R');
		}
	}
}

$designer = stripslashes(strtoupper($_POST['designer']));
$description = stripslashes($_POST['description']);
$item_name = stripslashes(strtoupper($_POST['item_name']));

$product_name = $_POST['item_name'];

$materials = stripslashes(strtoupper($_POST['materials']));
$retail_price = stripslashes(strtoupper($_POST['retail_price']));
$image_holder_url = $_POST['image_holder_url'];
$size = stripslashes(strtoupper($_POST['size']));
$lead_time = stripslashes(strtoupper($_POST['lead_time']));
// create new PDF document
$pdf = new MYPDF(P, PDF_UNIT, LETTER, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('THENWBLK');
$pdf->SetSubject('THENWBLK');
$pdf->SetKeywords('THENWBLK');


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$helvetican = $pdf->addTTFfont('./tcpdf/fonts/HelveticaNeueLight.ttf', 'TrueTypeUnicode', '', 10);
$pdf->SetFont('din1451std', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
$html = <<<EOD
<style>
body {
	width:100%;
}
img {
	height:310pt;
	max-width:8.5in;
}

</style>

<table>
<tr>
	<td align="center"><img src="$image_holder_url"/></td>
</tr>
</table>
EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
$pdf->setCellHeightRatio(1.7);
$html = <<<EOD
<table>
<tr>
	<td>&nbsp;</td>
	<td style="text-align:right;text-transform:uppercase;"><strong>$designer | $item_name</strong></td>
</tr>
<br/>
<tr>
	<td>&nbsp;</td>
	<td style="font-family:$helvetican;font-size:9pt;text-align:justify;">$description</td>
</tr>

</table>
<table>
<tr>
	<td style="font-size:14pt;">$retail_price</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>OPTIONS AVAILABLE</td>
	<td align="left" style="text-align:left;">LEAD TIME $lead_time</td>
	<td>$materials</td>
	<td align="right">SIZE SHOWN: $size</td>
</tr>
</table>
EOD;
// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='130', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);



$pdf->Image('../THENWBLK/images/NWBLK_logo.png',16,130,16,16,'PNG','http://www.thenwblk.com','',true,300,false,false,false,0,false,false,false);
$pdf->Image('../THENWBLK/images/header_lines.png',49,130,16,16,'PNG','http://www.thenwblk.com','',true,300,false,false,false,0,false,false,false);
$pdf->Image('../THENWBLK/images/tearsheet_copy.png',81,130,16,16,'PNG','http://www.thenwblk.com','',true,300,false,false,false,0,false,false,false);
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('THE NWBLK | '.$product_name, 'I');	

?>
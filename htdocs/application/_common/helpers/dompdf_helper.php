<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename, $stream=TRUE)
{
    require_once("dompdf/dompdf_config.inc.php");
    spl_autoload_register('DOMPDF_autoload');
/*	
$html = '<html><head>
<title>Prueba 2</title>
<style type="text/css">
body{
margin-top:400px;
margin-left:40px;
margin-right:40px;
margin-bottom:40px;
}
table th{
background-color:#333333;
color:#CCCCCC;
}
table{
border-collapse:collapse;
border:#c0c0c0 solid 1px;
}
table td{
text-align:center;
}
p{
text-align:justify;
}
h2{
color:#003366;
border-bottom:#003366 solid 3px;
}
</style>
</head>
<body>
<script type="text/php">
$header=$pdf->open_object();
$font = Font_Metrics::get_font("verdana", "bold");
$texto = "Google INC. 1600 Amphitheatre Parkway Mountain
 View CA 94043";
$hpagina = $pdf->get_height();
$wpagina = $pdf->get_width();
$wtexto = Font_Metrics::get_text_width($texto, $font, 14);
$pdf->image("http://www.google.com.pe/intl/en_com/images/logo_plain.png", "png", 40, 40, 200, 80);
$pdf->page_text($wpagina/2 - $wtexto/2, $hpagina-50, $texto,$font, 14, array(0,0,0));
$pdf->page_text($wpagina/2 , $hpagina-35, "{PAGE_NUM}" ,$font, 14, array(0,0,0));
$pdf->close_object();
$pdf->add_object($header, "all");
</script>
<h2>PDF con Header y Footer :</h2>
<br /><br />
<table border="0" align="center"
cellpadding="0" cellspacing="0">
  <tr>
        <th>header1</td>
        <th>header 2 </td>
        <th>header3</td>
  </tr>
  <tr>
    <td>1</td>
    <td>2</td>
    <td>2</td>
  </tr>
  <tr>
    <td>3</td>
    <td>5</td>
    <td>5</td>
  </tr>
  <tr>
    <td>6</td>
    <td>5</td>
    <td>8</td>
  </tr>
  <tr>
    <td>4</td>
    <td>8</td>
    <td>5</td>
  </tr>
  <tr>
    <td>6</td>
    <td>8</td>
    <td>9</td>
  </tr>
  <tr>
    <td>1</td>
    <td>2</td>
    <td>3</td>
  </tr>
</table>
<br />
<p>
<?php
for($a=1;$a<=50;$a++){
echo "Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
 In diam magna, tempus id, mattis at, nonummy";
}
?>
</p>

</body>
</html>';	
*/	
	
	
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
	$dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } 
	/*
	else {
        $CI =& get_instance();
        $CI->load->helper('file');
        write_file("./pdf/$filename.pdf", $dompdf->output());
    }
	*/
}
?> 
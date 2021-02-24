<?php
require('../../public/fpdf182/fpdf.php');
require('./htmlparser.inc');

class PDF_HTML_Table extends FPDF
{
protected $B;
protected $I;
protected $U;
protected $HREF;
private $nom;
private $adresse;
private $tel;
private $totalTTC;
private $totalHT;
private $lettre;
private $date;

public function setAdresse($adresse){
	$this->adresse = $adresse;
}
public function getAdresse(){
	return $this->adresse;
}

public function setDate($date){
	$this->date = $date;
}
public function getDate(){
	return $this->date;
}

public function setTel($tel){
	$this->tel = $tel;
}
public function getTel(){
	return $this->tel;
}

public function setTotalTTC($totalTTC){
	$this->totalTTC = $totalTTC;
}
public function getTotalTTC(){
	return $this->totalTTC;
}

public function setLettre($lettre){
	$this->lettre = $lettre;
}
public function getLettre(){
	return $this->lettre;
}

public function setTotalHT($totalHT){
	$this->totalHT = $totalHT;
}
public function getTotalHT(){
	return $this->totalHT;
}

public function setNom($nom){
	$this->nom = $nom;
}
public function getNom(){
	return $this->nom;
}


function __construct($orientation='P', $unit='mm', $format='A4')
{
	//Call parent constructor
	parent::__construct($orientation,$unit,$format);
	//Initialization
	$this->B=0;
	$this->I=0;
	$this->U=0;
	$this->HREF='';
}

	// En-tête
	function Header()
	{
		$logo = '../../public/image/logoChabs.png';
		// Logo
		$this->Image($logo,35,18,140,30);
		$this->Ln(30);
		$this->SetFont('Times','',10);
		$this->SetX(95);
		$this->Cell(20,25,'____________________________________________________________________',0,0,'C');
		$this->Ln(-1);
		$this->SetX(95);
		$this->Cell(20,25,'____________________________________________________________________',0,0,'C');
		
		$this->SetY(50);
		$this->SetFont('Times','',12);
		$this->SetX(170);
		$this->Cell(20,25,'Dakar, le '.$this->date,0,0,'R');

		$this->SetY(60);
		$this->SetFont('Times','B',18);
		$this->SetX(24);
		$this->Cell(20,25,utf8_decode('BON DE COMMANDE'),0,0,'L');
		$this->Rect(22,67,72,10);
		
		$this->SetY(75);
		$this->SetFont('Times','',12);
		$this->SetX(170);
		$this->Cell(20,25,utf8_decode('A : '.$this->getNom()),0,0,'R');
		$this->Ln(5);
		$this->SetX(170);
		$this->Cell(20,25,utf8_decode($this->getAdresse()),0,0,'R');
		$this->Ln(5);
		$this->SetX(170);
		$this->Cell(20,25,utf8_decode('Tel : '.$this->getTel()),0,0,'R');


		$this->Ln(30);
	}

	// Pied de page
	function Footer()
	{
	$this->SetY(-55);
	$this->SetX(167);
	$this->SetFont('Times','B',12);
	$this->Cell(15,25,utf8_decode("La Direction"),0,0,'L');
	$this->Ln(40);
	// Numéro de page
	$this->SetY(-25);
	$this->SetFont('Times','B',12);
	$this->Cell(0,10,'_________________________________________________________________________________',0,0,'C');
	$this->Ln(-2);
	$this->SetX(95);
	$this->SetFont('Times','',8);
	$this->Cell(15,25,'CHABS TRADING COMPANY',0,0,'C');
	$this->Ln(3);
	$this->SetX(95);
	$this->Cell(15,25,'Ouest Foire lot 13 Dakar',0,0,'C');
	$this->Ln(3);
	$this->SetX(95);
	$this->Cell(15,25,'Email : chabs.companytrading@gmail.com',0,0,'C');
	$this->Ln(3);
	$this->SetX(95);
	$this->Cell(15,25,'Tel : +221 77 630 22 11 / +221 33 820 37 04',0,0,'C');
	$this->Ln(3);
	$this->SetX(95);
	$this->Cell(15,25,utf8_decode('CBAO N° compte : SN012 01229 036198353701 52 - NINEA 005801966 2Y1'),0,0,'C');

}

	function RoundedRect($x, $y, $w, $h, $r, $round_corner = '1111', $style = '', $border_style = null, $fill_color = null) {
		if ('0000' == $round_corner) // Not rounded
			$this->Rect($x, $y, $w, $h, $style, $border_style, $fill_color);
		else { // Rounded
			if (!(false === strpos($style, 'F')) && $fill_color) {
				list($red, $g, $b) = $fill_color;
				$this->SetFillColor($red, $g, $b);
			}
			switch ($style) {
				case 'F':
					$border_style = null;
					$op = 'f';
					break;
				case 'FD': case 'DF':
				$op = 'B';
				break;
				default:
					$op = 'S';
					break;
			}
			if ($border_style)
				$this->SetLineStyle($border_style);

			$MyArc = 4 / 3 * (sqrt(2) - 1);

			$this->_Point($x + $r, $y);
			$xc = $x + $w - $r;
			$yc = $y + $r;
			$this->_Line($xc, $y);
			if ($round_corner[0])
				$this->_Curve($xc + ($r * $MyArc), $yc - $r, $xc + $r, $yc - ($r * $MyArc), $xc + $r, $yc);
			else
				$this->_Line($x + $w, $y);

			$xc = $x + $w - $r ;
			$yc = $y + $h - $r;
			$this->_Line($x + $w, $yc);

			if ($round_corner[1])
				$this->_Curve($xc + $r, $yc + ($r * $MyArc), $xc + ($r * $MyArc), $yc + $r, $xc, $yc + $r);
			else
				$this->_Line($x + $w, $y + $h);

			$xc = $x + $r;
			$yc = $y + $h - $r;
			$this->_Line($xc, $y + $h);
			if ($round_corner[2])
				$this->_Curve($xc - ($r * $MyArc), $yc + $r, $xc - $r, $yc + ($r * $MyArc), $xc - $r, $yc);
			else
				$this->_Line($x, $y + $h);

			$xc = $x + $r;
			$yc = $y + $r;
			$this->_Line($x, $yc);
			if ($round_corner[3])
				$this->_Curve($xc - $r, $yc - ($r * $MyArc), $xc - ($r * $MyArc), $yc - $r, $xc, $yc - $r);
			else {
				$this->_Line($x, $y);
				$this->_Line($x + $r, $y);
			}
			$this->_out($op);
		}
	}

	function _Point($x, $y) {
		$this->_out(sprintf('%.2F %.2F m', $x * $this->k, ($this->h - $y) * $this->k));
	}

	// Draws a line from last draw point
	// Parameters:
	// - x, y: End point
	function _Line($x, $y) {
		$this->_out(sprintf('%.2F %.2F l', $x * $this->k, ($this->h - $y) * $this->k));
	}

	// Draws a Bézier curve from last draw point
	// Parameters:
	// - x1, y1: Control point 1
	// - x2, y2: Control point 2
	// - x3, y3: End point
	function _Curve($x1, $y1, $x2, $y2, $x3, $y3) {
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c', $x1 * $this->k, ($this->h - $y1) * $this->k, $x2 * $this->k, ($this->h - $y2) * $this->k, $x3 * $this->k, ($this->h - $y3) * $this->k));
	}

	function SetLineStyle($style) {
		extract($style);
		if (isset($width)) {
			$width_prev = $this->LineWidth;
			$this->SetLineWidth($width);
			$this->LineWidth = $width_prev;
		}
		if (isset($cap)) {
			$ca = array('butt' => 0, 'round'=> 1, 'square' => 2);
			if (isset($ca[$cap]))
				$this->_out($ca[$cap] . ' J');
		}
		if (isset($join)) {
			$ja = array('miter' => 0, 'round' => 1, 'bevel' => 2);
			if (isset($ja[$join]))
				$this->_out($ja[$join] . ' j');
		}
		if (isset($dash)) {
			$dash_string = '';
			if ($dash) {
				$tab = explode(',', $dash);
				$dash_string = '';
				foreach ($tab as $i => $v) {
					if ($i > 0)
						$dash_string .= ' ';
					$dash_string .= sprintf('%.2F', $v);
				}
			}
			if (!isset($phase) || !$dash)
				$phase = 0;
			$this->_out(sprintf('[%s] %.2F d', $dash_string, $phase));
		}
		if (isset($color)) {
			list($r, $g, $b) = $color;
			$this->SetDrawColor($r, $g, $b);
		}
	}

	// Draws a line
	// Parameters:
	// - x1, y1: Start point
	// - x2, y2: End point
	// - style: Line style. Array like for SetLineStyle
	function Line($x1, $y1, $x2, $y2, $style = null) {
		if ($style)
			$this->SetLineStyle($style);
		parent::Line($x1, $y1, $x2, $y2);
	}


function WriteHTML2($html)
{
	//HTML parser
	$html=str_replace("\n",' ',$html);
	$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
	foreach($a as $i=>$e)
	{
		if($i%2==0)
		{
			//Text
			if($this->HREF)
				$this->PutLink($this->HREF,$e);
			else
				$this->Write(5,$e);
		}
		else
		{
			//Tag
			if($e[0]=='/')
				$this->CloseTag(strtoupper(substr($e,1)));
			else
			{
				//Extract attributes
				$a2=explode(' ',$e);
				$tag=strtoupper(array_shift($a2));
				$attr=array();
				foreach($a2 as $v)
				{
					if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
						$attr[strtoupper($a3[1])]=$a3[2];
				}
				$this->OpenTag($tag,$attr);
			}
		}
	}
}

function OpenTag($tag, $attr)
{
	//Opening tag
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,true);
	if($tag=='A')
		$this->HREF=$attr['HREF'];
	if($tag=='BR')
		$this->Ln(5);
	if($tag=='P')
		$this->Ln(10);
}

function CloseTag($tag)
{
	//Closing tag
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,false);
	if($tag=='A')
		$this->HREF='';
	if($tag=='P')
		$this->Ln(10);
}

function SetStyle($tag, $enable)
{
	//Modify style and select corresponding font
	$this->$tag+=($enable ? 1 : -1);
	$style='';
	foreach(array('B','I','U') as $s)
		if($this->$s>0)
			$style.=$s;
	$this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
	//Put a hyperlink
	$this->SetTextColor(0,0,255);
	$this->SetStyle('U',true);
	$this->Write(5,$txt,$URL);
	$this->SetStyle('U',false);
	$this->SetTextColor(0);
}

function WriteTable($data, $w)
{
	$this->SetLineWidth(.1);
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	$this->SetX(15);
	$ok = 0;
	$max = count($data);
	foreach($data as $row)
	{
		if($ok == ($max-1)){
			$this->SetFont('','B');
				$this->SetX(105);
				$nb=0;
				for($i=0;$i<count($row);$i++)
					$nb=max($nb,$this->NbLines($w[$i],trim($row[$i])));
				$h=5*$nb;
				$this->CheckPageBreak($h);
				for($i=0;$i<2;$i++)
				{	
					$x=$this->GetX();
					$y=$this->GetY();
					$this->Rect($x,$y,45,7,'D', null, array(204, 204, 204));
					$this->MultiCell($w[$i],5,trim($row[$i]),0,'C');
					//Put the position to the right of the cell
					$this->SetXY($x+45,$y);					
				}
				$this->Ln($h+2);
		}
		elseif($ok == ($max-2)){
			$this->SetFont('','B');
			$this->SetY($this->GetY()+2);
			$this->SetX(105);
			$nb=0;
			for($i=0;$i<count($row);$i++)
				$nb=max($nb,$this->NbLines($w[$i],trim($row[$i])));
			$h=5*$nb;
			$this->CheckPageBreak($h);
			for($i=0;$i<2;$i++)
			{	
				$x=$this->GetX();
				$y=$this->GetY();
				$this->Rect($x,$y,45,7,'D', null, array(204, 204, 204));
				$this->MultiCell($w[$i],5,trim($row[$i]),0,'C');
				//Put the position to the right of the cell
				$this->SetXY($x+45,$y);					
			}
			$this->Ln($h+2);
		}
		else{
			if($ok == 0){
				$this->SetFont('','B');
				$this->SetX(15);
				$nb=0;
				for($i=0;$i<count($row);$i++)
					$nb=max($nb,$this->NbLines($w[$i],trim($row[$i])));
				$h=5*$nb;
				$this->CheckPageBreak($h);
				for($i=0;$i<count($row);$i++)
				{	
					if($i == 0){
						$x=$this->GetX();
						$y=$this->GetY();
						$l = $w[$i]+25;
						$this->Rect($x,$y,$l,$h,'DF', null, array(204, 204, 204));
						$this->MultiCell($l,5,trim($row[$i]),0,'C');
						//Put the position to the right of the cell
						$this->SetXY($x+$l,$y);	
					}
					elseif($i == 1){
						$x=$this->GetX();
						$y=$this->GetY();
						$l = $w[$i]-25;
						$this->Rect($x,$y,$l,$h,'DF', null, array(204, 204, 204));
						$this->MultiCell($l,5,trim($row[$i]),0,'C');
						//Put the position to the right of the cell
						$this->SetXY($x+$l,$y);	
					}
					else{
						$x=$this->GetX();
						$y=$this->GetY();
						$this->Rect($x,$y,$w[$i],$h,'DF', null, array(204, 204, 204));
						$this->MultiCell($w[$i],5,trim($row[$i]),0,'C');
						//Put the position to the right of the cell
						$this->SetXY($x+$w[$i],$y);	
					}				
				}
				$this->Ln($h);
			}
			else{
				$this->SetFont('','');
				$this->SetX(15);
				$nb=0;
				for($i=0;$i<count($row);$i++)
					$nb=max($nb,$this->NbLines($w[$i],trim($row[$i])));
				$h=5*$nb;
				$this->CheckPageBreak($h);
				for($i=0;$i<count($row);$i++)
				{
					if($i == 0){
						$x=$this->GetX();
						$y=$this->GetY();
						$l = $w[$i]+25;
						$this->Rect($x,$y,$l,$h);
						$this->MultiCell($l,5,trim($row[$i]),0,'C');
						//Put the position to the right of the cell
						$this->SetXY($x+$l,$y);	
					}
					elseif($i == 1){
						$x=$this->GetX();
						$y=$this->GetY();
						$l = $w[$i]-25;
						$this->Rect($x,$y,$l,$h);
						$this->MultiCell($l,5,trim($row[$i]),0,'C');
						//Put the position to the right of the cell
						$this->SetXY($x+$l,$y);	
					}
					else{
						$x=$this->GetX();
						$y=$this->GetY();
						$this->Rect($x,$y,$w[$i],$h);
						$this->MultiCell($w[$i],5,trim($row[$i]),0,'C');
						//Put the position to the right of the cell
						$this->SetXY($x+$w[$i],$y);	
					}				
				}
				$this->Ln($h);
			}
		}
		$ok++;	
	}
	$lettre = $this->Conversion($this->totalTTC);
    $lettre = ucfirst($lettre).'francs';
    $text = "Arrêter le présent bon de commande à la somme de : $lettre";
	$this->SetX(15);
	$this->MultiCell(180,7,utf8_decode($text),0,'L');
}

function Rect($x, $y, $w, $h, $style = '', $border_style = null, $fill_color = null) {
	if (!(false === strpos($style, 'F')) && $fill_color) {
		list($r, $g, $b) = $fill_color;
		$this->SetFillColor($r, $g, $b);
	}
	switch ($style) {
		case 'F':
			$border_style = null;
			parent::Rect($x, $y, $w, $h, $style);
			break;
		case 'DF': case 'FD':
		if (!$border_style || isset($border_style['all'])) {
			if (isset($border_style['all'])) {
				$this->SetLineStyle($border_style['all']);
				$border_style = null;
			}
		} else
			$style = 'F';
		parent::Rect($x, $y, $w, $h, $style);
		break;
		default:
			if (!$border_style || isset($border_style['all'])) {
				if (isset($border_style['all']) && $border_style['all']) {
					$this->SetLineStyle($border_style['all']);
					$border_style = null;
				}
				parent::Rect($x, $y, $w, $h, $style);
			}
			break;
	}
	if ($border_style) {
		if (isset($border_style['L']) && $border_style['L'])
			$this->Line($x, $y, $x, $y + $h, $border_style['L']);
		if (isset($border_style['T']) && $border_style['T'])
			$this->Line($x, $y, $x + $w, $y, $border_style['T']);
		if (isset($border_style['R']) && $border_style['R'])
			$this->Line($x + $w, $y, $x + $w, $y + $h, $border_style['R']);
		if (isset($border_style['B']) && $border_style['B'])
			$this->Line($x, $y + $h, $x + $w, $y + $h, $border_style['B']);
	}
}

function NbLines($w, $txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 && $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function ReplaceHTML($html)
{
	$html = str_replace( '<li>', "\n<br> - " , $html );
	$html = str_replace( '<LI>', "\n - " , $html );
	$html = str_replace( '</ul>', "\n\n" , $html );
	$html = str_replace( '<strong>', "<b>" , $html );
	$html = str_replace( '</strong>', "</b>" , $html );
	$html = str_replace( '&#160;', "\n" , $html );
	$html = str_replace( '&nbsp;', " " , $html );
	$html = str_replace( '&quot;', "\"" , $html ); 
	$html = str_replace( '&#39;', "'" , $html );
	return $html;
}

function ParseTable($Table)
{
	$_var='';
	$htmlText = $Table;
	$parser = new HtmlParser ($htmlText);
	while ($parser->parse())
	{
		if(strtolower($parser->iNodeName)=='table')
		{
			if($parser->iNodeType == NODE_TYPE_ENDELEMENT)
				$_var .='/::';
			else
				$_var .='::';
		}

		if(strtolower($parser->iNodeName)=='tr')
		{
			if($parser->iNodeType == NODE_TYPE_ENDELEMENT)
				$_var .='!-:'; //opening row
			else
				$_var .=':-!'; //closing row
		}
		if(strtolower($parser->iNodeName)=='td' && $parser->iNodeType == NODE_TYPE_ENDELEMENT)
		{
			$_var .='#,#';
		}
		if ($parser->iNodeName=='Text' && isset($parser->iNodeValue))
		{
			$_var .= $parser->iNodeValue;
		}
	}
	$elems = explode(':-!',str_replace('/','',str_replace('::','',str_replace('!-:','',$_var)))); //opening row
	foreach($elems as $key=>$value)
	{
		if(trim($value)!='')
		{
			$elems2 = explode('#,#',$value);
			array_pop($elems2);
			$data[] = $elems2;
		}
	}
	return $data;
}

function WriteHTML($html)
{
	$html = $this->ReplaceHTML($html);
	//Search for a table
	$start = strpos(strtolower($html),'<table');
	$end = strpos(strtolower($html),'</table');
	if($start!==false && $end!==false)
	{
		$this->WriteHTML2(substr($html,0,$start).'<BR>');

		$tableVar = substr($html,$start,$end-$start);
		$tableData = $this->ParseTable($tableVar);
		for($i=1;$i<=count($tableData[0]);$i++)
		{
			if($this->CurOrientation=='L')
				$w[] = abs(120/(count($tableData[0])-1))+24;
			else
				$w[] = abs(120/(count($tableData[0])-1))+5;
		}
		$this->WriteTable($tableData,$w);

		$this->WriteHTML2(substr($html,$end+8,strlen($html)-1).'<BR>');
	}
	else
	{
		$this->WriteHTML2($html);
	}
}

///////////////////////////////////////CLASS CHIFFRE EN LETTRE/////////////////////////////////////////////////
//NE GERE PAS TOUT (les pluriels...)
#Variables
public $leChiffreSaisi;
public $enLettre='';
public $chiffre=array(1=>"un",2=>"deux",3=>"trois",4=>"quatre",5=>"cinq",6=>"six",7=>"sept",8=>"huit",9=>"neuf",10=>"dix",11=>"onze",12=>"douze",13=>"treize",14=>"quatorze",15=>"quinze",16=>"seize",17=>"dix-sept",18=>"dix-huit",19=>"dix-neuf",20=>"vingt",30=>"trente",40=>"quarante",50=>"cinquante",60=>"soixante",70=>"soixante-dix",80=>"quatre-vingt",90=>"quatre-vingt-dix");


#Fonction de conversion appelée dans la feuille principale
function Conversion($sasie)
{
$this->enLettre='';
$sasie=trim($sasie);

#suppression des espaces qui pourraient exister dans la saisie
$nombre='';
$laSsasie=explode(' ',$sasie);
foreach ($laSsasie as $partie)
$nombre.=$partie;

#suppression des zéros qui précéderaient la saisie
$nb=strlen($nombre);
for ($i=0;$i<=$nb;)
{
if(substr($nombre,$i,1)==0)
{
$nombre=substr($nombre,$i+1);
$nb=$nb-1;
}
elseif(substr($nombre,$i,1)<>0)
{
$nombre=substr($nombre,$i);
break;
}
}
#echo $nombre;
#$this->SupZero($nombre);
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($nombre);
#echo $nb.'<br/ >';
#$this->leChiffreSaisi=$nombre;
#conversion du chiffre saisi en lettre selon les cas
switch ($nb)
{
case 0:
$this->enLettre='zéro';
case 1:
if ($nombre==0)
{
$this->enLettre='zéro';
break;
}
elseif($nombre<>0)
{
$this->Unite($nombre);
break;
}

case 2:
$unite=substr($nombre,1);
$dizaine=substr($nombre,0,1);
$this->Dizaine(0,$nombre,$unite,$dizaine);
break;

case 3:
$unite=substr($nombre,2);
$dizaine=substr($nombre,1,1);
$centaine=substr($nombre,0,1);
$this->Centaine(0,$nombre,$unite,$dizaine,$centaine);
break;

#cas des milles
case ($nb>3 and $nb<=6):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,0,($nb-3));
$this->Mille($nombre,$unite,$dizaine,$centaine,$mille);
break;

#cas des millions
case ($nb>6 and $nb<=9):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,-6);
$million=substr($nombre,0,$nb-6);
$this->Million($nombre,$unite,$dizaine,$centaine,$mille,$million);
break;

#cas des milliards
/*case ($nb>9 and $nb<=12):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,-6);
$million=substr($nombre,-9);
$milliard=substr($nombre,0,$nb-9);
Milliard($nombre,$unite,$dizaine,$centaine,$mille,$million,$milliard);
break;*/

}
if (!empty($this->enLettre))
	return $this->enLettre;
}

#Gestion des miiliards
/*
function Milliard($nombre,$unite,$dizaine,$centaine,$mille,$million,$milliard)
{

}
*/

#Gestion des millions

function Million($nombre,$unite,$dizaine,$centaine,$mille,$million)
{
	#si les mille comportent un seul chiffre
	#$cent represente les 3 premiers chiffres du chiffre ex: 321 dans 12502321
	#$mille represente les 3 chiffres qui suivent les cents ex: 502 dans 12502321
	#reste represente les 6 premiers chiffres du chiffre ex: 502321 dans 12502321

	$cent=substr($nombre,-3);
	$reste=substr($nombre,-6);

	if (strlen($million)==1)
	{
	$mille=substr($nombre,1,3);
	$this->enLettre.=$this->chiffre[$million];
		if ($million == 1){
			$this->enLettre.=' million ';
		}else{
			$this->enLettre.=' millions ';
		}
	}
	elseif (strlen($million)==2)
	{
	$mille=substr($nombre,2,3);
	$nombre=substr($nombre,0,2);
	//echo $nombre;
	$this->Dizaine(0,$nombre,$unite,$dizaine);
	$this->enLettre.='millions ';
	}
	elseif (strlen($million)==3)
	{
	$mille=substr($nombre,3,3);
	$nombre=substr($nombre,0,3);
	$this->Centaine(0,$nombre,$unite,$dizaine,$centaine);
	$this->enLettre.='millions ';
	}

	#recuperation des cens dans nombre

	#suppression des zéros qui précéderaient le $reste
	$nb=strlen($reste);
	for ($i=0;$i<=$nb;)
	{
	if(substr($reste,$i,1)==0)
	{
	$reste=substr($reste,$i+1);
	$nb=$nb-1;
	}
	elseif(substr($reste,$i,1)<>0)
	{
	$reste=substr($reste,$i);
	break;
	}
	}
	$nb=strlen($reste);
	#si tous les chiffres apres les milions =000000 on affiche x million
	if ($nb==0)
	;
	else
	{
	#Gestion des milles
	#suppression des zéros qui précéderaient les milles dans $mille
	$nb=strlen($mille);
	for ($i=0;$i<=$nb;)
	{
	if(substr($mille,$i,1)==0)
	{
	$mille=substr($mille,$i+1);
	$nb=$nb-1;
	}
	elseif(substr($mille,$i,1)<>0)
	{
	$mille=substr($mille,$i);
	break;
	}
	}
	#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
	$nb=strlen($mille);
	#echo '<br />nb='.$nb.'<br />';
	if ($nb==0)
	;
	#AffichageResultat($enLettre);
	elseif ($nb==1)
	{
	if ($mille==1)
	$this->enLettre.='mille ';
	else
	{
	$this->Unite($mille);
	$this->enLettre.='mille ';
	}
	}
	elseif ($nb==2)
	{
	$this->Dizaine(1,$mille,$unite,$dizaine);
	$this->enLettre.='mille ';
	}
	elseif ($nb==3)
	{
	$this->Centaine(1,$mille,$unite,$dizaine,$centaine);
	$this->enLettre.='mille ';
	}
	#Gestion des cents
	#suppression des zéros qui précéderaient les cents dans $cent
	$nb=strlen($cent);
	for ($i=0;$i<=$nb;)
	{
	if(substr($cent,$i,1)==0)
	{
	$cent=substr($cent,$i+1);
	$nb=$nb-1;
	}
	elseif(substr($cent,$i,1)<>0)
	{
	$cent=substr($cent,$i);
	break;
	}
	}
	#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
	$nb=strlen($cent);
	#echo '<br />nb='.$nb.'<br />';
	if ($nb==0)
	;
	#AffichageResultat($enLettre);
	elseif ($nb==1)
	$this->Unite($cent);
	elseif ($nb==2)
	$this->Dizaine(0,$cent,$unite,$dizaine);
	elseif ($nb==3)
	$this->Centaine(0,$cent,$unite,$dizaine,$centaine);
	}
}

#Gestion des milles

function Mille($nombre,$unite,$dizaine,$centaine,$mille)
{
	#si les mille comportent un seul chiffre
	#$cent represente les 3 premiers chiffres du chiffre ex: 321 dans 12321
	if (strlen($mille)==1)
	{
	$cent=substr($nombre,1);
	#si ce chiffre=1
	if ($mille==1)
	$this->enLettre.='';
	#si ce chiffre<>1
	elseif($mille<>1)
	$this->enLettre.=$this->chiffre[$mille];
	}
	elseif (strlen($mille)>1)
	{
	if (strlen($mille)==2)
	{
	$cent=substr($nombre,2);
	$nombre=substr($nombre,0,2);
	#echo $nombre;
	$this->Dizaine(1,$nombre,$unite,$dizaine);
	}
	if (strlen($mille)==3)
	{
	$cent=substr($nombre,3);
	$nombre=substr($nombre,0,3);
	#echo $nombre;
	$this->Centaine(1,$nombre,$unite,$dizaine,$centaine);
	}
	}

	$this->enLettre.='mille ';
	#recuperation des cens dans nombre
	#suppression des zéros qui précéderaient la saisie
	$nb=strlen($cent);
	for ($i=0;$i<=$nb;)
	{
	if(substr($cent,$i,1)==0)
	{
	$cent=substr($cent,$i+1);
	$nb=$nb-1;
	}
	elseif(substr($cent,$i,1)<>0)
	{
	$cent=substr($cent,$i);
	break;
	}
	}
	#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
	$nb=strlen($cent);
	#echo '<br />nb='.$nb.'<br />';
	if ($nb==0)
	;//AffichageResultat($enLettre);
	elseif ($nb==1)
	$this->Unite($cent);
	elseif ($nb==2)
	$this->Dizaine(0,$cent,$unite,$dizaine);
	elseif ($nb==3)
	$this->Centaine(0,$cent,$unite,$dizaine,$centaine);

}

#Gestion des centaines

function Centaine($inmillier,$nombre,$unite,$dizaine,$centaine)
{
	$unite=substr($nombre,2);
	$dizaine=substr($nombre,1,1);
	$centaine=substr($nombre,0,1);
	#comme 700
	if ($unite==0 and $dizaine==0)
	{
		if ($centaine==1)
		$this->enLettre.='cent';
		elseif ($centaine<>1)
		{
			if ($inmillier == 0)
				$this->enLettre.=($this->chiffre[$centaine].' cents').' ';
			if ($inmillier == 1)
				$this->enLettre.=($this->chiffre[$centaine].' cent').' ';
		}
	}
	#comme 705
	elseif ($unite<>0 and $dizaine==0)
	{
		if ($centaine==1)
		$this->enLettre.=('cent '.$this->chiffre[$unite]).' ';
		elseif ($centaine<>1)
		$this->enLettre.=($this->chiffre[$centaine].' cent '.$this->chiffre[$unite]).' ';
	}
	//comme 750
	elseif ($unite==0 and $dizaine<>0)
	{
		#recupération des dizaines
		$nombre=substr($nombre,1);
		//echo '<br />nombre='.$nombre.'<br />';
		if ($centaine==1)
		{
		$this->enLettre.='cent ';
		$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
		}
		elseif ($centaine<>1)
		{
		$this->enLettre.=$this->chiffre[$centaine].' cent ';
		$this->Dizaine(0,$nombre,$unite,$dizaine).' ';

		}

	}
	#comme 695
	elseif ($unite<>0 and $dizaine<>0)
	{
		$nombre=substr($nombre,1);

		if ($centaine==1)
		{
		$this->enLettre.='cent ';
		$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
		}

		elseif ($centaine<>1)
		{
			$this->enLettre.=($this->chiffre[$centaine].' cent ');
			$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
		}
	}
}


#Gestion des dizaines

function Dizaine($inmillier,$nombre,$unite,$dizaine)
{
	$unite=substr($nombre,1);
	$dizaine=substr($nombre,0,1);

	#comme 70
	if ($unite==0)
	{
	$val=$dizaine.'0';
	$this->enLettre.=$this->chiffre[$val];
			if ($inmillier == 0 && $val == 80){
				$this->enLettre.='s ';
			}
			$this->enLettre.=' ';
	}
	#comme 71
	elseif ($unite<>0)
	#dizaine different de 9
	if ($dizaine<>9 and $dizaine<>7)
	{
	if ($dizaine==1)
	{
	$val=$dizaine.$unite;
	$this->enLettre.=$this->chiffre[$val].' ';
	}
	else
	{
	$val=$dizaine.'0';
	if ($unite == 1 && $dizaine <> 8){
	$this->enLettre.=($this->chiffre[$val].' et '.$this->chiffre[$unite]).' ';
	}else{
	$this->enLettre.=($this->chiffre[$val].'-'.$this->chiffre[$unite]).' ';
	}
	}
	}
	#dizaine =9
	elseif ($dizaine==9)
	$this->enLettre.=($this->chiffre[80].'-'.$this->chiffre['1'.$unite]).' ';
	elseif ($dizaine==7)
	{
	if ($unite == 1){
		$this->enLettre.=($this->chiffre[60].' et '.$this->chiffre['1'.$unite]).' ';
	}else{
		$this->enLettre.=($this->chiffre[60].'-'.$this->chiffre['1'.$unite]).' ';
	}
	}
}
#Gestion des unités

function Unite($unite)
{
	$this->enLettre.=($this->chiffre[$unite]).' ';
}

}
?>

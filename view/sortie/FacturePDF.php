<?php
require('../../public/fpdf182/fpdf.php');

class FacturePDF extends FPDF
{
    protected $ProcessingTable=false;
    protected $aCols=array();
    protected $TableX;
    protected $HeaderColor;
    protected $RowColors;
    protected $ColorIndex;

    // En-tête
    function Header()
    {
        $logo = '../../public/image/logoc.pdf';
        // Logo
        $this->Image($logo,18,18,50);
        // Police Arial gras 15
        $this->SetFont('Times','B',10);
        // Décalage à droite
        $this->Cell(151);
        // Titre
        $this->Cell(20,25,'BON DE COMMANDE',0,0,'C');

        // Saut de ligne
        $this->SetFont('Times','',12);
        $this->Ln(15);
        $this->SetX(24);
        $this->Cell(20,25,utf8_decode('N° commande :    '),0,0,'C');
        $this->SetFont('Times','B',11);
        $this->Cell(20,25,'          CMD-00025',0,0,'C');
        $this->SetX(170);
        $this->SetFont('Times','',12);
        $this->Cell(20,25,'Date: 30/03/2020',0,0,'R');
        $this->Ln(2);
        $this->SetX(34);
        $this->SetFont('Times','',10);
        $this->Cell(20,25,'------------------------------------------',0,0,'C');

        $this->Ln(2);
        $this->SetFont('Times','',8);
        $this->SetX(36);
        $this->Cell(20,25,utf8_decode('Le numéro  ci-dessus doit apparaître sur toute la'),0,0,'C');
        $this->Ln(2);
        $this->SetX(47);
        $this->Cell(15,25,'correspondance annexe, les papiers de livraisons et les factures',0,0,'C');

        $this->Ln(9);
        $this->SetFont('Times','',12);
        $this->SetX(23);
        $this->Cell(15,25,utf8_decode('Coordonnées :'),0,0,'C');
        $this->Ln(-1);
        $this->SetX(17);
        $this->SetFont('Times','',20);
        $this->Cell(15,25,'______________',0,0,'L');

        $this->SetX(175);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'Fournisseur :',0,0,'R');
        $this->Ln(-1);
        $this->SetX(175);
        $this->SetFont('Times','',20);
        $this->Cell(15,25,'______________',0,0,'R');


        $this->Ln(8);
        $this->SetX(22);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'Diafara Tech',0,0,'C');

        $this->SetX(175);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'Amadou Ndiaye',0,0,'R');


        $this->Ln(6);
        $this->SetX(22);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'Grand Mbao',0,0,'C');

        $this->SetX(175);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'Keur Massar',0,0,'R');


        $this->Ln(6);
        $this->SetX(28);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,utf8_decode('932, Dakar Sénégal'),0,0,'C');

        $this->SetX(175);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,utf8_decode('984, Rufisque Sénégal'),0,0,'R');

        $this->Ln(6);
        $this->SetX(21);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'778633314',0,0,'C');

        $this->SetX(175);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'784521035',0,0,'R');

        $this->Ln(6);
        $this->SetX(33);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'diafaradiallo@gmail.com',0,0,'C');

        $this->SetX(175);
        $this->SetFont('Times','',12);
        $this->Cell(15,25,'ndiayeamadou@gmail.com',0,0,'R');

        $this->Ln(23);
        $this->SetX(95);
        $this->SetFont('Times','BU',13);
        $this->Cell(15,25,utf8_decode('Article(s) commandé(s)'),0,0,'C');


        $this->Ln(18);
    }

// Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-35);
        // Police Arial italique 8
        $this->SetFont('Times','',20);
        // Numéro de page
        $this->Cell(0,10,'________________________________________________',0,0,'C');
        $this->Ln(-2);
        $this->SetX(19);
        $this->SetFont('Times','',8);
        $this->Cell(15,25,'1. Veuillez envoyer deux copies de votre facture',0,0,'L');
        $this->Ln(3);
        $this->SetX(19);
        $this->Cell(15,25,utf8_decode('2. Entrez cette commande conformément aux tarifs, aux conditions, à la méthode de livraison'),0,0,'L');

        $this->SetY(-35);
        $this->Ln(4);
        $this->SetFont('Times','',8);
        $this->SetX(19);
        $this->Cell(15,25, utf8_decode(' et aux spécifications répertoriées ci-dessus. '),0,0,'L');
        $this->Ln(3);
        $this->SetX(19);
        $this->Cell(15,25,utf8_decode('3. Veuillez nous informer immédiatement si vous n\'êtes pas en mesure d\'expédier la commande telle que spécifiée.'),0,0,'L');
    }

    function TableHeader()
    {
        $this->SetFont('Arial','B',12);
        //$this->SetX($this->TableX);
        $this->SetX(20);
        $fill=!empty($this->HeaderColor);
        if($fill)
            $this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
        foreach($this->aCols as $col)
            $this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
        $this->Ln();
    }

    function Row($data)
    {
        //$this->SetX($this->TableX);
        $this->SetX(20);
        $ci=$this->ColorIndex;
        $fill=!empty($this->RowColors[$ci]);
        if($fill)
            $this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
        foreach($this->aCols as $col)
            $this->Cell($col['w'],5,$data[$col['f']],1,0,$col['a'],$fill);
        $this->Ln();
        $this->ColorIndex=1-$ci;
    }

    function CalcWidths($width, $align)
    {
        // Compute the widths of the columns
        $TableWidth=0;
        foreach($this->aCols as $i=>$col)
        {
            $w=$col['w'];
            if($w==-1)
                $w=$width/count($this->aCols);
            elseif(substr($w,-1)=='%')
                $w=$w/100*$width;
            $this->aCols[$i]['w']=$w;
            $TableWidth+=$w;
        }
        // Compute the abscissa of the table
        if($align=='C')
            $this->TableX=max(($this->w-$TableWidth)/2,0);
        elseif($align=='R')
            $this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
        else
            $this->TableX=$this->lMargin;
    }

    function AddCol($field=-1, $width=-1, $caption='', $align='C')
    {
        // Add a column to the table
        if($field==-1)
            $field=count($this->aCols);
        $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
    }

    function Table($link, $query, $prop=array())
    {
        // Execute query
        $res=mysqli_query($link,$query) or die('Error: '.mysqli_error($link)."<br>Query: $query");
        // Add all columns if none was specified
        if(count($this->aCols)==0)
        {
            //Gestion taille colonnes
            $nb=mysqli_num_fields($res);
            for($i=0;$i<$nb;$i++){
                if ($i==0)
                $this->AddCol(-1,35);
                if ($i==1)
                    $this->AddCol(-1,68);
                if ($i==2)
                    $this->AddCol(-1,40);
                if ($i==3)
                    $this->AddCol(-1,25);
            }

        }
        // Retrieve column names when not specified
        foreach($this->aCols as $i=>$col)
        {
            if($col['c']=='')
            {
                if(is_string($col['f']))
                    $this->aCols[$i]['c']=ucfirst($col['f']);
                else
                    $this->aCols[$i]['c']=ucfirst(mysqli_fetch_field_direct($res,$col['f'])->name);
            }
        }
        // Handle properties
        if(!isset($prop['width']))
            $prop['width']=0;
        if($prop['width']==0)
            $prop['width']=$this->w-$this->lMargin-$this->rMargin;
        if(!isset($prop['align']))
            $prop['align']='C';
        if(!isset($prop['padding']))
            $prop['padding']=$this->cMargin;
        $cMargin=$this->cMargin;
        $this->cMargin=$prop['padding'];
        if(!isset($prop['HeaderColor']))
            $prop['HeaderColor']=array();
        $this->HeaderColor=$prop['HeaderColor'];
        if(!isset($prop['color1']))
            $prop['color1']=array();
        if(!isset($prop['color2']))
            $prop['color2']=array();
        $this->RowColors=array($prop['color1'],$prop['color2']);
        // Compute column widths
        $this->CalcWidths(170,$prop['align']);
        // Print header
        $this->TableHeader();
        // Print rows
        $this->SetFont('Times','',12);
        $this->ColorIndex=0;
        $this->ProcessingTable=true;
        while($row=mysqli_fetch_array($res))
            $this->Row($row);
        $this->ProcessingTable=false;
        $this->cMargin=$cMargin;
        $this->aCols=array();
    }
}
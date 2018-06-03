<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-04-17
 * Time: 13:50
 */


namespace controlleur;

require_once dirname(__DIR__)."/phpToPDF/fpdf.php";
require_once dirname(__DIR__)."/phpToPDF/phpToPDF.php";


class PDF extends \FPDF
{
    // En-tête
    function Header()
    {

        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        // Décalage à droite
        $this->Cell(80);
        // Titre
       // $dateFinal = strftime('%d-%m-%y', strtotime(date("Y/m/j")));
        //$this->Cell(30,10,'horaire de la semaine  ','C');
        // Saut de ligne
        $this->Ln(20);
    }
// Chargement des données
    function LoadData($file)
    {
        // Lecture des lignes du fichier
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }


// Tableau coloré
    function FancyTable($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // En-tête
        $w = array(50, 50, 50, 50);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Données
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
            $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
    }
}
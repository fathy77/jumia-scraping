<?php

namespace App\Http\Controllers;
use Goutte ;
use Illuminate\Support\Facades\Route;
use Spatie\SimpleExcel\SimpleExcelWriter;
use OpenSpout\Writer\Common\Creator\Style\StyleBuilder;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Writer\Common\Creator\Style\BorderBuilder;

use Illuminate\Http\Request;

class scrapingController extends Controller
{


    public function scrp() {




        $data =[];
        $index=0;

        $crawler = Goutte::request('GET', 'https://www.jumia.com.eg/mobile-phones/');
        $crawler->filter('.-paxs article a ')->each(function ($node)use(&$index,&$data) {


          //  dump($node->attr('data-name') .': '. $node->attr('data-price'));
    //  $phone = new phone();

    $node->filter('.info .name')->each(function ($name)use(&$index,&$data)  {
        $data[$index]['name']=$name->text();
    });

    $node->filter('.info .prc')->each(function ($price)use(&$index,&$data)  {
        $data[$index]['price']=$price->text();
    });

    $node->filter('.img-c .img')->each(function ($img)use(&$index,&$data)  {
          //  $data[$index]={'img':,'price':$pric,'nam':$nam};
          $data[$index]['img']=$img->attr('data-src');
    });

    $index++;


        });




    //





    return View('data',compact('data'));
    }



public function export_report_sheet (Request $request){

$name =$request->name;
$price =$request->price;
$type=$request->typ;


//dd($data);
    $border = (new BorderBuilder())
    ->setBorderBottom(Color::GREEN, Border::WIDTH_THIN, Border::STYLE_DASHED)

    ->build();





$style = (new StyleBuilder())
    ->setFontBold()
    ->setFontSize(10)
    ->setFontColor(Color::RED)
    ->setShouldWrapText()->setBorder($border)
    ->setBackgroundColor(Color::BLACK)->setFormat('50.000')
    ->build();
    //$writer= SimpleExcelWriter::streamDownload('your-export.xlsx')->addRow(['values', 'of', 'the', 'row'], $style);
  //  $writer->setHeaderStyle($style);
//dd($type);
  $writer = SimpleExcelWriter::streamDownload('your-rebort.'.$type);
  for($index =0; $index<count($name); $index++ ){
$writer->addRow([
    'the name of the phone' => $name[$index],
    'price' => $price[$index],
],$style);



  }

   $writer->toBrowser();




}

}

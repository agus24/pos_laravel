<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    private $roms = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);

    public function romanic_number($angka)
    { 
        $return = '';
        while($angka > 0)
        { 
            foreach($this->roms as $rom=>$arb) 
            {
                if($angka >= $arb) 
                { 
                    $angka -= $arb; 
                    $return .= $rom; 
                    break; 
                }
            }
        }

        return $return; 
    }

    public function formatZeroNumber($number,$nol)
    {
      $jumlah_nol = pow(10,$nol);
      $total = '';
      $arrs = array();
      for($jumlah_nol; $jumlah_nol > $number*10 ; $jumlah_nol/=10)
      {
        $total .= '0';
      }

      $total .= $number;
      return $total;
    }
}
<?php

namespace Nodopiano\Corda;

use Keboola\Csv\CsvFile;

/**
 * Class NewsLetter
 * @author Marco Bonomo
 * @package Corda
 */

class Csv
{

  public static function export($data = array(), $filename = 'export.csv')
  {
    $csvFile = new CsvFile(__DIR__ .'/storage/csv/'.$filename);
    $rows = array();
    // Dopo aver letto il file, aggiungo IN UNA NUOVA RIGA i nuovi valori del form.
    foreach ($csvFile as $row) {
      array_push($rows, $row);
    }
    array_push ($rows, $data);
    $csvFile2 = new CsvFile(__DIR__ .'/storage/csv/'.$filename.'.tmp');
    foreach ($rows as $row) {
      $csvFile2->writeRow($row);
    }
    // Sovrascrivo il file di partenza con quello temporaneo che ho appena scritto.
    rename(__DIR__ .'/assets/csv/'.$filename.'.tmp', __DIR__ .'/assets/csv/'.$filename);
  }
}

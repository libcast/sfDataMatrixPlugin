<?php
/*
 * This file is part of the Libcast sfDataMatrix plugin.
 * 
 * (c) 2011 Libcast SAS (www.libcast.com)
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Generate a DataMatrix for the specified string
 * 
 * 
 * @param string $str String to encode
 * @param string $filename Target path to put the geneerated image
 * @param boolean $replaceIfExist Replace the target path file if it exists already
 * @return string
 */
function datamatrix($str, $filename = null, $replaceIfExist = false, $options = array())
{
  if (is_null($filename))
  {
    $return_value = '/uploads/datamatrix/'.md5($str).'.png';
    $filename = sfConfig::get('sf_web_dir').$return_value;
  }
  else
  {
    $return_value = $filename;
  }
  if (!file_exists($dir = dirname($filename)))
  {
    mkdir($dir, 0755, true);
  }

  if (file_exists($filename) && !$replaceIfExist)
  {
    return $return_value;
  }

  return sfDataMatrix::encode($str)->to($filename, $options) ? $return_value : false;
}
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
 * sfDataMatrix Class
 *
 * This provides support for data matrix
 *
 * @package   sfDataMatrixPlugin
 * @author    Keven Godet <keven@libcast.com>
 * @link      http://en.wikipedia.org/wiki/Data_matrix_(computer)
 * @link      http://github.com/libcast/sfDataMatrixPlugin
 */
class sfDataMatrix
{
  /** @var string */
  protected $str;

  /**
   *
   * @param string $str 
   */
  public function __construct($str)
  {
    $this->str = $str;
  }

  /**
   *
   * @param string $str
   * @return sfDataMatrix 
   */
  public static function encode($str)
  {
    return new sfDataMatrix($str);
  }

  /**
   *
   * @param string $path
   * @param array $options
   * @return string|boolean 
   */
  public function to($path, $options = array())
  {
    $optionString = '';
    foreach ($options as $name => $value)
    {
      $optionString .= ' --'.$name.'='.$value;
    }
    $command = sprintf('printf "%s" | dmtxwrite -o %s %s', $this->str, $path, $optionString);
    exec($command);

    return file_exists($path) ? $path : false;
  }
}
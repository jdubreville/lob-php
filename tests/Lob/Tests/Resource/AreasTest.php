<?php

/*
 * This file is part of the Lob.com PHP Client.
 *
 * (c) 2013 Lob.com, https://www.lob.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lob\Tests\Resource;

class AreasTest extends \Lob\Tests\ResourceTest
{
  protected $resourceMethodName = 'areas';

  public function testCreateWithRoutes()
  {
      $area = $this->resource->create(array(
          'name' => 'Demo Area job', // Required
          'front' => 'https://www.lob.com/areafront.pdf',
          'back' => 'https://www.lob.com/areaback.pdf',
          'routes' => '94158-C001',
          'target_type' => 'all',
          'full_bleed' => '1'
      ));

      $this->assertTrue(is_array($area));
      $this->assertTrue(array_key_exists('id', $area));
  }

  public function testGetArea()
  {
      $area = $this->resource->retrieve('area_350e47ace201ee4');
      $this->assertEquals($area['id'], 'area_350e47ace201ee4');
  }
}

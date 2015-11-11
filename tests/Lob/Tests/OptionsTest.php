<?php

/*
 * This file is part of the Lob.com PHP Client.
 *
 * (c) 2013 Lob.com, https://www.lob.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lob\Tests;

use Lob\Lob;
use Lob\Exception\ValidationException;

class OptionsTest extends \PHPUnit_Framework_TestCase
{
	protected $lob;


	protected function setUp()
    {
        $this->lob = new Lob('test_0dc8d51e0acffcb1880e0f19c79b2f5b0cc');
    }

/*
    public function testLowConnectionTimeout()
    {
   		$this->lob->setOptions(array(
   			"request" => array(
   				"connection_timeout" => 1
   			)
   		));

   		// Try to get settings.  Should timeout due to low connection timeout
   		$this->lob->settings()->all(array(
            'count' => 1
        ));

    }
 */

    /**
    * Attempt to test a Low timeout.  This will hopefully cause a Curl Exception 
    * because the response took longer than 1 second to come back.  This may work if the 
    * response is too fast. 
    */
    public function testLowTimeout()
    {
    	$this->setExpectedException('CurlException');
   		

   		$this->lob->setOptions(array(
   			"request" => array(
   				"timeout" => 1
   			)
   		));
		
		try
		{
   		// Try to get settings.  Should timeout due to low connection timeout
   		$output = $this->lob->settings()->all();
   		print_r($output);
   		}
   		catch(\Exception $ex)
   		{
   			print_r($ex->getMessage());
   			die();
   		}
   		die();
    }

    /**
    * @group versioning
    */
    public function testVersionHeader()
    {
        // Should break because the lob version is no longer supported.  But does allow the user to change the version
        $this->setExpectedException('Lob\Exception\ValidationException');

        $this->lob->setOptions(array(
            "request" => array(
                "headers" => array(
                    "Lob-Version" => "2015-04-11"
                  )
              )
        ));

        $output = $this->lob->checks()->create(array(
          'description'       => 'Demo Check',
          'to[name]'          => 'Harry Zhang',
          'to[address_line1]' => '123 Test Street',
          'to[address_city]'  => 'Mountain View',
          'to[address_zip]'   => '94041',
          'to[address_state]' => 'CA',
          'from'              => 'adr_eae4448bb64c07f0',
          'bank_account'      => 'bank_8cad8df5354d33f',
          'amount'            => 2200,
          'memo'              => 'rent',
          'logo'              => 'https://s3-us-west-2.amazonaws.com/lob-assets/lob_check_logo.png',
          'file'              => '<h1 style="padding-top:4in;">Demo Check for {{name}}</h1>',
          'data[name]'        => 'Harry'
        ));
    }
}
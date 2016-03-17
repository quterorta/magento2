<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Elasticsearch\Test\Unit\Model\Adapter\Index\Config;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

class SchemaLocatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $moduleReaderMock;

    /**
     * @var \Magento\Elasticsearch\Model\Adapter\Index\Config\SchemaLocator
     */
    protected $model;

    /**
     * Set up test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->moduleReaderMock = $this->getMock('Magento\Framework\Module\Dir\Reader', [], [], '', false);
        $this->moduleReaderMock->expects(
            $this->any()
        )->method(
            'getModuleDir'
        )->with(
            'etc',
            'Magento_Elasticsearch'
        )->will(
            $this->returnValue('schema_dir')
        );

        $objectManager = new ObjectManagerHelper($this);
        $this->model = $objectManager->getObject(
            '\Magento\Elasticsearch\Model\Adapter\Index\Config\SchemaLocator',
            [
                'moduleReader' => $this->moduleReaderMock
            ]
        );
    }

    /**
     * Test getSchema() method.
     */
    public function testGetSchema()
    {
        $this->assertEquals('schema_dir/esconfig.xsd', $this->model->getSchema());
    }

    /**
     * Test getPerFileSchema() method.
     */
    public function testGetPerFileSchema()
    {
        $this->assertEquals('schema_dir/esconfig.xsd', $this->model->getPerFileSchema());
    }
}

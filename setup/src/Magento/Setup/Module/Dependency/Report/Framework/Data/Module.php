<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Setup\Module\Dependency\Report\Framework\Data;

/**
 * Testmodule
 */
class Module
{
    /**
     * Testmodule name
     *
     * @var string
     */
    protected $name;

    /**
     * Testmodule dependencies
     *
     * @var \Magento\Setup\Module\Dependency\Report\Framework\Data\Dependency[]
     */
    protected $dependencies;

    /**
     * Testmodule construct
     *
     * @param array $name
     * @param \Magento\Setup\Module\Dependency\Report\Framework\Data\Dependency[] $dependencies
     */
    public function __construct($name, array $dependencies = [])
    {
        $this->name = $name;
        $this->dependencies = $dependencies;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get dependencies
     *
     * @return \Magento\Setup\Module\Dependency\Report\Framework\Data\Dependency[]
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * Get total dependencies count
     *
     * @return int
     */
    public function getDependenciesCount()
    {
        return count($this->dependencies);
    }
}

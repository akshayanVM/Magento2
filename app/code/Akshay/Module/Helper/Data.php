<?php
// app/code/Vendor/Module/Helper/Data.php

namespace Akshay\Module\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $valueToPass;

    /**
     * Set the value to be passed to the model
     *
     * @param mixed $value
     * @return $this
     */
    public function setValueToPass($value)
    {
        $this->valueToPass = $value;
        return $this;
    }

    /**
     * Get the value to be passed to the model
     *
     * @return mixed
     */
    public function getValueToPass()
    {
        return $this->valueToPass;
    }
}

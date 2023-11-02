<?php

namespace SampleStore\Storemodule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class StoreInfo extends Template
{
    protected $storeManager;

    public function __construct(
        Template\Context $context,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
    }

    public function getStoreInformation()
    {
        $currentStore = $this->storeManager->getStore();

        // Get store ID, code, and name
        $storeId = $currentStore->getId();
        $storeCode = $currentStore->getCode();
        $storeName = $currentStore->getName();

        // Get store's website information
        $website = $currentStore->getWebsite();
        $websiteId = $website->getId();
        $websiteCode = $website->getCode();
        $websiteName = $website->getName();

        // Get store's group information
        $storeGroup = $currentStore->getGroup();
        $storeGroupId = $storeGroup->getId();
        $storeGroupCode = $storeGroup->getCode();
        $storeGroupName = $storeGroup->getName();
?>
        <table border="1">
            <tr>
                <th>Property</th>
                <th>Value</th>
            </tr>
            <?php
            // Output the store information

            echo "<tr><td>Store ID</td><td>$storeId</td></tr>";
            echo "<tr><td>Store Code</td><td>$storeCode</td></tr>";
            echo "<tr><td>Store Name</td><td>$storeName</td></tr>";
            echo "<tr><td>Website ID</td><td>$websiteId</td></tr>";
            echo "<tr><td>Website Code</td><td>$websiteCode</td></tr>";
            echo "<tr><td>Website Name</td><td>$websiteName</td></tr>";
            echo "<tr><td>Store Group ID</td><td>$storeGroupId</td></tr>";
            echo "<tr><td>Store Group Code</td><td>$storeGroupCode</td></tr>";
            echo "<tr><td>Store Group Name</td><td>$storeGroupName</td></tr>";
            ?>
        </table>
<?php
    }
}
?>
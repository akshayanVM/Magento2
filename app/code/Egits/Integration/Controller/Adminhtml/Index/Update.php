<?php

namespace Egits\Integration\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Egits\Integration\Model\PostFactory;
use Egits\Integration\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class Update extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @var PostResource
     */
    protected $postResource;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Used to call the collection
     *
     * @var PostFactory
     */
    protected $collectionFactory;

    /**
     * Update constructor.
     *
     * @param Context $context
     * @param PostResource $postResource
     * @param PageFactory $resultPageFactory
     * @param PostFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        PostResource $postResource,
        PageFactory $resultPageFactory,
        PostFactory $collectionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->collectionFactory = $collectionFactory;
        $this->postResource = $postResource;
        parent::__construct($context);
    }

    /**
     * The execute function
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();

        if (isset($data['image_url_edit'][0]['image_url'])) {
            $imageUrlFromNestedArray = $data['image_url_edit'][0]['image_url'];
        }

        // var_dump($imageUrlFromNestedArray);
        // dd();

        // Check if 'id' exists in the data
        if (isset($data['id'])) {
            $model = $this->collectionFactory->create();

            // Load existing record by ID
            $this->postResource->load($model, $data['id']);

            // Update model data with form data
            if (isset($data['brand_name'])) {
                $model->setBrandName($data['brand_name']);
            }

            if (isset($imageUrlFromNestedArray)) {
                $model->setImageUrl($imageUrlFromNestedArray);
            }

            // Save the updated model
            $this->postResource->save($model);

            // Add success message
            $this->messageManager->addSuccessMessage(__('Data updated successfully.'));
        } else {
            // If ID doesn't exist, handle the new record creation logic here
            // This is where you'd typically add new records
            $this->messageManager->addErrorMessage(__('ID is missing. Cannot update record.'));
        }

        // Redirect to appropriate page
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('brands_module/Index'); // Adjust the path as needed

        return $resultRedirect;
    }
}

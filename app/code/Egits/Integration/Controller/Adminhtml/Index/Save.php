<?php

namespace Egits\Integration\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Egits\Integration\Model\PostFactory;
use Egits\Integration\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\RequestInterface;
// use Magento\Framework\Controller\ResultFactory;


/**
 * Class that does the save action
 *
 * @param Egits\Integration\Controller\Adminhtml\Index
 */
class Save implements ActionInterface
{
    /**
     * Holds an instance of the post resource class
     *
     * @var PostResource
     */
    protected $postResource;
    /**
     * Holds and instance of the page factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * Holds an instance of the collection factory
     *
     * @var $collectionFactory
     */
    protected $collectionFactory;

    protected  $messageManager;

    protected $resultFactory;

    /**
     * Request instance
     *
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param PostResource $postResource
     * @param PageFactory $resultPageFactory
     * @param PostFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        PostResource $postResource,
        PageFactory $resultPageFactory,
        PostFactory $collectionFactory,
        ResultFactory $resultFactory,
        ManagerInterface $messageManager
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->collectionFactory = $collectionFactory;
        $this->postResource = $postResource;
        $this->messageManager = $messageManager;
        $this->request = $request;
        $this->resultFactory = $resultFactory;
        // parent::__construct($context);
    }

    /**
     * The execute method used for saving the data
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function execute()
    {

        $data = (array)$this->request->getParams();

        $test = $data['brand_name'];

        $test3 = $data['image_url'][0]['image_url'];

        $model = $this->collectionFactory->create();

        if (isset($data['id'])) {
            // Load existing record for update
            $model = $this->postResource->load($model, $data['id']);
        }

        $model->setBrandName($test);

        $model->setImageUrl($test3);

        $this->postResource->save($model);

        $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('brands_module/Index'); // This is just an intelllephense error

        return $resultRedirect;
    }
}

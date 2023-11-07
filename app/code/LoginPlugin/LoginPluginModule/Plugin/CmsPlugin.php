<?php

namespace LoginPlugin\LoginPluginModule\Plugin;

use Magento\Cms\Controller\Page\View as CmsPageView;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Action\Action;
use Psr\Log\LoggerInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Magento\Customer\Model\Session as CustomerSession;

class CmsPlugin
{
    protected $logger;
    protected $redirectFactory;
    protected $url;
    protected $customerSession;
    protected $message;

    public function __construct(
        RedirectFactory $redirectFactory,
        LoggerInterface $logger,
        UrlInterface $url,
        CustomerSession $customerSession,
        MessageManager $message
    ) {
        $this->redirectFactory = $redirectFactory;
        $this->url = $url;
        $this->customerSession = $customerSession;
        $this->message = $message;
        $this->logger = $logger;
    }

    public function beforeDispatch(
        CmsPageView $subject,
        $request
    ) {
        $this->logger->info('Your message goes here');
        $restrictedCmsPageIds = [4, 6]; // Add your restricted CMS paege IDs here
        $pageId = (int)$request->getParam('page_id');

        if (in_array($pageId, $restrictedCmsPageIds)) {
            if ($this->customerSession->isLoggedIn()) {
                $this->customerSession->logout();
                $url = $this->url->getUrl('customer/account/login');
                $subject->getResponse()->setRedirect($url);
                $this->$message->addErrorMessage(__('You are not allowed to access this page.'));
            }
        }

        // if (in_array($currentCmsPageId, $restrictedCmsPageIds) && !$this->customerSession->isLoggedIn()) {
        //     $resultRedirect = $this->redirectFactory->create();
        //     $resultRedirect->setUrl($this->url->getUrl('customer/account/login'));
        //     $resultRedirect->setHttpResponseCode(302);
        //     $resultRedirect->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0', true);
        //     $resultRedirect->setHeader('Pragma', 'no-cache', true);
        //     $resultRedirect->setHeader('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT', true);

        //     return [$request, $resultRedirect];
        // }
    }
}

// if (in_array($pageId, $restrictedPages)) {
//                 if ($this->customerSession->isLoggedIn()) {
//                     $this->customerSession->logout();
//                     $url = $this->url->getUrl('customer/account/login');
//                     $subject->getResponse()->setRedirect($url);
                    
//                     $this->messageManager->addErrorMessage(__('You must be logged in to access this page.'));

//                 }
//             }

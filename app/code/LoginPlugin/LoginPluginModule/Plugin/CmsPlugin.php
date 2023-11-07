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
            // Only give access if the user is logged in
            // if ($this->customerSession->isLoggedIn()) {
            //     $this->customerSession->logout();
            $url = $this->url->getUrl('customer/account/login');
            $subject->getResponse()->setRedirect($url);
            $this->message->addErrorMessage(__('You are not allowed to access this page.'));
            //}
        }
    }
}

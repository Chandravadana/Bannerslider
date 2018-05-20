<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Chandu\Bannerslider\Controller\Adminhtml\Slider;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Chandu\Bannerslider\Model\Bannerslider;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\RequestInterface;

//use Magento\Framework\Stdlib\DateTime\DateTime;
//use Magento\Ui\Component\MassAction\Filter;
//use Chandu\News\Model\ResourceModel\Test\CollectionFactory;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    protected $scopeConfig;

    protected $_escaper;
    protected $inlineTranslation;
    protected $_dateFactory;
    //protected $_modelNewsFactory;
    //  protected $collectionFactory;
    //  protected $filter;
    /**
     * @param Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\Escaper $escaper,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory
    ) {
        // $this->filter = $filter;
        // $this->collectionFactory = $collectionFactory;
        $this->dataPersistor = $dataPersistor;
        $this->scopeConfig = $scopeConfig;
        $this->_escaper = $escaper;
        $this->_dateFactory = $dateFactory;
        $this->inlineTranslation = $inlineTranslation;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('banner_id');

            if (isset($data['isactive']) && $data['isactive'] === 'true') {
                $data['isactive'] = Block::STATUS_ENABLED;
            }
            if (empty($data['banner_id'])) {
                $data['banner_id'] = null;
            }


            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->_objectManager->create('Chandu\Bannerslider\Model\Bannerslider')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This Banner no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }


            if (isset($data['bannerimage'][0]['name']) && isset($data['bannerimage'][0]['tmp_name'])) {
                $data['bannerimage'] ='/bannerslider/'.$data['bannerimage'][0]['name'];
            } elseif (isset($data['bannerimage'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
                $data['bannerimage'] =$data['bannerimage'][0]['name'];
            } else {
                $data['bannerimage'] = null;
            }

            $model->setData($data);


            $this->inlineTranslation->suspend();
            try {
                //////////////////// email
                $model->save();
                $this->messageManager->addSuccess(__('Banner Saved successfully'));
                $this->dataPersistor->clear('banner_slider');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['banner_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the banner.'));
            }

            $this->dataPersistor->set('banner_slider', $data);
            return $resultRedirect->setPath('*/*/edit', ['banner_id' => $this->getRequest()->getParam('banner_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

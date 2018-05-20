<?php

namespace Chandu\Bannerslider\Block\Adminhtml\Bannerslider;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    )
    {
        $this->context = $context;
        $this->registry = $registry;
    }

    /**
     * Return Current Banner ID
     *
     * @return int|null
     */
    public function getId()
    {
        $banner = $this->registry->registry('bannerslider');
        return $banner ? $banner->getId() : null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}

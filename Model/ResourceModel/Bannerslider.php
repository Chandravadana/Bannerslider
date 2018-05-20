<?php

namespace Chandu\Bannerslider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Bannerslider extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('banner_slider', 'banner_id');
    }
}

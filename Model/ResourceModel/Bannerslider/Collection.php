<?php

namespace Chandu\Bannerslider\Model\ResourceModel\Bannerslider;

use \Chandu\Bannerslider\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Chandu\Bannerslider\Model\Bannerslider', 'Chandu\Bannerslider\Model\ResourceModel\Bannerslider');
        $this->_map['fields']['banner_id'] = 'main_table.banner_id';
    }
}

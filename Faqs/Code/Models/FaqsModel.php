<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faqs\Faqs\Code\Models;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Model\BaseModel;
use Kazist\KazistFactory;
use Kazist\Service\Database\Query;

/**
 * Description of MarketplaceModel
 *
 * @author sbc
 */
class FaqsModel extends BaseModel {

    public function appendSearchQuery($query) {

        $query = parent:: appendSearchQuery($query);

        $query->orderBy('ff.ordering ', 'ASC');

        return $query;
    }

    public function getFaqs($category_id) {

        $query = new Query();

        $query->select('ff.*');
        $query->from('#__faqs_faqs', 'ff');

        if ($category_id) {
            $query->where('ff.category_id=:category_id');
            $query->setParameter('category_id', (int) $category_id);
        } else {
            $query->where('1=-1');
        }
        $query->orderBy('id ', 'DESC');



        $record = $query->loadObjectList();

        return $record;
    }

    //put your code here
    public function getAdditionalDetail($items) {

        $tmp_array = array();

        if (!empty($items)) {
            foreach ($items as $item) {
                $tmp_array[] = $this->getItemAdditionDetails($item);
            }
        }

        return $tmp_array;
    }

    public function getItemAdditionDetails($item) {

        $item_obj = (is_object($item)) ? $item : new \stdClass();

        $item_obj->title = ucwords($item->title);
        $item_obj->faqs = $this->getFaqs($item->id);

        return $item_obj;
    }

    public function save($form_data) {

        $id = parent::save($form_data);

        $factory = new KazistFactory();

        if (!(int) $form_data['ordering']) {

            $data = new \stdClass();
            $data->id = $id;
            $data->ordering = $id;

            $factory->saveRecord('#__faqs_faqs', $data);
        }

        return $id;
    }

}

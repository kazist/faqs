<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faqs\Categories\Code\Models;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Model\BaseModel;
use Kazist\KazistFactory;
use Kazist\Service\Database\Query;

/**
 * Description of MarketplaceModel
 *
 * @author sbc
 */
class CategoriesModel extends BaseModel {

    public function getFaqs($category_id, $offset = 0, $limit = 10) {

        $factory = new KazistFactory();

        $session = $factory->getSession();

        //$email->debug_exit = true;
        $uri = $session->get('uri');

        $query = new Query();
        $query->select('ff.*');
        $query->from('#__faqs_faqs', 'ff');

        if ($category_id) {
            $query->where('ff.category_id=:category_id');
            $query->setParameter('category_id', $category_id);
        } else {
            $query->where('1=-1');
        }
        $query->orderBy('id ', 'DESC');

        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

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
        $item_obj->faqs = $this->getFaqs($item->id, 0, 3);

        return $item_obj;
    }

    public function getCategoryTotalFaqs($category_id) {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('COUNT(*) AS total');
        $query->from('#__faqs_faqs', 'ff');
        if ($category_id) {
            $query->where('ff.category_id=:category_id');
            $query->setParameter('category_id', $category_id);
        } else {
            $query->where('1=-1');
        }



        $record = $query->loadObject();

        return $record->total;
    }

    public function loadCategoryFaqs() {
        $paths = array();

        $object_arr = new \stdClass();
        $factory = new KazistFactory();


        $offset = $this->request->request->get('offset');
        $action = $this->request->request->get('action');

        $object_arr->category_id = $this->request->request->get('category_id');
        $object_arr->offset_faqs = ($action == 'previous') ? $offset - 10 : $offset + 10;

        $template = 'faq.list.twig';
        $this->twig_paths[] = realpath(JPATH_ROOT . '/applications/Faqs/generalviews');
        $html = $factory->renderData($object_arr, $template, $paths);


        return $html;
    }

}

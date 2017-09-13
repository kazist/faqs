<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faqs\Addons\Faqs\Models;

use Kazist\KazistFactory;
use Kazist\Service\Database\Query;

class FaqsModel {

    public function getInfo() {
        return 'Hello World!';
    }

    public function getFaqs($limit) {


        $query = new Query();

        $query->select('ff.*');
        $query->from('#__faqs_faqs', 'ff');
        // $query->where('ff.published=1');
        $query->orderBy('ff.id', 'DESC');

        $query->setFirstResult(0);
        $query->setMaxResults($limit);

        $records = $query->loadObjectList();

        return $records;
    }

}

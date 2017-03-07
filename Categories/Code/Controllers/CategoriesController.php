<?php

/*
 * This file is part of Kazist Framework.
 * (c) Dedan Irungu <irungudedan@gmail.com>
 *  For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 * 
 */

/**
 * Description of CategoriesController
 *
 * @author sbc
 */

namespace Faqs\Categories\Code\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\BaseController;
use Faqs\Categories\Code\Models\CategoriesModel;

class CategoriesController extends BaseController {

    public function indexAction() {

        $this->model = new CategoriesModel();

        $items = $this->model->getRecords();
        $items = $this->model->getAdditionalDetail($items);

        $data_arr['items'] = $items;

        $this->html = $this->render('Faqs:Categories:Code:views:table.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

    public function detailAction() {

        $this->twig_paths[] = JPATH_ROOT . '/applications/Game/generalviews/';

        $this->model = new CategoriesModel();

        $item = $this->model->getRecord();
        $item = $this->model->getItemAdditionDetails($item);

        $data_arr['item'] = $item;

        $this->html = $this->render('Faqs:Categories:Code:views:detail.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}

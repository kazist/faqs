<?php

/*
 * This file is part of Kazist Framework.
 * (c) Dedan Irungu <irungudedan@gmail.com>
 *  For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 * 
 */

/**
 * Description of FaqsController
 *
 * @author sbc
 */

namespace Faqs\Faqs\Code\Controllers\Admin;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\BaseController;
use Faqs\Faqs\Code\Models\FaqsModel;

class FaqsController extends BaseController {

    public function detailAction() {

        $this->twig_paths[] = JPATH_ROOT . '/applications/Faqs/generalviews/';

        $this->model = new FaqsModel();

        $item = $this->model->getRecord();

        $data_arr['item'] = $item;
        $this->html = $this->render('Faqs:Faqs:Code:views:admin:detail.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}

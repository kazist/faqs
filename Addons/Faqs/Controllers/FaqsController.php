<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faqs\Addons\Faqs\Controllers;

use Kazist\Controller\AddonController;
use Faqs\Addons\Faqs\Models\FaqsModel;

/**
 * Kazist view class for the application
 *
 * @since  1.0
 */
class FaqsController extends AddonController {

    function indexAction($offset = 0, $limit = 6) {

        $model = new FaqsModel;

        $faqs = $model->getFaqs();

        $data_arr['faqs'] = $faqs;

        $this->html = $this->render('Faqs:Addons:Faqs:views:faqs.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}

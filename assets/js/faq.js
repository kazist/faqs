/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function () {
    faq.init();
});

faq = function () {
    return {
        init: function () {

            faq.addEvents(jQuery('body'));

        }, addEvents: function (html) {

            html.find(".faqs-navigation a").on('click', function (event) {
                faq.loadFaqs(jQuery(this));
            });

            return html;

        }, loadFaqs: function (this_element) {

            var action = this_element.attr('action');
            var offset = this_element.attr('offset');
            var category_id = this_element.attr('category_id');
            var data_object = {action: action, offset: offset, category_id: category_id};

            var form = kazist.callAjaxByRoute('faqs.categories.ajaxloadfaqs', data_object, true);

            console.log(form);
            jQuery('.category-faqs-listing').html(form);

            faq.addEvents(jQuery('.category-faqs-listing'));
        }

    };
}();
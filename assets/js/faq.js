/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function () {
    
    faq.init();

    jQuery(".toggle-accordion").on("click", function () {
        
        var accordionId = jQuery(this).attr("accordion-id"),
                numPanelOpen = jQuery(accordionId + ' .collapse.in').length;

        jQuery(this).toggleClass("active");

        if (numPanelOpen == 0) {
            openAllPanels(accordionId);
        } else {
            closeAllPanels(accordionId);
        }
    })

    openAllPanels = function (aId) {
        console.log("setAllPanelOpen");
        jQuery(aId + ' .panel-collapse:not(".in")').collapse('show');
    }
    closeAllPanels = function (aId) {
        console.log("setAllPanelclose");
        jQuery(aId + ' .panel-collapse.in').collapse('hide');
    }


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
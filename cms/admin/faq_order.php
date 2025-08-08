<?php
function cms_save_faq_order(string $order, bool $ajax): void {
    cms_require_permission('faq_edit');
    cms_set_setting('faq_order', $order);
    cms_admin_log('Reordered FAQs');
    if ($ajax) {
        echo 'ok';
    } else {
        header('Location: faq.php');
    }
}

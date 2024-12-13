<?php
require_once 'ajaxConfig.php';
if ($func->isAjax()) {
    @$name_form = htmlspecialchars($_POST['name_form']);
    @$class_form = htmlspecialchars($_POST['class_form']);
    @$submit = htmlspecialchars($_POST['submit']);
    $response['html'] = $func->getTemplateLayoutsFor([
        'name_layouts' => 'sectionModal',
        'name_form' => $name_form,
        'class_form' => $class_form,
        'submit' => $submit,
    ]);
    echo json_encode($response);
}

<?php
namespace Catalog\Form;

use Zend\Form\Form;

class CartForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('cart');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf',
        ));
        $this->add(array(
            'name' => 'amount',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'goods',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Купить',
                'id' => 'submitbutton',
            ),
        ));
    }
}
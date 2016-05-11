<?php
namespace Catalog\Form;

use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
class BlogPostForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('item');
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new \Catalog\Form\BlogPostInputFilter());
        $this->add(array(
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf',
        ));
        $this->add(array(
            'name' => 'userId',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'goodsId',
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
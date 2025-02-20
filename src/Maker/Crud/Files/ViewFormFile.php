<?php

namespace IS\CrudMaker\Maker\Crud\Files;

class ViewFormFile extends File
{
    const PREFIX_FILE = '.blade.php';

    const FILE_NAME = 'viewForm';

    public function setSettings($settings): File
    {
        $this->patch = $settings['path'] . '/' . lcfirst($this->propertyContainer->getProperty('entity'));

        return $this;
    }

    protected function getFileName(): string
    {
        return 'form' . static::PREFIX_FILE;
    }

    protected function buildClass(): File
    {
        $this->shortcodes->setShortcode('$FIELDS$', $this->getFieldsTemplate());

        return parent::buildClass();
    }

    protected function getFieldsTemplate(): string
    {
        $fields = '';

        foreach ($this->fields->getFields() as $field) {
            $fields .= '<input type="text" value="{{ $'
                . lcfirst($this->propertyContainer->getProperty('entity'))
                . '->' . $field . '  ?? \'\' }}">'
                . PHP_EOL;
        }

        return $fields;
    }
}

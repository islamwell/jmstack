<?php

/**
 * Widget to use coordinate picker jQuery plugin.
 *
 * Link to original jQuery plugin:
 * @link https://github.com/davidsalazar/coordinate-picker
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class CoordinatePicker extends CWidget
{
    /** @var CModel model */
    public $model;

    /** @var string latitude attribute name in $model */
    public $latitudeAttribute = 'latitude';

    /** @var string longitude attribute name in $model */
    public $longitudeAttribute = 'longitude';

    /** @var string latitude input id */
    public $latitudeInputId;

    /** @var string longitude input id */
    public $longitudeInputId;

    /** @var string Label for picker link, when not set “Pick Coordinates” will be used */
    public $label = null;
    /** @var string An absolute URL to the published assets */
    public $assets;

    /** @var float Default latitude for picked coordinates, by default set to Kiev */
    public $defaultLatitude;
    /** @var float Default longitude for picked coordinates, by default set to Kiev */
    public $defaultLongitude;
    /** @var int Map zoom level when editing already picked coordinates, by default at city level(12) */
    public $editZoom;
    /** @var int Map zoom level when picking new coordinates, by default at country level(7) */
    public $pickZoom;

    /**
     *  Publish assets and generate input ids when they is not set
     */
    public function init()
    {
        $this->assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/CoordinatePicker/coordinate_picker'); //, false, -1, true
        if (!isset($this->latitudeInputId)) {
            $this->latitudeInputId = CHtml::activeId($this->model, $this->latitudeAttribute);
        }
        if (!isset($this->longitudeInputId)) {
            $this->longitudeInputId = CHtml::activeId($this->model, $this->longitudeAttribute);
        }
    }

    /**
     *  Register required scripts and styles, render widget
     */
    public function run()
    {
        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($this->assets . '/jquery.coordinate_picker.js');
        $cs->registerCssFile($this->assets . '/styles/smodal/shadow.css');

        if (!isset($this->label)) $this->label = 'Pick Coordinates';

        echo CHtml::link($this->label, '#', array('id' => $this->getId()));

        $pluginSettings = array(
            'lat_selector' => "#{$this->latitudeInputId}",
            'long_selector' => "#{$this->longitudeInputId}",
        );
        if (isset($this->defaultLatitude))
            $pluginSettings['default_lat'] = $this->defaultLatitude;
        if (isset($this->defaultLongitude))
            $pluginSettings['default_long'] = $this->defaultLongitude;
        if (isset($this->editZoom))
            $pluginSettings['edit_zoom'] = $this->editZoom;
        if (isset($this->pickZoom))
            $pluginSettings['pick_zoom'] = $this->pickZoom;

        $pluginSettings = CJavaScript::encode($pluginSettings);
        $cs->registerScript($this->getId() . 'script', "$('#{$this->getId()}').coordinate_picker({$pluginSettings});");

    }

}

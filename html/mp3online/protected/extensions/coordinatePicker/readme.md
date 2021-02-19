Coordinate picker usage instructions
===========================

1. Checkout source code to your project, for example to ext.coordinatepicker.
2. Render inputs.
3. Register script with widget.

Example:

    :::php
    echo $form->textField($model, 'lat');
    echo $form->textField($model,'long');

    $this->widget('ext.coordinatepicker.CoordinatePicker', array(
        'model' => $model,
        'latitudeAttribute' => 'lat',
        'longitudeAttribute' => 'long',
        //optional settings
        'editZoom' => 12,
        'pickZoom' => 7,
        'defaultLatitude' => 50.443513052458044,
        'defaultLongitude' => 30.498046875,
    ));
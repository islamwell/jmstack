	<!-- Sample code to insert piecemaker widget into view files. -->
	<div id="piecemaker-container" class="span-22 prepend-1 append-1">
		<?php 
		$this->widget('application.extensions.piecemaker.PieceMaker', array(
		
			'contents'=>array(			
				array(
					'image', 'images/gallery/Fly Agaric Fly Hawaii.jpg', 'Fly Agaric Fly Hawaii',
				),

				array(
					'image', 'images/gallery/Ford Mustang.jpg', 'Ford Mustang',
				),

				array(
					'image', 'images/gallery/Little Mountain.jpg', 'Little Mountain',
				),

				array(
					'image', 'images/gallery/South Durras Sunrise.jpg', 'South Durras Sunrise',
				),

				array(
					'image', 'images/gallery/Step Into My Dream.jpg', 'Step Into My Dream',
				),

				array(
					'image', 'images/gallery/Swan On Sunset Lake.jpg', 'Swan On Sunset Lake',
				),

				array(
					'image', 'images/gallery/Woman.gif', 'Woman',
				),
			),

			'transitions'=>array(
				array(9, 1.2, 'easeInOutBack', 0.1, 300, 30),
				array(15, 3, 'easeInOutElastic', 0.03, 200, 10),
				array(5, 1.3, 'easeInOutCubic', 0.1, 500, 50),
				array(9, 1.25, 'easeInOutBack', 0.1, 900, 5),
			),
			
		)); ?>
	</div>
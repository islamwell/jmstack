<?php

class PieceMakerXml
{
	protected $xml;

	public function __construct($xmlUrl)
	{
		$this->xml = new SimpleXMLElement($xmlUrl, 0, true);
	}

	public function asXml($xmlPath = '')
	{
		// Prettify output xml
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($this->xml->asXml());
		
		// Save or return xml
		if ($xmlPath != '')
			$dom->save($xmlPath);
		else
			return $dom->saveXml();
	}

	public function addImage($source, $title, $text = '', $hyperlink = '', $target = '_blank')
	{
		$pmContents = $this->xml->Contents[0];

		$newImage = $pmContents->addChild('Image');
		$newImage->addAttribute('Source', $source);
		$newImage->addAttribute('Title', $title);

		if ($text != '') $newImage->addChild('Text', CHtml::encode($text));

		if ($hyperlink != '')
		{
			$newLink = $newImage->addChild('Hyperlink');
			$newLink->addAttribute('URL', $hyperlink);
			$newLink->addAttribute('Target', $target);
		}
	}

	public function addFlash($source, $title, $preview = '')
	{
		$pmContents = $this->xml->Contents[0];

		$newFlash = $pmContents->addChild('Flash');
		$newFlash->addAttribute('Source', $source);
		$newFlash->addAttribute('Title', $title);

		if ($preview != '')
		{
			$newPreview = $newFlash->addChild('Image');
			$newPreview->addAttribute('Source', $preview);
		}
	}

	public function addVideo($source, $title, $width, $height, $autoplay = true,
								$preview = '')
	{
		$pmContents = $this->xml->Contents[0];

		$newVideo = $pmContents->addChild('Video');
		$newVideo->addAttribute('Source', '../../'.$source);
		$newVideo->addAttribute('Title', $title);
		$newVideo->addAttribute('Width', $width);
		$newVideo->addAttribute('Height', $height);
		$newVideo->addAttribute('Autoplay', $autoplay ? 'true' : 'false');

		if ($preview != '')
		{
			$newPreview = $newVideo->addChild('Image');
			$newPreview->addAttribute('Source', $preview);
		}
	}

	public function addTransition($pieces, $time, $transiton, $delay, $depthOffset,
									$cubeDistance)
	{
		static $isFirst = true; // Is this the first time the function is called?
		$transitions = $this->xml->Transitions[0];

		if ($isFirst)
		{
			// If the function IS called, remove default transiton in favor of
			//	user specified transition.
			unset($transitions->Transition);
		}

		$newTrans = $transitions->addChild('Transition');
		$newTrans->addAttribute('Pieces', $pieces);
		$newTrans->addAttribute('Time', $time);
		$newTrans->addAttribute('Transiton', $transiton);
		$newTrans->addAttribute('Delay', $delay);
		$newTrans->addAttribute('DepthOffset', $depthOffset);
		$newTrans->addAttribute('CubeDistance', $cubeDistance);

		$isFirst = false;
	}
}

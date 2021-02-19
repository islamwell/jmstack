<?php
/**
 * Yii widget encapsulating the very unique PieceMaker 2 flash content slider.
 */

Yii::import('application.extensions.piecemaker.PieceMakerXml');

class PieceMaker extends CWidget
{
	/**
	* @var array() Image, Flash or Video content for the slider.
	* 
	* Video content urls must be relative to the piecemaker.swf object
	* 	located under assets/unique-id/
	*/
	public $contents = array();

	/**
	* @var array() Transition effects for contents.
	*
	* You must specify at least one transition. Otherwise a default
	* 	transition is used. See defaults.xml.
	*
	* If you specify multiple transitions, they are rotated in the
	* 	order they are specified.
	*/
	public $transitions = array();

	/**
	* @var array() Different configuration settings for the widget.
	*
	* Default settings are specified in defaults.xml. Override at will.
	*/
	public $settings = array();

	public $jsParams = array();

	/**
	* @var PieceMakerXml
	*/
	protected $xml;

	protected $assetsUrl;

	public function run()
	{
		$xmlPath = Yii::app()->basePath.'/extensions/piecemaker/assets/piecemaker.xml';

		$this->makeXml($xmlPath);

		if (!isset($this->assetsUrl))
			$this->assetsUrl = Yii::app()->getAssetManager()->publish(
				Yii::getPathOfAlias('application.extensions.piecemaker.assets'),
				false,
				-1,
				YII_DEBUG
			);

		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($this->assetsUrl.'/swfobject.js');

		$cs->registerScript('Yii.PieceMaker', $this->makeJs(), 0);

		// Html code to embed the swf object
		$html = '<div id="piecemaker">'.PHP_EOL;
		$html .= '<p>Put your alternative Non Flash content here.</p>'.PHP_EOL;
		$html .= '</div>'.PHP_EOL;

		echo $html;
	}

	protected function makeXml($xmlPath = '')
	{
		// Load default settings from xml.
		$defaultXmlPath = Yii::app()->basePath.'/extensions/piecemaker/defaults.xml';
		$this->xml = new PieceMakerXml($defaultXmlPath);

		foreach ($this->contents as $params)
		{
			switch ( strtolower($params[0]) )
			{
			case 'image':
				$this->xml->addImage(	$params[1],
										$params[2],
										isset($params[3]) ? $params[3] : null,
										isset($params[4]) ? $params[4] : null,
										isset($params[5]) ? $params[5] : null);
				break;

			case 'flash':
				$this->xml->addFlash(	$params[1],
										$params[2],
										isset($params[3]) ? $params[3] : null);
				break;

			case 'video':
				$this->xml->addVideo($params[1], $params[2], $params[3], $params[4],
										$params[5], $params[6]);
				break;

			default:
				break;
			}
		}

		foreach ($this->transitions as $effect)
		{
			$this->xml->addTransition($effect[0], $effect[1], $effect[2], $effect[3],
										$effect[4], $effect[5]);
		}

		if ($xmlPath != '')
		{
			// Save xml to file
			$this->xml->asXml($xmlPath);
		}
		else
		{
			return $this->xml->asXml();
		}
	}

	protected function makeJs()
	{
		$js = 'var flashvars = {};';
		$js .= 'flashvars.cssSource = "'.$this->assetsUrl.'/piecemaker.css";';
		$js .= 'flashvars.xmlSource = "'.$this->assetsUrl.'/piecemaker.xml";';

		$js .= 'var params = {};';
		$js .= 'params.play = "true";';
		$js .= 'params.menu = "false";';
		$js .= 'params.scale = "showall";';
		$js .= 'params.wmode = "transparent";';
		$js .= 'params.allowfullscreen = "true";';
		$js .= 'params.allowscriptaccess = "always";';
		$js .= 'params.allownetworking = "all";';

		$js .= 'swfobject.embedSWF("'.$this->assetsUrl.'/piecemaker.swf", "piecemaker",
				"870", "550", "10", null, flashvars, params, null);';

		return $js;
	}
}

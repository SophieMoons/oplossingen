<?php
class HTMLBuilder
{
	protected $header;
	protected $body;
	protected $footer;
	
	public function __construct($header, $body, $footer)
	{
		$this->header =	$header;
		$this->body	= $body;
		$this->footer =	$footer;

		$this->buildPage(); //1 keer alles is benoemd, tijd voor de assemblage
	}

	public function buildHeader()
	{
		$cssPath	= dirname(dirname(__FILE__)) . '/css/';	//
		$filesArr = glob($cssPath . '/*.' . 'css');	    	// pad zoeken
															// CSS inladen
		$cssLinks = $this->buildCssLink($filesArr);			//

		include('html/'. $this->header);
	}
		
	public function buildBody()
	{
		include('html/'. $this->body);
	}

	public function buildFooter()
	{
		$jsPath	= dirname(dirname(__FILE__)) . '/js/';	//
		$filesArr =	glob($jsPath . '/*.' . 'js');		// pad zoeken
														// JS inladen
		$jsScripts = $this->buildJsScripts($filesArr);	//

		include ('html/'. $this->footer);
	}

	public function findFiles($dir, $file)
	{
		return glob($dir . '/*.' . $file);	

	}
		public function buildJsScripts($filesArr)
		{
			$jsHTMLArr = array();
					
			foreach ($filesArr as $file)
			{
				$fileInfo =	pathinfo($file);
				$fileName =	$fileInfo['basename'];
					
				$jsHTMLArr[] = '<script src="js/' . $fileName . '"></script>';
			}
			
				return implode('', $jsHTMLArr);
		}

		public function buildCssLink($filesArr)
		{
				$cssHTMLArr	=	array();
		
				foreach ($filesArr as $file)
				{
					$fileInfo	=	pathinfo($file);
					$fileName	=	$fileInfo['basename'];
				
					$cssHTMLArr[] = '<link rel="stylesheet" type="text/css" href="../css/' . $fileName . '">';
				}
			
				return implode('', $cssHTMLArr);
		}

	public function buildPage() //alles wordt nu in 1 pagina gegoten
	{
		$this->buildHeader();
		$this->buildBody();
		$this->buildFooter();
	}

	}
?>
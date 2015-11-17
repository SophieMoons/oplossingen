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
			
		$this->buildPage();
	}

	public function buildHeader()
	{

	}

		public function createCssLink($filesArr)
			{

			}
		
	public function buildBody()
	{
		include('html/'. $this->body);
	}

	public function buildFooter()
	{

		include ('html/'. $this->footer);
	}

		public function createJsScripts($filesArr)
		{
		
			return implode('', $jsHTMLArr);
		}

	public function buildPage()
		{
			$this->buildHeader();
			$this->buildBody();
			$this->buildFooter();
		}	
	}
?>
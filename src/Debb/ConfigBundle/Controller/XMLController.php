<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Localdev\AdminBundle\Util\ControllerUtils;
use Localdev\AdminBundle\Controller\CRUDController;

/**
 * Contains default actions for xml generation of DEBBComponents or PLMXML
 *
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
abstract class XMLController extends CRUDController
{
	/**
	 * @var string type of debbcomponent
	 */
	public $debbType = 'Node';

	/**
	 * Download entity as xml file
	 *
	 * @Route("/xml/{id}.xml", requirements={"id"="\d+"});
	 *
	 * @param int                                       $id       item id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function asXmlAction($id)
	{
		$response = new \Symfony\Component\HttpFoundation\Response();
		$response->headers->set('Content-Type', 'text/xml');
		header('Content-Type: text/xml');
		echo $this->getDebbXml($id, true);
		return $response;
	}

	/**
	 * Return entity as DEBBComponents.xml string
	 *
	 * @param int $id item id
	 * @param bool $pretty format output for user?
	 *
	 * @return string the DEBBComponents.xml string
	 */
	public function getDebbXml($id, $pretty = false)
	{
		$item = $this->getEntity($id);

		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><'.$this->debbType.' />');
		$info = $item->getDebbXmlArray();
		if(array_key_exists($this->debbType, $info))
		{
			$info = $info[$this->debbType];
		}
		else
		{
			foreach($info as $key => $val)
			{
				$info = $val;
			}
		}
		\Debb\ManagementBundle\Entity\Base::array_to_xml($info, $xml);

		if ($pretty)
		{
			$dom = dom_import_simplexml($xml)->ownerDocument;
			$dom->formatOutput = true;
			$dom->preserveWhiteSpace = true;
			$xmlStr = $dom->saveXML();
		}
		else
		{
			$xmlStr = $xml->asXML();
		}

		$xmlStr = str_replace('<'.$this->debbType.'>',  '<xsd_1:'.$this->debbType.' xmlns:xsd_1="http://www.coolemall.eu/DEBBComponent" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.coolemall.eu/DEBBComponent DEBBComponents.xsd " >',
			str_replace('</'.$this->debbType.'>', '</xsd_1:'.$this->debbType.'>', $xmlStr));

		$room = new \Debb\ConfigBundle\Controller\RoomController();
		$room->setContainer($this->getContainer());
		$room->valide($xmlStr, file_get_contents('../utils/DEBBComponents.xsd'));

		return $xmlStr;
	}
}

<?php
namespace Debb\ManagementBundle\Controller;

use Debb\ManagementBundle\Entity\Base;
use Localdev\AdminBundle\Controller\CRUDController;

/**
 * Used for user specific entities
 *
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class BaseController extends CRUDController
{
	/**
	 * @inheritdoc
	 */
	protected function getEntities($repository = '')
	{
		return $this->getRepository($repository)->findAllFromUser($this->getUser());
	}

	/**
	 * @inheritdoc
	 */
	public function createForm($type, $data = null, array $options = array())
	{
		if($data instanceof Base && method_exists($data, 'setUser') && method_exists($data, 'getUser') && $data->getUser() === null)
		{
			$data->setUser($this->getUser());
		}
		return $this->container->get('form.factory')->create($type, $data, $options);
	}
}

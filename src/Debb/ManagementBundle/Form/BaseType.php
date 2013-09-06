<?php

namespace Debb\ManagementBundle\Form;

use CoolEmAll\UserBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class BaseType
 * @package Debb\ManagementBundle\Form
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class BaseType extends AbstractType
{
	/**
	 * @var \Symfony\Component\DependencyInjection\Container
	 */
	protected $container;

	/**
	 * The query builder function for the user specifications
	 */
	protected $userQueryBuilder;

	/**
	 * @param Container $container
	 */
	function __construct(Container $container = null)
	{
		$this->container = $container;
		$this->userQueryBuilder = function(EntityRepository $er)
		{
			$user = $this->container->get('security.context')->getToken()->getUser();
			$qb = $er->createQueryBuilder('p');
			if($user instanceof User)
			{
				$qb->where('p.user = :user')->setParameter('user', $user);
			}
			else
			{
				$qb->where('p.user IS NULL');
			}
			return $qb;
		};
	}

	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('manufacturer', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
			->add('product', null, array('required' => false))
			->add('label', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
			->add('hostname', null, array('required' => false))
			->add('type', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
			->add('maxPower', null, array('required' => false))
			->add('powerUsageProfile', null, array('attr' => array('class' => 'noBreakAfterThis'), 'required' => false))
			->add('powerUsage', null, array('required' => false))
		;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'base';
	}
}

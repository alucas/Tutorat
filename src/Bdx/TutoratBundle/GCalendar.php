<?php

namespace Bdx\TutoratBundle;

use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Request;

class GCalendar
{
	private $session;

	private $request;

	public function __construct(Session $session, Request $request)
	{
		$this->session = $session;
		$this->request = $request;

		require_once 'Zend/Loader.php';
		\Zend_Loader::loadClass('Zend_Gdata');
		\Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		\Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		\Zend_Loader::loadClass('Zend_Gdata_Calendar');

		$gdataCal = new \Zend_Gdata_Calendar();
	}

	public function isLogged()
	{
		if ($this->session->has('gdata_sToken')) {
			return True;
		}

		if ($this->request->query->has('token')) {
			$this->session->set('gdata_sToken', 
					\Zend_Gdata_AuthSub::getAuthSubSessionToken(
						$this->request->query->get('token')));

			return True;
		}

		return False;
	}

	public function getAuthSubUrl()
	{
		$next = $this->request->getUri();
		$scope = 'https://www.google.com/calendar/feeds/';
		$secure = false;
		$session = true;
		return \Zend_Gdata_AuthSub::getAuthSubTokenUri(
				$next, $scope, $secure, $session);
	}

	public function getEvents()
	{
		$gdataCal = new \Zend_Gdata_Calendar();
		$query = $gdataCal->newEventQuery();
		$query->setUser('fafnfej4e9gpd52dn6d3lnluc0%40group.calendar.google.com');
		$query->setVisibility('private-a2cb8c971b18a17db0a255e3fe292520');
		$query->setProjection('basic');
		
		return $gdataCal->getCalendarEventFeed($query);
	}
}

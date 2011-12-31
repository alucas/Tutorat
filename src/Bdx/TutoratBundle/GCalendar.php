<?php

namespace Bdx\TutoratBundle;

use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Request;

class GCalendar
{
	private $session;

	private $request;

	private $login;

	private $password;

	private $calendarId;

	private $calendarCookie;

	public function __construct(Session $session, Request $request,
			$login, $password, $calendarId, $calendarCookie)
	{
		$this->session = $session;
		$this->request = $request;
		$this->login = $login;
		$this->password = $password;
		$this->calendarId = $calendarId;
		$this->calendarCookie = $calendarCookie;

		require_once 'Zend/Loader.php';
		\Zend_Loader::loadClass('Zend_Gdata');
		\Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		\Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		\Zend_Loader::loadClass('Zend_Gdata_Calendar');

		$gdataCal = new \Zend_Gdata_Calendar();
	}

	public function hardLogin() {
		$service = \Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$client = \Zend_Gdata_ClientLogin::getHttpClient(
					$this->login,
					$this->password,
					$service);

		return $client;
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

	public function createEvent ($client, $start, $end,
			$title = '[pas de titre]', $desc = '[pas de message]',
			$where = '[pas de lieux]'
			)
	{
		$gdataCal = new \Zend_Gdata_Calendar($client);

		$newEvent = $gdataCal->newEventEntry();

		$newEvent->title = $gdataCal->newTitle($title);
		$newEvent->where = array($gdataCal->newWhere($where));
		$newEvent->content = $gdataCal->newContent("$desc");

		$when = $gdataCal->newWhen();
		$when->startTime = $start->format(\DateTime::RFC3339);
		$when->endTime = $end->format(\DateTime::RFC3339);
		$newEvent->when = array($when);

		$uri = 'https://www.google.com/calendar/feeds/'.$this->calendarId.'/private/full';

		// Upload the event to the calendar server
		// A copy of the event as it is recorded on the server is returned
		$createdEvent = $gdataCal->insertEvent($newEvent, $uri);

		return $createdEvent->id->text;
	}
}

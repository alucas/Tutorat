<?php

namespace Bdx\TutoratBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TutorRepository
 */
class TutorRepository extends EntityRepository
{
	public function findNameDurationByLeftJoinRDV()
	{
		$query = $this->createQueryBuilder('t')
			->select('t.name, r.duration')
			->leftJoin('t.rdvs', 'r')
			->getQuery();

		return $query->getResult();
	}
}

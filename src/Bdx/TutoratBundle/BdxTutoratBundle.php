<?php

namespace Bdx\TutoratBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Bdx\TutoratBundle\DependencyInjection\Compiler\TwigFormPass;

class BdxTutoratBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);

		$container->addCompilerPass(new TwigFormPass());
	}
}

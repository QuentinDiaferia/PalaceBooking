<?php

namespace PB\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PBUserBundle extends Bundle {
	public function getParent() {
		return 'FOSUserBundle';
	}
}

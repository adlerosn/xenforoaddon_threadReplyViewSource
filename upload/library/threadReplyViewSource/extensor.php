<?php
class threadReplyViewSource_extensor
{
public static function load_class($class, array &$extend)
{
	if ($class == 'XenForo_ControllerPublic_Post')
	{
		$extend[] = 'threadReplyViewSource_extendControllerPublicPost';
	}
}
}

<?php

class threadReplyViewSource_extendControllerPublicPost extends XFCP_threadReplyViewSource_extendControllerPublicPost {
	public function actionViewsource(){
		$postId = $this->_input->filterSingle('post_id', XenForo_Input::UINT);
		$ftpHelper = $this->getHelper('ForumThreadPost');
		list($post, $thread, $forum) = $ftpHelper->assertPostValidAndViewable($postId);
		$this->_assertCanEditPost($post, $thread, $forum);
		$options = XenForo_Application::get('options');
		$forbidden = $options->viewsourcehideitems;
		$message = $post['message'];
		$msglwr = mb_strtolower($message);
		$failed = false;
		foreach($forbidden as $itm){
			if(strpos($msglwr,mb_strtolower($itm))!==false){
				$failed = true;
				break;
			}
		}
		$viewParams = array(
			'post' => $post,
			'thread' => $thread,
			'forum' => $forum,
			'message' => $message,
			'musthide' => $failed
			);
		return $this->responseView(
			'kiror_post_viewsource',
			'kiror_post_viewsource',
			$viewParams
		);
	}
}

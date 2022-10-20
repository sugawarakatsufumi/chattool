<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

/**
 * Followings Controller
 */
class FollowingsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public $uses = array('Users', 'Followings');	

	public function follow($id) {
		$this->Followings->recursive = 1;
		//debug($this->Followings->find('all'));
		$this->autoRender = false;
		$follower_id = $id;
		$auth = $this->Auth->user();
		$id = $auth['id'];
		$this->loadModel('Users');
		//userチェック
		$checkUserFlg = $this->Users->find('all', array(
		  'conditions'=>array('Users.id'=>$follower_id)
		));
		if (!$checkUserFlg) {
			echo '存在しないユーザーです';
		}else{
		  //followしてるかチェック！
		  $fw_checkflg = $this->Followings->find('all', array(
			'conditions'=>array('followings.follower_id'=>$follower_id, 'followings.user_id'=>$id)
		  ));
		  if(!$fw_checkflg){
			$this->Followings->set(
			  array(
				'user_id' => $id,
				'follower_id' => $follower_id
			  )
			);
			$this->Followings->save();
			$this->redirect(array('controller'=>'users','action'=>'users'));
			echo 'フォローしました';
		  }else{
			$this->redirect(array('controller'=>'users','action'=>'users'));
			echo 'follow済みです';
		  }
		}
	}

	public function unfollow($id) {
		$this->autoRender = false;
		$follower_id = $id;
		$auth = $this->Auth->user();
		$id = $auth['id'];
		$this->loadModel('Users');
		//userチェック
		$checkUserFlg = $this->Users->find('all', array(
		  'conditions'=>array('Users.id'=>$follower_id)
		));
		if (!$checkUserFlg) {
				echo '存在しないユーザーです';
			}else{
		  //followしてるかチェック！
		  $fw_checkflg = $this->Followings->find('all', array(
			'conditions'=>array(
				'AND' => array('followings.follower_id'=>$follower_id, 'followings.user_id'=>$id)
			)
		  ));
		  $unfollow_id = $fw_checkflg[0]['Followings']['id'];
		  if($unfollow_id){
			$this->Followings->delete($unfollow_id);
			$this->redirect(array('controller'=>'users','action'=>'users'));
			echo "りむーぶ";
		  }else{
			$this->redirect(array('controller'=>'users','action'=>'users'));
			echo '不正操作';
		  }
		}
	}
}

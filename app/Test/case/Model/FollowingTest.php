<?php
App::uses('Following', 'Model');

/**
 * Following Test Case
 */
class FollowingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.following'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Following = ClassRegistry::init('Following');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Following);

		parent::tearDown();
	}

}

<?php
/**
 * contains User class
 */

namespace OST\V0;

/**
 * Class encapsulating methods to interact with V0 API's for User module
 */
class User extends \OST\Base
{

  /**
   * Constructor
   *
   * @param object $requestObj request object which would fire API calls
   *
   */
  public function __construct($requestObj)
  {
    parent::__construct($requestObj, '/users');
  }

  /**
   * Create a User
   *
   * @param array $params params for creating a user
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function create($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/create', $params);
  }

  /**
   * Edit a User
   *
   * @param array $params params for editing a user
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function edit($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/edit', $params);
  }

  /**
   * List Users
   *
   * @param array $params params for fetching users list
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function getList($params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/list', $params);
  }

  /**
   * Airdrop Tokens
   *
   * @param array $params params for dropping tokens to user(s)
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function airdropTokens($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/airdrop/drop', $params);
  }

  /**
   * Get Airdrop Status
   *
   * @param array $params params for getting airdrop status
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function getAirdropStatus($params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/airdrop/status', $params);
  }

}

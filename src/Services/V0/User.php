<?php
/**
 * User class
 */

namespace OST\V0;

use Lib\Request;

/**
 * Class encapsulating methods to interact with V0 API's for User module
 */
class User extends \OST\Base
{

  /**
   * Constructor
   *
   * @param Request $requestObj request object which would fire API calls
   *
   */
  public function __construct(Request $requestObj)
  {
    parent::__construct($requestObj, '/users');
  }

  /**
   * Create a User
   *
   * @param array $params params for creating a user
   *
   * @return object
   *
   */
  public function create(array $params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/create', $params);
  }

  /**
   * Edit a User
   *
   * @param array $params params for editing a user
   *
   * @return object
   *
   */
  public function edit(array $params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/edit', $params);
  }

  /**
   * List Users
   *
   * @param array $params params for fetching users list
   *
   * @return object
   *
   */
  public function getList(array $params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/list', $params);
  }

  /**
   * Airdrop Tokens
   *
   * @param array $params params for dropping tokens to user(s)
   *
   * @return object
   *
   */
  public function airdropTokens(array $params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/airdrop/drop', $params);
  }

  /**
   * Get Airdrop Status
   *
   * @param array $params params for getting airdrop status
   *
   * @return object
   *
   */
  public function getAirdropStatus(array $params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/airdrop/status', $params);
  }

}

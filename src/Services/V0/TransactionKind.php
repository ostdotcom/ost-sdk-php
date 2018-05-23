<?php
/**
 * TransactionKind class
 */

namespace OST\V0;

/**
 * Class encapsulating methods to interact with V0 API's for TransactionKind module
 */
class TransactionKind extends \OST\Base
{

  /**
   * Constructor
   *
   * @param object $requestObj request object which would fire API calls
   *
   */
  public function __construct($requestObj)
  {
    parent::__construct($requestObj, '/transaction-types');
  }

  /**
   * Create an Action
   *
   * @param array $params params for creating an action
   *
   * @return object
   *
   */
  public function create($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/create', $params);
  }

  /**
   * Edit an Action
   *
   * @param array $params params for editing an action
   *
   * @return object
   *
   */
  public function edit($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/edit', $params);
  }

  /**
   * List Actions
   *
   * @param array $params params for fetching list of actions
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
   * @param array $params params for creating a user
   *
   * @return object
   *
   */
  public function execute($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/execute', $params);
  }

  /**
   * Get Airdrop Status
   *
   * @param array $params params for creating a user
   *
   * @return object
   *
   */
  public function getStatus($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/status', $params);
  }

}

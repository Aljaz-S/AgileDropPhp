<?php

namespace Drupal\events_status\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;


/**
 * Provides a block with events status content.
 *
 * @Block(
 *   id = "events_status",
 *   admin_label = @Translation("Events Status"),
 * )
 */
class EventsStatus extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
	
	/*
	*	Set node information and custom secrives date calculator
	*/
	$node = \Drupal::routeMatch()->getParameter('node');
	$service = \Drupal::service('events_status.date_calculator');
	
	/*
	* Checking if node type is event
	*/
	if($node->getType() == "event") {
		
		/* 
		*	Get node ID and Title
		*/
		$nid = $node->id();
		$title = $node->getTitle() . ' Status';
		
		/*
		*	Collect events date based on node ID
		*/
		$connection = \Drupal::database();
		$db_result = $connection->select('node__field_event_date', 'n')
			->condition('n.entity_id', $nid, '=')
			->fields('n', array('field_event_date_value'))
			->execute();
		
		$result = $db_result->fetchAll();		
		
		/*
		*	Checking if DB result has value
		*/
		if (!empty($result)) {		
			foreach($result as $value){	
				/*
				*	Call to custom service to calculate date difference, passing events date in strtotime format 
				*/
				$event_date = date_create(date("Y-m-d", strtotime($value->field_event_date_value)));
				$respond = $service->daysUntilEventStarts($event_date); 
			}
		} else {
			$respond = "There is no event information available!";
		}
	} else {
		$respond = "This is not event.";
	}
	
    return [
	  '#title' => t($title),
      '#markup' => t($respond),
	  '#cache' => [
        'max-age' => 0, // no cache please
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['my_block_settings'] = $form_state->getValue('my_block_settings');
  }
}
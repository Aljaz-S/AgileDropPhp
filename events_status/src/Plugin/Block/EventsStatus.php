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
	# Create date variables
	$current_date = date("Y-m-d");
	$datetime1 = date_create($current_date);
	$content = "";
	
	# SQL to fetch dates and titles of all events, if getting result the while function is executed process recived data
	$sql = "SELECT c.title AS Event_Title, d.field_event_date_value AS Event_Date FROM node__field_event_date d INNER JOIN node_field_data c ON c.nid = d.entity_id order by d.field_event_date_value desc;";
	$result = db_query($sql)->fetchAll();
	
	if (!empty($result)) {		
		foreach($result as $value){
			
			$datetime2 = date_create(date("Y-m-d", strtotime($value->Event_Date)));
			$interval = date_diff($datetime1, $datetime2);
			$day_diff = $interval->format("%R%a");
			
			/* Creating content to return in block
			*	Event logic:
			*	- Event in future display: 12 days left until event starts.
			*	- Event in past display: This event already passed.
			*	- Event happening today display: This event is happening today.
			*/
			if ($day_diff == 0){
				$content .= "<h1>" . $value->Event_Title . " </h1> <p>Date: " . $value->Event_Date . "</p><p>This event is happening today</p><hr/>";
			} else if ($day_diff < 0) {
				$content .= "<h1>" . $value->Event_Title . "</h1> <p>Date: " . $value->Event_Date . "</p><p> This event already passed.</h4><p><hr/>";
			} else if ($day_diff > 0) {
				$content .= "<h1>" . $value->Event_Title . "</h1> <p>Date: " . $value->Event_Date . "</p><p>" . $day_diff . " days left until event starts</p><hr/>";
			}
		}
	} else {
		$content = "There is not event information available!";
	}
	
    return [
	  '#title' => 'Events Status',
      '#markup' => t($content),
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
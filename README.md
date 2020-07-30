# AgileDropPhp - Event Status
--------------------------------
DESCRIPTION
--------------------------------
Custom block which will be displayed in the sidebar on event pages. The block is displaying how many days are left until the event starts, example: ‘12 days left until event starts’. If the event is going to happen on the current day display 'This event is happening today'. If the event has ended, display ‘This event already passed.’.


--------------------------------
VERSION
--------------------------------
- 1.1 
	- Module logic devided to display only on single event nodes 
	- Added new services DateCalculator
	- Install process updated
	
- 1.0 	
	- Date: 24.7.2020
	- Type: module
	- Dependencies: block
	- Core: 8.x
	- Cached: no
	- Input: none
	- Output: Content to display how many day are left until the events start. 
	- SQL Tables:
	   - node__field_event_date 'date'
	
	Output logic:<br />
	- Event in future display: 12 days left until event starts. 
	- Event in past display: This event already passed. 
	- Event happening today display: This event is happening today.
	
--------------------------------
INSTALL
--------------------------------
- Source the repositroy to pc and copy folder "events_status" to drupal location "core/modules/custom", if custom folder doesn't exists create it
- Nagivate to Administration -> Extend install module Events Status under Custom category
- After successful installation navigate to Administration -> Structure -> Block Layout and add block to desired location and define to display only on event content type
- Events content will display in single event node block
